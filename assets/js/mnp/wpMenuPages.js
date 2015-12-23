define(['jquery'], function ($) {
    var e = {
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
    };
    return $.extend(e, wpMenuPages);
});