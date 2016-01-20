(function ($) {
    /**
     * Object that holds lib settings and definitions.
     * An extension of wpMenuPages obj that comes from WordPress localize
     *
     * @type Object
     */
    wpMenuPages = $.extend(
        {
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
        }, wpMenuPages);

    /*******************************************************************************
     * helper module
     ******************************************************************************/
    /**
     * Helper obj
     *
     * @type Object
     */
    var helper = {
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

    /*******************************************************************************
     * domSelector module
     ******************************************************************************/
    /**
     *
     * @type Object
     */
    var domSelector = {
        ctrlSaveBtnSelector: '.btn-save-options',
        ctrlResetBtnSelector: '.btn-reset-options',
        ctrlTabResetBtnSelector: '.btn-tab-reset-options',
        ctrlExportOptsSelector: '.btn-export-options',
        ctrlImportOptsSelector: '.btn-import-options',
        ctrlAllControlsSelector: '.wp-menu-pages-control',
        activeTabSelector: '.tab-pane.active',
        select2Selector: '.select2.wp-menu-pages-input',

        getActiveTab: function () {
            return $(this.activeTabSelector);
        },

        getSaveBtn: function () {
            return $(this.ctrlSaveBtnSelector);
        },
        /**
         *
         * @returns {*|HTMLElement}
         */
        getResetBtn: function () {
            return $(this.ctrlResetBtnSelector);
        },
        /**
         *
         * @returns {*|HTMLElement}
         */
        getTabResetBtn: function () {
            return $(this.ctrlTabResetBtnSelector);
        },
        /**
         *
         * @returns {*|HTMLElement}
         */
        getExportBtn: function () {
            return $(this.ctrlExportOptsSelector);
        },
        /**
         *
         * @returns {*|HTMLElement}
         */
        getImportBtn: function () {
            return $(this.ctrlImportOptsSelector);
        },

        getAllControls: function () {
            return $(this.ctrlAllControlsSelector);
        }
    };

    /*******************************************************************************
     * form module
     ******************************************************************************/
    /**
     *
     * @type Object
     */
    var form = {
        getActiveTabOptions: function () {
            var $form = domSelector.getActiveTab().find('form');
            return $form.serialize();
        }
    };

    /*******************************************************************************
     * field module
     ******************************************************************************/
    var helpBlockClass = 'help-block';
    var helpBlockErrorClass = 'input-error';
    var helpBlockErrorSelector = '.' + helpBlockClass + '.' + helpBlockErrorClass;

    var field = {
        helpBlockClass: helpBlockClass,
        helpBlockErrorClass: helpBlockErrorClass,
        helpBlockErrorSelector: helpBlockErrorSelector,
        helpBlockTemplate: '<span id="{{id}}" class="' + helpBlockClass + ' ' + helpBlockErrorClass + '">' +
        '{{msg}}</span>',
        inputHasErrorClass: 'has-error',
        inputStandardClass: 'wp-menu-pages-input',

        markInvalid: function ($field, errors) {
            if (typeof $field == 'string') {
                $field = this.getByName($field, false);
            }
            if (errors == undefined || errors.length == 0 || !$field
                || $field.length == undefined || $field.length == 0) {
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
        markValid: function ($field) {
            if (typeof $field == 'string') {
                $field = this.getByName($field, false);
            }

            if (!$field || $field.length == undefined || $field.length == 0) {
                return;
            }

            var $formGroup = $field.closest('.form-group');
            $formGroup.removeClass(this.inputHasErrorClass);
            $formGroup.find(this.helpBlockErrorSelector).remove();
        },
        getByName: function (fieldName, fromActiveTab) {
            fromActiveTab = fromActiveTab == undefined;
            var context = fromActiveTab ? domSelector.getActiveTab() : $('.wp-menu-pages-ns');
            return context.find('.' + this.inputStandardClass + '#' + fieldName);
        },

        updateValues: function (newValues) {
            if (newValues == undefined || newValues.length == 0) {
                return [];
            }

            for (var fieldName in newValues) {
                if(!newValues.hasOwnProperty(fieldName)){
                    continue;
                }
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

        updateRadioValue: function (name, value) {
            $('#' + name + '[value="' + value + '"]').parent().button('toggle');
        },

        isSelect2: function (field) {
            var $field = field instanceof jQuery ? field : this.getByName(field, false);
            if ($field && $field.length > 0) {
                return $field.is(domSelector.select2Selector);
            }

            return false;
        }
    };

    /*******************************************************************************
     * select2Handler module
     ******************************************************************************/
    var select2Handler = {
        domSelector: '.select2.wp-menu-pages-input',
        count: function () {
            return this.getElements().length;
        },

        hasElements: function () {
            return this.count() > 0;
        },

        getElements: function () {
            return $(this.domSelector);
        },

        getElementOptions: function ($element) {
            return $element.data();
        },

        isBinded: function ($element) {
            return $element.data('select2');
        },

        maybeUnbind: function ($element) {
            if (this.isBinded($element)) {
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
            if (this.hasElements()) {
                this.bindAll();
            }
        },

        isSelect2: function (fieldName) {
            return field.isSelect2(fieldName);
        }
    };

    /*******************************************************************************
     * alert module
     ******************************************************************************/
    var alerts = {
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

        alert: function (type, msg, timeout) {
            var $alert = $(this.getAlertMarkUp(msg, type));
            $(this.alertsWrapperSelector).append($alert);
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
            this.alert(this.TYPE_SUCCESS, msg, timeout);
        },
        info: function (msg, timeout) {
            this.alert(this.TYPE_INFO, msg, timeout);
        },
        warning: function (msg, timeout) {
            this.alert(this.TYPE_WARNING, msg, timeout);
        },
        danger: function (msg, timeout) {
            this.alert(this.TYPE_DANGER, msg, timeout);
        },
        getAlertMarkUp: function (msg, type) {
            return this.alertTemplate.replace('{{type}}', type).replace('{{msg}}', msg);
        }
    };

    /*******************************************************************************
     * controls module
     ******************************************************************************/
    var controls = {
        loadingClass: 'loading',

        loading: function ($element, state, disable) {
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

        bindControls: function () {
            // TODO not a proper place for all these bindings

            domSelector.getSaveBtn().click(function (e) {
                e.preventDefault();
                ajax.saveOptions(form.getActiveTabOptions());
            });

            domSelector.getResetBtn().click(function (e) {
                e.preventDefault();
                ajax.resetOptions();
            });

            domSelector.getTabResetBtn().click(function (e) {
                e.preventDefault();
                ajax.resetOptions(form.getActiveTabOptions());
            });

            domSelector.getExportBtn().click(function (e) {
                e.preventDefault();
                ajax.exportOptions();
            });
            domSelector.getImportBtn().click(function (e) {
                e.preventDefault();
                $('#import-options-input').click();
            });

            $('#import-options-input').change(function (e) {
                e.preventDefault();

                var r = confirm("This will overwrite all current options.\nAre you sure you want to do that?");
                if (r != true) {
                    return;
                }

                helper.readSingleFileAsText(e.originalEvent, function (e) {
                    try {
                        var newOptions = JSON.parse(e.target.result);
                        ajax.importOptions(newOptions);
                    } catch (error) {
                        alert('There was an error reading options file:\n' + error.message)
                    }
                })
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

                // FIXME We have to reconstruct select2 each time because if rendered while
                // hidden then width and height are taking wrong values
                select2Handler.maybeBindAll();
                ajax.updateCoreOptions(newOptions);
            });
        }
    };

    /*******************************************************************************
     * ajax module
     ******************************************************************************/

    var ajax = {
        ajaxUrl: ajaxurl,
        context: wpMenuPages.context,

        post: function (data, complete, error, success, dataType) {
            $.ajax({
                url: this.ajaxUrl,
                method: 'POST',
                data: data,
                success: success,
                complete: complete,
                error: error,
                dataType: dataType ? dataType : 'json'
            });
        },

        saveOptions: function (newOptions) {
            var action = wpMenuPages.actionSavePrefix + this.context;
            var data = {
                options: newOptions,
                action: action,
                nonce: wpMenuPages.nonce[action]
            };

            controls.loading(domSelector.getSaveBtn(), true, true);

            var success = function (response) {
                if (response.data != undefined && response.data.options != undefined) {
                    var fields = response.data.options;
                    for (var fieldName in fields) {
                        if (!fields.hasOwnProperty(fieldName)) {
                            continue;
                        }

                        if (fields[fieldName].valid) {
                            field.markValid(fieldName);
                            continue;
                        }

                        field.markInvalid(fieldName, fields[fieldName].errors);
                    }
                }

                if (response.success == undefined || response.success == false) {
                    alerts.danger('There was an error saving the options');
                    return false;
                }


                alerts.success('Options Saved!', 2000);
                return true;
            };
            var error = function () {
                alerts.danger('There was an error saving the options');
            };

            var complete = function () {
                controls.loading(domSelector.getSaveBtn(), false);
            };

            this.post(data, complete, error, success);
        },

        exportOptions: function () {
            var action = wpMenuPages.actionExportPrefix + this.context;
            var data = {
                action: action,
                nonce: wpMenuPages.nonce[action]
            };

            controls.loading(domSelector.getExportBtn(), true, true);

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
                controls.loading(domSelector.getExportBtn(), false);
            };

            var error = function () {
                alerts.danger('There was an error while trying to prepare your download');
            };

            this.post(data, complete, error, success);
        },

        importOptions: function (newOptions) {
            if (newOptions.length == 0) {
                return;
            }

            var action = wpMenuPages.actionImportPrefix + this.context;
            var data = {
                action: action,
                nonce: wpMenuPages.nonce[action],
                options: newOptions
            };

            controls.loading(domSelector.getAllControls(), true, true);

            var success = function (response) {
                if (response.success == undefined || response.success == false) {
                    error(response);
                    return false;
                }

                alerts.success('Options Import Successful', 2000);
                if (response.data != undefined && response.data.options != undefined) {
                    field.updateValues(response.data.options);
                }

                return true;
            };

            var complete = function () {
                controls.loading(domSelector.getAllControls(), false);
            };

            var error = function () {
                alerts.danger('There was an error while importing options');
            };

            this.post(data, complete, error, success);
        },

        resetOptions: function (include) {
            var action = wpMenuPages.actionResetPrefix + this.context;
            var data = {
                'action': action,
                'nonce': wpMenuPages.nonce[action]
            };

            if (include) {
                data.include = include;
            }

            controls.loading(domSelector.getResetBtn(), true, true);
            controls.loading(domSelector.getTabResetBtn(), true, true);

            var success = function (response) {
                if (response.success == undefined || response.success == false) {
                    error(response);
                    return false;
                }

                alerts.success('All Options Have Been Reset to Defaults', 2000);
                if (response.data != undefined && response.data.defaults != undefined) {
                    field.updateValues(response.data.defaults);
                }

                return true;
            };

            var complete = function () {
                controls.loading(domSelector.getResetBtn(), false);
                controls.loading(domSelector.getTabResetBtn(), false);
            };

            var error = function () {
                alerts.danger('There was an error reseting options');
            };

            this.post(data, complete, error, success);
        },

        updateCoreOptions: function (newOptions) {
            var action = wpMenuPages.actionUpdateCoreOptionsPrefix + this.context;
            var data = {
                'options': newOptions,
                'action': action,
                'nonce': wpMenuPages.nonce[action]
            };

            this.post(data);
        }
    };

    /*******************************************************************************
     * modal component
     ******************************************************************************/
    var modal = {
        markup: '<div class="modal fade" tabindex="-1" role="dialog"> ' +
        '<div class="modal-dialog"> <div class="modal-content"> ' +
        '<div class="modal-header"> ' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button> ' +
        '<h4 class="modal-title">{{title}}</h4> </div> ' +
        '<div class="modal-body">{{body}} </div> ' +
        '<div class="modal-footer">{{footer}} </div> </div> </div> </div>',

        getMarkUp: function(title, body, footer){
            return this.markup.replace('{{title}}', title).replace('{{body}}', body).replace('{{footer}}', footer);
        }
    };

    /*******************************************************************************
     * Start the engines
     ******************************************************************************/
    $(function () {
        // Bind the controls
        controls.bindControls();

        // Bind date-time elements
        var $date = $('input.date');
        var $dateTime = $('input.datetime');
        var $month = $('input.month');
        var $time = $('input.time');

        $date.datetimepicker({
            format: wpMenuPages.dateTimePicker.dateFormat,
            icons: wpMenuPages.dateTimePicker.icons
        });
        $dateTime.datetimepicker({
            format: wpMenuPages.dateTimePicker.dateFormat + ' ' + wpMenuPages.dateTimePicker.timeFormat,
            icons: wpMenuPages.dateTimePicker.icons
        });
        $month.datetimepicker({
            format: wpMenuPages.dateTimePicker.monthFormat,
            icons: wpMenuPages.dateTimePicker.icons
        });
        $time.datetimepicker({
            format: wpMenuPages.dateTimePicker.timeFormat,
            icons: wpMenuPages.dateTimePicker.icons
        });
    });
})(jQuery);