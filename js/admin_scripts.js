jQuery(document).ready(function($){
    $(document).on('focus', '.un-car-text-pass', function(){
        $(this).attr('type', 'text');
    });
    $(document).on('focusout', '.un-car-text-pass', function(){
        $(this).attr('type', 'password');
    });
});