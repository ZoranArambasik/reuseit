<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<!-- 1. Begagnad Laptop / koirsten laptop field.
2. Godina
3. HDD i memorija.
--------------------------

Finnis i lager - fiksna strana ja ima. -->

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'col-12', $product ); ?>>

<?php
				$grade = get_the_terms( $product->get_id(), 'grade' );
				$grades = get_the_terms($id, 'grade');
				$grade  = !empty($grades) ? $grades[0]->name : '';
				$gr_text = '';

				if ($grade == 'A') {
						$gradetext = 'Mycket bra skick';
						$grade_info  = '<div class="text_garde_singel_product">'.$gradetext.'</div>';
			 } elseif ($grade == 'B') {
						$gradetext = 'Bra skick';
						$grade_info  = '<div class="text_garde_singel_product">'.$gradetext.'</div>';

			 } elseif ($grade == 'C') {
						$gradetext = 'OK skick';
						$grade_info  = '<div class="text_garde_singel_product">'.$gradetext.'</div>';

			 } elseif ($grade == 'Ny') {
						$gradetext = 'Ny produkt';
						$grade_info  = '<div class="text_garde_singel_product">'.$gradetext.'</div>';

			 } else {
						$grade_info = '';
			 }

			 $text_lev_bild  = '<div class="text_lev_bild_product">Produktbild är en leverantörsbild (Ej exakt produkt)</div>';

			 $image_prod = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
			 $product_g = new WC_product(get_the_ID());
			 $attachment_ids = $product_g->get_gallery_image_ids();

			 ?>
	<div class="row single-product-wrapper">
		<div class="col-12 col-lg-2 img-wrapper extra-images pl-0 pr-0 d-none d-lg-block d-xl-block">
				<?php
				if( !empty($image_prod) ) {
						echo '<div class="col-12 mini_img">';
							echo '<div class="img-section-mini" onclick="javascript:ShowProductimage(0);">';
							echo '<img src="'.$image_prod[0].'" class="img-fluid" alt="">';
							echo '</div>';
					echo '</div>';
					}

					if( !empty($attachment_ids) ) {
						$countimg = 1;
						foreach( $attachment_ids as $attachment_id ) {
							// Display the image URL
							$original_image_url = wp_get_attachment_url( $attachment_id );


							echo '<div class="col-12 mini_img">';



								echo '<div class="img-section-mini" onclick="javascript:ShowProductimage('.$countimg.');">';
									echo '<img src="'.$original_image_url.'" class="img-fluid" alt="">';

								echo '</div>';

							echo '</div>';
							$countimg++;
						}
					}
				?>
		</div>
		<div class="col-12 col-lg-4 pr-lg-0 pl-lg-0 img-wrapper">
			<div class="single-product-slider">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				//do_action( 'woocommerce_before_single_product_summary' );

				if( !empty($image_prod) ) {

					echo '<div class="col-12 wrapper pl-0 pr-0">';

						echo '<div class="img-section">';
							echo $grade_info;
							echo '<img src="'.$image_prod[0].'" class="img-fluid" alt="">';
							echo $text_lev_bild;
						echo '</div>';

					echo '</div>';

				}

				if( !empty($attachment_ids) ) {
					foreach( $attachment_ids as $attachment_id ) {
						// Display the image URL
						$original_image_url = wp_get_attachment_url( $attachment_id );


						echo '<div class="col-12 wrapper pl-0 pr-0">';

							echo '<div class="img-section">';
								echo $grade_info;
								echo '<img src="'.$original_image_url.'" class="img-fluid" alt="">';
								echo $text_lev_bild;
							echo '</div>';

						echo '</div>';
					}
				}



				?>
			</div>
			<div class="prev-next">
			  <div class="previous_slick"><i class="fas fa-chevron-left"></i></div>
			  <div class="next_slick pr-lg-5"><i class="fas fa-chevron-right"></i></div>
			</div>
		</div>
		<?php
		/**
		 * ACF & other fields related to the product
		 *
		 */
		$id = get_the_ID();
		$title = get_the_title();
		$body = get_the_content();
		$desc = get_field('product_list_desc', $id);

		$brands = get_the_terms($id, 'brand');
		$product_model = get_field('product_model', $id);
		$product_display_type = get_field('product_display_type', $id);
		$product_formfactor = get_field('product_formfactor', $id);
		$product_storage = get_field('product_storage', $id);
		$product_storage_type = get_field('product_storage_type', $id);
		$product_graphics_card = get_field('product_graphics_card', $id);
		$product_optical_drive = get_field('product_optical_drive', $id);
		//$product_bluetooth = get_field('product_bluetooth', $id);
		$product_usb_ports = get_field('product_usb_ports', $id);
		$product_hdmi_ports = get_field('product_hdmi_ports', $id);
		$product_numeric = get_field('product_numberic_keypad', $id);
		$product_vga_ports = get_field('product_vga_ports', $id);
		//$product_audio_inout = get_field('product_audio_inout', $id);
		$product_touchpad = get_field('product_touchpad', $id);
		//$product_sdxc = get_field('product_sdxc', $id);
		$product_powersupply = get_field('product_powersupply', $id);
		$product_thunderbolt = get_field('product_thunderbolt', $id);
		$product_camera = get_field('product_camera', $id);
		$stockstatus = $product->get_stock_status();
		$brand = get_the_terms( $product->get_id(), 'brand' );

		$o_system = get_the_terms( $product->get_id(), 'operating_systems' );
		//  echo "<pre>".print_r($product->get_price(), 1)."</pre>";
		$company = WC()->session->get( 'my_custom_tax_rate_company' );
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_price();


		if ($grade == 'A') {
			$gr_text = 'Sparsamt använda produkter bra skick. Här kan du förvänta dig en produkt med mycket små tecken på användning. Inga, eller få minimala repor och andra märken på chassi.';
			$grade  = '<div class="grade-click">
							<div class="single-product-grade"><img src="/wp-content/themes/reuseit-new/images/reuseit-skick.jpg"></div>
							<span class="mm-strong"><strong>'.$gradetext.' </strong></span>
							<span class="with-underline">Läs mer.</span>
							<div class="grade-popup"><div class="single-product-grade">' . $grade . '</div> Sparsamt använda produkter bra skick. Här kan du förvänta dig en produkt med mycket små tecken på användning. Inga, eller få minimala repor och andra märken på chassi.<span class="close-grade-click">x</span></div>
						</div>';
		}
		elseif ($grade == 'B') {
			$gr_text = 'Fullt funktionella produkter men med slitage. Det förekommer synliga tecken på användning, så som repor och skrapmärken. Skärmen kan ha ytliga repor men är fri från sprickor.';
			$grade  = '<div class="grade-click">
							<div class="single-product-grade"><img src="/wp-content/themes/reuseit-new/images/reuseit-skick.jpg"></div>
							<span class="mm-strong"><strong>'.$gradetext.' </strong></span>
							<span class="with-underline">Läs mer.</span>
							<div class="grade-popup"><div class="single-product-grade">' . $grade . '</div> Fullt funktionella produkter men med slitage. Det förekommer synliga tecken på användning, så som repor och skrapmärken. Skärmen kan ha ytliga repor men är fri från sprickor.<span class="close-grade-click">x</span></div>
						</div>';
		}
		elseif ($grade == 'C') {
			$gr_text = 'Fullt funktionella produkter men med tydliga tecken på slitage såsom djupare repor, bucklor och märken.  Repor på skärmen samt små färgskiftningar på förekommer.';
			$grade  = '<div class="grade-click">
							<div class="single-product-grade"><img src="/wp-content/themes/reuseit-new/images/reuseit-skick.jpg"></div>
							<span class="mm-strong"><strong>'.$gradetext.'</strong></span>
							<span class="with-underline">Läs mer.</span>
							<div class="grade-popup">'.$grade.' Fullt funktionella produkter men med tydliga tecken på slitage såsom djupare repor, bucklor och märken.  Repor på skärmen samt små färgskiftningar på förekommer.<span class="close-grade-click">x</span></div>
						</div>';
		}
		elseif ($grade == 'S') {
			$gr_text = '';
			$grade  = '<div class="grade-click"><div class="single-product-grade">' . $gradetext . '</div></div>';
		}
		elseif ($grade == 'Ny') {
			$gr_text = 'Helt nya oanvända produkter.';
			$grade  = '<div class="grade-click">
						<div class="single-product-grade"><img src="/wp-content/themes/reuseit-new/images/reuseit-skick.jpg"></div>
						<span class="mm-strong"><strong>'.$gradetext.' </strong></span>
						<span class="with-underline">Läs mer.</span>
						<div class="grade-popup">'.$grade.' Helt nya oanvända produkter.<span class="close-grade-click">x</span></div>
					</div>';
		}

		else {
		 $grade = '';
		}



	    if($stockstatus == 'instock'){
			$stock = '<img src="/wp-content/themes/reuseit-new/images/reuseit-i-lager.jpg"><span class="instock">Finns i lager, <a href="'.get_bloginfo("url").'/vara-kopvillkor/">Leveranstid 2-4 arbetsdagar.</a></span>';
	    }else if($stockstatus == 'onbackorder'){
		    $stock = '<img src="/wp-content/themes/reuseit-new/images/reuseit-bestallning.jpg"><span class="backorder">Beställningsvara</span>';
	    }else{
		    $stock = '<img src="/wp-content/themes/reuseit-new/images/reuseit-ej-i-lager.jpg"><span class="not-instock">Ej i lager</span>';
	    }
		if($company == 1){

			$regular_price_tax = wc_get_price_excluding_tax( $product, array('price' => $regular_price ) );
			$sale_price_tax = wc_get_price_excluding_tax( $product, array('price' => $sale_price ) );

			$moms = '  <span class="tax-span">(ex. moms)</span>';
		}
		else {

			$regular_price_tax = wc_get_price_including_tax( $product, array('price' => $regular_price ) );
			$sale_price_tax = wc_get_price_including_tax( $product, array('price' => $sale_price ) );

			$moms = '<span class="tax-span">(ink. moms)</span>';


		}
		$saving_price = wc_price( $regular_price_tax - $sale_price_tax );
		$precision = 1; // Max number of decimals
		$saving_percentage = round( 100 - ( $sale_price_tax / $regular_price_tax * 100 )) . '%';
		?>
		<div class="col-12 col-lg-6 content-wrapper">
			<div class="item row">

				<div class="col-12 info-single-prod">
					<div class="top-product-info">
						<?php if ($brands): ?>
							<p class="brand-name"><?php echo $brands[0]->name; ?></p>
						<?php endif ?>
						<h1><?php echo $title; ?></h1>
						<?php if ($desc): ?>
							<p><?php echo $desc; ?></p>
						<?php endif ?>



						<div class="more-info mb-2">
							<p>Tillverkare <?php echo $brands[0]->name; ?> Art nr: <?php echo $product->get_sku(); ?></p>
						</div>
						<?php
						if( is_product() ) { // add in conditionals
								$text = $product->get_short_description();
								$words = 40; // change word length
								$more = ' …'; // add a more cta

								$post_post_excerpt = wp_trim_words( $text, $words, $more );
						}
						?>


						<p><span class="product_desc_text"><?php echo $post_post_excerpt; ?></span></p>
					</div>

					<div class="price-content" style="margin-top:10px;float:left;">
						<?php if ($sale_price_tax !== $regular_price_tax): ?>
							<div class="sale-price"><?php echo $sale_price_tax ?>:-<?php //echo get_woocommerce_currency_symbol(); ?></div><?php echo $moms; ?>
							<div class="regular-price-overline"><?php echo $regular_price_tax; ?>:- <?php //echo get_woocommerce_currency_symbol(); ?></div>
							<?php else: ?>
							<div class="sale-price"><?php echo $sale_price_tax ?>:-<?php //echo get_woocommerce_currency_symbol(); ?></div><?php echo $moms; ?>
						<?php endif; ?>
					</div>

					<div class="trust_product_page">
						<div class="trustpilot-widget" data-locale="sv-SE" data-template-id="5419b637fa0340045cd0c936" data-businessunit-id="4c5b1c9200006400050d7fdd" data-style-height="28px" data-style-width="100%" data-theme="light">
							<a href="https://se.trustpilot.com/review/reuseit.se" target="_blank" rel="noopener">Trustpilot</a>
						</div>
					</div>

					<?php
					if($company != 1) {
						?>
					<div class="klarna-placement">
						<klarna-placement
							data-key="credit-promotion-badge"
							data-locale="sv-SE"
							data-purchase-amount="<?php echo $sale_price_tax*100; ?>"
						></klarna-placement>
					</div>
					<?php }?>
					<?php
					if($company == 1) {
						$rentprice = round(($sale_price_tax*0.032),0); ?>
						<div class="klarna-placement">
						<span class="extra-tax-span tax-span" style="font-size:15px;">Hyra: <b><?php echo $rentprice;?>kr/mån</b> vid hyra 36 månader</span>
						</div>
					<?php }?>

					<div class="price-single-page">
						<div class="inner-price">
							<?php echo $grade; ?>
								</div>

						<div class="instock-product">
							<?php echo $stock; ?>
						</div>
					</div>



				</div>

				<div class="col-12">



					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */

					//do_action( 'woocommerce_single_product_summary' );

					woocommerce_template_single_add_to_cart();

					?>
				</div>
				<div class="productCheckboxes">
					<span><img src="<?php bloginfo('template_directory') ?>/images/cube.png">Fri frakt över 3000 kr</span>
					<span><img src="<?php bloginfo('template_directory') ?>/images/check.png">Minst 12 månaders garanti</span>
					<span><img src="<?php bloginfo('template_directory') ?>/images/bb.png">14 dagars fri returrätt</span>
				</div>

			</div>

		</div>



</div>
</div>
<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
//do_action( 'woocommerce_after_single_product_summary' );
if(get_the_ID() == 4151 || get_the_id() == 4296){ } else {
?>
<div class="container-fluid p-0 accordionbg">
<div class="col-12  container more-info-tabs accordion" id="myGroup">
	<div class="row">
		<div class="col-12 specification">
					<?php
						//echo "<pre>".print_r(get_post_meta($id, '_custom_product_ram_info', true), 1)."</pre>";
					?>
						<div class="row">
							<!-- <div class="col-12"><div><hr></div></div> -->
							<div class="col-12 tabsbg">
								<div class="item">
									<a href="#description" data-toggle="collapse" class="" aria-expanded="true" data-parent="#myGroup">Produktbeskrivning</a>
									<a href="#specification" data-toggle="collapse" class="collapsed" data-parent="#myGroup" >Specifikationer</a>
									<!-- <a href="#tillbehor" data-toggle="collapse" class="collapsed" data-parent="#myGroup" >Tillbehör</a> -->
								</div>
							</div>
							<div class="col-lg-8 col-md-8 mx-auto item-main-description">
								<div class="row align-items-center">
									<div class="col-md-8">
										<?php $mt = 'mt-5'; ?>
										<?php if (get_field('main_tab_title')): ?>
											<?php $mt = ''; ?>
											<h2><?php echo get_field('main_tab_title') ?></h2>
										<?php endif ?>
									</div>
									<?php if (get_field('shape_right_description_top_text') || get_field('shape_right_description_bottom_text')): ?>
										<div class="col-md-4 text-center">
											<div class="message-shape" style="background:url(<?php bloginfo('template_directory') ?>/images/flower-shape.png) no-repeat center center;">
												<div class="message-shape-inner">
													<div class="message-inner">
														<?php if (get_field('shape_right_description_top_text')): ?>
															<div class="shape-top-text"><?php echo get_field('shape_right_description_top_text') ?></div>
														<?php endif ?>
														<?php if (get_field('shape_right_description_bottom_text')): ?>
															<div class="shape-bottom-text"><?php echo get_field('shape_right_description_bottom_text') ?></div>
														<?php endif ?>
													</div>
												</div>
											</div>
										</div>
									<?php endif ?>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-8 col-md-8 mx-auto collapse show" id="description" data-parent="#myGroup">
								<div class="<?php echo $mt; ?> mb-5">
									<div class="product-single-content"><?php echo get_the_content(); ?></div>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 mx-auto collapse" id="specification" data-parent="#myGroup">
								<div class="<?php echo $mt; ?> mb-5">
									<table class="table table-striped">
										<tbody>
										<?php if(!empty($product_model)){ ?>
										<tr>
											<td><strong>Modell</strong></td>
											<td><?php echo $product_model; ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_processor' ))){
										?>
										<tr>
											<td><strong>Processor</strong></td>
											<td><?php echo $product->get_attribute( 'pa_processor' ); ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_ram' ))){
										?>
										<tr>
											<td><strong>Internminne</strong></td>
											<td><?php echo $product->get_attribute( 'pa_ram' ); ?></td>
										</tr>
										<?php
										}
										if(!empty(get_post_meta($id, '_custom_product_ram_info', true))){
										?>
										<tr>
											<td><strong>Minnestyp</strong></td>
											<td><?php echo get_post_meta($id, '_custom_product_ram_info', true); ?></td>
										</tr>
										<?php
										}
										if(!empty(get_post_meta($id, '_custom_product_max_ram', true))){
										?>
										<tr>
											<td><strong>Maximalt minne</strong></td>
											<td><?php echo get_post_meta($id, '_custom_product_max_ram', true); ?></td>
										</tr>
										<?php
										}
										if(!empty($product_storage)){
										?>
										<tr>
											<td><strong>Lagring</strong></td>
											<td><?php echo $product_storage; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_storage_type)){
										?>
										<tr>
											<td><strong>Typ av hårddisk</strong></td>
											<td><?php echo $product_storage_type; ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_size' ))){
										?>
										<tr>
											<td><strong>Skärmstorlek</strong></td>
											<td><?php echo $product->get_attribute( 'pa_size' ); ?></td>
										</tr>
										<?php
										}
										if(!empty($product_display_type)){
										?>
										<tr>
											<td><strong>Skärmupplösning</strong></td>
											<td><?php echo $product_display_type; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_camera)){
										?>
										<tr>
											<td><strong>Kamera</strong></td>
											<td><?php echo $product_camera; ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_color' ))){
										?>
										<tr>
											<td><strong>Färg</strong></td>
											<td><?php echo $product->get_attribute( 'pa_color' ); ?></td>
										</tr>
										<?php
										}
										if(!empty($product_graphics_card)){
										?>
										<tr>
											<td><strong>Grafikkort</strong></td>
											<td><?php echo $product_graphics_card; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_numeric)){
										?>
										<tr>
											<td><strong>Numeriskt tangentbord</strong></td>
											<td><?php echo $product_numeric; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_formfactor)){
										?>
										<tr>
											<td><strong>Formfaktor</strong></td>
											<td><?php echo $product_formfactor; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_optical_drive)){
										?>
										<tr>
											<td><strong>Optisk enhet</strong></td>
											<td><?php echo $product_optical_drive; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_usb_ports)){
										?>
										<tr>
											<td><strong>USB-portar</strong></td>
											<td><?php echo $product_usb_ports; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_hdmi_ports)){
										?>
										<tr>
											<td><strong>Övriga anslutningar</strong></td>
											<td><?php echo $product_hdmi_ports; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_touchpad)){
										?>
										<tr>
											<td><strong>Pekskärm</strong></td>
											<td><?php echo $product_touchpad; ?></td>
										</tr>
										<?php
										}
										if(!empty($o_system)){
										?>
										<tr>
											<td><strong>Operativsystem</strong></td>
											<td><?php echo $o_system[0]->name; ?></td>
										</tr>
										<?php
										}
										if(!empty($product_powersupply)){
										?>
										<tr>
											<td><strong>Strömkabel</strong></td>
											<td><?php echo $product_powersupply; ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_cores' ))){
										?>
										<tr>
											<td><strong>Cores</strong></td>
											<td><?php echo $product->get_attribute( 'pa_cores' ); ?></td>
										</tr>
										<?php
										}
										if(!empty($product->get_attribute( 'pa_network' ))){
										?>
										<tr>
											<td><strong>Nätverk</strong></td>
											<td><?php echo $product->get_attribute( 'pa_network' ); ?></td>
										</tr>
										<?php
										}
										if(!empty($brand)){
										?>
										<tr>
											<td><strong>Varumärke</strong></td>
											<td><?php echo $brand[0]->name; ?></td>
										</tr>
										<?php
										}
										if(!empty($grade)){
										?>
										<tr>
											<td><strong>Skick</strong></td>
											<td><?php echo $gr_text; ?></td>
										</tr>
										<?php
										}
										$weight = $product->get_weight();

										if ( $product->has_weight() ) {
											?>
											<tr>
											<td><strong>Vikt</strong></td>
											<td><?php echo $weight; ?> kg</td>
										</tr>
										<?php
										}
										?>

										</tbody>
									</table>
								</div>
							</div>
							<!-- <div class="col-lg-8 col-md-10 mx-auto <?php //echo $mt; ?> mb-5 collapse" id="tillbehor" data-parent="#myGroup">
								Some content for later
							</div> -->
						</div>

			</div>
		</div>
	</div>
</div>


<?php } ?>


<?php do_action( 'woocommerce_after_single_product' ); ?>
<div class="product-holder">
  <div class="prev-next-products">
    <div class="previous_product"><span  class="lnr lnr-chevron-left"></span></div>
    <div class="next_product"><span class="lnr lnr-chevron-right"></span></div>
  </div>
  <h2>Liknande produkter</h2>
  <div class="product-slider">
  <?php if( !empty(wc_get_related_products($id)) ) : ?>
  	<?php foreach (wc_get_related_products($id, 20) as $key => $value) : ?>
      <div class="slider-img-wrapper">
          <?php echo create_list_item_two($value); ?>
      </div>
  <?php endforeach; endif; ?>
  </div>
</div>
<div class="image-text">
    <div class="container">
        <div class="row row-eq-height pr-lg-3">
            <div class="col-lg-7 pr-lg-0">
                <div class="img-left-holder">
                    <?php $pi = get_field('image_product_below', 9029); ?>
                    <?php if (!empty($pi)): ?>
                        <img src="<?php echo esc_url($pi['url']); ?>" alt="<?php echo esc_attr($pi['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center pl-lg-5 pr-lg-5 pb-lg-5 pt-lg-4 col-text-right-holder">
                <div class="txt-right-holder">
                    <h2><?php echo get_field('product_title_below', 9029); ?></h2>
                    <div class="desc"><?php echo get_field('description_product_below', 9029); ?></div>
                    <?php
                    $link2 = get_field('button_product_below', 9029);
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
<script>
function ShowProductimage(nbr){
	//jQuery('.single-product-slider').slickGoTo(1);
	jQuery('.single-product-slider').slick('slickGoTo', nbr);
}

</script>
