define(['jquery', 'mnp/select2', 'mnp/controls', 'mnp/wpMenuPages'], function ($, select2Handler, controls, wpMenuPages) {
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

        /*******************************************************************************
         * Bind date-time elements
         ******************************************************************************/
        var $date = $('input.date');
        var $dateTime = $('input.datetime');
        var $month = $('input.month');
        var $time = $('input.time');

        if($date.length > 0 || $dateTime.length > 0 || $dateTimeLocal.length > 0 || $week.length > 0
            || $month.length > 0 || $time.length > 0){
            require(['dateTimePicker'], function(){
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
        }
    });
});