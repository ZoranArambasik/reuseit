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
$id = 'icons-with-text' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'icons-with-text';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('icons_and_text') ): ?>
  <div class="container">
    <div class="icons-text">
      <div class="row align-items-center icons_and_text">
        <?php
        while ( have_rows('icons_and_text') ) : the_row();
            $image = get_sub_field('add_image');
            $text = get_sub_field('add_text');
            ?>
            <div class="icons_each mb-4">
              <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> ">
                  <div class="icon-image">
                      <?php
                          echo "<img src='" .$image. "' alt='Icon'>";
                       ?>
                   </div>
                   <div class="next-to-icon"><?php echo $text; ?></div>
              </div>
            </div> 
       <?php endwhile; ?>
     </div>
    </div>
  </div>
<?php endif; ?>
