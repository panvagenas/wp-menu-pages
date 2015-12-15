define(['jquery', 'mnp/domSelector'], function ($, domSelector) {
    return {
        helpBlockClass: 'help-block',
        helpBlockTemplate: '<span id="{{id}}" class="help-block">{{msg}}</span>',
        inputHasErrorClass: 'has-error',
        inputStandartClass: 'wp-menu-pages-input',

        markInvalid: function($field, errors){
            if(typeof $field == 'string'){
                $field = this.getByName($field);
            }
            if ( errors == undefined || errors.length == 0 || !$field || $field.length == undefined || $field.length == 0) {
                return;
            }
            var error = errors.join('<br />');
            var helpBlockMarkUp = this.helpBlockTemplate
                .replace('{{msg}}', error)
                .replace('{{id}}', $field.attr('name') + '-error');

            var $formGroup = $field.closest('.form-group');
            $formGroup.addClass(this.inputHasErrorClass);

            $formGroup.find('.'+this.helpBlockClass).remove();

            $field.after(helpBlockMarkUp);
        },
        markValid: function($field){
            if(typeof $field == 'string'){
                $field = this.getByName($field);
            }

            if (!$field || $field.length == undefined || $field.length == 0) {
                return;
            }

            var $formGroup = $field.closest('.form-group');
            $formGroup.removeClass(this.inputHasErrorClass);
            $formGroup.find('.'+this.helpBlockClass).remove();
        },
        getByName: function(fieldName, fromActiveTab){
            fromActiveTab = fromActiveTab == undefined;
            var context = fromActiveTab ? domSelector.getActiveTab() : $('.wp-menu-pages-ns');
            return context.find('.'+this.inputStandartClass+'[name="' + fieldName + '"]');
        },
        updateValues: function(newValues){
            if ( newValues == undefined || newValues.length == 0) {
                return [];
            }

            for (var fieldName in newValues) {
                var value = newValues[fieldName];

                var $field = $('.'+this.inputStandartClass+'#' + fieldName);

                if ($field == undefined || $field.length == 0) {
                    continue;
                }

                if ($field.attr('type') == 'radio') {
                    require(['bootstrap/button'], function(button){
                        $('#'+fieldName+'[value="'+value+'"]').parent().button('toggle');
                    });
                    continue;
                }

                // FIXME Select2 not updating just by assigning new values to input

                $field.val(value);
            }
        }
    };
})