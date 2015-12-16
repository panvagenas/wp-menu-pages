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
            domSelector.getSaveBtn().click(function(){
                require(['mnp/ajax', 'mnp/form'], function(ajax, form){
                    ajax.saveOptions(form.getActiveTabOptions());
                })
            });

            domSelector.getResetBtn().click(function(){
                require(['mnp/ajax'], function(ajax){
                    ajax.resetOptions();
                })
            });

            domSelector.getTabResetBtn().click(function(){
                require(['mnp/ajax', 'mnp/form'], function(ajax, form){
                    ajax.resetOptions(form.getActiveTabOptions());
                })
            });

            domSelector.getExportBtn().click(function () {
                require(['mnp/ajax'], function(ajax){
                    ajax.exportOptions();
                })
            });
            domSelector.getImportBtn().click(function () {
                require(['dropzone'], function(dropzone){
                    // TODO Implement
                });
            });
        }
    };
})