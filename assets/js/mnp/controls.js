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
        }
    };
})