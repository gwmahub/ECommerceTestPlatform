$("document").ready( function(){

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

    /**
     * citiesBe -> get the citiesName from the postcode
     */
    $('.postcode').on('keyup', function(){
        if( $(this).val().length > 3 ){
            $.ajax({
                type:'get',
                url: Routing.generate( 'cities_be', { pc: $(this).val() } ),
            // url:'http://symfony.ecom.localhost/app_dev.php/address/citiesbe/' + $(this).val(),
                beforeSend: function(){
                    if( $('.loading').length === 0 ){
                        $('.city').parent().prepend('<div class="loading"></div>');
                    }
                    $('.city option').remove();
                },
                success: function(data){
                    $.each(data.cities, function(index, value){
                        $('.city').append($('<option>', { value: value, text: value }));
                    });
                    $('.loading').remove();
                }
        })
        }else{
            $('.city').val('');
        }
    });

});

//
//
// $(function () {
//
//     $('[data-toggle="tooltip"]').tooltip();
//
//     $('#user-menu-but-opclo, #nav-left-bloc-menu-but-opclo').on('click', function(){
//
//         if( $(this).attr('aria-expanded') === "true" ){
//             $(this).find('>:first-child').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');
//
//         }else if( $(this).attr('aria-expanded') === "false"  ){
//             $(this).find('>:first-child').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
//         }
//     });
//
//
//     $('#basket-delivery-form input').addClass('form-control');
//     $('#basket-delivery-form > p > input[type="submit"]').css('margin-top', '15px').removeClass('form-control');
//
// });