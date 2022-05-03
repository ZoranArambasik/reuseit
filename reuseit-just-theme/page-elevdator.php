<?php
/**
* Template Name: Elevdator
 */

get_header(); ?>



	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'elevdator' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
 echo  '<div class="col-12 puff-section"><div class="row">';
 $buy_t = get_field('buy_title');
 $buy_d = get_field('buy_description');
 $return_t = get_field('return_title');
 $return_d = get_field('return_description');
       
          echo '<div class="col-12 item col-md-6 col-lg-6 mb-4">';
            echo '<div class="item-wrap">';
              echo '<div class="content">';
                echo '<h3>'.$buy_t.'</h3>';
                echo $buy_d;
              echo '</div>';
            echo '</div>';
          echo '</div>';
          echo '<div class="col-12 item col-md-6 col-lg-6 mb-4">';
            echo '<div class="item-wrap">';
              echo '<div class="content">';
                echo '<h3>'.$return_t.'</h3>';
                echo $return_d;
              echo '</div>';
            echo '</div>';
          echo '</div>';

    
  echo '</div></div>';
get_footer();
