/*!
 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date 2016-01-27
 * @copyright Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @preserve
 */
(function($){
    //noinspection JSUnresolvedVariable
    WpMenuPages = {
        context: wpMenuPagesDefinitions.context,
        actions: {},
        filters: {},
        do_action: function (hook) {
            var counter = 0;
            if (!WpMenuPages.actions.hasOwnProperty(hook) || WpMenuPages.actions[hook].length == 0) {
                return counter;
            }

            for (var c in WpMenuPages.actions[hook]) {
                if (!WpMenuPages.actions[hook].hasOwnProperty(c)
                    || !$.isFunction(WpMenuPages.actions[hook][c])) {
                    continue;
                }
                WpMenuPages.actions[hook][c].apply(WpMenuPages.actions[hook], Array.prototype.slice.call(arguments, 1));
                counter++;
            }

            return counter;
        },
        apply_filter: function (hook, value) {
            if (!WpMenuPages.filters.hasOwnProperty(hook) || WpMenuPages.filters[hook].length == 0) {
                return value;
            }

            for (var c in WpMenuPages.filters[hook]) {
                if (!WpMenuPages.filters[hook].hasOwnProperty(c)
                    || !$.isFunction(WpMenuPages.filters[hook][c])) {
                    continue;
                }
                value = WpMenuPages.filters[hook][c](value);
            }

            return value;
        },
        add_action: function (hook, callback) {
            if (!$.isFunction(callback)) {
                return false;
            }
            if (!WpMenuPages.actions.hasOwnProperty(hook)) {
                WpMenuPages.actions[hook] = []
            }

            return WpMenuPages.actions[hook].push(callback);
        },
        add_filter: function (hook, callback) {
            if (!$.isFunction(callback)) {
                return false;
            }
            if (!WpMenuPages.filters.hasOwnProperty(hook)) {
                WpMenuPages.filters[hook] = []
            }

            return WpMenuPages.filters[hook].push(callback);
        },
        $: jQuery,
        def: wpMenuPagesDefinitions,
        settings: {
            statesKey: 'state',
            pageOptionsKey: 'pageOptions',
            wpDateFormat: 'F j, Y',
            wpTimeFormat: 'g:i a',
            dateTimePicker: {
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    previous: 'fa fa-angle-left',
                    next: 'fa fa-angle-right',
                    today: 'fa fa-crosshairs',
                    clear: 'fa fa-trash-o',
                    close: 'fa fa-times'
                },
                dateFormat: 'YYYY-MM-DD',
                timeFormat: 'HH:mm:ss',
                weekFormat: 'ww',
                monthFormat: 'MM'
            }
        },
        init: function () {
            WpmControls.bind();
            WpmTab.bind();
            WpmSelect2.bindAll();
            WpmOptions.init();

            var $date = $('input.date');
            var $dateTime = $('input.datetime');
            var $month = $('input.month');
            var $time = $('input.time');

            $date.datetimepicker({
                format: WpMenuPages.settings.dateTimePicker.dateFormat,
                icons: WpMenuPages.settings.dateTimePicker.icons
            });
            $dateTime.datetimepicker({
                format: WpMenuPages.settings.dateTimePicker.dateFormat
                + ' ' + WpMenuPages.settings.dateTimePicker.timeFormat,
                icons: WpMenuPages.settings.dateTimePicker.icons
            });
            $month.datetimepicker({
                format: WpMenuPages.settings.dateTimePicker.monthFormat,
                icons: WpMenuPages.settings.dateTimePicker.icons
            });
            $time.datetimepicker({
                format: WpMenuPages.settings.dateTimePicker.timeFormat,
                icons: WpMenuPages.settings.dateTimePicker.icons
            });
        }
    };

    WpmOptions = {
        saved: wpMenuPagesDefinitions.options.options,
        defaults: wpMenuPagesDefinitions.options.defaults,
        baseName: wpMenuPagesDefinitions.options.baseName,
        whenLoaded: '',

        haveChanged: function(){
            var changed = false;
            WpmSelect.allFields().each(function(){
                var name = $(this).attr('name');
                var val = $(this).val();
                // TODO Not working properly
                if(WpmOptions.saved.hasOwnProperty(name) && WpmOptions.saved[name] != val){
                    changed = true;
                    return false;
                }
                return true;
            });

            return changed;
        },
        maybeWarn: function(){
            if(WpmOptions.haveChanged()){
                WpmOptions.addWarning();
            }
        },
        addWarning: function () {
            console.log('CCCC'+moment().format('SSS'))
        },
        init: function(){
            WpmSelect.allFields().change(WpmOptions.maybeWarn);
        }
    };

    WpmHelper = {
        isString: function (v) {
            return typeof v == 'string';
        },
        isJquery: function (v) {
            return v instanceof jQuery;
        },
        readSingleFileAsText: function (e, callback) {
            //Retrieve the first (and only!) File from the FileList object
            var file = e.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = callback;
                reader.readAsText(file);
            }

            return false;
        }
    };

    WpmAjax = {
        ajaxUrl: ajaxurl,
        actions: {
            def: wpMenuPagesDefinitions.actions,
            save: function () {
                return WpmAjax.actions.def.actionSavePrefix + WpMenuPages.context;
            },
            export: function () {
                return WpmAjax.actions.def.actionExportPrefix + WpMenuPages.context;
            },
            import: function () {
                return WpmAjax.actions.def.actionImportPrefix + WpMenuPages.context;
            },
            reset: function () {
                return WpmAjax.actions.def.actionResetPrefix + WpMenuPages.context;
            },
            updateCoreOptions: function () {
                return WpmAjax.actions.def.actionUpdateCoreOptionsPrefix + WpMenuPages.context;
            }
        },
        nonce: {
            def: wpMenuPagesDefinitions.nonce,
            save: function () {
                return WpmAjax.nonce.def[WpmAjax.actions.save()];
            },
            export: function () {
                return WpmAjax.nonce.def[WpmAjax.actions.export()];
            },
            import: function () {
                return WpmAjax.nonce.def[WpmAjax.actions.import()];
            },
            reset: function () {
                return WpmAjax.nonce.def[WpmAjax.actions.reset()];
            },
            updateCoreOptions: function () {
                return WpmAjax.nonce.def[WpmAjax.actions.updateCoreOptions()];
            }
        },
        post: function (data, complete, error, success, dataType) {
            $.ajax({
                url: WpmAjax.ajaxUrl,
                method: 'POST',
                data: data,
                success: success,
                complete: complete,
                error: error,
                dataType: dataType ? dataType : 'json'
            });
        },
        save: function (newOptions, complete, error, success, dataType) {
            if (newOptions.length == 0) {
                WpMenuPages.do_action('WpmAjax::save::empty');
                return;
            }
            var data = {
                options: newOptions,
                action: WpmAjax.actions.save(),
                nonce: WpmAjax.nonce.save()
            };

            function c(response) {
                WpMenuPages.do_action('WpmAjax::save::complete:before', response, dataType);
                $.isFunction(complete) && complete(response);
                WpMenuPages.do_action('WpmAjax::save::complete:after', response, dataType);
            }

            function e(response) {
                WpMenuPages.do_action('WpmAjax::save::error:before', response, dataType);
                $.isFunction(error) && error(response);
                WpMenuPages.do_action('WpmAjax::save::error:after', response, dataType);
            }

            function s(response) {
                WpMenuPages.do_action('WpmAjax::save::success:before', response, dataType);
                $.isFunction(success) && success(response);
                WpMenuPages.do_action('WpmAjax::save::success:after', response, dataType);
            }

            WpmAjax.post(data, c, e, s, dataType);
        },
        export: function (complete, error, success, dataType) {
            var data = {
                action: WpmAjax.actions.export(),
                nonce: WpmAjax.nonce.export()
            };

            function c(response) {
                WpMenuPages.do_action('WpmAjax::export::complete:before', response, dataType);
                $.isFunction(complete) && complete(response);
                WpMenuPages.do_action('WpmAjax::export::complete:after', response, dataType);
            }

            function e(response) {
                WpMenuPages.do_action('WpmAjax::export::error:before', response, dataType);
                $.isFunction(error) && error(response);
                WpMenuPages.do_action('WpmAjax::export::error:after', response, dataType);
            }

            function s(response) {
                WpMenuPages.do_action('WpmAjax::export::success:before', response, dataType);
                $.isFunction(success) && success(response);
                WpMenuPages.do_action('WpmAjax::export::success:after', response, dataType);
            }

            WpmAjax.post(data, c, e, s, dataType);
        },
        import: function (newOptions, complete, error, success, dataType) {
            if (newOptions.length == 0) {
                WpMenuPages.do_action('WpmAjax::import::empty');
                return;
            }

            var data = {
                options: newOptions,
                action: WpmAjax.actions.import(),
                nonce: WpmAjax.nonce.import()
            };

            function c(response) {
                WpMenuPages.do_action('WpmAjax::import::complete:before', response, dataType);
                $.isFunction(complete) && complete(response);
                WpMenuPages.do_action('WpmAjax::import::complete:after', response, dataType);
            }

            function e(response) {
                WpMenuPages.do_action('WpmAjax::import::error:before', response, dataType);
                $.isFunction(error) && error(response);
                WpMenuPages.do_action('WpmAjax::import::error:after', response, dataType);
            }

            function s(response) {
                WpMenuPages.do_action('WpmAjax::import::success:before', response, dataType);
                $.isFunction(success) && success(response);
                WpMenuPages.do_action('WpmAjax::import::success:after', response, dataType);
            }

            WpmAjax.post(data, c, e, s, dataType);
        },
        reset: function (fieldNames, complete, error, success, dataType) {
            if (fieldNames.length == 0) {
                WpMenuPages.do_action('WpmAjax::reset::empty');
                return;
            }

            var data = {
                fieldNames: fieldNames,
                action: WpmAjax.actions.reset(),
                nonce: WpmAjax.nonce.reset()
            };

            function c(response) {
                WpMenuPages.do_action('WpmAjax::reset::complete:before', response, dataType);
                $.isFunction(complete) && complete(response);
                WpMenuPages.do_action('WpmAjax::reset::complete:after', response, dataType);
            }

            function e(response) {
                WpMenuPages.do_action('WpmAjax::reset::error:before', response, dataType);
                $.isFunction(error) && error(response);
                WpMenuPages.do_action('WpmAjax::reset::error:after', response, dataType);
            }

            function s(response) {
                WpMenuPages.do_action('WpmAjax::reset::success:before', response, dataType);
                $.isFunction(success) && success(response);
                WpMenuPages.do_action('WpmAjax::reset::success:after', response, dataType);
            }

            WpmAjax.post(data, c, e, s, dataType);
        },
        updateCoreOptions: function (newOptions, complete, error, success, dataType) {
            var data = {
                options: newOptions,
                action: WpmAjax.actions.updateCoreOptions(),
                nonce: WpmAjax.nonce.updateCoreOptions()
            };

            function c(response) {
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::complete:before', response, dataType);
                $.isFunction(complete) && complete(response);
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::complete:after', response, dataType);
            }

            function e(response) {
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::error:before', response, dataType);
                $.isFunction(error) && error(response);
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::error:after', response, dataType);
            }

            function s(response) {
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::success:before', response, dataType);
                $.isFunction(success) && success(response);
                WpMenuPages.do_action('WpmAjax::updateCoreOptions::success:after', response, dataType);
            }

            WpmAjax.post(data, c, e, s, dataType);
        }
    };

    WpmAlerts = {
        TYPE_SUCCESS: 'success',
        TYPE_INFO: 'info',
        TYPE_WARNING: 'warning',
        TYPE_DANGER: 'danger',

        alertsWrapperSelector: '.alerts-wrapper',

        alertTemplate: '<div class="alert alert-{{type}} alert-dismissible fade in" ' +
        'role="alert" style="display: none;">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
        '<span aria-hidden="true">&times;</span> </button>' +
        '{{msg}}' +
        '</div>',

        getAlertTemplate: function () {
            return WpMenuPages.apply_filter('WpmAlerts::alertTemplate', WpmAlerts.alertTemplate);
        },

        getAlertsWrapperSelector: function(){
            return WpMenuPages.apply_filter('WpmAlerts::alertsWrapperSelector', WpmAlerts.alertsWrapperSelector);
        },

        alert: function (type, msg, timeout) {
            var $alert = $(WpmAlerts.getAlertMarkUp(msg, type));
            $(WpmAlerts.getAlertsWrapperSelector()).append($alert);
            $alert.slideDown('fast');
            if (timeout) {
                setTimeout(function () {
                    $alert.slideUp(function () {
                        $alert.remove()
                    })
                }, timeout);
            }
            $alert.alert();
        },

        success: function (msg, timeout) {
            WpmAlerts.alert(WpmAlerts.TYPE_SUCCESS, msg, timeout);
        },
        info: function (msg, timeout) {
            WpmAlerts.alert(WpmAlerts.TYPE_INFO, msg, timeout);
        },
        warning: function (msg, timeout) {
            WpmAlerts.alert(WpmAlerts.TYPE_WARNING, msg, timeout);
        },
        danger: function (msg, timeout) {
            WpmAlerts.alert(WpmAlerts.TYPE_DANGER, msg, timeout);
        },
        getAlertMarkUp: function (msg, type) {
            return WpmAlerts.getAlertTemplate().replace('{{type}}', type).replace('{{msg}}', msg);
        }
    };

    WpmControls = {
        loadingClass: 'loading',
        importOptionsInputSelector: '#import-options-input',
        $: jQuery,

        loading: function ($element, state, disable) {
            $element = WpmSelect.getJqueryInstance($element);

            if (state) {
                // start loading
                $element.addClass(WpmControls.loadingClass);
                if (disable) {
                    $element.attr('disabled', 'disabled');
                }
                return;
            }
            // stop loading
            $element.removeClass('loading');
            $element.attr('disabled', false);
        },
        startLoading: function ($element, disable) {
            WpmControls.loading($element, true, disable);
        },
        endLoading: function ($element, disable) {
            WpmControls.loading($element, false, disable);
        },
        saveTab: function (ev) {
            ev.preventDefault();

            var newOptions = WpmForm.getOptionsFromActiveTab();

            WpmControls.startLoading(WpmSelect.saveBtn(), true);

            var s = function(response){
                if (response.data != undefined && response.data.options != undefined) {
                    var fields = response.data.options;
                    for (var fieldName in fields) {
                        if (!fields.hasOwnProperty(fieldName)) {
                            continue;
                        }

                        if (fields[fieldName].valid) {
                            WpmField.markValid(fieldName);
                            continue;
                        }

                        WpmField.markInvalid(fieldName, fields[fieldName].errors);
                    }
                }

                if (response.success == undefined || response.success == false) {
                    WpmAlerts.danger('There was an error saving the options');
                    return false;
                }

                WpmAlerts.success('Options Saved!', 2000);
                return true;
            };

            var e = function () {
                WpmAlerts.danger('There was an error saving the options');
            };

            var c = function () {
                WpmControls.endLoading(WpmSelect.saveBtn(), true);
            };

            WpmAjax.save(newOptions, c, e, s, 'json');
        },
        resetTab: function (ev) {
            WpmControls.resetOptions(ev, WpmForm.getOptionsFromActiveTab());
        },
        resetOptions: function (ev, include) {
            ev.preventDefault();

            if(!WpmHelper.isString(include)){
                include = '';
            }

            WpmControls.startLoading(WpmSelect.resetBtn(), true);
            WpmControls.startLoading(WpmSelect.resetTabBtn(), true);

            var success = function (response) {
                if (response.success == undefined || response.success == false) {
                    error(response);
                    return false;
                }

                WpmAlerts.success('All Options Have Been Reset to Defaults', 2000);
                if (response.data != undefined && response.data.defaults != undefined) {
                    WpmField.updateValues(response.data.defaults);
                }

                return true;
            };

            var complete = function () {
                WpmControls.endLoading(WpmSelect.resetBtn(), true);
                WpmControls.endLoading(WpmSelect.resetTabBtn(), true);
            };

            var error = function () {
                WpmAlerts.danger('There was an error reseting options');
            };

            WpmAjax.reset(include, complete, error, success, 'json');
        },
        saveOptions: function (ev) {
            // TODO Implement
        },
        exportOptions: function (ev) {
            ev.preventDefault();

            WpmControls.startLoading(WpmSelect.exportBtn(), true);

            var success = function (response) {
                if (response.success == undefined || response.success == false) {
                    error(response);
                    return false;
                }

                var blob = new Blob([response.data.options], {
                    type: "application/json;charset=utf-8;"
                });
                saveAs(blob, response.data.name + '.json');

                return true;
            };

            var complete = function () {
                WpmControls.endLoading(WpmSelect.exportBtn(), true);
            };

            var error = function () {
                WpmAlerts.danger('There was an error while trying to prepare your download');
            };

            WpmAjax.export(complete, error, success, 'json');
        },
        importOptions: function (ev) {
            ev.preventDefault();

            var r = confirm("This will overwrite all current options.\nAre you sure you want to do that?");
            if (r != true) {
                return;
            }

            WpmControls.startLoading(WpmSelect.allControls(), true);

            var success = function (response) {
                if (response.success == undefined || response.success == false) {
                    error(response);
                    return false;
                }

                WpmAlerts.success('Options Import Successful', 2000);
                if (response.data != undefined && response.data.options != undefined) {
                    WpmField.updateValues(response.data.options);
                }

                return true;
            };

            var complete = function () {
                WpmControls.endLoading(WpmSelect.allControls(), true);
            };

            var error = function () {
                WpmAlerts.danger('There was an error while importing options');
                WpmControls.endLoading(WpmSelect.allControls(), true);
            };

            WpmHelper.readSingleFileAsText(ev.originalEvent, function (e) {
                try {
                    var newOptions = JSON.parse(e.target.result);
                    WpmAjax.import(newOptions, complete, error, success, 'json');
                } catch (error) {
                    alert('There was an error reading options file:\n' + error.message);
                    WpmControls.endLoading(WpmSelect.allControls(), true);
                }
            });
        },
        bind: function () {
            // TODO Implement saveBtn
            WpmSelect.saveBtn().click(WpmControls.saveOptions);
            WpmSelect.saveTabBtn().click(WpmControls.saveTab);
            WpmSelect.resetBtn().click(WpmControls.resetOptions);
            WpmSelect.resetTabBtn().click(WpmControls.resetTab);
            WpmSelect.exportBtn().click(WpmControls.exportOptions);
            WpmSelect.importBtn().click(function(e){
                e.preventDefault();
                $(WpmControls.importOptionsInputSelector).click();
            });
            $(WpmControls.importOptionsInputSelector).change(WpmControls.importOptions);
        }
    };

    WpmField = {
        inputHasErrorClass: 'has-error',
        inputStandardClass: 'wp-menu-pages-input',
        helpBlockErrorSelector: '.help-block.input-error',

        markInvalid: function ($field, errors) {
            $field = WpmHelper.isString($field) ? WpmField.getByName($field, false) : $field;

            if (errors == undefined || errors.length == 0 || !$field
                || $field.length == undefined || $field.length == 0) {
                return;
            }

            var error = errors.join('<br />');

            var helpBlockMarkUp = WpmField.getHelpBlockTemplate()
                .replace('{{msg}}', error)
                .replace('{{id}}', $field.attr('name') + '-error');

            var $formGroup = $field.closest('.form-group');
            $formGroup.addClass(WpmField.inputHasErrorClass);

            $formGroup.find(WpmField.helpBlockErrorSelector).remove();

            $field.after(helpBlockMarkUp);
        },
        markValid: function ($field) {
            $field = WpmHelper.isString($field) ? WpmField.getByName($field, false) : $field;

            if (!$field || $field.length == undefined || $field.length == 0) {
                return;
            }

            var $formGroup = $field.closest('.form-group');
            $formGroup.removeClass(WpmField.inputHasErrorClass);
            $formGroup.find(WpmField.helpBlockErrorSelector).remove();
        },
        getByName: function (fieldName, fromActiveTab) {
            fromActiveTab = fromActiveTab == undefined;
            var context = fromActiveTab ? WpmTab.activeTab() : $('.wp-menu-pages-ns');
            return context.find('.' + WpmField.inputStandardClass + '#' + fieldName);
        },
        updateValues: function (newValues) {
            if (newValues == undefined || newValues.length == 0) {
                return [];
            }

            for (var fieldName in newValues) {
                if (!newValues.hasOwnProperty(fieldName)) {
                    continue;
                }
                var value = newValues[fieldName];

                var $field = WpmField.getByName(fieldName, false);

                if ($field == undefined || $field.length == 0) {
                    continue;
                }

                if ($field.attr('type') == 'radio') {
                    WpmField.updateRadioValue(fieldName, value);
                } else {
                    $field.val(value);
                }

                $field.trigger('change');
            }
        },
        updateRadioValue: function (fieldName, value) {
            $('#' + fieldName + '[value="' + value + '"]').parent().button('toggle');
        },
        isSelect2: function ($field) {
            $field = WpmHelper.isJquery($field) ? $field : WpmField.getByName($field, false);

            if ($field && $field.length > 0) {
                return $field.is(WpmSelect.select2Selector);
            }

            return false;
        },
        getHelpBlockTemplate: function(){
            return '<span id="{{id}}" class="help-block input-error">{{msg}}</span>';
        }
    };

    WpmForm = {
        getOptions: function ($form) {
            // FIXME Doesn't get empty multi-select
            $form = WpmSelect.getJqueryInstance($form);
            return $form.serialize();
        },
        getOptionsFromActiveTab: function () {
            return WpmForm.getOptions(WpmTab.activeTab());
        }
    };

    WpmSelect = {
        $: jQuery,
        ctrlSaveBtnSelector: '.btn-save-options',
        ctrlSaveAllBtnSelector: '.btn-save-options',
        ctrlResetBtnSelector: '.btn-reset-options',
        ctrlTabResetBtnSelector: '.btn-tab-reset-options',
        ctrlExportOptsSelector: '.btn-export-options',
        ctrlImportOptsSelector: '.btn-import-options',
        ctrlAllControlsSelector: '.wp-menu-pages-control',
        activeTabSelector: '.tab-pane.active',
        select2Selector: '.select2.wp-menu-pages-input',
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        activeTab: function () {
            return $(WpmSelect.activeTabSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        saveBtn: function () {
            return $(WpmSelect.ctrlSaveBtnSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        saveTabBtn: function () {
            return $(WpmSelect.ctrlSaveBtnSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        resetBtn: function () {
            return $(WpmSelect.ctrlResetBtnSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        resetTabBtn: function () {
            return $(WpmSelect.ctrlTabResetBtnSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        exportBtn: function () {
            return $(WpmSelect.ctrlExportOptsSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        importBtn: function () {
            return $(WpmSelect.ctrlImportOptsSelector);
        },
        /**
         *
         * @returns {*|jQuery|HTMLElement}
         */
        allControls: function () {
            return $(WpmSelect.ctrlAllControlsSelector);
        },
        getJqueryInstance: function (v) {
            if (WpmHelper.isJquery(v)) {
                return v;
            }
            if (WpmHelper.isString(v)) {
                return $(v);
            }
            return $();
        },
        allFields: function(){
            return $('.'+WpmField.inputStandardClass);
        }
    };

    WpmTab = {
        activeTab: function () {
            return WpmSelect.activeTab().find('form');
        },
        activate: function ($tab) {
            // TODO Implement
        },
        shownBsTab: function(e){
            var $target = $(e.target);
            var $source = $(e.relatedTarget);
            var newOptions = {
                state: {
                    active: $target.data('title'),
                    inActive: $source.data('title')
                }
            };

            // FIXME We have to reconstruct select2 each time because if rendered while
            // hidden then width and height are taking wrong values
            WpmSelect2.maybeBindAll();
            WpmAjax.updateCoreOptions(newOptions);
        },
        bind: function(){
            $('a[data-toggle="tab"]').on('shown.bs.tab', WpmTab.shownBsTab)
        }
    };

    WpmSelect2 = {
        domSelector: '.select2.wp-menu-pages-input',
        count: function () {
            return WpmSelect2.getElements().length;
        },

        hasElements: function () {
            return WpmSelect2.count() > 0;
        },

        getElements: function () {
            return $(WpmSelect2.domSelector);
        },

        getElementOptions: function ($element) {
            var elName = $element.attr('id');
            if(wpMenuPagesDefinitions.select2.hasOwnProperty(elName)){
                return wpMenuPagesDefinitions.select2[elName]['options'];
            }
            return {};
        },

        isBinded: function ($element) {
            return $element.data('select2');
        },

        maybeUnbind: function ($element) {
            if (WpmSelect2.isBinded($element)) {
                //noinspection JSUnresolvedFunction
                $element.select2("destroy");
            }
        },

        bindAll: function () {
            var handler = this;
            handler.getElements().each(function () {
                var $element = $(this);

                handler.maybeUnbind($element);

                var options = handler.getElementOptions($element);
                $element.select2(options);
            });
        },

        maybeBindAll: function () {
            if (WpmSelect2.hasElements()) {
                WpmSelect2.bindAll();
            }
        },

        isSelect2: function (fieldName) {
            return WpmField.isSelect2(fieldName);
        }
    };

    $(document).ready(function(){
        WpMenuPages.init()
    })
})(jQuery);
