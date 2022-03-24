$(document).ready(function() {
    $('#add_more').click(function(){
        $('.field-repeat:first-child').clone().appendTo('#field_container');
        $('.field-repeat:last-child input , .field-repeat:last-child select').val('');
        $('.field-repeat:last-child').find('.field-value').hide();
        $('.row-delete').show();
    });

    $('body').on('change' , '.field-type',function(){
        if($(this).find('option:selected').text()=='Select'){
            $(this).parents('.field-repeat').find('.field-value').show();
        }else{
            $(this).parents('.field-repeat').find('.field-value').hide();
        }
    });

    $('body').on('click' , '.remove-row',function(){
        if($('.field-repeat').length > 1 ) {
            $(this).parents('.field-repeat').remove();
        }
        if($('.field-repeat').length == 1 ) {
            $('.remove-row').hide();
        }
        
    });
    

});