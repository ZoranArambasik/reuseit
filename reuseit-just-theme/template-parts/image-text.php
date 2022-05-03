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
$id = 'image-text' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-text';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php if (have_rows('image_text_section')): while(have_rows('image_text_section')): the_row() ?>
<div class="image-text">
    <div class="container">
        <div class="row row-eq-height row pr-lg-3">
            <div class="col-lg-7 pr-lg-0">
                <div class="img-left-holder">
                    <?php $pi = get_sub_field('image_left'); ?>
                    <?php if (!empty($pi)): ?> 
                        <img src="<?php echo esc_url($pi['url']); ?>" alt="<?php echo esc_attr($pi['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center pl-lg-5 pr-lg-5 pb-lg-5 pt-lg-4 col-text-right-holder">
                <div class="txt-right-holder">
                    <h2><?php echo get_sub_field('title'); ?></h2>
                    <div class="desc"><?php echo get_sub_field('description'); ?></div>
                    <?php
                    $link2 = get_sub_field('button');
                    if( $link2 ): 
                        $link_url = $link2['url'];
                        $link_title = $link2['title'];
                        $link_target = $link2['target'] ? $link2['target'] : '_self';
                        ?>
                        <a class="url-button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>