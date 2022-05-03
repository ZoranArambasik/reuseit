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
$id = 'two-columns-text-image' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-columns-text-image';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div class="text-cl-image">
    <div class="container">
        <div class="row pr-md-3">
            <?php if (have_rows('column_one')): while(have_rows('column_one')): the_row() ?>
                <div class="col-md-6">
                    <div class="inner-column-one">
                        <div class="row">
                            <div class="col-lg-5 pl-lg-5 pb-lg-5 pt-lg-4">
                                <div class="txt-right-holder">
                                    <h3 class="back-from-button"><?php echo get_sub_field('title'); ?></h3>
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
                           
                            <div class="col-lg-7 ml-lg-auto">
                                <div class="img-r-holder">
                                    <?php $pi2 = get_sub_field('image_right_one'); ?>
                                    <?php if (!empty($pi2)): ?> 
                                        <img src="<?php echo esc_url($pi2['url']); ?>" alt="<?php echo esc_attr($pi2['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php if (have_rows('column_two')): while(have_rows('column_two')): the_row() ?>
                <div class="col-md-6">
                    <div class="inner-column-two">
                        <div class="row">
                            <div class="col-lg-5 pl-lg-5 pb-lg-5 pt-lg-4">
                                <div class="txt-right-holder">
                                    <h3 class="back-from-button"><?php echo get_sub_field('title'); ?></h3>
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
                           
                            <div class="col-lg-7 ml-lg-auto second-inner-img-holder">
                                <div class="img-r-holder">
                                    <?php $pi = get_sub_field('image_right'); ?>
                                    <?php if (!empty($pi)): ?> 
                                        <img src="<?php echo esc_url($pi['url']); ?>" alt="<?php echo esc_attr($pi['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>