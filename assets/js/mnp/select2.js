define(['jquery', 'mnp/field'], function ($, field) {
    return {
        domSelector: '.select2.wp-menu-pages-input',
        count: function () {
            return this.getElements().length;
        },

        hasElements: function () {
            return this.count() > 0;
        },

        getElements: function () {
            return $(this.domSelector);
        },

        getElementOptions: function ($element) {
            return $element.data();
        },

        isBinded: function ($element) {
            return $element.data('select2');
        },

        maybeUnbind: function($element){
            if(this.isBinded($element)){
                $element.select2("destroy");
            }
        },

        bindAll: function () {
            var handler = this;
            require(['select2/jquery.select2'], function () {
                handler.getElements().each(function () {
                    var $element = $(this);

                    handler.maybeUnbind($element)

                    var options = handler.getElementOptions($element);
                    $element.select2(options);
                });
            });
        },

        maybeBindAll: function(){
            if(this.hasElements){
                this.bindAll();
            }
        },

        isSelect2: function(fieldName){
            return field.isSelect2(fieldName);
        }
    };
})