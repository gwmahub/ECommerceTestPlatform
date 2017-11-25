$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('#user-menu-but-opclo, #nav-left-bloc-menu-but-opclo').on('click', function(){

        if( $(this).attr('aria-expanded') === "true" ){
            $(this).find('>:first-child').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');

        }else if( $(this).attr('aria-expanded') === "false"  ){
            $(this).find('>:first-child').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
        }
    });


    $('#basket-delivery-form input').addClass('form-control');
    $('#basket-delivery-form > p > input[type="submit"]').css('margin-top', '15px').removeClass('form-control');


});