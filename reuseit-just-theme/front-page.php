<?php
/*
Template Name: Homepage
*/

get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif;

// dynamic_sidebar('collections-frontpage');

//get_template_part( 'news', 'index' );


get_footer();