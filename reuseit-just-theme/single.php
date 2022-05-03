<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
	<?php woocommerce_breadcrumb(); global $post; ?>

	<div class="row">
		<div class="col-12">
			<div class="full-size-auto">
			<?php if ( has_post_thumbnail($post->ID) ) { 
			        echo get_the_post_thumbnail($post->ID, 'single_top_image');
			      }
			      else {
			          echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
			              . '/images/no-image.png" />';
			      } 
			?>
			</div>
		</div>
	<section id="primary" class="single-post-page content-area col-md-10 mx-auto">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			echo '<h1>' . get_the_title() . '</h1>';
			the_content();
			
			// get_template_part( 'template-parts/content', get_post_format() );

			    // the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</section><!-- #primary -->
	</div>
<?php
get_footer();
