(function($){
    $('[data-type="select2"]').each(function(){
        var $input = $(this);
        var options = $input.data();
        $input.select2(options);
    });
})(jQuery);