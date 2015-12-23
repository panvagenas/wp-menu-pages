define(['jquery'], function ($, Alert) {
    var alertsWrapperSelector = '.alerts-wrapper';
    var $alertsWrapper = $(alertsWrapperSelector);

    return {
        TYPE_SUCCESS: 'success',
        TYPE_INFO: 'info',
        TYPE_WARNING: 'warning',
        TYPE_DANGER: 'danger',

        alertsWrapperSelector: alertsWrapperSelector,
        $alertsWrapper: $alertsWrapper,

        alertTemplate: '<div class="alert alert-{{type}} alert-dismissible fade in" role="alert" style="display: none;">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
        '<span aria-hidden="true">&times;</span> </button>' +
        '{{msg}}' +
        '</div>',

        alert: function (type, msg, timeout) {
            var $alert = $(this.getAlertMarkUp(msg, type));
            this.$alertsWrapper.append($alert);
            $alert.slideDown('fast');
            if (timeout) {
                setTimeout(function () {
                    $alert.slideUp(function () {
                        $alert.remove()
                    })
                }, timeout);
            }
            require(['bootstrap/alert'], function(){
                $alert.alert();
            })
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
})