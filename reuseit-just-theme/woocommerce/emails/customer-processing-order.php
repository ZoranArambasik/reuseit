<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        table, td, div, h1, h2, h3, h4, h5, p, li, span, a {
    line-height: 1.5; font-family: 'Helvetica', sans-serif; text-decoration: none;}
        td {padding:2px !important;}
        @media screen and ( max-width:400px ) {

        }
        p, td, span {
            font-size: 14px;
            margin: 0px;
        }
    </style>
</head>

<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
//do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
//do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
//do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
//do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
//if ( $additional_content ) {
    //echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
//}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
//do_action( 'woocommerce_email_footer', $email );
?>

<div style="width:800px; max-width: 96%; margin:30px auto;">
    <div style="position: relative;background: #55B948; padding: 30px 0px; width:100%;">
        <div style="width:95%; margin:0 auto;">
            <div style="height: 50px; align-items: center; justify-content: space-between;">
                <?php if ( is_active_sidebar( 'order-received-logo' ) ) : ?>
                    <div style="text-align: center;"><a href="<?php bloginfo('url'); ?>" target="_blank"><?php dynamic_sidebar( 'order-received-logo' ); ?></a></div>
                <?php endif; ?>
                <!-- <a style="float: right; line-height: 28px; color: #55B948;text-decoration: none;background: white;padding: 13px 20px;border-radius: 30px;font-weight: bold; font-size: 15px;" href="<?php bloginfo('url') ?>">Till reuseit.se</a> -->
            </div>
        </div>
    </div>
    <?php
    if ( $order ) :?>


        <div style="font-family: 'Helvetica', sans-serif; width: 100%; max-width: 600px; margin: 40px auto 0px auto; color: black; padding-bottom: 30px; text-align:center;">
            <div style="font-family: 'Helvetica', sans-serif; text-align: center;margin-bottom: 40px;font-weight: bold;">
                
                    <img class="happy-face" src="<?php bloginfo('url'); ?>/wp-content/uploads/2021/11/happy-face.png">
                    <p>#miljöhjälte</p>
                
            </div>
            <?php 
            $tnx = '<h3 style="margin-top: 0;font-weight: bold;font-size: 24px; margin-bottom: 15px; color: #000 !important; text-align: center;">Hej ' . $order->get_billing_first_name() . ', tack för ditt köp!</h3>';
                echo apply_filters( 'woocommerce_thankyou_order_received_text', _e( $tnx, 'woocommerce' ), $order ); ?>
                <?php if ( is_active_sidebar( 'order-received-user-description' ) ) : ?>
                    <?php dynamic_sidebar( 'order-received-user-description' ); ?>
                <?php endif; ?>     
        </div>

        <?php
            $order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
            $show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
            $show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
            $downloads             = $order->get_downloadable_items();
            $show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();


        ?>
        <?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php //do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
        <div style="margin: 40px auto; border-top: 1px solid #838383; padding-top: 50px;">
            <?php
            do_action( 'woocommerce_order_details_before_order_table_items', $order );

            foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product(); 
                $custom_field = get_post_meta( $product->get_id(), 'product_list_desc', true ); 
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_price();
                $regular_price_tax = wc_get_price_including_tax( $product, array('price' => $regular_price ) );
                $sale_price_tax = wc_get_price_including_tax( $product, array('price' => $sale_price ) );
                $custom_shape_top = get_post_meta( $product->get_id(), 'shape_right_description_top_text', true ); 
                $custom_shape_bottom = get_post_meta( $product->get_id(), 'shape_right_description_bottom_text', true ); 
                $currency = get_option('woocommerce_currency');
                
                ?>
                <div style="color: black; width: 100%;border-bottom: 1px solid #838383;margin-bottom: 50px;padding-bottom: 50px; border-collapse: collapse; width: 100%; text-align:center;">
                    
                        
                            <div style="line-height: 1.5;font-family: 'Helvetica', sans-serif; text-decoration: none;display: inline-block;vertical-align: middle;max-width: 320px;min-width: 220px;width: 220px;margin: 0 auto;">
                                <img style="max-width:100%;" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
                            </div>
                            <div style="line-height: 1.5;font-family: 'Helvetica', sans-serif; text-decoration: none;display: inline-block;max-width: calc(100% - 20px);width: 426px;vertical-align: middle;text-align: left;margin: 0 auto;">
                                <div style="margin-left: 20px; margin-right: 20px;">

                                <?php
                                do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
                                $is_visible        = $product && $product->is_visible();
                                $product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
                                $qty          = $item->get_quantity();
                                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );

                                if ( $refunded_qty ) {
                                    $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                                } else {
                                    $qty_display = esc_html( $qty );
                                }
                                ?>

                                <h4 style="clear: both;color: #24292e;font-weight: bold;margin-top: 24px;margin-bottom: 8px;font-size: 18px;"><a style="color: #24292e; font-weight: bold;" href="<?php echo $product_permalink; ?>" target="_blank"><?php echo $item->get_name(); ?></a></h4>
                                <?php if ($custom_field): ?>
                                    <p ><?php echo $custom_field; ?></p>
                                <?php endif ?>
                                <?php echo '<p style="margin-top: 30px;margin-bottom: 2px;"><span style="font-weight:bold;">Pris: </span>' . $sale_price_tax . ' ' . $currency .'<span style="font-size:14px;"> (ex.moms)</span></p>'; ?>
                                <?php echo '<p style="margin-top: 0px; margin-bottom: 0px;"><span style="font-weight:bold;">Antal: </span> ' . $qty_display . '</p>'; ?>

                                <?php

                                do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                                ?>
                                <?php //echo $order->get_formatted_line_subtotal( $item ); ?>
                                </div>
                            </div>
                            <div style="line-height: 1.5;font-family: 'Helvetica', sans-serif; text-decoration: none;display: inline-block;vertical-align: top;max-width: 320px;min-width: 140px;width: 140px;margin: 20px auto 0 auto;">
                            <?php if ($custom_shape_top || $custom_shape_bottom): ?>
                                
                                <div style="font-family:Arial,sans-serif;height: 140px;width: 140px;display: table-cell;text-align: center;vertical-align: middle;border-radius: 50%;background: black;">
                                    <div style="font-size: 15px; font-weight: bold; color:white"><?php echo $custom_shape_top; ?></div>
                                    <div style="font-size: 14px; font-weight: bold;color:white;"><?php echo $custom_shape_bottom; ?></div>
                                </div>
                                  
                            <?php endif ?>
                            </div>
                        

                </div>
               
            <?php }

            do_action( 'woocommerce_order_details_after_order_table_items', $order );
            ?>
        </div>
        <div style="color: black; margin-bottom: 50px;padding-bottom: 50px; border-bottom: 1px solid #838383; display: flex; flex-wrap: wrap;">
            <?php 
                $price_without_tax = $order->get_total() - $order->get_total_tax() - $order->get_shipping_total();
                $shipping_total = $order->get_shipping_total();
                $currency = get_option('woocommerce_currency');
            ?>
            <div style="margin: 0 auto; width: 95%;">
                <p style="margin-bottom: 0; font-size: 18px;">
                    <?php esc_html_e( 'Order #' . $order->get_order_number(), 'woocommerce' ); ?>
                </p>
                <table style="color: black; margin-bottom: 10px; max-width: 520px; width:100%;">
                    <tbody>
                        <tr>
                            <td><?php _e('Delsumma'); ?></td>
                            <td><?php echo $price_without_tax.' '.$currency; ?></td>
                        </tr>
                        <tr>
                            <td><?php _e('Moms'); ?></td>
                            <td><?php echo $order->get_total_tax() .' '.$currency; ?></td>
                        </tr>
                        <?php if (!empty($shipping_total)): ?>
                            <tr>
                                <td><?php _e('Fraktkostnad'); ?></td>
                                <td><?php echo $shipping_total.' '.$currency; ?></td>
                            </tr>
                        <?php else:?> 
                            <tr>
                                <td><?php _e('Fraktfritt'); ?></td>
                                <td></td>
                            </tr>
                        <?php endif ?>
                        
                        <tr style="font-weight:bold;">
                            <td><?php _e('TOTALT'); ?></td>
                            <td><?php echo $order->get_total().' '.$currency; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="color: black;border-bottom: 1px solid #838383; padding-bottom: 50px;margin-bottom: 50px; display: flex; flex-wrap: wrap;">
            <div style="width:95%; margin:0 auto;">
                <div style="width:100%;">
                    
                       
                            <div style="vertical-align: top; display:inline-block; width:250px; margin-bottom:10px">
                                <p style="margin:0px; font-weight: bold;"><?php _e('Leveransadress'); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_billing_first_name().' '.$order->get_billing_last_name(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_billing_address_1(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_billing_address_2(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_billing_postcode() .' '.$order->get_billing_city(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_billing_country(); ?></p>
                            </div>
                        
                            <div style="vertical-align: top; display:inline-block; width:250px; margin-bottom:10px">
                                <p style="margin:0px; font-weight: bold;"><?php _e('Fakturaadress') ?></p>
                                <p style="margin:0px;"><?php echo $order->get_shipping_first_name().' '.$order->get_shipping_last_name(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_shipping_address_1(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_shipping_address_2(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_shipping_postcode() .' '.$order->get_shipping_city(); ?></p>
                                <p style="margin:0px;"><?php echo $order->get_shipping_country(); ?></p>
                            </div>
                       
                            <div style="vertical-align: top; display:inline-block; width:250px;">
                                <p style="margin:0px; font-weight:bold;" class="payment-method-title"><?php _e('Betalningsmetod'); ?></p>
                                <?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
                            </div>
                       
                    
                </div>
            </div>
        </div>
        <div style="color: black; max-width: 95%;margin: 0 auto;margin-bottom: 40px;">
            <?php $args = array(
                'post_type' => 'order_thank_you',
                'posts_per_page' => 1,
                'post_status' => 'private'
              
            );
            $query = new WP_Query ($args); ?>
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <?php
                        $order_title = get_field('order_title');
                        $order_text = get_field('order_text');
                        $link = get_field('order_link');
                        $order_image = get_field('order_image');
                    ?>
                    <div style="display: inline-block;width: 435px;max-width: 100%;">
                        <?php if ($order_title): ?>
                            <p style="margin-bottom:0px; font-weight: bold;"><?php echo $order_title ?></p>
                        <?php endif ?>
                        <?php if ($order_text): ?>
                            <p style="margin-bottom:0px; font-weight: bold;"><?php echo $order_text ?></p>
                        <?php endif ?>
                        <?php 
                       
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a style="border-radius: 47px;background-color: #55b948;color: white;max-width: 100%;padding: 10px 20px;display: inline-block;margin-top: 30px;" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div style="display: inline-block;width: 320px;vertical-align: top;text-align: center;max-width: 100%;">
                        <p style="float:left;margin-top:10px; position:relative; z-index: 999;"><a href="https://se.trustpilot.com/review/reuseit.se?utm_medium=Trustbox&amp;utm_source=EmailNewsletter1" style="text-decoration: none;"><img src="https://emailsignature.trustpilot.com/newsletter/sv-SE/1/4c5b1c9200006400050d7fdd/text1@2x.png" border="0" height="18" alt="Human score" style="max-height: 18px;"></a> &nbsp;&nbsp; <a href="https://se.trustpilot.com/review/reuseit.se?utm_medium=Trustbox&amp;utm_source=EmailNewsletter1" style="text-decoration: none;"><img src="https://emailsignature.trustpilot.com/newsletter/sv-SE/1/4c5b1c9200006400050d7fdd/stars@2x.png" border="0" height="20" alt="Trustpilot Stars" style="max-height: 20px;"></a> &nbsp;&nbsp; <span style="display: inline-block;"><a href="https://se.trustpilot.com/review/reuseit.se?utm_medium=Trustbox&amp;utm_source=EmailNewsletter1" style="text-decoration: none;"><img src="https://emailsignature.trustpilot.com/newsletter/sv-SE/1/4c5b1c9200006400050d7fdd/text2@2x.png" border="0" height="18" alt="number of reviews" style="max-height: 18px;"></a> &nbsp;&nbsp; <a href="https://se.trustpilot.com/review/reuseit.se?utm_medium=Trustbox&amp;utm_source=EmailNewsletter1" style="text-decoration: none;"><img src="https://emailsignature.trustpilot.com/brand/n/1/logo.png" border="0" height="20" alt="Trustpilot Logo" style="max-height: 20px; display: inline-block;"></a></span></p>
                        <?php if( !empty( $order_image ) ): ?>
                            <img style="max-width: 100%;" src="<?php echo esc_url($order_image['url']); ?>" alt="<?php echo esc_attr($order_image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    <?php else : ?>

        <div style="font-family: 'Helvetica', sans-serif; width: 100%; max-width: 600px; margin: 40px auto 0px auto; color: black; padding-bottom: 30px; text-align:center;">
            <div style="font-family: 'Helvetica', sans-serif; text-align: center;margin-bottom: 40px;font-weight: bold;">
                
                    <img class="happy-face" src="<?php bloginfo('url'); ?>/wp-content/uploads/2021/10/happy-face.png">
                    <p>#miljöhjälte</p>
                
            </div>
            <?php 
            $tnx = '<h3 style="margin-top: 0;font-weight: bold;font-size: 24px; margin-bottom: 15px; color: #000 !important; text-align: center;">Hej ' . $order->get_billing_first_name() . ', tack för ditt köp!</h3>';
                echo apply_filters( 'woocommerce_thankyou_order_received_text', _e( $tnx, 'woocommerce' ), $order ); ?>
                <?php if ( is_active_sidebar( 'order-received-user-description' ) ) : ?>
                    <?php dynamic_sidebar( 'order-received-user-description' ); ?>
                <?php endif; ?>     
        </div>

    <?php endif; ?>
    <div style="background: black;padding: 80px 0px 40px 0px;color: white;">
        <div style="margin: 0 auto;width: 95%;border-bottom: 1px solid #ffffff;padding-bottom: 30px;margin-bottom: 30px;">
            <table style="width:100%; color: white;">
                <tbody>
                    <tr>
                        <td>
                            <?php dynamic_sidebar('footer-order-received-top'); ?>
                        </td>
                        <td style="vertical-align: top; text-align: right;">
                            <a href="http://www.instagram.com/reuseitsweden/" target="_blank" rel="noopener noreferrer"><img src="<?php bloginfo('template_directory') ?>/woocommerce/emails/instagram.jpg"></a><a href="http://www.facebook.com/reuseitsweden/" target="_blank" rel="noopener noreferrer"><img src="<?php bloginfo('template_directory') ?>/woocommerce/emails/facebook.jpg"></a><a href="http://se.linkedin.com/company/reuseit-sweden-ab" target="_blank" rel="noopener noreferrer"><img src="<?php bloginfo('template_directory') ?>/woocommerce/emails/linkedin.jpg"></a> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin: 0 auto;width: 95%;">
            <p style="font-size: 12px; color:white;">REUSEIT MEMBER OF ELANDERS GROUP</p>       
        </div>
    </div>

</div>

</html>