<?php
// Register and load the widget
function wpb_load_products_widget() {
    register_widget( 'wp_prdocuts_frontpage_widget' );
}

add_action( 'widgets_init', 'wpb_load_products_widget' );

// Creating the widget
class wp_prdocuts_frontpage_widget extends WP_Widget {


function __construct() {
parent::__construct('wp_prdocuts_frontpage_widget',__('Products frontpage widget', 'wpb_widget_domain'),
      array( 'description' => __( 'Products frontpage widget', 'wpb_widget_domain' ), ));
}

// Creating widget front-end

public function widget( $args, $instance ){

  //echo $args['before_title'] . $title . $args['after_title'];

  $title = $instance['title'];
  $text = $instance['text'];

  //Get the steps..
  $box = get_field('prod_products', 'widget_' . $args['widget_id']);


 
  echo  '<div class="col-12 products-section" id="new-products">';
    echo '<div class="row">';
        echo '<div class="col-12 centered mb-4">';
            echo '<h3>'.$title.'</h3>';
        echo '</div>';
    echo '</div>';
  echo '<div class="row">';

   
    if(is_array($box)) :
  
        foreach ($box as $key => $value) :
          
            echo create_list_item($value->ID);
          endforeach;
    endif;

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

} // Class wp_prdocuts_frontpage_widget ends her
