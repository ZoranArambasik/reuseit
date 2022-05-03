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
$id = 'product-slider' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'product-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


$products = get_field('prod_products_slider');
if( $products ): ?>
  
    
    <div class="product-holder">
      <div class="prev-next-products">
        <div class="previous_product"><span  class="lnr lnr-chevron-left"></span></div>
        <div class="next_product"><span class="lnr lnr-chevron-right"></span></div>
      </div>
      <?php if (get_field('product_slider_title')) { ?>
        <h2><?php echo get_field('product_slider_title'); ?></h2>
      <?php } ?>
      <div class="product-slider">
      <?php foreach( $products as $post ): 
          setup_postdata($post); ?>
          <div class="slider-img-wrapper">
              <?php echo create_list_item_two($post->ID); ?>
          </div>
      <?php endforeach; ?>
      </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>