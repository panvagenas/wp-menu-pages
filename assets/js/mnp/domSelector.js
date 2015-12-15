define(['jquery'], function ($) {
    return {
        ctrlSaveBtnSelector: '.btn-save-options',
        ctrlResetBtnSelector: '.btn-reset-options',
        ctrlTabResetBtnSelector: '.btn-tab-reset-options',
        ctrlExportOptsSelector: '.btn-export-options',
        ctrlImportOptsSelector: '.btn-import-options',
        activeTabSelector: '.tab-pane.active',

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
        }
    };
})