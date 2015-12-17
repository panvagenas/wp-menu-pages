requirejs.config({
    baseUrl: wpMenuPages.uriPathToJs+'/lib',
    paths: {
        mnp: "../mnp",
        wp: wpMenuPages.wpUrl+'/wp-includes/js'
    },
    shim: {
        "bootstrap/*": ["jquery"]
    }
});

requirejs(["mnp/main"]);