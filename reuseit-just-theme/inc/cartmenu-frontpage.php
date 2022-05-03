<?php

function load_cartmenu_shortcode() {

	global $woocommerce;
	$totalItemsInCart = $woocommerce->cart->cart_contents_count;

	?>
  	<div class="" id="cartmenu">
  		<div class="container">
			<div class="row title">
					<div class="col-12">
						<div class="img-section-top">
							<div class="btn" id="closeCartMenu" >
								<img src="<?php echo get_template_directory_uri(); ?>/images/delete-1.png" class="img-responsie" alt="close">
							</div>
							<?php echo '<p>Min varukorg</p>'; ?>
						</div>
						<hr>
				</div>
			</div>
  		</div>

  	<div class="container items">

		<?php

		$items = $woocommerce->cart->get_cart();
		$total_price = 0;
		$total_tax = 0;

		if(!empty($items)) :

		foreach($items as $item => $values) :
			$extras = '';	
			$_product =  wc_get_product( $values['data']->get_id() );
			$price = $_product->get_regular_price();
			$price_2 = wc_get_price_including_tax($_product);
			$price_3 = wc_get_price_excluding_tax($_product);
			$getProductDetail = wc_get_product( $values['product_id'] );
			$removeItem = wc_get_cart_remove_url( $values['key'] );
			$prodImgUrl = get_the_post_thumbnail_url($values['product_id']);
			$childTermttachment_ids[0] = get_post_thumbnail_id( $values['product_id'] );
			$childTermttachment = wp_get_attachment_image_src($childTermttachment_ids[0], 'full' );
			$currencySymbolItem = get_woocommerce_currency_symbol();
			$company = WC()->session->get( 'my_custom_tax_rate_company' );

			if(!empty($values['ppom'])){
				$json_obj = json_decode(json_encode($values['ppom']['ppom_option_price']), true);
				$jsonData = stripslashes(html_entity_decode($json_obj));
				$ppom_data = json_decode($jsonData, true);
				//echo "<pre>".print_r($ppom_data, 1)."</pre>";
				if(!empty($ppom_data)){
					foreach($ppom_data as $key => $val) :
					if($company == 1){
						$warranty = $val['price'];
						if($warranty == 313 || $warranty == 375 || $warranty == 500 || $warranty == 750 ){
							$warranty = $warranty * 0.80;
						}
			            $price_2 += $warranty;
						$price_3 += $warranty;
						if(empty($val['label'])){
							$extras = '<p class="ppom_extras_cart"></p>';
						} else {
							$extras = '<p class="ppom_extras_cart">'.$val['label'].': '.$warranty.' kr</p>';
						}
						$tax = $price_2 - $price_3;
		           	} else {
			            $warranty = $val['price'];
			            $taxfree_warranty = $val['price'] * 0.80;
			            if($warranty == 250 || $warranty == 300 || $warranty == 400 || $warranty == 600 ){
							$warranty = $warranty * 1.25;
							$taxfree_warranty = $val['price'];
						}
			            $price_2 += $warranty;
						$price_3 += $taxfree_warranty;
						if(empty($val['label'])){
							$extras = '<p class="ppom_extras_cart"></p>';
						} else {
							$extras = '<p class="ppom_extras_cart">'.$val['label'].': '.$warranty.' kr</p>';
						}
						$tax = $price_2 - $price_3;
		            }
					endforeach;
				} else {
					$tax = $price_2 - $price_3;
				}
			
			} else {
				$tax = $price_2 - $price_3;
			}
			
			//echo "<pre>".print_r($values['ppom'], 1)."</pre>";
			?>

  	 	<div class="row mb-2 cart-item" data-prodid="<?php echo $values['product_id']; ?>" data-prodkey="<?php echo $values['key']; ?>">
			<?php
				$categorie_name = get_the_terms(  $values['product_id'], 'brand' );
				$totalWithTax = $values['line_subtotal'] + $values['line_subtotal_tax'];
				if($company == 1){
					$total_price += ($price_3 * $values['quantity']);
				} else {
					$total_price += ($price_2 * $values['quantity']);
				}
				$total_tax += ($tax * $values['quantity']);
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['product_id']), 'single-post-thumbnail' );
				$list_img = get_field('product_list_image', $values['product_id'] );
				$prod_img = $image[0] != "" ? $image[0] : get_template_directory_uri().'/images/no-image.png';
				
			?>
			<div class="col-5">
				<div class="img-section">
					<img src="<?php echo $prod_img; ?>" class="img-responsive" alt="">
				</div>
			</div>
			<div class="col-7">
				<div class="first">

					<a href="<?php echo get_the_permalink($values['product_id']); ?>">
						<h3><?php echo $_product->get_title(); ?></h3>
					</a>
					<p class="brand">Tillverkare: <?php echo $categorie_name[0]->name; ?></p>
					<?php if($company == 1){ ?>
					<p class="total">Antal: <?php echo $values['quantity']; ?> st: <span><?php echo wc_get_price_excluding_tax($_product); ?> kr</span></p>
					<?php echo $extras; ?>
					<p class="totalprice">Totalt: <?php echo ($price_3 * $values['quantity']) . ' ' . $currencySymbolItem; ?></p>
						<p class="totalmoms">(ex. moms)</p>
					<?php } else { ?>
					<p class="total">Antal: <?php echo $values['quantity']; ?> st: <span><?php echo wc_get_price_including_tax($_product); ?> kr</span></p>
					<?php echo $extras; ?>
					<p class="totalprice">Totalt: <?php echo ($price_2 * $values['quantity']) . ' ' . $currencySymbolItem; ?></p>
						<p class="totalmoms">Varav moms <?php echo ($tax * $values['quantity']) . ' ' . $currencySymbolItem; ?></p>
					<?php } ?>
					<a class="remove-cart-item" data-product_id="<?php echo $values['product_id']; ?>" data-product_sku="<?php echo $_product->get_sku(); ?>" data-cart_item_key="<?php echo $values['key']; ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/bin-2.png" class="img-responsie close" alt="close">
					</a>

				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-12">
				<hr>
			</div>
  	 	</div>
	<?php endforeach; ?>
	<?php else: ?>
  	<div class="row" id="noitemscart">
  		<div class="col-12 no-items-found">
			<?php echo '<h3>Din varukorg är tom!</h3>'; ?>
  		</div>
  	</div>
	<?php endif; ?>
  </div>
	<div class="container buttons">
		<div class="row">
			<?php

				$totalAmount = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
				$taxtTotalSub = $woocommerce->cart->get_tax_totals( );
				$currencySymbol = get_woocommerce_currency_symbol();
				$subTotal = $woocommerce->cart->total . $totalAmount;
				$totalTaxSub = $woocommerce->cart->get_taxes();

			?>
			<div class="col-12 checkout">
				<p id="totalpricecart" class="totalcart"><strong>Totalt: </strong><?php echo $total_price; ?> <?php echo $currencySymbol; ?> 
				<?php if($company == 1){ ?>
					(ex. moms)</p>
				<?php } else { ?>
					(varav moms <?php echo $total_tax; ?> kr)</p>
				<?php }  ?>
				<div class="clearfix"></div>
				<hr>
				<div class="btn">
					<a href="/checkout/">Till kassan</a>
				</div>
			</div>
		</div>
	</div>

  		</div>

<?php

	}

add_shortcode('LOAD_CARTMENU_TEMP_SHORTCODE', 'load_cartmenu_shortcode');
