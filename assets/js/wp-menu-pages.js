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
            '<div class="alert alert-{{type}} alert-dismissible" role="alert" style="display: none;">' +
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
    WpMenuPages.prototype.ajaxPost = function (data, complete, error, success, datatype) {
        $.ajax({
            url: this.ajaxUrl,
            method: 'POST',
            data: data,
            success: success,
            complete: complete,
            error: error,
            dataType: datatype ? datatype : 'json'
        });
    };
    /**
     * Displays an alert in the alert-wrapper of the page
     * @param msg The actual message
     * @param type The type of the alert. See bootstrap alerts
     */
    WpMenuPages.prototype.alert = function (msg, type, timeout) {
        var $alert = $(this.getAlertMarkUp(msg, type));
        this.$alertsWrapper.append($alert);
        $alert.slideDown('fast');
        if(timeout){
            setTimeout(function() {$alert.slideUp(function(){$alert.remove()})}, timeout);
        }
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
        return $form.serialize();
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
        if (errors.length == 0 || !$field || $field.length == undefined || $field.length == 0) {
            return;
        }
        var error = errors.join('<br />');
        var helpBlockMarkUp = this.inputHelpBlockTemplate.replace('{{msg}}', error).replace('{{id}}', $field.attr('name') + '-error');

        var $formGroup = $field.closest('.form-group');
        $formGroup.addClass('has-error');

        $formGroup.find('.help-block').remove();

        $field.after(helpBlockMarkUp);
    };

    WpMenuPages.prototype.markFieldValid = function ($field) {
        if (!$field || $field.length == undefined || $field.length == 0) {
            return;
        }

        var $formGroup = $field.closest('.form-group');
        $formGroup.removeClass('has-error');
        $formGroup.find('.help-block').remove();
    };
    WpMenuPages.prototype.getVisibleFieldByName = function (fieldName) {
        return this.$activeTab.find('[name="' + fieldName + '"]');
    };

    WpMenuPages.prototype.updateOptionsValue = function (newValues) {
        if (newValues == undefined || newValues.length == 0) {
            return [];
        }

        for (var fieldName in newValues) {
            var value = newValues[fieldName];

            var $field = $('.wp-menu-pages-input#' + fieldName);

            if ($field == undefined || $field.length == 0) {
                continue;
            }

            if ($field.attr('type') == 'radio') {
                $('#'+fieldName+'[value="'+value+'"]').parent().button('toggle');
                continue;
            }

            $field.val(value);
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


            $wpMenuPages.alert('Options Saved!', 'success', 2000);
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

            $wpMenuPages.alert('All Options Reseted to Defaults', 'success', 2000);
            // TODO Update options in tabs or reload page
            if (response.data != undefined && response.data.defaults != undefined) {
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
        var action = this.actionExportPrefix + this.context;
        var data = {
            'action': action,
            'nonce': wpMenuPagesDefinitions.nonce[action]
        };

        var $wpMenuPages = this;

        this.loading(this.getExportBtn(), true, true);

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
            $wpMenuPages.loading($wpMenuPages.getResetBtn(), false);
            $wpMenuPages.loading($wpMenuPages.getTabResetBtn(), false);
        };

        var error = function () {
            $wpMenuPages.alert('There was an error while trying to prepare your download', 'danger');
        };

        this.ajaxPost(data, complete, error, success);
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


    wpMenuPages.getExportBtn().click(function (e) {
        e.preventDefault();
        wpMenuPages.exportOptions();
    });
    wpMenuPages.getImportBtn().click(function () {
    });

    $("[rel='tooltip']").tooltip();
})(jQuery);

/* FileSaver.js
 * A saveAs() FileSaver implementation.
 * 1.1.20151003
 *
 * By Eli Grey, http://eligrey.com
 * License: MIT
 *   See https://github.com/eligrey/FileSaver.js/blob/master/LICENSE.md
 */

/*global self */
/*jslint bitwise: true, indent: 4, laxbreak: true, laxcomma: true, smarttabs: true, plusplus: true */

/*! @source http://purl.eligrey.com/github/FileSaver.js/blob/master/FileSaver.js */

var saveAs = saveAs || (function(view) {
        "use strict";
        // IE <10 is explicitly unsupported
        if (typeof navigator !== "undefined" && /MSIE [1-9]\./.test(navigator.userAgent)) {
            return;
        }
        var
            doc = view.document
        // only get URL when necessary in case Blob.js hasn't overridden it yet
            , get_URL = function() {
                return view.URL || view.webkitURL || view;
            }
            , save_link = doc.createElementNS("http://www.w3.org/1999/xhtml", "a")
            , can_use_save_link = "download" in save_link
            , click = function(node) {
                var event = new MouseEvent("click");
                node.dispatchEvent(event);
            }
            , is_safari = /Version\/[\d\.]+.*Safari/.test(navigator.userAgent)
            , webkit_req_fs = view.webkitRequestFileSystem
            , req_fs = view.requestFileSystem || webkit_req_fs || view.mozRequestFileSystem
            , throw_outside = function(ex) {
                (view.setImmediate || view.setTimeout)(function() {
                    throw ex;
                }, 0);
            }
            , force_saveable_type = "application/octet-stream"
            , fs_min_size = 0
        // See https://code.google.com/p/chromium/issues/detail?id=375297#c7 and
        // https://github.com/eligrey/FileSaver.js/commit/485930a#commitcomment-8768047
        // for the reasoning behind the timeout and revocation flow
            , arbitrary_revoke_timeout = 500 // in ms
            , revoke = function(file) {
                var revoker = function() {
                    if (typeof file === "string") { // file is an object URL
                        get_URL().revokeObjectURL(file);
                    } else { // file is a File
                        file.remove();
                    }
                };
                if (view.chrome) {
                    revoker();
                } else {
                    setTimeout(revoker, arbitrary_revoke_timeout);
                }
            }
            , dispatch = function(filesaver, event_types, event) {
                event_types = [].concat(event_types);
                var i = event_types.length;
                while (i--) {
                    var listener = filesaver["on" + event_types[i]];
                    if (typeof listener === "function") {
                        try {
                            listener.call(filesaver, event || filesaver);
                        } catch (ex) {
                            throw_outside(ex);
                        }
                    }
                }
            }
            , auto_bom = function(blob) {
                // prepend BOM for UTF-8 XML and text/* types (including HTML)
                if (/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(blob.type)) {
                    return new Blob(["\ufeff", blob], {type: blob.type});
                }
                return blob;
            }
            , FileSaver = function(blob, name, no_auto_bom) {
                if (!no_auto_bom) {
                    blob = auto_bom(blob);
                }
                // First try a.download, then web filesystem, then object URLs
                var
                    filesaver = this
                    , type = blob.type
                    , blob_changed = false
                    , object_url
                    , target_view
                    , dispatch_all = function() {
                        dispatch(filesaver, "writestart progress write writeend".split(" "));
                    }
                // on any filesys errors revert to saving with object URLs
                    , fs_error = function() {
                        if (target_view && is_safari && typeof FileReader !== "undefined") {
                            // Safari doesn't allow downloading of blob urls
                            var reader = new FileReader();
                            reader.onloadend = function() {
                                var base64Data = reader.result;
                                target_view.location.href = "data:attachment/file" + base64Data.slice(base64Data.search(/[,;]/));
                                filesaver.readyState = filesaver.DONE;
                                dispatch_all();
                            };
                            reader.readAsDataURL(blob);
                            filesaver.readyState = filesaver.INIT;
                            return;
                        }
                        // don't create more object URLs than needed
                        if (blob_changed || !object_url) {
                            object_url = get_URL().createObjectURL(blob);
                        }
                        if (target_view) {
                            target_view.location.href = object_url;
                        } else {
                            var new_tab = view.open(object_url, "_blank");
                            if (new_tab == undefined && is_safari) {
                                //Apple do not allow window.open, see http://bit.ly/1kZffRI
                                view.location.href = object_url
                            }
                        }
                        filesaver.readyState = filesaver.DONE;
                        dispatch_all();
                        revoke(object_url);
                    }
                    , abortable = function(func) {
                        return function() {
                            if (filesaver.readyState !== filesaver.DONE) {
                                return func.apply(this, arguments);
                            }
                        };
                    }
                    , create_if_not_found = {create: true, exclusive: false}
                    , slice
                    ;
                filesaver.readyState = filesaver.INIT;
                if (!name) {
                    name = "download";
                }
                if (can_use_save_link) {
                    object_url = get_URL().createObjectURL(blob);
                    setTimeout(function() {
                        save_link.href = object_url;
                        save_link.download = name;
                        click(save_link);
                        dispatch_all();
                        revoke(object_url);
                        filesaver.readyState = filesaver.DONE;
                    });
                    return;
                }
                // Object and web filesystem URLs have a problem saving in Google Chrome when
                // viewed in a tab, so I force save with application/octet-stream
                // http://code.google.com/p/chromium/issues/detail?id=91158
                // Update: Google errantly closed 91158, I submitted it again:
                // https://code.google.com/p/chromium/issues/detail?id=389642
                if (view.chrome && type && type !== force_saveable_type) {
                    slice = blob.slice || blob.webkitSlice;
                    blob = slice.call(blob, 0, blob.size, force_saveable_type);
                    blob_changed = true;
                }
                // Since I can't be sure that the guessed media type will trigger a download
                // in WebKit, I append .download to the filename.
                // https://bugs.webkit.org/show_bug.cgi?id=65440
                if (webkit_req_fs && name !== "download") {
                    name += ".download";
                }
                if (type === force_saveable_type || webkit_req_fs) {
                    target_view = view;
                }
                if (!req_fs) {
                    fs_error();
                    return;
                }
                fs_min_size += blob.size;
                req_fs(view.TEMPORARY, fs_min_size, abortable(function(fs) {
                    fs.root.getDirectory("saved", create_if_not_found, abortable(function(dir) {
                        var save = function() {
                            dir.getFile(name, create_if_not_found, abortable(function(file) {
                                file.createWriter(abortable(function(writer) {
                                    writer.onwriteend = function(event) {
                                        target_view.location.href = file.toURL();
                                        filesaver.readyState = filesaver.DONE;
                                        dispatch(filesaver, "writeend", event);
                                        revoke(file);
                                    };
                                    writer.onerror = function() {
                                        var error = writer.error;
                                        if (error.code !== error.ABORT_ERR) {
                                            fs_error();
                                        }
                                    };
                                    "writestart progress write abort".split(" ").forEach(function(event) {
                                        writer["on" + event] = filesaver["on" + event];
                                    });
                                    writer.write(blob);
                                    filesaver.abort = function() {
                                        writer.abort();
                                        filesaver.readyState = filesaver.DONE;
                                    };
                                    filesaver.readyState = filesaver.WRITING;
                                }), fs_error);
                            }), fs_error);
                        };
                        dir.getFile(name, {create: false}, abortable(function(file) {
                            // delete file if it already exists
                            file.remove();
                            save();
                        }), abortable(function(ex) {
                            if (ex.code === ex.NOT_FOUND_ERR) {
                                save();
                            } else {
                                fs_error();
                            }
                        }));
                    }), fs_error);
                }), fs_error);
            }
            , FS_proto = FileSaver.prototype
            , saveAs = function(blob, name, no_auto_bom) {
                return new FileSaver(blob, name, no_auto_bom);
            }
            ;
        // IE 10+ (native saveAs)
        if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob) {
            return function(blob, name, no_auto_bom) {
                if (!no_auto_bom) {
                    blob = auto_bom(blob);
                }
                return navigator.msSaveOrOpenBlob(blob, name || "download");
            };
        }

        FS_proto.abort = function() {
            var filesaver = this;
            filesaver.readyState = filesaver.DONE;
            dispatch(filesaver, "abort");
        };
        FS_proto.readyState = FS_proto.INIT = 0;
        FS_proto.WRITING = 1;
        FS_proto.DONE = 2;

        FS_proto.error =
            FS_proto.onwritestart =
                FS_proto.onprogress =
                    FS_proto.onwrite =
                        FS_proto.onabort =
                            FS_proto.onerror =
                                FS_proto.onwriteend =
                                    null;

        return saveAs;
    }(
        typeof self !== "undefined" && self
        || typeof window !== "undefined" && window
        || this.content
    ));
// `self` is undefined in Firefox for Android content script context
// while `this` is nsIContentFrameMessageManager
// with an attribute `content` that corresponds to the window

if (typeof module !== "undefined" && module.exports) {
    module.exports.saveAs = saveAs;
} else if ((typeof define !== "undefined" && define !== null) && (define.amd != null)) {
    define([], function() {
        return saveAs;
    });
}
