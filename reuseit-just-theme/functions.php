<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter
 */

if ( ! function_exists( 'wp_bootstrap_starter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_bootstrap_starter_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wp-bootstrap-starter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'wp-bootstrap-starter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    function wp_boostrap_starter_add_editor_styles() {
        add_editor_style( 'custom-editor-style.css' );
    }
    add_action( 'admin_init', 'wp_boostrap_starter_add_editor_styles' );

}
endif;

add_action( 'after_setup_theme', 'wp_bootstrap_starter_setup' );

add_action( 'woocommerce_init', function(){

    if ( is_user_logged_in() || is_admin() )
        return;

    if ( isset( WC()->session ) ) {

        if ( ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }

    }


} );



/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder(){
        $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

            if(!get_option( 'triggered_welcomet')){
                $message = sprintf(__( 'Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'wp-bootstrap-starter' ),
                    esc_url( $theme_page_url )
                );

                printf(
                    '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
                    $message
                );
                add_option( 'triggered_welcomet', '1', '', 'yes' );
            }

}
add_action( 'admin_notices', 'wp_bootstrap_starter_reminder' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_starter_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wp_bootstrap_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function wp_bootstrap_starter_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-starter' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'wp-bootstrap-starter' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<div class="footer-1">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'wp-bootstrap-starter' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'wp-bootstrap-starter' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'wp-bootstrap-starter' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="footer-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 5', 'wp-bootstrap-starter' ),
        'id'            => 'footer-5',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 6', 'wp-bootstrap-starter' ),
        'id'            => 'footer-6',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'            => __( 'Top Home Page', 'widg' ),
        'id'              => 'puff-homepage',
        'description'     => __( 'Överst på hemsidan', 'widg' ),
        'before_widget'   => '',
        'after_widget'    => '',
        'before_title'    => '',
        'after_title'     => '',
      ) );
    register_sidebar( array(
        'name'            => __( 'Home', 'widg' ),
        'id'              => 'collections-frontpage',
        'description'     => __( 'Puff på startsidan', 'widg' ),
        'before_widget'   => '',
        'after_widget'    => '',
        'before_title'    => '',
        'after_title'     => '',
      ) );

      register_sidebar( array(
        'name'            => __( 'Filter', 'widg' ),
        'id'              => 'prdouct-filter',
        'description'     => __( 'Filtrering på produktsidorna', 'widg' ),
        'before_widget'   => '<div class="filter-shop-inner">',
        'after_widget'    => '</div>',
        'before_title'    => '<h4 class="open-search-term">',
        'after_title'     => '<span>+</span></h4>',
      ) );

      register_sidebar( array(
        'name'            => __( 'Header above', 'widg' ),
        'id'              => 'above-header',
        'description'     => __( 'Above header', 'widg' ),
        'before_widget'   => '',
        'after_widget'    => '',
        'before_title'    => '',
        'after_title'     => '',
      ) );
       register_sidebar( array(
        'name'            => __( 'Elevköp', 'widg' ),
        'id'              => 'student-widget',
        'description'     => __( 'Ingångar elevköp', 'widg' ),
        'before_widget'   => '',
        'after_widget'    => '',
        'before_title'    => '',
        'after_title'     => '',
      ) );
       register_sidebar( array(
         'name'            => __( 'Order Received Logo', 'widg' ),
         'id'              => 'order-received-logo',
         'description'     => __( 'Order Received Logo', 'widg' ),
         'before_widget'   => '',
         'after_widget'    => '',
         'before_title'    => '',
         'after_title'     => '',
       ) );
       register_sidebar( array(
         'name'            => __( 'Order Received User Description', 'widg' ),
         'id'              => 'order-received-user-description',
         'description'     => __( 'Order Received User Description', 'widg' ),
         'before_widget'   => '',
         'after_widget'    => '',
         'before_title'    => '',
         'after_title'     => '',
       ) );
       register_sidebar( array(
         'name'            => __( 'Footer Order Received Top', 'widg' ),
         'id'              => 'footer-order-received-top',
         'description'     => __( 'Footer Order Received Top', 'widg' ),
         'before_widget'   => '',
         'after_widget'    => '',
         'before_title'    => '',
         'after_title'     => '',
       ) );


}
add_action( 'widgets_init', 'wp_bootstrap_starter_widgets_init' );

// function defer_parsing_of_js( $url ) {
//     if ( is_user_logged_in() ) return $url; //don't break WP Admin
//     if ( FALSE === strpos( $url, '.js' ) ) return $url;
//     if ( strpos( $url, 'jquery.js' ) ) return $url;
//     return str_replace( ' src', ' defer src', $url );
// }
// add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );

/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts() {
    // load bootstrap cairo_surface_status(surface)

    // wp_enqueue_style( 'wp-bootstrap-muli-font', 'https://fonts.googleapis.com/css?family=Muli:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300&&display=swap' );
    //if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.10.2/css/all.css' );
    /*} else {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/pro-fontawesome.min.css' );
        //wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css' );
    }*/

	wp_enqueue_style( 'wp-bootstrap-starter-style', get_stylesheet_uri() );
    if(get_theme_mod( 'theme_option_setting' ) && get_theme_mod( 'theme_option_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'theme_option_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/'.get_theme_mod( 'theme_option_setting' ).'.css', false, '' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-lora') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-lora-font', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-merriweather') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-merriweather-font', 'https://fonts.googleapis.com/css?family=Merriweather:300,400,400i,700,900|Montserrat:300,400,400i,500,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-poppins') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'roboto-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'arbutusslab-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-arbutusslab-opensans-font', 'https://fonts.googleapis.com/css?family=Arbutus+Slab|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'oswald-muli') {
        wp_enqueue_style( 'wp-bootstrap-starter-oswald-muli-font', 'https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800|Oswald:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-opensans-font', 'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'robotoslab-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-robotoslab-roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:300,300i,400,400i,500,700,700i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) && get_theme_mod( 'preset_style_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_style_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/typography/'.get_theme_mod( 'preset_style_setting' ).'.css', false, '' );
    }
    wp_enqueue_style( 'jquery-simple-mobilemenu', get_template_directory_uri() . '/inc/jquery-mobilemenu/styles/jquery-simple-mobilemenu.css', array(), '', 'all');
	//		$rand = rand( 1, 99999999999 );
		wp_enqueue_style( 'homepage', get_template_directory_uri() . '/style/home.css', array(), '2.0', 'all');
		//wp_enqueue_style( 'homepage', get_template_directory_uri() . '/style/home.css', array(), $rand, 'all');

	wp_enqueue_style( 'login-checkout', get_template_directory_uri() . '/style/login_checkout.css', array(), '1.1', 'all');
    wp_enqueue_style( 'linear-icons', get_template_directory_uri() . '/inc/assets/css//linearicons.min.css' );


	wp_enqueue_script('jquery');

    // Internet Explorer HTML5 support
    wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/inc/assets/js/html5.js', array(), '3.7.0', false );
    wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

	// load bootstrap js
    //if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_script('wp-bootstrap-starter-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.15.0/dist/umd/popper.min.js', array(), '', true );
    	wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js', array(), '', true );
   /* } else {
        wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true );
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
    }*/
    wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true );
	wp_enqueue_script( 'wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );
	wp_enqueue_script( 'jquery-simple-mobilemenu', get_template_directory_uri() . '/inc/jquery-mobilemenu/jquery-simple-mobilemenu.min.js', array(), '', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/inc/main.js', array(), '', true );
	wp_enqueue_script('mouseswipe', '//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js', array(), '', true );
    wp_enqueue_script('woocommerce-ajax-add-to-cart', get_template_directory_uri() . '/assets/ajax-add-to-cart.js', array('jquery'), '', true);
    wp_enqueue_script('ajax-remove-form-cart', get_template_directory_uri() . '/assets/ajax-remove-form-cart.js', array('jquery'), '', true);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_scripts' );



/**
 * Add Preload for CDN scripts and stylesheet
 */
function wp_bootstrap_starter_preload( $hints, $relation_type ){
    if ( 'preconnect' === $relation_type && get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        $hints[] = [
            'href'        => 'https://cdn.jsdelivr.net/',
            'crossorigin' => 'anonymous',
        ];
        // $hints[] = [
        //     'href'        => 'https://use.fontawesome.com/',
        //     'crossorigin' => 'anonymous',
        // ];
    }
    return $hints;
}

add_filter( 'wp_resource_hints', 'wp_bootstrap_starter_preload', 10, 2 );



function wp_bootstrap_starter_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "wp-bootstrap-starter" ) . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __( "Password:", "wp-bootstrap-starter" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "wp-bootstrap-starter" ) . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter( 'the_password_form', 'wp_bootstrap_starter_password_form' );


/**
 * Post types.
 */
require get_template_directory() . '/inc/main-setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * SIde menu
 */
require get_template_directory() . '/inc/cartmenu-frontpage.php';
/**
 * Wordpeess function
 */
require get_template_directory() . '/inc/wordpress-functions.php';
require get_template_directory() . '/inc/woo-functions.php';


// WIDGETS
require get_template_directory() . '/widgets/products-widgets.php';
require get_template_directory() . '/widgets/products-featured-widgets.php';
require get_template_directory() . '/widgets/puff-widgets.php';
require get_template_directory() . '/widgets/woocommerce-categories-widget.php';
require get_template_directory() . '/widgets/home-contact.php';

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}


function my_custom_mime_types( $mimes ) {

// New allowed mime types.
$mimes['svg'] = 'image/svg+xml';
$mimes['svgz'] = 'image/svg+xml';
$mimes['doc'] = 'application/msword';

// Optional. Remove a mime type.
unset( $mimes['exe'] );

return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Lägg i kundvagn', 'woocommerce' );
}


add_image_size( 'single_top_image', 1260, 570, true );
add_image_size( 'blog', 720, 540, true );


function register_acf_block_types() {

    acf_register_block_type(array(
        'name'              => 'slider-top',
        'title'             => __('Top Slider'),
        'description'       => __('A custom Slider block.'),
        'render_template'   =>  'template-parts/front-page-slider.php',
        'category'          => 'Top Slider',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'slider-top', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'icons-with-text',
        'title'             => __('Icons with text'),
        'description'       => __('Icons with text block.'),
        'render_template'   =>  'template-parts/icons-with-text.php',
        'category'          => 'Icons with text',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'icons-with-text', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'product-slider',
        'title'             => __('Product Slider'),
        'description'       => __('Product Slider block.'),
        'render_template'   =>  'template-parts/product-slider.php',
        'category'          => 'Product Slider',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'product-slider', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'image-text',
        'title'             => __('Image text'),
        'description'       => __('Image right text left'),
        'render_template'   =>  'template-parts/image-text.php',
        'category'          => 'Image text',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'image-text', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'two-columns-text-image',
        'title'             => __('Two Columns Text & Image'),
        'description'       => __('Two Columns Text & Image'),
        'render_template'   =>  'template-parts/two-columns-text-image.php',
        'category'          => 'text and image',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'two-columns-text-image', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'two-columns-text-inside-image',
        'title'             => __('Two Columns Text Inside Image'),
        'description'       => __('Two Columns Text Inside Image'),
        'render_template'   =>  'template-parts/two-columns-text-inside-image.php',
        'category'          => 'text and image',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'two-columns-text-inside-image', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'italic-large-font-text',
        'title'             => __('Italic Large Font Text'),
        'description'       => __('Italic Large Font Text'),
        'render_template'   =>  'template-parts/italic-large-font-text.php',
        'category'          => 'Large Italic Font',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'italic-large-font-text', 'quote' ),
    ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}


add_action('admin_head', 'block_editor_full_width');
function block_editor_full_width() {
    echo '<style>
        .wp-block {max-width: 1220px !important; padding: 0px 10px !important;}
    </style>';
}


function theme_name_script_enqueue() {
    if (!is_product_category() || !is_shop()) {
        wp_enqueue_style( 'slick','https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
        wp_enqueue_script( 'slickjs', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery') );
        wp_enqueue_script('customjs', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true);
    }

}
add_action( 'wp_enqueue_scripts', 'theme_name_script_enqueue' );

add_filter('acf/fields/relationship/query/name=prod_products_slider', 'relationship_options_filter', 10, 3);

function relationship_options_filter($options, $field, $the_post) {

    $options['post_status'] = array('publish');

    return $options;
}

function shapeSpace_recent_posts_shortcode($atts, $content = null) {

    global $post;

    extract(shortcode_atts(array(
        'cat'     => '',
        'num'     => '5',
        'order'   => 'DESC',
        'orderby' => 'post_date',
    ), $atts));

    $args = array(
        'cat'            => $cat,
        'posts_per_page' => $num,
        'order'          => $order,
        'orderby'        => $orderby,
    );

    $output = '';

    $posts = get_posts($args);
    $output .= '<div class="container"><div class="row one-post-row">';
    foreach($posts as $post) {

        setup_postdata($post);
        $desc = get_field('news_description', $post->ID);
        $output .= '<div class="col-lg-5 pr-lg-5 mb-3">';
            $output .= '<h2>' . get_the_title() . '</h2>';
            $output .= '<div class="post-description">'.$desc.'</div>';
            $output .= '<a class="url-button-green" href="'. get_the_permalink() .'">Läs mer</a>';
        $output .= '</div>';
        $output .= '<div class="col-lg-7">';
             $output .= '<div class="post-thumb">'. get_the_post_thumbnail() .'</div>';
        $output .= '</div>';
    }
    $output .= '</div></div>';
    wp_reset_postdata();

    return  $output ;

}
add_shortcode('recent_posts', 'shapeSpace_recent_posts_shortcode');


/**
 * Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 */

// -------------
// 1. Show Buttons

add_action( 'woocommerce_before_add_to_cart_quantity', 'silva_display_quantity_minus' );
add_action( 'woocommerce_after_add_to_cart_quantity', 'silva_display_quantity_plus' );

function silva_display_quantity_plus() {
   echo '<button type="button" class="plus" ><span>+</span></button>';
}


function silva_display_quantity_minus() {
   echo '<button type="button" class="minus" ><span>-</span></button>';
}

// Note: to place minus @ left and plus @ right replace above add_actions with:
//add_action( 'woocommerce_before_add_to_cart_quantity', 'silva_display_quantity_minus' );
//add_action( 'woocommerce_after_add_to_cart_quantity', 'silva_display_quantity_plus' );

// -------------
// 2. Trigger jQuery script

add_action( 'wp_footer', 'silva_add_cart_quantity_plus_minus' );

function silva_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product() ) return;
   ?>
      <script type="text/javascript">

      jQuery(document).ready(function($){

         $('form.cart').on( 'click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));

            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }

         });

      });

      </script>
   <?php
}
add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() {
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}
add_filter( 'pre_option_default_category', '__return_empty_string', 999 );


add_filter('woocommerce_default_catalog_orderby', 'misha_default_catalog_orderby');

function misha_default_catalog_orderby( $sort_by ) {
	return 'price';
}
