
(function ($) {
// Ajax delete product in the cart
$(document).on('click', 'a.remove-cart-item', function (e)
{
    e.preventDefault();

    var element_this = $(this);

    var product_id = $(this).attr("data-product_id"),
        cart_item_key = $(this).attr("data-cart_item_key"),
        product_container = $(this).parents('.mini_cart_item');

    // Add loader
    product_container.block({
        message: null,
        overlayCSS: {
            cursor: 'none'
        }
    });

    // $(element_this).hide();
    // jQuery(element_this).siblings('img.spinner').first().show();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: "product_remove",
            product_id: product_id,
            cart_item_key: cart_item_key
        },
        success: function(response) {

            // $(element_this).show();
            // jQuery(element_this).siblings('img.spinner').first().hide();
            // if ( ! response || response.error ) {
            //     return;
            // }

            if( response.total_items == 0 ) {
                $('#cart-total').removeClass('active');
            }


            if( typeof response.total_items !== 'undefined' ) {
                $('#cart-total').html(`${response.total_items}`);
            }
            if( typeof response.cart_total !== 'undefined' ) {
                $('#totalpricecart').html(`<strong>Totalt: </strong>${response.cart_total} ${response.curr}`);
            }

                

            var fragments = response.fragments;

    
            var list = $('#cartmenu').find('div.cart-item');

            list.each(function(idx, li) {

                var product = $(li);
                var prod_id = $(li).data('prodid');
                var key = $(li).data('prodkey');
                
                
                if( product_id == prod_id ) {
                    
                    $(product).remove();
           
                } 
            });


            // Replace fragments
            if ( fragments ) {
                $.each( fragments, function( key, value ) {
                    $( key ).replaceWith( value );
                });
            }
        }
    });
});


})(jQuery);