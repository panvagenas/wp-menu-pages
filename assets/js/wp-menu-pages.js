(function($){
    console.log(wpMenuPagesDefinitions);
    var WpMenuPages = function(context){
        this.context = context;

        this.ctrllSaveBtnSelector = '.btn-save-options';
        this.ctrllResetBtnSelector = '.btn-reset-options';
        this.ctrlExportOptsSelector = '.btn-export-options';
        this.ctrlImportOptsSelector = '.btn-import-options';

        this.$activeTab = jQuery('.tab-pane.active');
        var $wpMenuPages = this;
        jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $wpMenuPages.$activeTab = jQuery(jQuery(e.target).attr('href'));
        });

        this.ajaxUrl = ajaxurl;

        this.actionPrefix = 'wp-menu-pages-';
        this.actionSavePrefix = this.actionPrefix+'save-options-';
        this.actionResetPrefix = this.actionPrefix+'reset-options-';
        this.actionExportPrefix = this.actionPrefix+'export-options-';
        this.actionImportPrefix = this.actionPrefix+'import-options-';

        this.alertsWrapperSelector = '.alerts-wrapper';
        this.$alertsWrapper = $(this.alertsWrapperSelector);
        this.alertTemplate =
            '<div class="alert alert-{{type}} alert-dismissible fade" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
            '<span aria-hidden="true">&times;</span> </button>' +
            '{{msg}}' +
            '</div>';
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getSaveBtn = function(){
        return $(this.ctrllSaveBtnSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getResetBtn = function(){
        return $(this.ctrllResetBtnSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getExportBtn = function(){
        return $(this.ctrlExportOptsSelector);
    };
    /**
     *
     * @returns {*|HTMLElement}
     */
    WpMenuPages.prototype.getImportBtn = function(){
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
    WpMenuPages.prototype.ajaxPost = function(data, complete, error, success){
        $.ajax({
            url: this.ajaxUrl,
            method: 'POST',
            data: data,
            success: success,
            complete: complete,
            error: error,
            dataType: 'json',
        });
    };
    /**
     * Displays an alert in the alert-wrapper of the page
     * @param msg The actual message
     * @param type The type of the alert. See bootstrap alerts
     */
    WpMenuPages.prototype.alert = function(msg, type){
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
    WpMenuPages.prototype.getAlertMarkUp = function(msg, type){
        return this.alertTemplate.replace('{{type}}', type).replace('{{msg}}', msg);
    };
    /**
     * Get options from active tab serialized
     * @returns {*}
     */
    WpMenuPages.prototype.getActiveTabOptions = function(){
        var $form = this.$activeTab.find('form');
        return $form.serialize();// TODO Implement
    };
    /**
     * Adds loading apperance to $element
     * @param string|jQuery $element
     * @param bool state
     * @param bool disable
     */
    WpMenuPages.prototype.loading = function($element, state, disable){
        if(!($element instanceof jQuery)){
            $element = $($element);
        }

        $icon = $element.find('i');

        if(state){
            // start loading
            $icon.addClass('loading');
            if(disable){
                $element.attr('disabled', 'disabled');
            }
            return;
        }
        // stop loading
        $icon.removeClass('loading');
        $element.attr('disabled', false);
    }

    /**
     * Saves the options defined by newOptions. This needs a nonce in order to work.
     *
     * @param newOptions
     * @param ajaxNonce
     */
    WpMenuPages.prototype.saveOptions = function(newOptions, ajaxNonce){
        var action = this.actionSavePrefix + this.context;
        var data = {
            'options': newOptions,
            'action' : action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        var $wpMenuPages = this;

        this.loading(this.getSaveBtn(), true, true);

        var success = function(response){
            if(response.success == undefined || response.success == false){
                error(response);
                return false;
            }

            $wpMenuPages.alert('Options Saved!', 'success');
            return true;
        };
        var error = function(response){
            $wpMenuPages.alert('There was an error saving the options', 'danger');
        }

        var complete = function(response){
            $wpMenuPages.loading($wpMenuPages.getSaveBtn(), false);
        }

        this.ajaxPost(data, complete, error, success);
    };
    ;
    /**
     * Resets all options to defaults
     */
    WpMenuPages.prototype.resetOptions = function(){
        var action = this.actionResetPrefix + this.context;
        var data = {
            'action' : action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        var $wpMenuPages = this;

        this.loading(this.getResetBtn(), true, true);

        var success = function(response){
            if(response.success == undefined || response.success == false){
                error(response);
                return false;
            }

            $wpMenuPages.alert('All Options Reseted to Defaults', 'success');
            // TODO Update options in tabs or reload page

            return true;
        };

        var complete = function(response){
            $wpMenuPages.loading($wpMenuPages.getResetBtn(), false);
        }

        var error = function(response){
            $wpMenuPages.alert('There was an error reseting options', 'danger');
        }

        this.ajaxPost(data, complete, error, success);
    };
    WpMenuPages.prototype.tabResetOptions = function($tabName){};
    WpMenuPages.prototype.exportOptions = function(){};
    WpMenuPages.prototype.importOptions = function(){};
    WpMenuPages.prototype.getDefaultOptions = function(newOptions){};


    var wpMenuPages = new WpMenuPages(wpMenuPagesDefinitions.context);

    $('.select2').each(function(){
        var $input = $(this);
        var options = $input.data();
        $input.select2(options);
    });

    wpMenuPages.getSaveBtn().click(function(){
        wpMenuPages.saveOptions(wpMenuPages.getActiveTabOptions(), $(this).data('nonce'));
    });

    wpMenuPages.getResetBtn().click(function(){
        wpMenuPages.resetOptions();
    });

    wpMenuPages.getExportBtn().click(function(){});
    wpMenuPages.getImportBtn().click(function(){});

    $("[rel='tooltip']").tooltip();
})(jQuery);