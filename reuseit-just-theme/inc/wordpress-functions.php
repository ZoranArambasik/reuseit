<?php
// Display Fields
add_action('woocommerce_product_data_panels', 'woocommerce_product_custom_fields');

// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');


function woocommerce_product_custom_fields() {
   echo '<div id="wk_custom_tab_data" class="panel woocommerce_options_panel">';
    global $woocommerce, $post;
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_max_ram',
            'placeholder' => 'Maximum RAM',
            'label' => __('Maximum RAM', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_ram_info',
            'placeholder' => 'RAM info',
            'label' => __('RAM info', 'woocommerce')
        )
    );
   echo '</div>';
}

add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab', 10, 1 );
function wk_custom_product_tab( $default_tabs ) {
    $default_tabs['custom_tab'] = array(
        'label'   =>  __( 'Extra fält', 'domain' ),
        'target'  =>  'wk_custom_tab_data',
        'priority' => 60,
        'class'   => array()
    );
    return $default_tabs;
}
function my_login_logo()  { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('/wp-content/themes/reuseit/images/logo.svg');
            width: 100%;
            background-size: 100%;
            height: 130px;
        }
        .login.login-action-login.wp-core-ui{
	        background-color: #fff;
        }
        .login #loginform {
	        background: transparent !important;
        }
        .login #loginform label {
	        color: #000;
        }
        .login #backtoblog a, .login #nav a {
	        color: #000 !important;
        }
        .login form {
	        border: none !important;
	        box-shadow: none !important;
        }
        .wp-core-ui .button-primary {
	        background-color: #51bb3e !important;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return '/';
}



function woocommerce_product_custom_fields_save($post_id)
{
    // Custom Product Text Field
    $woocommerce_custom_product_text_field = $_POST['_custom_product_max_ram'];
    if (!empty($woocommerce_custom_product_text_field))
        update_post_meta($post_id, '_custom_product_max_ram', esc_attr($woocommerce_custom_product_text_field));

// Custom Product Textarea Field
    $woocommerce_custom_procut_textarea = $_POST['_custom_product_ram_info'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_custom_product_ram_info', esc_html($woocommerce_custom_procut_textarea));

}

//Function for display of subitems in menu
function get_childrens($id, $nav_id) {
	$menu = wp_get_nav_menu_object( $nav_id );
	$nav_menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
	$children = array();
	foreach($nav_menu_items as $items) {
		if($items->menu_item_parent == $id){
			array_push($children, $items);
		}
	}
	return $children;
}

//big menu YAMM!3
function desktop_menu($id){

	global $woocommerce;

	$img_url = get_bloginfo('template_url');
	echo '<ul class="nav navbar-nav ml-auto">';

		$menu = wp_get_nav_menu_object( $id );
		$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

		foreach($menuitems as $items){
			$children = get_childrens($items->ID, $id);
			if($items->menu_item_parent == 0){
				if(!empty($children)){
					if ($items->classes[0] == 'big-menu'){
							//echo "<pre>".print_r($items, 1)."</pre>";
						echo '<li class="dropdown yamm-fw" data-toggle="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">'.$items->title.'</a>';
							echo '<ul class="dropdown-menu">';
								echo '<li>';
									echo '<div class="yamm-content">';
										$fix = count($children);
										//counts submenues so we can display the right columns
										switch($fix) {
										    case 3:
										        $class = "col-sm-4";
										        $row = "class='row'";
										        break;
										    case 4:
										        $class = "col-sm-3";
										        $row = "class='row'";
										        break;
										    case 5:
										        $class = "special-grid";
										        $row = "";
										        break;
										    case 6:
										        $class = "col-sm-2";
										        $row = "class='row'";
										        break;
										}
										echo '<div '.$row.'>';

											foreach($children as $child){

												if(!empty($child->classes[1])){ $classes = $child->classes[1]; } else { $classes = ''; }
												echo '<div class="'.$class.' '.$classes.'">';
													echo '<h4><a class="second-lvl head_link" href="'.$child->url.'">'.$child->title.'</a></h4>';
														$childChildren = get_childrens($child->ID, $id);
														echo '<ul class="ul-lvl-three">';
															foreach($childChildren as $childChild){
																echo '<li><a class="third-lvl" href="'.$childChild->url.'">'.$childChild->post_title.'</a></li>';
															}
														echo '</ul>';
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';
						echo '</li>';
					} else {
						//if only only one submenu, has a more regular dropdown menu
						echo '<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><img class="img-responsive" src="'.$img_url.'/images/burger_icon.png">'.$items->title.'<img class="img-responsive caret_icon" src="'.$img_url.'/images/caret_icon.png"></a>';
							echo '<ul class="dropdown-menu" role="menu">';
								foreach($children as $child){
									$icon = get_field('icon', $child);
									echo '<li><a class="second-lvl" href="'.$child->url.'"><img src="'.$icon.'">'.$child->title.'</a></li>';
								}
							echo '</ul>';
						echo '</li>';


					}
				} else {
					// normal menuitem without any submenu
					echo '<li class="menu-item"><a class="first-lvl" href="'.$items->url.'">'.$items->title.'</a>';
				}

			}
		}


		echo '<form role="search" method="get" class="woocommerce-product-search" action="/">';
			echo '<input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Sök produkt här" value="" name="s">';
			echo '<input type="hidden" name="post_type" value="product">';
		echo '</form>';

	echo '</ul>';
	echo '<div class="icon-wrapper">';
		echo '<a href="/mina-sidor"><img class="img-responsive"  id="user-icon" src="'.$img_url.'/images/user_icon.png"></a>';
		echo '<div class="wrapper-cart">';
			echo '<img class="img-responsive" id="opensidecart" src="'.$img_url.'/images/cart_icon.png">';
			$active_class = $woocommerce->cart->get_cart_contents_count() > 0 ? 'active' : '';
			echo  '<span id="cart-total" class="'.$active_class.'">'.$woocommerce->cart->get_cart_contents_count().'</span>';
		echo '</div>';
			echo '<img class="img-responsive trigger-search" src="'.$img_url.'/images/search_icon.png">';

	echo '</div>';
}


//mobilemenu sliding to submenu like native app menu
function mobile_menu($id){

	echo '<div class="sm_menu_outer">';
		echo '<ul class="mobile_menu">';
		/*
		$img = get_field('s_bild', 29);
		$img = $img['url'];
		$link = get_field('s_link', 29);
		$cont = get_field('s_text', 29);
		*/
		$menu = wp_get_nav_menu_object( $id );
		$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
	//	echo '<li class="first-nav"><a href="'.$link['url'].'"><div class="left-menu">'.$cont.'</div><div class="right-menu"><img src="'.$img.'" class="img-responsive"></div><div class="subtext">'.$link['title'].'</div></a></li>';
		foreach($menuitems as $items){
			$children = get_childrens($items->ID, $id);
			if($items->menu_item_parent == 0){
				if(!empty($children)){

					//multiple submenues
					if($items->classes[0] == 'big-menu'){
						echo '<li class="hasChild">';
							echo '<a href="#">'.$items->title.'</a>';
							echo '<ul class="submenu">';
							foreach($children as $child){
								echo '<h4 class="mobile-parent"><a href="'.$child->url.'">'.$child->title.'</a></h4>';
								$childChildren = get_childrens($child->ID, $id);
								echo '<ul class="child-submenu">';
									foreach($childChildren as $childChild){
										echo '<li class="mobile-child"><a href="'.$childChild->url.'">'.$childChild->title.'</a></li>';
									}
								echo '</ul>';

							}
							echo '</ul>';
						echo '</li>';
					//only one submenu
					} else {
						echo '<li class="hasChild">';
							echo '<li class="parent-without-slide"><a href="#" class="parent-no-slide">'.$items->title.'</a></li>';
							//echo '<a href="#">'.$items->title.'</a>'; //enable sliding menu
							//echo '<ul class="submenu">';  //enable sliding menu
							foreach($children as $child){
								$icon = get_field('icon', $child);
								if($child->classes[0] == 'head-link') {
									echo '<h4 class="mobile-parent"><a href="'.$child->url.'">'.$child->title.'</a></h4>';
								} else {
		                        	echo '<li class="mobile-child"><a href="'.$child->url.'"><img src="'.$icon.'">'.$child->title.'</a></li>';
		                        }
							}

							//echo '</ul>';
						echo '</li>';


					}
				} else {

					//single menuitem
					echo '<li class="noChild"> <a href="'.$items->url.'">'.$items->title.'</a> </li>';
				}
			}


		}
		$img_url = get_bloginfo('template_url');
		echo '<li class="mobile-child">';
		echo '<a href="/mina-sidor">';
		echo '<img src="'.$img_url.'/images/user.png" />Mina Sidor</a>';
		echo '</li>';
		 echo '<div class="mobile-price-check">';

        		            $company = WC()->session->get( 'my_custom_tax_rate_company' );
        		            if($company == 1){
        			            $c_checked = 'checked="checked"';
        			            $checked = '';
        		            } else {
        			            $checked = 'checked="checked"';
        			            $c_checked = '';
        		            }


                        echo '<label class="topmenu-label topmenu-label-first">Privat';
                        echo '<input '.$checked.' name="tax_toggle" value="private" id="private" type="radio" />';
                        echo '</label>';
                        echo '<label class="topmenu-label topmenu-label-second">Företag';
                        echo '<input '.$c_checked.' name="tax_toggle" type="radio" value="company" id="company" />';
	                    echo '</label>';

                    echo '</div>';

	echo '</ul>';


echo '</div>';

}
