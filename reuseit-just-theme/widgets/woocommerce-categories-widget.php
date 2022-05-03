<?php
// Register and load the widget
function wpb_load_wp_category_widget() {
    register_widget( 'wp_categories_frontpage_widget' );
}

add_action( 'widgets_init', 'wpb_load_wp_category_widget' );

// Creating the widget
class wp_categories_frontpage_widget extends WP_Widget {


function __construct() {
parent::__construct('wp_categories_frontpage_widget',__('Woo Categories frontpage widget', 'wpb_widget_domain'),
      array( 'description' => __( 'Woo Categories frontpage widget', 'wpb_widget_domain' ), ));
}

// Creating widget front-end

public function widget( $args, $instance ){

  

  $title = $instance['title'];
  $text = $instance['text'];

  //Get the steps..
  $post_objects = get_field('woo_categories_widget', 'widget_' . $args['widget_id']);
  if( $post_objects ):
    ?>
    <div class="cat-banner-holder-div mb-4">
      <div class="">
        <h3><?php echo $title; ?></h3>
        <p><?php echo $text;  ?></p>
      </div>
        <!-- <?php //echo $args['before_title'] . $title . $args['after_title']; ?> -->

      <ul class="cat-banner-holder p-2">

      <?php 
        $x = 1;
        $i = 0;
        $max = count($post_objects);

      foreach( $post_objects as $post_object):

          if ($x == $max && !($x % 2 == 0)) {
                $secondClass ='last-category-item';
          } else {
            $secondClass = '';
          }

       if( $i % 3 == 0) {
        $class = 'banner-item-long col-md-8 col-lg-8 col-sm-12';
       }
       else {
         $class = 'banner-item-normal col-md-4 col-lg-4 col-sm-12';
       } 
       
        $image = get_field('woocommerce_category_image', $post_object );
       
        $link = $post_object->slug; 
      ?>
        <li class="cat-banner-item <?php echo $class . ' ' . $secondClass; ?>">
          <div class="front-cat-image">
            <?php 
            if (empty($image)) { ?>
              <a href="<?php bloginfo('url') ?>/produkter/<?php echo $link ?>"><img src="<?php bloginfo('template_directory') ?>/images/no-image.png"></a>
           <?php } else { ?>
              <a href="<?php bloginfo('url') ?>/produkter/<?php echo $link ?>"><img src="<?php echo $image; ?>"></a>
          <?php } ?>
              
          </div>
          <div class="front-cat-text">
            <h3 class="cat-fr-text"><?php echo $post_object->name; ?></h3>
            <p class="cat-fr-link"><a href="<?php bloginfo('url') ?>/produkter/<?php echo $link ?>">Se vårt utbud</a></p>
          </div>
        </li>
       <?php
      $x++;
      $i++;

      if ($i > 3) {
          $i = 0;
      }
        endforeach; ?>
      </ul>
    </div>
  <?php endif;
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

} // Class wp_categories_frontpage_widget ends here
