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
$id = 'two-columns-text-inside-image' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-columns-text-inside-image';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div class="two-columns-text-inside-image">
    <div class="container">
        <div class="row">
            <?php if (have_rows('column_one_inside')): while(have_rows('column_one_inside')): the_row() ?>
                <div class="col-md-6">
                    <div class="inner-txt-inside-image">
                       
                        <div class="full-size-image">
                            <?php $pi = get_sub_field('image_top_one'); ?>
                            <?php if (!empty($pi)): ?> 
                                <img src="<?php echo esc_url($pi['url']); ?>" alt="<?php echo esc_attr($pi['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="txt-inside-image">
                            <h3 class="back-from-button"><?php echo get_sub_field('title'); ?></h3>
                            <div class="description"><?php echo get_sub_field('description'); ?></div>
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
            <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('column_two_inside')): while(have_rows('column_two_inside')): the_row() ?>
                <div class="col-md-6">
                    <div class="inner-txt-inside-image">
                        
                        <div class="full-size-image">
                            <?php $pi = get_sub_field('image_top_one'); ?>
                            <?php if (!empty($pi)): ?> 
                                <img src="<?php echo esc_url($pi['url']); ?>" alt="<?php echo esc_attr($pi['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="txt-inside-image">
                            <h3 class="back-from-button"><?php echo get_sub_field('title'); ?></h3>
                            <div class="description"><?php echo get_sub_field('description'); ?></div>
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
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>