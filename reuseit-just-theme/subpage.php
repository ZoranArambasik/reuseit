<?php
/**
* Template Name: Subpage
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			$title = get_the_title();
				echo '<div class="container"><div class="row"><div class="col-12"><h1>'.$title.'</h1></div></div></div>';
				echo the_content();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
