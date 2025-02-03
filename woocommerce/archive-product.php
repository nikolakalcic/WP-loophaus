<?php
/**
 * WooCommerce Product Archive (Shop Page)
 */

defined('ABSPATH') || exit;

get_header(); ?>

<main class="woocommerce-container">
    <?php
    do_action('woocommerce_before_main_content');

    if (woocommerce_product_loop()) {
        woocommerce_output_loop();
    } else {
        do_action('woocommerce_no_products_found');
    }

    do_action('woocommerce_after_main_content');
    ?>
</main>

<?php get_footer(); ?>