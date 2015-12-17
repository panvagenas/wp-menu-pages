define(['jquery', 'mnp/select2', 'mnp/controls'], function ($, select2Handler, controls) {
    $(function () {
        require(['bootstrap/transition']);

        controls.bindControls();

        /*******************************************************************************
         * Load select 2 iff it's necessary
         ******************************************************************************/
        select2Handler.maybeBindAll();

        /*******************************************************************************
         * Load bootstrap components only if they are required
         ******************************************************************************/
        var $tabs = $('.tab-pane');
        if ($tabs.length > 0) {
            require(['bootstrap/tab']);
        }

        var $collapsible = $('.panel-collapse');
        if ($collapsible.length > 0) {
            require(['bootstrap/collapse']);
        }

        var $tooltiped = $("[rel='tooltip']");
        if ($tooltiped.length > 0) {
            require(['bootstrap/tooltip'], function (tooltip) {
                $tooltiped.tooltip();
            });
        }

        var $dataToggledButtons = $('[data-toggle="buttons"]');
        if ($dataToggledButtons.length > 0) {
            require(['bootstrap/button']);
        }
    });
});