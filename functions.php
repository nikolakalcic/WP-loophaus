/* functions.php */
<?php
if (!defined('ABSPATH')) exit;

function loophaus_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    register_nav_menus([
        'primary' => __('Primary Menu', 'loophaus'),
        'footer' => __('Footer Menu', 'loophaus'),
    ]);
}
add_action('after_setup_theme', 'loophaus_setup');

function loophaus_enqueue() {
    // Styles
    wp_enqueue_style('loophaus-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    wp_enqueue_style('loophaus-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
    
    // Scripts
    wp_enqueue_script('loophaus-navigation', get_template_directory_uri() . '/assets/js/navigation.js', [], '1.0', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'loophaus_enqueue');

// Custom WooCommerce modifications
function loophaus_woocommerce_setup() {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'loophaus_woocommerce_setup');

// Disable WooCommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Add custom image sizes
add_image_size('loophaus-featured', 800, 600, true);
add_image_size('loophaus-thumbnail', 400, 300, true);
