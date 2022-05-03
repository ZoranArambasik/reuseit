<div class="container-fluid topmenu p-0">
    <div class="black-box">
        <div class="container">
                <div class="green-top-message-check-price">

                  <div class="icons-text-front">
                    <div class="row align-items-center icons_and_text">
                    <div class="icons_each">
                    <div id="icons-with-1" class="icons-with-text">
                    <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/fri-frakt.png" alt="Alltid fri frakt" title="Alltid fri frakt"></div>
                    <div class="next-to-icon">Fri frakt över 3000kr</div></div>
                    </div>
                    </div>
                    </div>
                    <div class="icons-text-front">
                    <div class="row align-items-center icons_and_text">
                    <div class="icons_each">
                    <div id="icons-with-1" class="icons-with-text">
                    <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/fri-retur.png" alt="14 dagars fri returrätt" title="14 dagars fri returrätt"></div>
                    <div class="next-to-icon">14 dagars fri returrätt</div></div>
                    </div>
                    </div>
                    </div>
                    <div class="icons-text-front">
                    <div class="row align-items-center icons_and_text">
                    <div class="icons_each">
                    <div id="icons-with-1" class="icons-with-text">
                    <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/hallbart-val.png" alt="Ett hållbart val!" title="Ett hållbart val!"></div>
                    <div class="next-to-icon">Ett hållbart val!</div></div>
                    </div>
                    </div>
                    </div>
                    <div class="icons-text-front">
                    <div class="row align-items-center icons_and_text">
                    <div class="icons_each">
                    <div id="icons-with-1" class="icons-with-text">
                    <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/garanti.png" alt="Ett hållbart val!" title="Ett hållbart val!"></div>
                    <div class="next-to-icon">Minst 12 månaders garanti</div></div>
                    </div>
                    </div>
                  </div>


                    <!-- mobil -->
                    <div class="mobile-ups-banner">
                      <div id="mobile-ups-1" class="mobile-ups-banner--item">
                      <img class="mobile-ups-banner--icon" src="/wp-content/themes/reuseit-new/images/fri-frakt.png" alt="Icon Fri frakt över 3000kr">
                        <p class="mobile-ups-banner--text">Fri frakt över 3000kr</p>
                      </div>
                      <div id="mobile-ups-2" class="mobile-ups-banner--item">
                      <img class="mobile-ups-banner--icon" src="/wp-content/themes/reuseit-new/images/fri-retur.png" alt="14 dagars fri returrätt">
                        <p class="mobile-ups-banner--text">14 dagars fri returrätt
                      </p>
                      </div>
                      <div id="mobile-ups-3" class="mobile-ups-banner--item">
                      <img class="mobile-ups-banner--icon" src="/wp-content/themes/reuseit-new/images/hallbart-val.png" alt="Ett hållbart val!">
                        <p class="mobile-ups-banner--text">1-3 dagars leverans</p>
                      </div>
                    </div>
                    <!-- End mobil -->

                    <div class="top-price-check">
                        <?php
                            $company = WC()->session->get( 'my_custom_tax_rate_company' );
                            if($company == 1){
                                $c_checked = 'checked="checked"';
                                $checked = '';
                            } else {
                                $checked = 'checked="checked"';
                                $c_checked = '';
                            }
                            ?>

                        <label class="topmenu-label topmenu-label-first">Privatperson
                        <input <?php echo $checked; ?> name="tax_toggle" value="private" id="private" type="radio" />
                        <!-- <span class="checkmark"></span> -->
                        </label>
                        <label class="topmenu-label topmenu-label-second">Företag
                        <input <?php echo $c_checked; ?> name="tax_toggle" type="radio" value="company" id="company" />
                        <!-- <span class="checkmark"></span> -->
                        </label>

                    </div>
                </div>

        </div>
    </div>
    <div class="container container-slider">
        <div class="row pl-3 pr-3">
        <a href="#searchModal" data-toggle="modal" data-target="#searchModal" class="search-icon"><img class="img-responsive" src="<?php bloginfo('template_directory')?>/images/search_icon.png"></a>
        <div class="topmenu-items top-menu-desktop-items row mx-auto pt-3 pb-3">

                <div class="top-logo col-12 col-md-4 col-lg-3 p-0">
                    <a href="<?php echo esc_url( home_url( '/' )); ?>">
                      <img class="" src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" />
                    </a>
                </div>
                <div class="col-md-5"><?php echo do_shortcode('[wcas-search-form]'); ?></div>
                <div class="top-price-shop col-12 col-md-5 col-lg-4 p-0">
                    <div class="hiddenTrust hidden-xs hidden-sm" style="float:left;margin-top:10px;">
                      <div class="trustpilot-widget" data-locale="sv-SE" data-template-id="5419b732fbfb950b10de65e5" data-businessunit-id="4c5b1c9200006400050d7fdd" data-style-height="24px" data-style-width="100%" data-theme="light">
                        <a href="https://se.trustpilot.com/review/reuseit.se" target="_blank" rel="noopener">Trustpilot</a>
                      </div>
                    </div>
                    <div class="shopbag">
                        <?php
                        global $woocommerce;
                        $img_url = get_bloginfo('template_url');
                            echo '<div class="icon-wrapper">';
                                echo '<a class="my-pages" href="/mina-sidor"><img class="img-responsive"  id="user-icon" src="'.$img_url.'/images/user_icon.png"></a>';
                                echo '<div class="wrapper-cart">';
                                    echo '<img class="img-responsive" id="opensidecart" src="'.$img_url.'/images/cart_icon.png">';
                                    $active_class = $woocommerce->cart->get_cart_contents_count() > 0 ? 'active' : '';
                                    echo  '<span id="cart-total" class="'.$active_class.'">'.$woocommerce->cart->get_cart_contents_count().'</span>';
                                echo '</div>';
                            echo '</div>';
                        ?>
                    </div>
                </div>

        </div>
        <div class="desktop-menu"><?php wp_nav_menu (array('menu' => 'new-main-menu' )); ?></div>
        </div>
        </div>
    </div>
</div>
<div id="searchModal" class="modal in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content" align="center">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">Stäng <i class="fa fa-times" aria-hidden="true"></i></button>
						<?php echo do_shortcode('[wcas-search-form]'); ?>
					</div>
    			</div>
  			</div>
		</div>
