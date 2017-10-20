$(function($){

    // Bootstrap Validator
    $('form').submit(function() {
        $('form').find('.form-control').each(function(){
            $('.form-control').addClass('empty');

            if($(this).val() != ''){
                $(this).removeClass('empty');
                return false;
            } else {
                $('form').find('.empty').css(
                {
                    'background':'#fff0a0',
                    'color': '#d91b1b'
                });
                return false;   
            }
        })
        return false;
    });
});
