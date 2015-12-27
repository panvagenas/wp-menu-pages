define(['jquery', 'mnp/domSelector'], function ($, domSelector) {
    return {
        loadingClass: 'loading',

        loading: function($element, state, disable){
            if (!($element instanceof jQuery)) {
                $element = $($element);
            }

            var $icon = $element.find('i');

            if (state) {
                // start loading
                $icon.addClass(this.loadingClass);
                if (disable) {
                    $element.attr('disabled', 'disabled');
                }
                return;
            }
            // stop loading
            $icon.removeClass('loading');
            $element.attr('disabled', false);
        },

        bindControls: function(){
            // TODO not a proper place for all these bindings

            domSelector.getSaveBtn().click(function(e){
                e.preventDefault();
                require(['mnp/ajax', 'mnp/form'], function(ajax, form){
                    ajax.saveOptions(form.getActiveTabOptions());
                })
            });

            domSelector.getResetBtn().click(function(e){
                e.preventDefault();
                require(['mnp/ajax'], function(ajax){
                    ajax.resetOptions();
                })
            });

            domSelector.getTabResetBtn().click(function(e){
                e.preventDefault();
                require(['mnp/ajax', 'mnp/form'], function(ajax, form){
                    ajax.resetOptions(form.getActiveTabOptions());
                })
            });

            domSelector.getExportBtn().click(function (e) {
                e.preventDefault();
                require(['mnp/ajax'], function(ajax){
                    ajax.exportOptions();
                })
            });
            domSelector.getImportBtn().click(function (e) {
                e.preventDefault();
                $('#import-options-input').click();
            });

            $('#import-options-input').change(function (e) {
                e.preventDefault();

                var r = confirm("This will overwrite all current options.\nAre you sure you want to do that?");
                if(r != true){
                    return;
                }

                require(['mnp/helper', 'mnp/ajax'], function (helper, ajax) {
                    // TODO Implement
                    helper.readSingleFileAsText(e.originalEvent, function (e) {
                        try {
                            var newOptions = JSON.parse(e.target.result)
                            ajax.importOptions(newOptions);
                        } catch (error){
                            alert('There was an error reading options file:\n'+error.message)
                        }
                    })
                });
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var $target = $(e.target);
                var $source = $(e.relatedTarget);
                var newOptions = {
                    state: {
                        active: $target.data('title'),
                        inActive: $source.data('title')
                    }
                };

                // FIXME We have to reconstruct select2 each time because if rendered while hidden then width and height are taking wrong values
                require(['mnp/select2', 'mnp/ajax'], function(select2, ajax){
                    select2.maybeBindAll();
                    ajax.updateCoreOptions(newOptions);
                })
            });
        }
    };
})