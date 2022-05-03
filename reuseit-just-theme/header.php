<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- link rel="icon" type="image/svg+xml" href="<?php echo get_bloginfo('template_url'); ?>/images/favicon-reuseit.svg" -->
    <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url'); ?>/images/favicon-reuseit.ico" type="image/vnd.microsoft.icon" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="facebook-domain-verification" content="sk5tiepq7gug031rpugkay8onffljc" />
    <script> (function(ss,ex){ window.ldfdr=window.ldfdr||function(){(ldfdr._q=ldfdr._q||[]).push([].slice.call(arguments));}; (function(d,s){ fs=d.getElementsByTagName(s)[0]; function ce(src){ var cs=d.createElement(s); cs.src=src; cs.async=1; fs.parentNode.insertBefore(cs,fs); }; ce('https://sc.lfeeder.com/lftracker_v1_'+ss+(ex?'_'+ex:'')+'.js'); })(document,'script'); })('bElvO73w6OG7ZMqj'); </script>
<?php wp_head();

if(isset($_REQUEST['vat'])){
	if($_REQUEST['vat'] == '1'){
			WC()->session->set( 'my_custom_tax_rate_company', 1 );
		} else {

			WC()->session->__unset( 'my_custom_tax_rate_company' );
		}
}
?>
</head>

<body <?php body_class(); ?>>
<?php
if(WC()->session->get( 'my_custom_tax_rate_company' ) != 1){
?>
<script async src="https://eu-library.klarnaservices.com/lib.js" data-client-id="ffb79c84-b453-5019-bd3b-61f09cec83c9"></script>
<?php }?>

<?php echo do_shortcode('[LOAD_CARTMENU_TEMP_SHORTCODE]');
$coupon_banner = get_field('coupon_banner', 29);
?>
<?php $extrasc = ''; ?>
<?php if(!empty($coupon_banner)){ ?>
	<div class="couponBanner"><?php echo $coupon_banner; ?></div>
	<?php $extrasc = 'extraMarg'; ?>
<?php } ?>
<div id="page" class="site <?php echo $extrasc; ?>">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php //esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a> -->
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>

				<?php get_template_part( 'a_header', 'index' );
					//echo '<span class="session">'.WC()->session->get( 'my_custom_tax_rate_company' ).'</span>';
				?>
        <?php if ( is_checkout() ) { get_template_part( 'c_header', 'index' ); } ?>

	<?php mobile_menu(20); ?>
	<form role="search" method="get" class="swoocommerce-product-search" action="/">
		<input type="search" id="woocommerce-product-search-field-0" class="search-field-mobile" placeholder="Sök produkt" value="" name="s" style="display:none">
		<input type="hidden" name="post_type" value="product">
	</form>

		<!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <?php get_template_part( 'top', 'index' ); ?>
    <?php endif; ?>

	<div id="content" class="site-content">

		<?php
			// if (is_front_page()) {
			// 	dynamic_sidebar('puff-homepage');
			// }
		?>
		<?php if (is_front_page()): ?>
			<div class="front-page">

		<?php else: ?>
			<div class="container">

		<?php endif; ?>
                <?php endif; ?>
