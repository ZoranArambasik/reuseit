<?php
// Register and load the widget
function wpb_load_puff_widget() {
    register_widget( 'wp_puff_frontpage_widget' );
}

add_action( 'widgets_init', 'wpb_load_puff_widget' );

// Creating the widget
class wp_puff_frontpage_widget extends WP_Widget {


function __construct() {
parent::__construct('wp_puff_frontpage_widget',__('Puff frontpage widget', 'wpb_widget_domain'),
      array( 'description' => __( 'Puff frontpage widget', 'wpb_widget_domain' ), ));
}

// Creating widget front-end

public function widget( $args, $instance ){

  $title = $instance['title'];
  $text = $instance['text'];

  //Get the steps..
  $box = get_field('puff_box', 'widget_' . $args['widget_id']); 
  $widget_id = $args['widget_id'];
  echo  '<div class="col-12 puff-section" id='.$widget_id.'><div class="row">';

    if(is_array($box)) {
        foreach ($box as $key => $value) {
          // var_dump($value);
          $size = '';

          if( $value['puff_size'] == '33' ) {
            $size = 'col-md-4 col-lg-4';
          } elseif( $value['puff_size'] == '50' ) {
            $size = 'col-md-6 col-lg-6';
          } else {
            $size = 'col-lg-12';
          }

          $txt_pos = $value['puff_text_position'] == 'center' ? 'center' : 'left';
          

          $height = $value['puff_height'] != "" ? 'height: '.$value['puff_height'].'px;' : '';
          echo '<div class="col-12 item '.$size.' mb-4">';
            echo '<div class="item-wrap item-wrap-'.$value['puff_image']['ID'].'" style=" background-color: '.$value['puff_color'].'; background-image:url('.$value['puff_image']['url'].'); '.$height.' ">';
              echo '<div class="content '.$txt_pos.'" style=" color: '.$value['puff_text_color'].' ">';
                echo '<img class="sm-img" src="'.$value['small_right_image'].'">';
                echo '<h3 style=" color: '.$value['puff_text_color'].' ">'.$value['puff_title'].'</h3>';
                echo $value['puff_description'];
                echo !empty($value['puff_link']) ? '<div class="link-section"><a href="'.$value['puff_link']['url'].'">'.$value['puff_link']['title'].'</a></div>' : '';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
    }
    
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

} // Class wp_puff_frontpage_widget ends her
