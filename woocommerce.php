<?php
/**
 * The WooCommerce template file.
 *
 * This file is used to display all WooCommerce pages (shop, cart, checkout).
 * It loads WooCommerce content inside your theme's structure.
 */

get_header(); ?>

<main class="woocommerce-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php if ( is_active_sidebar( 'woocommerce-sidebar' ) ) : ?>
                    <aside class="woocommerce-sidebar">
                        <?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
                    </aside>
                <?php endif; ?>
            </div>
            <div class="col-md-9">
                <?php woocommerce_content(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>