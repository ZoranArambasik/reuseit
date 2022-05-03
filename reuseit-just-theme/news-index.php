
	<?php
	$args = array( 'post_type' => 'post', 'posts_per_page' => 4 );
	$loop = new WP_Query( $args );
	?>


		<div class="col-12 mb-5 news-section">
			<div class="row">
				<div class="col-12 centered mb-4">
					<h3>News</h3>
        		</div>
			</div>
			<div class="row">
				<?php foreach ($loop->posts as $key => $value) { 
					$img = get_field('news_image', $value->ID);
					$desc = get_field('news_description', $value->ID);
					$link = get_field('news_link', $value->ID);
					?>

					<div class="col-12 col-md-6 col-lg-3 mb-5 item">
						<div class="wrapper">
							<a href="<?php echo $link['url']; ?>">
								<div class="content">
									<div class="img-wrapper" style="background-image:url('<?php echo $img['url']; ?>');"></div>
									<div class="content-wrapper">
										<h3><?php echo get_the_title($value->ID); ?></h3>
										<p><?php echo $desc; ?></p>
									</div>
								</div>
							</a>
						</div>
					</div>

				<?php } ?>
			</div>
		</div>