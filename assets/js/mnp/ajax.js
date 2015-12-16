define(['jquery', 'mnp/controls', 'mnp/domSelector', 'mnp/field', 'mnp/alert', 'fileSaver'],
    function ($, controls, domSelector, field, alert, saveAs) {

        var actionPrefix = 'wp-menu-pages-';
        var actionSavePrefix = actionPrefix + 'save-options-';
        var actionResetPrefix = actionPrefix + 'reset-options-';
        var actionExportPrefix = actionPrefix + 'export-options-';
        var actionImportPrefix = actionPrefix + 'import-options-';
        var actionUpdateCoreOptionsPrefix = actionPrefix + 'update-core-options-';

        return {
            ajaxUrl: ajaxurl,
            context: wpMenuPagesDefinitions.context,

            actionPrefix: 'wp-menu-pages-',
            actionSavePrefix: actionSavePrefix,
            actionResetPrefix: actionResetPrefix,
            actionExportPrefix: actionExportPrefix,
            actionImportPrefix: actionImportPrefix,
            actionUpdateCoreOptionsPrefix: actionUpdateCoreOptionsPrefix,

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
                var action = this.actionSavePrefix + this.context;
                var data = {
                    options: newOptions,
                    action: action,
                    nonce: wpMenuPagesDefinitions.nonce[action]
                };

                controls.loading(domSelector.getSaveBtn(), true, true);

                var success = function (response) {
                    if (response.data != undefined && response.data.options != undefined) {
                        var fields = response.data.options;
                        for (var fieldName in fields) {
                            if (fields[fieldName].valid) {
                                field.markValid(fieldName);
                                continue;
                            }

                            field.markInvalid(fieldName, fields[fieldName].errors);
                        }
                    }

                    if (response.success == undefined || response.success == false) {
                        alert.danger('There was an error saving the options');
                        return false;
                    }


                    alert.success('Options Saved!', 2000);
                    return true;
                };
                var error = function () {
                    alert.danger('There was an error saving the options');
                };

                var complete = function () {
                    controls.loading(domSelector.getSaveBtn(), false);
                };

                this.post(data, complete, error, success);
            },

            exportOptions: function () {
                var action = this.actionExportPrefix + this.context;
                var data = {
                    action: action,
                    nonce: wpMenuPagesDefinitions.nonce[action]
                };

                controls.loading(domSelector.getExportBtn(), true, true);

                var success = function (response) {
                    if (response.success == undefined || response.success == false) {
                        error(response);
                        return false;
                    }

                    var blob = new Blob([response.data.options], {
                        type: "application/json;charset=utf-8;",
                    });
                    saveAs(blob, response.data.name + '.json');

                    return true;
                };

                var complete = function () {
                    controls.loading(domSelector.getExportBtn(), false);
                };

                var error = function () {
                    alert.danger('There was an error while trying to prepare your download');
                };

                this.post(data, complete, error, success);
            },

            importOptions: function (newOptions) {
                if (newOptions.length == 0) {
                    return;
                }

                var action = this.actionImportPrefix + this.context;
                var data = {
                    action: action,
                    nonce: wpMenuPagesDefinitions.nonce[action],
                    options: newOptions
                };

                controls.loading(domSelector.getAllControls(), true, true);

                var success = function (response) {
                    if (response.success == undefined || response.success == false) {
                        error(response);
                        return false;
                    }

                    alert.success('Options Import Successful', 2000);
                    if (response.data != undefined && response.data.options != undefined) {
                        field.updateValues(response.data.options);
                    }

                    return true;
                };

                var complete = function () {
                    controls.loading(domSelector.getAllControls(), false);
                };

                var error = function () {
                    alert.danger('There was an error while importing options');
                };

                this.post(data, complete, error, success);
            },

            resetOptions: function (include) {
                var action = this.actionResetPrefix + this.context;
                var data = {
                    'action': action,
                    'nonce': wpMenuPagesDefinitions.nonce[action]
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

                    alert.success('All Options Have Been Reset to Defaults', 2000);
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
                    alert.danger('There was an error reseting options');
                };

                this.post(data, complete, error, success);
            },

            updateCoreOptions: function(newOptions){
                var action = this.actionUpdateCoreOptionsPrefix + this.context;
                var data = {
                    'options': newOptions,
                    'action': action,
                    'nonce': wpMenuPagesDefinitions.nonce[action]
                };

                this.post(data);
            }
        };
    }
);