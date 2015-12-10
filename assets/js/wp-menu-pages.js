(function ($) {
    /**
     *
     * @param context
     * @constructor
     */
    var WpMenuPages = function (context) {
        this.context = context;

        this.ctrlSaveBtnSelector = '.btn-save-options';
        this.ctrlResetBtnSelector = '.btn-reset-options';
        this.ctrlTabResetBtnSelector = '.btn-tab-reset-options';
        this.ctrlExportOptsSelector = '.btn-export-options';
        this.ctrlImportOptsSelector = '.btn-import-options';

        this.$activeTab = $('.tab-pane.active');
        var $wpMenuPages = this;
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var $target = $(e.target);
            $wpMenuPages.$activeTab = $($target.attr('href'));
            $wpMenuPages.updateCoreOptions({activeTab: $target.data('title')});
            // FIXME We have to reconstruct select2 each time because if rendered while hidden then no width and height are taking weird values
            $wpMenuPages.bindSelect2();
        });

        this.ajaxUrl = ajaxurl;

        this.actionPrefix = 'wp-menu-pages-';
        this.actionSavePrefix = this.actionPrefix + 'save-options-';
        this.actionResetPrefix = this.actionPrefix + 'reset-options-';
        this.actionExportPrefix = this.actionPrefix + 'export-options-';
        this.actionImportPrefix = this.actionPrefix + 'import-options-';
        this.actionUpdateCoreOptionsPrefix = this.actionPrefix + 'update-core-options-';

        this.alertsWrapperSelector = '.alerts-wrapper';
        this.$alertsWrapper = $(this.alertsWrapperSelector);
        this.alertTemplate =
            '<div class="alert alert-{{type}} alert-dismissible fade" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
            '<span aria-hidden="true">&times;</span> </button>' +
            '{{msg}}' +
            '</div>';
        this.inputHelpBlockTemplate = '<span id="{{id}}" class="help-block">{{msg}}</span>';
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getSaveBtn = function () {
        return $(this.ctrlSaveBtnSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getResetBtn = function () {
        return $(this.ctrlResetBtnSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getTabResetBtn = function () {
        return $(this.ctrlTabResetBtnSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getExportBtn = function () {
        return $(this.ctrlExportOptsSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getImportBtn = function () {
        return $(this.ctrlImportOptsSelector);
    };

    /**
     * Performs a POST request to WordPress ajax handler
     *
     * @param data
     * @param complete
     * @param error
     * @param success
     */
    WpMenuPages.prototype.ajaxPost = function (data, complete, error, success) {
        $.ajax({
            url: this.ajaxUrl,
            method: 'POST',
            data: data,
            success: success,
            complete: complete,
            error: error,
            dataType: 'json'
        });
    };
    /**
     * Displays an alert in the alert-wrapper of the page
     * @param msg The actual message
     * @param type The type of the alert. See bootstrap alerts
     */
    WpMenuPages.prototype.alert = function (msg, type) {
        var $alert = $(this.getAlertMarkUp(msg, type));
        this.$alertsWrapper.append($alert);
        $alert.fadeTo('fast', 1).addClass('in');
    };
    /**
     * Return the markup of an alert
     * @param msg The actual message
     * @param type The type of the alert. See bootstrap alerts
     * @returns {string}
     */
    WpMenuPages.prototype.getAlertMarkUp = function (msg, type) {
        return this.alertTemplate.replace('{{type}}', type).replace('{{msg}}', msg);
    };
    /**
     * Get options from active tab serialized
     * @returns {*}
     */
    WpMenuPages.prototype.getActiveTabOptions = function () {
        var $form = this.$activeTab.find('form');
        return $form.serialize();// TODO Implement
    };
    /**
     * Adds loading apperance to $element
     * @param $element string|jQuery
     * @param state bool
     * @param disable bool
     */
    WpMenuPages.prototype.loading = function ($element, state, disable) {
        if (!($element instanceof jQuery)) {
            $element = $($element);
        }

        var $icon = $element.find('i');

        if (state) {
            // start loading
            $icon.addClass('loading');
            if (disable) {
                $element.attr('disabled', 'disabled');
            }
            return;
        }
        // stop loading
        $icon.removeClass('loading');
        $element.attr('disabled', false);
    };

    WpMenuPages.prototype.bindSelect2 = function () {
        $('.select2').each(function () {
            var $input = $(this);
            if ($input.data('select2')) {
                $input.select2("destroy");
            }
            var options = $input.data();
            $input.select2(options);
        });
    };

    WpMenuPages.prototype.markFieldInvalid = function ($field, errors) {
        if(errors.length == 0 || !$field || $field.length == undefined || $field.length == 0){
            return;
        }
        var error = errors.join('<br />');
        var helpBlockMarkUp = this.inputHelpBlockTemplate.replace('{{msg}}', error).replace('{{id}}', $field.attr('name')+'-error');

        var $formGroup = $field.closest('.form-group');
        $formGroup.addClass('has-error');

        $formGroup.find('.help-block').remove();

        $field.after(helpBlockMarkUp);
    };

    WpMenuPages.prototype.markFieldValid = function ($field) {
        if(!$field || $field.length == undefined || $field.length == 0){
            return;
        }

        var $formGroup = $field.closest('.form-group');
        $formGroup.removeClass('has-error');
        $formGroup.find('.help-block').remove();
    };
    WpMenuPages.prototype.getVisibleFieldByName = function (fieldName) {
        return this.$activeTab.find('[name="'+fieldName+'"]');
    };

    WpMenuPages.prototype.updateOptionsValue = function(newValues){
        if(newValues == undefined || newValues.length == 0){
            return [];
        }

        for(var fieldName in newValues){
            var $field = $('.wp-menu-pages-input[name="'+fieldName+'"]');
            var value = newValues[fieldName];

            if($field == undefined){
                continue;
            }

            if($field.is('input')){
                // handle different input types
            }else if($field.is('select')){
                // handle select-one and select-multiple
                $field.val(value);
            }else if($field.is('textarea')){
                // handle textarea fields
                $field.val(value);
            }
        }
    };

    /**
     * Saves the options defined by newOptions. This needs a nonce in order to work.
     *
     * @param newOptions
     */
    WpMenuPages.prototype.saveOptions = function (newOptions) {
        var action = this.actionSavePrefix + this.context;
        var data = {
            'options': newOptions,
            'action': action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        var $wpMenuPages = this;

        this.loading(this.getSaveBtn(), true, true);

        var success = function (response) {
            if (response.data != undefined && response.data.options != undefined) {
                var fields = response.data.options;
                for (var fieldName in fields) {
                    if (fields[fieldName].valid) {
                        $wpMenuPages.markFieldValid($wpMenuPages.getVisibleFieldByName(fieldName));
                        continue;
                    }

                    $wpMenuPages.markFieldInvalid(
                        $wpMenuPages.getVisibleFieldByName(fieldName),
                        fields[fieldName].errors
                    );
                }
            }

            if (response.success == undefined || response.success == false) {
                $wpMenuPages.alert('There was an error saving the options', 'danger');
                return false;
            }


            $wpMenuPages.alert('Options Saved!', 'success');
            return true;
        };
        var error = function () {
            $wpMenuPages.alert('There was an error saving the options', 'danger');
        };

        var complete = function () {
            $wpMenuPages.loading($wpMenuPages.getSaveBtn(), false);
        };

        this.ajaxPost(data, complete, error, success);
    };

    /**
     * Saves core options defined by newOptions. This needs a nonce in order to work.
     *
     * @param newOptions
     */
    WpMenuPages.prototype.updateCoreOptions = function (newOptions) {
        var action = this.actionUpdateCoreOptionsPrefix + this.context;
        var data = {
            'options': newOptions,
            'action': action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        this.ajaxPost(data);
    };

    /**
     * Resets options.
     *
     * If include is defined then only these options are reseted, if not then all options get their default value.
     *
     * @param include Serialized values of the options to reset
     */
    WpMenuPages.prototype.resetOptions = function (include) {
        var action = this.actionResetPrefix + this.context;
        var data = {
            'action': action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        if (include) {
            data.include = include;
        }

        var $wpMenuPages = this;

        this.loading(this.getResetBtn(), true, true);
        this.loading(this.getTabResetBtn(), true, true);

        var success = function (response) {
            if (response.success == undefined || response.success == false) {
                error(response);
                return false;
            }

            $wpMenuPages.alert('All Options Reseted to Defaults', 'success');
            // TODO Update options in tabs or reload page
            if(response.data != undefined && response.data.defaults != undefined){
                $wpMenuPages.updateOptionsValue(response.data.defaults);
            }

            return true;
        };

        var complete = function () {
            $wpMenuPages.loading($wpMenuPages.getResetBtn(), false);
            $wpMenuPages.loading($wpMenuPages.getTabResetBtn(), false);
        };

        var error = function () {
            $wpMenuPages.alert('There was an error reseting options', 'danger');
        };

        this.ajaxPost(data, complete, error, success);
    };
    /**
     * Resets options for active tab
     */
    WpMenuPages.prototype.activeTabResetOptions = function () {
        this.resetOptions(this.getActiveTabOptions());
    };
    WpMenuPages.prototype.exportOptions = function () {
    };
    WpMenuPages.prototype.importOptions = function () {
    };


    var wpMenuPages = new WpMenuPages(wpMenuPagesDefinitions.context);

    wpMenuPages.bindSelect2();

    wpMenuPages.getSaveBtn().click(function () {
        wpMenuPages.saveOptions(wpMenuPages.getActiveTabOptions(), $(this).data('nonce'));
    });

    wpMenuPages.getResetBtn().click(function () {
        wpMenuPages.resetOptions();
    });

    wpMenuPages.getTabResetBtn().click(function () {
        wpMenuPages.activeTabResetOptions();
    });


    wpMenuPages.getExportBtn().click(function () {
    });
    wpMenuPages.getImportBtn().click(function () {
    });

    $("[rel='tooltip']").tooltip();
})(jQuery);