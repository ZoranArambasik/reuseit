<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-top' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider-top';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('slider_images') ): ?>
<div class="slide-image-and-text">
<div class="slide-images">
    <?php
    while ( have_rows('slider_images') ) : the_row(); ?>
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
            
              <div class="slider-text">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6 ml-md-auto pl-md-5">
                        <div class="small-text"><?php the_sub_field('slider_small_text'); ?></div>
                        <h1 class="large-text"><?php the_sub_field('slider_large_text'); ?></h1>
                         <?php 
                         $link = get_sub_field('slider_button');
                         if( $link ): ?>
                            <div class="slider-button">
                                <?php
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="url-button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                            </div>
                        <?php endif; ?> 
                      </div>
                      <div class="col-md-6">

                        <div class="header-image">
                            <?php
                              $image = get_sub_field('slider_img'); 
                              echo "<img src='" .$image. "' alt='Slide Image'>";
                             ?>
                         </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div> 
   <?php endwhile; ?>
</div>
<div class="prev-next">
  <div class="previous_slick"><span class="lnr lnr-chevron-left"></span></div>
  <div class="next_slick"><span class="lnr lnr-chevron-right"></span></div>
</div>
<?php   
endif;
?>
</div>