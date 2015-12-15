define(['jquery', 'mnp/domSelector'], function ($, domSelector) {
    return {
        getActiveTabOptions: function(){
            var $form = domSelector.getActiveTab().find('form');
            return $form.serialize();
        }
    };
})