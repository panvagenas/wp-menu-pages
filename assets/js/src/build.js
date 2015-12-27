// r.js -o build.js
({
    appDir: './',
    dir: '../dist',
    baseUrl: "./lib",
    name: "../app",
    fileExclusionRegExp: /^(r|build)\.js$/,
    removeCombined: true,
    optimizeCss: 'standard',
    paths: {
        "mnp": "../mnp",
        'jquery': 'jquery',
        'jquery.shim': 'select2/jquery.shim'
    },
    shim: {
        "bootstrap/*": ["jquery"]
    }
})