<?php
// Register and load the widget
function wpb_load_products_featured_widget() {
    register_widget( 'wp_prdocuts_featured_frontpage_widget' );
}

add_action( 'widgets_init', 'wpb_load_products_featured_widget' );

// Creating the widget
class wp_prdocuts_featured_frontpage_widget extends WP_Widget {


function __construct() {
parent::__construct('wp_prdocuts_featured_frontpage_widget',__('Products featured frontpage widget', 'wpb_widget_domain'),
      array( 'description' => __( 'Products featured frontpage widget', 'wpb_widget_domain' ), ));
}

// Creating widget front-end

public function widget( $args, $instance ){

  //echo $args['before_title'] . $title . $args['after_title'];

  $title = $instance['title'];
  $text = $instance['text'];

  //Get the steps..
  $box = get_field('prod_featured_products', 'widget_' . $args['widget_id']);



  echo  '<div class="col-12 products-section mb-5" id="feutured-products">';
    echo '<div class="row">';
        echo '<div class="col-12 centered mb-4">';
            echo '<h3>'.$title.'</h3>';
        echo '</div>';
    echo '</div>';
  echo '<div class="row">';


    if(is_array($box)) {

        foreach ($box as $key => $value) {
          $id = $value->ID;
          $_product = wc_get_product( $id);
          $currencySymbol = get_woocommerce_currency_symbol();
          $prods = new WC_product($id);
         //echo "<pre>".print_r($prods, 1)."</pre>";
		  $image = wp_get_attachment_image_src( get_post_thumbnail_id($id) ,'medium');
          $list_img = get_field('product_list_image', $id);
          $desc = get_field('product_list_desc', $id);
          $brands = get_the_terms($id, 'brand');
           $grades = get_the_terms($id, 'grade');
           $grade  = $grades[0]->name;

           if ($grade == 'A') {
               $grade  = '<div class="grade"><div class="grade-a">' . $grade . '</div></div>';
          } elseif ($grade == 'B') {
               $grade  = '<div class="grade"><div class="grade-b">' . $grade . '</div></div>';
          } elseif ($grade == 'C') {
               $grade  = '<div class="grade"><div class="grade-c">' . $grade . '</div></div>';
          } else {
               $grade = '';
          }
          $company = WC()->session->get( 'my_custom_tax_rate_company' );
			if($company == 1){
				$price = wc_get_price_excluding_tax($_product);
				$moms = '  <span class="tax-span">(ex. moms)</span>';
				$rentprice = round(($price*0.032),0);
			$extraContent = '<span class="tax-span" style="font-size:15px;margin-top:5px;">Hyra: <b>'.$rentprice.'kr/mån</b> vid hyra 36 månader</span>';
			} else {
				$price = wc_get_price_including_tax($_product);
				$moms = '  <span class="tax-span">(ink. moms)</span>';
				$extraContent = '';
			}
          $prod_img = $image[0] != "" ? $image['0'] : get_template_directory_uri().'/images/no-image.png';
          //$stock = $_product->get_stock_quantity() > 0 ? '<span class="instock">I lager</span>' : '<span class="not-instock">Ej i lager</span>';
		    $stockstatus = $_product->get_stock_status();
		    if($stockstatus == 'instock'){
				$stock = '<span class="instock">I lager</span>';
		    }else if($stockstatus == 'onbackorder'){
			    $stock = '<span class="backorder">Beställningsvara</span>';
		    }else{
			    $stock = '<span class="not-instock">Ej i lager</span>';
		    }
          if( $key === 0 ) {

            echo '<div class="col-6 col-sm-6 col-md-4 col-lg-3 small-image productbox mb-3" data-price="'.$price.'">';
            echo '<div class="wrapper">';
            echo '<div class="img-wrapper">';
              echo '<a href="'.get_permalink($id).'">';
              echo $grade;
              echo '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid">';
              echo '</a>';
              echo '<div class="add-to-cart-holder"><div class="add-to-cart">';
                echo '<a href="'.get_permalink($id).'"><span class="go-to-product">+</span></a>';
                echo $_product->get_price() ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
                echo $_product->get_price() ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
              echo '</div></div>';
            echo '</div>';
            echo '<div class="content-wrapper">';
            echo '<div class="first">';
            echo '<a href="'.get_permalink($id).'">';
            echo '<h3>'.get_the_title($id).'</h3>';
            echo '<p>'.$desc.'</p>';
            echo '</a>';
            echo '</div>';
            echo '<div class="second">';
            echo '<h4>'.$price.' '.$currencySymbol.' '.$moms.'</h4>';
            echo $stock;
            echo $extraContent;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


          } else {

            echo '<div class="col-6 col-sm-6 col-md-4 col-lg-3 small-image productbox mb-3" data-price="'.$price.'">';    
            echo '<div class="wrapper">';
            echo '<div class="img-wrapper">';
              echo '<a href="'.get_permalink($id).'">';
              echo $grade;
              echo '<img src="'.$prod_img.'" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image img-fluid">';
              echo '</a>';
              echo '<div class="add-to-cart-holder"><div class="add-to-cart">';
                echo '<a href="'.get_permalink($id).'"><span class="go-to-product">+</span></a>';
                echo $_product->get_price() ? '<span class="add-to-cart-span"><img src="'.get_template_directory_uri().'/images/cart_icon.png" class="img-fluid add add_to_cart_button_woo" data-id="'.$id.'" alt="add to cart"></span>' : '';
                echo $_product->get_price() ? '<img src="'.get_template_directory_uri().'/images/tail-spin.svg" class="img-fluid spinner"" alt="spinner">' : '';
              echo '</div></div>';
            echo '</div>';
            echo '<div class="content-wrapper">';
            echo '<div class="first">';
            echo '<a href="'.get_permalink($id).'">';
            echo '<h3>'.get_the_title($id).'</h3>';
            echo '<p>'.$desc.'</p>';
            echo '</a>';
            echo '</div>';
            echo '<div class="second">';
            echo '<h4>'.$price.' '.$currencySymbol.' '.$moms.'</h4>';
            echo $stock;
            echo $extraContent;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

          }

        }


    }
  echo '</div>';

  echo '</div>';

}



// Widget Backend
public function form( $instance ) {

$title   =  isset( $instance['title'] ) ? $instance['title'] : '';
$text   =  isset( $instance['text'] ) ? $instance['text'] : '';

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<input class="widefat" placeholder="Text" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text); ?>" />
</p>

<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();

$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? ( $new_instance['title'] ) : '';
$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? ( $new_instance['text'] ) : '';
return $instance;

}




} // Class wp_prdocuts_featured_frontpage_widget ends her
