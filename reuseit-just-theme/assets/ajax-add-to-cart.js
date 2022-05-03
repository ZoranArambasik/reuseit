(function ($) {

    $(document).on('click', '.add_to_cart_button_woo', function (e) {
        e.preventDefault();




        // var $thisbutton = $(this),
        //         $form = $thisbutton.closest('form.cart'),
        //         id = $thisbutton.val(),
        //         product_qty = $form.find('input[name=quantity]').val() || 1,
        //         product_id = $form.find('input[name=product_id]').val() || id,
        //         variation_id = $form.find('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: $(this).data('id'),
            product_sku: '',
            quantity: 1
        };

        
        var element_this = $(this);
        $(document.body).trigger('adding_to_cart', [data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                
                $(element_this).hide();
                $(element_this).parent().hide();
                jQuery(element_this).parent().siblings('img').first().show();

                //$thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                
                $(element_this).show();
                $(element_this).parent().show();
                jQuery(element_this).parent().siblings('img').first().hide();
                // var data = $.parseHTML(response.responseJSON.fragments['div.widget_shopping_cart_content']);
                var list = $('#cartmenu').find('div.cart-item');
                var obj = JSON.parse(response.responseText);
                
                if( typeof obj.total_items !== 'undefined' ) {
                    $('#cart-total').addClass('active');
                    $('#cart-total').html(`${obj.total_items}`);
                }
                if( typeof obj.cart_total !== 'undefined' ) {
                    $('#totalpricecart').html(`<strong>Totalt: </strong>${obj.cart_total} ${obj.curr} (ink moms)`);
                }

                
                
                if( list.length === 0 ) {
                    createElement(list, obj, data);
                } else {

                
                    if( !checkIfItemExists(list, obj, data) && typeof obj.product_url !== 'undefined' ) {
                        createElement(list, obj, data);
                    }

                    list.each(function(idx, li) {

                        var product = $(li);
                        var prod_id = $(li).data('prodid');
                        var key = $(li).data('prodkey');
                        
                        
                        if( data.product_id ===  prod_id && typeof obj.product_url !== 'undefined' ) {

                            $(product).find('p.total').html(`Totalt: ${obj.product_url[key].quantity} st`);
                            $(product).find('p.totalprice').html(`${obj.product_url[key].line_total} ${obj.curr}`);

                   
                        } 
                    });
                }

                $('#cartmenu').addClass("is-open");
                //$thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {

                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                }
            },
        });

        return false;
    });


    
    function createElement(list, obj, data) {
        $('#noitemscart').remove();
        
        //var html = `<div class="row mb-2 cart-item" data-prodid="${data.product_id}" data-prodkey="${obj.key[0]}"> <div class="col-5"> <div class="img-section"> <img src="${obj.product_img}" class="img-responsive" alt=""> <a href="" class="remove-cart-item" data-product_id="${data.product_id}"  data-cart_item_key="${obj.key[0]}">X</a><img src="${obj.site_wp_url}/images/tail-spin.svg" class="img-fluid spinner" alt="spinner"></div> </div> <div class="col-7"> <div class="first"> <a href="">${obj.cat_name}</a> <h3>${obj.prod_name}</h3> <p class="totalprice">Pris: ${obj.prod_price} ${obj.curr}</p> <p class="total">Totalt: 1 st</p> </div> </div> <div class="clearfix"> </div> <div class="col-12"> <hr> </div> </div>`;
        var html = `<div class="row mb-2 cart-item" data-prodid="${data.product_id}" data-prodkey="${obj.key[0]}"> <div class="col-5"> <div class="img-section"> <img src="${obj.product_img}" class="img-responsive" alt=""> </div> </div> <div class="col-7"> <div class="first"> <a href="${obj.product_img}"> <h3>${obj.prod_name}</h3> </a> <p class="brand">Tillverkare: ${obj.cat_name}</p><p class="total">Antal: ${obj.quantity} st: <span>${obj.prod_price} ${obj.curr}</span></p><p class="totalprice">Totalt: ${obj.prod_price} ${obj.curr}</p><p class="totalmoms">Varav moms ${obj.cart_tax} kr</p><a href="" class="remove-cart-item" data-product_id="${data.product_id}"  data-cart_item_key="${obj.key[0]}"><img src="${obj.site_wp_url}/images/bin-2.png" class="img-responsie" alt="close"> </a> </div> </div> <div class="clearfix"> </div> <div class="col-12"> <hr> </div> </div>`;
        var htmlDOM = $.parseHTML(html);
        
        $('#cartmenu .items').append(htmlDOM);
       
    }

    function checkIfItemExists(list, obj, data) {

        var toReturn;

        list.each(function(idx, li) {

            var product = $(li);
            var prod_id = $(li).data('prodid');
            var key = $(li).data('prodkey');
            
            
            if( data.product_id ===  prod_id && typeof obj.product_url !== 'undefined' ) {
                toReturn = prod_id;
                return false;
                
            } 

        });

        return toReturn; 

    }



    // function findXX(word) {
    //     var toReturn; 
    //     $.each(someArray, function(i) {
    //         $('body').append('-> '+i+'<br />');
    //         if(someArray[i] == word) {
    //             toReturn = someArray[i];
    //             return false;
    //         }   
    //     }); 
    //     return toReturn; 
    // }


})(jQuery);