define(['jquery', 'mnp/domSelector'], function ($, domSelector) {
    var helpBlockClass = 'help-block';
    var helpBlockErrorClass = 'input-error';
    var helpBlockErrorSelector = '.'+helpBlockClass+'.'+helpBlockErrorClass;
    return {
        helpBlockClass: helpBlockClass,
        helpBlockErrorClass: helpBlockErrorClass,
        helpBlockErrorSelector: helpBlockErrorSelector,
        helpBlockTemplate: '<span id="{{id}}" class="'+helpBlockClass+' '+helpBlockErrorClass+'">{{msg}}</span>',
        inputHasErrorClass: 'has-error',
        inputStandardClass: 'wp-menu-pages-input',

        markInvalid: function($field, errors){
            if(typeof $field == 'string'){
                $field = this.getByName($field, false);
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

            $formGroup.find(this.helpBlockErrorSelector).remove();

            $field.after(helpBlockMarkUp);
        },
        markValid: function($field){
            if(typeof $field == 'string'){
                $field = this.getByName($field, false);
            }

            if (!$field || $field.length == undefined || $field.length == 0) {
                return;
            }

            var $formGroup = $field.closest('.form-group');
            $formGroup.removeClass(this.inputHasErrorClass);
            $formGroup.find(this.helpBlockErrorSelector).remove();
        },
        getByName: function(fieldName, fromActiveTab){
            fromActiveTab = fromActiveTab == undefined;
            var context = fromActiveTab ? domSelector.getActiveTab() : $('.wp-menu-pages-ns');
            return context.find('.'+this.inputStandardClass+'#' + fieldName);
        },

        updateValues: function(newValues){
            if ( newValues == undefined || newValues.length == 0) {
                return [];
            }

            for (var fieldName in newValues) {
                var value = newValues[fieldName];

                var $field = this.getByName(fieldName, false);

                if ($field == undefined || $field.length == 0) {
                    continue;
                }

                if ($field.attr('type') == 'radio') {
                    this.updateRadioValue(fieldName, value);
                    continue;
                }

                $field.val(value);

                $field.trigger('change');
            }
        },

        updateRadioValue: function(name, value){
            require(['bootstrap/button'], function(){
                $('#'+name+'[value="'+value+'"]').parent().button('toggle');
            });
        },

        isSelect2: function(field){
            var $field = field instanceof jQuery ? field : this.getByName(field, false);
            if($field && $field.length > 0){
                return $field.is(domSelector.select2Selector);
            }

            return false;
        }
    };
})