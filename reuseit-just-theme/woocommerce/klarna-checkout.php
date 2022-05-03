<div class="row custom-checkout-section">
    <div class="col-12 step step-1 mb-5">
        <div class="item">
            <?php
            /**
             * Klarna Checkout page
             *
             * Overrides /checkout/form-checkout.php.
             *
             * @package klarna-checkout-for-woocommerce
             */

            wc_print_notices();

            do_action( 'woocommerce_before_checkout_form', $checkout );
            do_action( 'kco_wc_before_checkout_form' );

            // If checkout registration is disabled and not logged in, the user cannot checkout.
            if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
                echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
                return;
            }
            ?>
        </div>
    </div>
    <div class="col-12">
        <form name="checkout" class="checkout woocommerce-checkout row">

            <div id="kco-wrapper col-12">
                <div class="row">
                <div id="kco-order-review" class="col-12 step step-2 mb-5">
                    <div class="item">
                        <?php do_action( 'kco_wc_before_order_review' ); ?>
                        <?php woocommerce_order_review(); ?>
                        <?php do_action( 'kco_wc_after_order_review' ); ?>
                    </div>
                    <p class="checkout-select-other-company">
                      <label class="topmenu-label topmenu-label-second">Är du företag? klicka här
                      <input <?php echo $c_checked; ?> name="tax_toggle" type="radio" value="company" id="company" />
                      </label>
                  </p>
                </div>


                <div id="kco-iframe" class="col-12 step step-3">
                    <div class="item">
                        <?php do_action( 'kco_wc_before_snippet' ); ?>
                        <?php kco_wc_show_snippet(); ?>
                        <?php do_action( 'kco_wc_after_snippet' ); ?>
                     </div>
                </div>

                </div>

            </div>

        </form>
    </div>




<?php do_action( 'kco_wc_after_checkout_form' ); ?>
</div>
