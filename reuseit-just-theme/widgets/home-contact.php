<?php
// Register and load the widget
function wpb_contact_puff_widget() {
    register_widget( 'wp_puff_contact_widget' );
}

add_action( 'widgets_init', 'wpb_contact_puff_widget' );

// Creating the widget
class wp_puff_contact_widget extends WP_Widget {


function __construct() {
parent::__construct('wp_puff_contact_widget',__('Puff Contact widget', 'wpb_widget_domain'),
      array( 'description' => __( 'Puff Contact widget', 'wpb_widget_domain' ), ));
}

// Creating widget front-end

public function widget( $args, $instance ){

  $title = $instance['title'];
  $text = $instance['text'];

  //Get the steps..
  $box = get_field('puff_contact', 'widget_' . $args['widget_id']); 
  $widget_id = $args['widget_id'];
  echo  '<div class="container mt-5"><div class="mx-auto col-12 col-lg-10 col-md-10 puff-contact" id='.$widget_id.'>';
    echo '<h3>' . $title . '</h3>';
    echo $box;
    echo '</div></div>';
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

} // Class wp_puff_contact_widget ends her
