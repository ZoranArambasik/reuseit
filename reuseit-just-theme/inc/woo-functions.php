<?php

/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=90052
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.1
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */


 function filter_woocommerce_available_payment_gateways( $available_gateways ) {

 if (! is_checkout() ) return $available_gateways; // stop doing anything if we’re not on checkout page.
   if (array_key_exists('hyra_reuseit',$available_gateways)) {

      global $woocommerce;


    $cart_subtotal = round((($woocommerce->cart->total*1.03)/36),0);

     // Gateway ID for Ask for Quote is ‘quotes-gateway’.
     $available_gateways['hyra_reuseit']->order_button_text = "Bekräfta köpet av hyra";
     $available_gateways['hyra_reuseit']->title = "Hyra: "." <b>".$cart_subtotal."kr/mån</b> vid hyra 36 månader";
     $available_gateways['hyra_reuseit']->method_title = "Hyra: "." <b>".$cart_subtotal."kr/mån</b> vid hyra 36 månader";
   }

 return $available_gateways;

 }

 // add the filter
 add_filter( 'woocommerce_available_payment_gateways', 'filter_woocommerce_available_payment_gateways', 10, 1 );





function get_values_fields($id) {

    $_product = wc_get_product( $id);
    $currencySymbol = get_woocommerce_currency_symbol();
    $prods = new WC_product($id);
    $list_img = get_field('product_list_image', $id);
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id), 'single-post-thumbnail' );
    $brands = get_the_terms($id, 'brand');

    $data = array(
      '_product'        => $_product,
      'currencySymbol'  => $currencySymbol,
      'prods'           => $prods,
      'list_img'        => $image,
      'brands'          => $brands,
      'grades'          => $grades,
    );

    return $data;

  }

 //  function create_list_item($id, $class = null) {
 //    $_product = wc_get_product( $id);
 //    $currencySymbol = get_woocommerce_currency_symbol();
 //    $prods = new WC_product($id);
 //    $list_img = get_field('product_list_image', $id);
 //    $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) ,'medium');
 //    $desc = get_field('product_list_desc', $id);
 //    $brands = get_the_terms($id, 'brand');
 //    $grades = get_the_terms($id, 'grade');
 //    $grade  = $grades[0]->name;

 //    if ($grade == 'A') {
 //        $grade  = '<div class="grade"><div class="grade-a">' . $grade . '</div></div>';
 //   } elseif ($grade == 'B') {
 //        $grade  = '<div class="grade"><div class="grade-b">' . $grade . '</div></div>';
 //   } elseif ($grade == 'C') {
 //        $grade  = '<div class="grade"><div class="grade-c">' . $grade . '</div></div>';
 //   } elseif ($grade == 'S') {
 //        $grade  = '<div class="grade"><div class="grade-s">' . $grade . '</div></div>';
 //   } elseif ($grade == 'Ny') {
 //        $grade  = '<div class="grade"><div class="grade-ny">' . $grade . '</div></div>';
 //   } else {
 //        $grade = '';
 //   }

 //    $prod_img = $image[0] != "" ? $image[0] : get_template_directory_uri().'/images/no-image.png';
 //    //$stock = $_product->get_stock_quantity() > 0 ? '<span class="instock">I lager</span>' : '<span class="not-instock">Ej i lager</span>';
 //    $stockstatus = $_product->get_stock_status();
 //    if($stockstatus == 'instock'){
	// 	$stock = '<span class="instock">I lager</span>';
 //    }else if($stockstatus == 'onbackorder'){
	//     $stock = '<span class="backorder">Beställningsvara</span>';
 //    }else{
	//     $stock = '<span class="not-instock">Ej i lager</span>';
 //    }

	// $company = WC()->session->get( 'my_custom_tax_rate_company' );
	// if($company == 1){
	// 	$price = wc_get_price_excluding_tax($_product);
	// 	$moms = '  <span class="tax-span">(ex. moms)</span>';
	// 	$rentprice = round(($price*0.032),0);
	// 	$extraContent = '<span class="tax-span" style="font-size:15px;margin-top:5px;">Hyra: <b>'.$rentprice.'kr/mån</b> vid hyra 36 månader</span>';
	// } else {
	// 	$price = wc_get_price_including_tax($_product);
	// 	$moms = '  <span class="tax-span">(ink. moms)</span>';
	// 	$extraContent = '';
	// }

 //    if( $class ) {

 //        $html = '';

 //        $html .= '<div class="wrapper">';

 //                $html .= '<div class="img-wrapper">';
 //                    $html .= '<a href="'.get_permalink($id).'">';
 //                        $html .= $grade;
 //                        $html .= '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid">';
 //                    $html .= '</a>';
 //                    $html .= '<div class="add-to-cart-holder"><div class="add-to-cart">';
 //                        $html .= '<a href="'.get_permalink($id).'">';
 //                            $html .= '<span class="go-to-product">+</span>';
 //                        $html .= '</a>';
 //                        $html .= $price ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
 //                        $html .= $price ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
 //                    $html .= '</div></div>';
 //                $html .= '</div>';
 //                $html .= '<div class="content-wrapper">';
 //                $html .= '<div class="first">';
 //                    $html .= '<a href="'.get_permalink($id).'">';
 //                        $html .= '<h3>'.get_the_title($id).'</h3>';
 //                        $html .= '<p class="some-product-description">'.$desc.'</p>';
 //                    $html .= '</a>';
 //                $html .= '</div>';

 //                $html .= '<div class="second">';

 //                    $html .= '<h4>'.$price.''.$currencySymbol.' '.$moms.'</h4>';
 //                    $html .= $stock;
 //                    $html .= $extraContent;


 //                $html .= '</div>';

 //            $html .= '</div>';

 //        $html .= '</div>';

 //    } else {
 //        $html = '';
 //        $html .= '<div class="col-6 col-sm-6 col-md-4 col-lg-3 small-image productbox mb-3">';
 //            $html .= '<div class="wrapper">';
 //                $html .= '<div class="img-wrapper">';
 //                    $html .= '<a href="'.get_permalink($id).'">';
 //                        $html .=  $grade;
 //                        $html .= '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid">';
 //                    $html .= '</a>';
 //                    $html .= '<div class="add-to-cart-holder"><div class="add-to-cart">';
 //                        $html .= '<a href="'.get_permalink($id).'">';
 //                            $html .= '<span class="go-to-product">+</span>';
 //                        $html .= '</a>';
 //                        $html .= $price ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
 //                        $html .= $price ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
 //                    $html .= '</div></div>';
 //                $html .= '</div>';
 //                $html .= '<div class="content-wrapper">';
 //                    $html .= '<div class="first">';
 //                        $html .= '<a href="'.get_permalink($id).'">';
 //                            $html .= '<h3>'.get_the_title($id).'</h3>';
 //                            $html .= '<p class="some-product-description">'.$desc.'</p>';
 //                        $html .= '</a>';
 //                    $html .= '</div>';
 //                    $html .= '<div class="second">';
 //                        $html .= '<h4>'.$price.''.$currencySymbol.' '.$moms.'</h4>';
 //                        $html .= $stock;
 //                        $html .= $extraContent;
 //                    $html .= '</div>  ';
 //                $html .= '</div> ';
 //            $html .= '</div>';
 //        $html .= '</div>';




 //    }


 //    return $html;
 //  }

   add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
  function wcs_custom_get_availability( $availability, $_product ) {
      $data = $_product->get_data();

    if ( $data['stock_status'] == 'instock' ) {
        if(get_the_ID() !== 4151){
        $availability['availability'] = __('<span class="instock"><img src="/wp-content/themes/reuseit-new/images/reuseit-i-lager.jpg" style="float:left;"> I lager!</span>', 'woocommerce');
        }
    }

    if ( $data['stock_status'] == 'onbackorder' ) {
        $availability['availability'] = __('<span class="backorder"><img src="/wp-content/themes/reuseit-new/images/reuseit-bestallning.jpg" style="float:left;"> Beställningsvara, 5-10 dagars leveranstid</span>', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( $data['stock_status'] == 'outofstock' ) {
        $availability['availability'] = __('<span class="not-instock"><img src="/wp-content/themes/reuseit-new/images/reuseit-ej-i-lager.jpg" style="float:left;"> Ej i lager</span>', 'woocommerce');
    }
    return $availability;
      // Change In Stock Text
     /* if ( $_product->is_in_stock() ) {
          $availability['availability'] = __('<i class="fa fa-smile-o" aria-hidden="true"></i> I lager!', 'woocommerce');
      }
      // Change Out of Stock Text
      if ( ! $_product->is_in_stock() ) {
          $availability['availability'] = __('<i class="fa fa-frown-o" aria-hidden="true"></i> Ej i lager', 'woocommerce');
      }
      return $availability;*/
  }



//   function woocommerce_ajax_add_to_cart_js() {
//     if (function_exists('is_product') && is_product()) {
//         wp_enqueue_script('woocommerce-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/ajax-add-to-cart.js', array('jquery'), '', true);
//     }
// }
// add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);


//Change tax rate based on session
function woo_diff_rate_for_user( $tax_class, $product ) {
	$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if (strpos($url,'wp-admin') !== false) {

	} else {
    	$company = WC()->session->get( 'my_custom_tax_rate_company' );
	    if ($company == 1) {

	        /*$tax_class = "Zero Rate";*/
	    }
	    return $tax_class;
	}
}
add_filter( "woocommerce_product_get_tax_class", "woo_diff_rate_for_user", 1, 2 );
add_filter( "woocommerce_product_variation_get_tax_class", "woo_diff_rate_for_user", 1, 2 );


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $variation_id = absint($_POST['variation_id']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);

            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

                do_action('woocommerce_ajax_added_to_cart', $product_id);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }

                global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                $categorie_name = get_the_terms(  $product_id, 'brand' );
                $key_hash = array();
                $product_woo = wc_get_product( $product_id );
                $list_img = get_field('product_list_image', $product_id);
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'single-post-thumbnail' );
                $prod_img = $image[0] != "" ? $image[0] : get_template_directory_uri().'/images/no-image.png';


                foreach($items as $item => $values) {
                    if( $values['product_id'] == $product_id ) {
                        array_push($key_hash ,$values['key']);
                    }

                }
                $company = WC()->session->get( 'my_custom_tax_rate_company' );
                if($company == 1){
	                $price_ = $price_ = wc_get_price_excluding_tax($product_woo);
	                $eprice_ = wc_get_price_including_tax($product_woo);
	                $tax = $eprice_ - $price_;
                } else {
	                $price_ = wc_get_price_including_tax($product_woo);
	                $eprice_ = wc_get_price_excluding_tax($product_woo);
	                $tax = $price_ - $eprice_;
                }
                $data = array (
                    'success' => true,
                    'product_url' => $items,
                    'prod_name' => get_the_title($product_id),
                    'cat_name' => $categorie_name[0]->name,
                    'key'   => $key_hash,
                    'prod_price' => $price_,
                    'curr'         => get_woocommerce_currency_symbol(),
                    'product_img' => $prod_img,
                    'cart_total' => $woocommerce->cart->total,
                    'cart_tax' => round($tax),
                    'quantity' => $woocommerce->cart->get_cart_item_quantities()[$product_id],
                    'total_items' => $woocommerce->cart->get_cart_contents_count(),
                    'site_wp_url' => get_template_directory_uri(),
                );

                echo wp_send_json($data);

                WC_AJAX :: get_refreshed_fragments();
            } else {

                $data = array(
                    'cart_items' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));


                echo wp_send_json($data);
            }

            wp_die();
        }




        // Remove product in the cart using ajax
function warp_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();
    global $woocommerce;
    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
        'cart_total' => $woocommerce->cart->total,
        'total_items' => $woocommerce->cart->get_cart_contents_count(),
        'curr'         => get_woocommerce_currency_symbol(),
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );









function product_pagination_by_category() {
    if( is_product_category() )
        $limit = -1;

    return isset($limit) ? $limit : false;
}
add_filter( 'loop_shop_per_page', 'product_pagination_by_category');


//Unset klarna chekout for company and unset invoice for privat
add_filter('woocommerce_available_payment_gateways','filter_gateways',1);
function filter_gateways($gateways){
	$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if (strpos($url,'wp-admin') !== false) {

	} else {
	    global $woocommerce;
		$company = WC()->session->get('my_custom_tax_rate_company');
		if($company == 1){
			unset($gateways['kco']);
		} else {
			unset($gateways['cod']);
			unset($gateways['hyra_reuseit']);
		}
		//Remove a specific payment option
	}

    return $gateways;
}

/*add_filter( 'woocommerce_checkout_fields' , 'custom_mod_checkout_fields' );
function custom_mod_checkout_fields( $fields ) {
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_state']);
return $fields;
}*/


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
	$company = WC()->session->get( 'my_custom_tax_rate_company' );
	if($company == 1){
    	$fields['billing']['billing_company']['required'] = true;
    } else {
	    $fields['billing']['billing_company']['required'] = false;
    }
     unset($fields['billing']['billing_address_2']);
     unset($fields['billing']['shipping_address_2']);
     unset($fields['billing']['billing_state']);
     return $fields;
}




add_action( 'woocommerce_before_order_notes', 'bbloomer_add_custom_checkout_field' );

function bbloomer_add_custom_checkout_field( $checkout ) {
	$company = WC()->session->get( 'my_custom_tax_rate_company' );
	if($company == 1){
	   woocommerce_form_field( 'organisationsnummer', array(
	      'type' => 'text',
	      'class' => array( 'form-row-wide' ),
	      'label' => 'Organisationsnummer',
	      'placeholder' => '',
	      'required' => true,
	      'priority' => 10,
	   ), $checkout->get_value( 'organisationsnummer' ) );
   } else {

   }
}



add_action( 'woocommerce_checkout_update_order_meta', 'bbloomer_save_new_checkout_field' );

function bbloomer_save_new_checkout_field( $order_id ) {
    if ( $_POST['organisationsnummer'] ) update_post_meta( $order_id, '_organisationsnummer', esc_attr( $_POST['organisationsnummer'] ) );
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'bbloomer_show_new_checkout_field_order', 10, 1 );

function bbloomer_show_new_checkout_field_order( $order ) {
   $order_id = $order->get_id();
   if ( get_post_meta( $order_id, '_organisationsnummer', true ) ) echo '<p><strong>Organisationsnummer:</strong> ' . get_post_meta( $order_id, '_organisationsnummer', true ) . '</p>';
}

add_action( 'woocommerce_email_after_order_table', 'bbloomer_show_new_checkout_field_emails', 20, 4 );

function bbloomer_show_new_checkout_field_emails( $order, $sent_to_admin, $plain_text, $email ) {
    if ( get_post_meta( $order->get_id(), '_organisationsnummer', true ) ) echo '<p><strong>Organisationsnummer:</strong> ' . get_post_meta( $order->get_id(), '_organisationsnummer', true ) . '</p>';
}



function create_list_item_two($id, $class = null) {
    $_product = wc_get_product($id);
    $currencySymbol = get_woocommerce_currency_symbol();
    $prods = new WC_product($id);
    $good_val = get_field('good_value_product', $id);
    $list_img = get_field('product_list_image', $id);
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) ,'medium');
    $desc .= get_field('product_list_desc', $id) ? '<p class="some-product-description">' . get_field('product_list_desc', $id) . '</p>' : '';
    $brands = get_the_terms($id, 'brand');
    $grades = get_the_terms($id, 'grade');
    $grade  = !empty($grades) ? $grades[0]->name : '';


    if ($grade == 'A') {
        $gradetext = 'Mycket bra skick';
        $grade  = '<div class="grade"><div class="grade-a">' . $grade . '</div></div>';
        $grade1  = '<div class="text_garde">'.$gradetext.'</div>';

   } elseif ($grade == 'B') {
        $gradetext = 'Bra skick';
        $grade  = '<div class="grade"><div class="grade-b">' . $grade . '</div></div>';
        $grade1  = '<div class="text_garde">'.$gradetext.'</div>';

   } elseif ($grade == 'C') {
        $gradetext = 'OK skick';
        $grade  = '<div class="grade"><div class="grade-c">' . $grade . '</div></div>';
        $grade1  = '<div class="text_garde">'.$gradetext.'</div>';

   } elseif ($grade == 'S') {
        //$grade = 'Mycket bra skick';
        $grade  = '<div class="grade"><div class="grade-s">' . $grade . '</div></div>';
   } elseif ($grade == 'Ny') {
        $gradetext = 'Ny produkt';
        $grade  = '<div class="grade"><div class="grade-ny">' . $grade . '</div></div>';
        $grade1  = '<div class="text_garde">'.$gradetext.'</div>';

   } else {
        $grade = '';
        $grade1 = '';
   }

    $prod_img = $image[0] != "" ? $image[0] : get_template_directory_uri().'/images/no-image.png';
    //$stock = $_product->get_stock_quantity() > 0 ? '<span class="instock">I lager</span>' : '<span class="not-instock">Ej i lager</span>';
    $stockstatus = $_product->get_stock_status();
    if($stockstatus == 'instock'){
    $stock = '<span class="instock"><img src="/wp-content/themes/reuseit-new/images/reuseit-i-lager.jpg" style="float:left;"> I lager</span>';
    }else if($stockstatus == 'onbackorder'){
      $stock = '<span class="backorder"><img src="/wp-content/themes/reuseit-new/images/reuseit-bestallning.jpg" style="float:left;"> Beställningsvara</span>';
    }else{
      $stock = '<span class="not-instock"><img src="/wp-content/themes/reuseit-new/images/reuseit-ej-i-lager.jpg" style="float:left;"> Ej i lager</span>';
    }
    if( !is_admin()){
      $company = WC()->session->get( 'my_custom_tax_rate_company' );
    }
    else {
      $company = NULL;
    }


  $regular_price = $_product->get_regular_price();
  $sale_price = $_product->get_price();
  if($company == 1){

    $regular_price_tax = wc_get_price_excluding_tax( $_product, array('price' => $regular_price ) );
    $sale_price_tax = wc_get_price_excluding_tax( $_product, array('price' => $sale_price ) );
    $rentprice = round(($sale_price_tax*0.032),0);
    $extraContent = '<span class="tax-span" style="font-size:14px;margin-top:5px;">Hyra: <b>'.$rentprice.'kr/mån</b> vid hyra 36 månader</span>';
    $moms = '  <span class="tax-span-list">(ex. moms)</span>';
  }
  else {

    $regular_price_tax = wc_get_price_including_tax( $_product, array('price' => $regular_price ) );
    $sale_price_tax = wc_get_price_including_tax( $_product, array('price' => $sale_price ) );
    $moms = '  <span class="tax-span-list">(ink. moms)</span>';
    $extraContent = '';
  }
  $saving_price = wc_price( $regular_price_tax - $sale_price_tax );
  $precision = 1; // Max number of decimals
  $saving_percentage = round( 100 - ( $sale_price_tax / $regular_price_tax * 100 )) . '%';

    if( $class ) {

        $html = '';


                // OVDE SNE TOP
                $html .= '<div class="slider-inner-img-wrapper img-wrapper">';
                    $html .= '<a href="'.get_permalink($id).'">';
                    // $html .= $grade;
                      $html .= $grade1;

                      $html .= '<div class="thumb-slider-holder">';
                        $html .= $sale_price_tax !== $regular_price_tax ? '<span class="spara">Spara ' . $saving_percentage . '</span>' : '';
                        $html .= $good_val ? '<span class="good_value"><img src="' . get_bloginfo("template_directory") . '/images/good-value.png"></span>' : '';
                        $html .= '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid"></div>';
                    $html .= '</a>';
                    $html .= '<div class="add-to-cart-holder"><div class="add-to-cart">';
                        $html .= '<a href="'.get_permalink($id).'">';
                            $html .= '<span class="go-to-product">+</span>';
                        $html .= '</a>';
                        $html .= $sale_price_tax ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
                        $html .= $sale_price_tax ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
                    $html .= '</div></div>';
                $html .= '</div>';
                $html .= '<div class="content-wrapper-product-slider">';
                $html .= '<div class="first">';
                    $html .= '<a href="'.get_permalink($id).'">';
                        $html .= '<h3>'.get_the_title($id).'</h3>';
                        $html .= $desc;
                    $html .= '</a>';
                $html .= '</div>';

                $html .= '<div class="second">';

                    $html .= $sale_price_tax !== $regular_price_tax ?
                      '<div class="two-prices-with-tax"><div class="two-prices"><div class="sale-price">' . $sale_price_tax .':- ' . '</div>
                      <div class="divide-prices">/</div>
                      <div class="inline-with-price regular-price-with-sale">' . $regular_price_tax .':-' .
                      '</div></div></div>' :
                      '<div class="inline-with-price regular-price regular-price-on-lists">'
                        . $sale_price_tax .':-
                      </div>';
                    $html .= '<div class="extra-content">'.$moms.'</div>';
                    $html .= '<div class="extra-content">'.$extraContent.'</div>';
                    $html .= $stock;

                $html .= '</div>';


            $html .= '</div>';



    } else {
        // OVDE SNE BOTTOM
        $html = '';


            $html .= '<div class="slider-inner-img-wrapper img-wrapper">';
                $html .= '<a href="'.get_permalink($id).'">';
                // $html .= $grade;
                  $html .= $grade1;
                  $html .= '<div class="thumb-slider-holder">';
                    $html .= $sale_price_tax !== $regular_price_tax ? '<span class="spara">Spara ' . $saving_percentage . '</span>' : '';
                    $html .= $good_val ? '<span class="good_value"><img src="' . get_bloginfo("template_directory") . '/images/good-value.png"></span>' : '';
                    $html .= '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid"></div>';
                $html .= '</a>';
                $html .= '<div class="add-to-cart-holder"><div class="add-to-cart">';
                    $html .= '<a href="'.get_permalink($id).'">';
                        $html .= '<span class="go-to-product">+</span>';
                    $html .= '</a>';
                    $html .= $sale_price_tax ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
                    $html .= $sale_price_tax ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
                $html .= '</div></div>';
            $html .= '</div>';
            $html .= '<div class="content-wrapper-product-slider">';
                $html .= '<div class="first">';
                    $html .= '<a href="'.get_permalink($id).'">';
                        $html .= '<h3>'.get_the_title($id).'</h3>';
                        $html .= $desc;
                    $html .= '</a>';
                $html .= '</div>';
                $html .= '<div class="second">';

                    $html .= $sale_price_tax !== $regular_price_tax ?
                      '<div class="two-prices-with-tax"><div class="two-prices"><div class="sale-price">' . $sale_price_tax .':- ' . '</div>
                      <div class="divide-prices">/</div>
                      <div class="inline-with-price regular-price-with-sale">'.$regular_price_tax .':-' .
                      '</div></div></div>' :
                      '<div class="inline-with-price regular-price regular-price-on-lists">'
                        . $sale_price_tax .':-
                      </div>';
                    $html .= '<div class="extra-content">'.$moms.'</div>';
                    $html .= '<div class="extra-content">'.$extraContent.'</div>';
                    $html .= $stock;

                $html .= '</div>';


            $html .= '</div>';





    }
    return $html;
  }

/*add_action( 'woocommerce_review_order_after_shipping', 'ts_review_order_after_shipping', 10 );
function ts_review_order_after_shipping(){
	$company = WC()->session->get( 'my_custom_tax_rate_company' );
	global $woocommerce;
	$totalItemsInCart = $woocommerce->cart->total;
	$tax = $woocommerce->cart->total * 0.25;

	if($company == 1){
		echo '<tr class="order-total">
			<th>Moms</th>
			<td><span class="woocommerce-Price-amount amount">'.round($tax).'<span class="woocommerce-Price-currencySymbol">kr</span></span></td>
		</tr>';
	}

}*/
