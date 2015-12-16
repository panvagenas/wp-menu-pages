({
    appDir: './',
    dir: './dist',
    baseUrl: "./lib",
    name: "../app",
    fileExclusionRegExp: /^(r|build)\.js$/,
    removeCombined: true,
    optimizeCss: 'standard',
    paths: {
        "mnp": "../mnp"
    },
    shim: {
        "bootstrap/*": ["jquery"]
    }
})