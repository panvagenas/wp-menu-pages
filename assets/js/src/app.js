requirejs.config({
    baseUrl: wpMenuPages.uriPathToJs+'/lib',
    paths: {
        mnp: "../mnp",
        wp: wpMenuPages.wpUrl+'/wp-includes/js',
        'jquery.shim': 'select2/jquery.shim'
    },
    shim: {
        "bootstrap/*": ["jquery"],
        dateTimePicker: 'moment'
    }
});

requirejs(["mnp/main"]);