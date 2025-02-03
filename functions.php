/* functions.php */
<?php
if (!defined('ABSPATH')) exit;

// Enable error logging
if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

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
    wp_enqueue_script('loophaus-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
    
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

function loophaus_customize_register($wp_customize) {
    // Add settings and controls here
    $wp_customize->add_setting('hero_title', [
        'default' => 'Eco Building Materials',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('hero_title', [
        'label' => __('Hero Title', 'loophaus'),
        'section' => 'title_tagline',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('hero_subtitle', [
        'default' => 'Sustainable solutions for modern construction',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('hero_subtitle', [
        'label' => __('Hero Subtitle', 'loophaus'),
        'section' => 'title_tagline',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('about_section_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_image', [
        'label' => __('About Section Image', 'loophaus'),
        'section' => 'title_tagline',
        'settings' => 'about_section_image',
    ]));

    $wp_customize->add_setting('about_section_title', [
        'default' => 'About Loophaus',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('about_section_title', [
        'label' => __('About Section Title', 'loophaus'),
        'section' => 'title_tagline',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('about_section_text', [
        'default' => 'Your trusted source for eco-friendly building materials.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);

    $wp_customize->add_control('about_section_text', [
        'label' => __('About Section Text', 'loophaus'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ]);

    // Logo Size Control
    $wp_customize->add_setting('logo_size', [
        'default' => '160',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('logo_size', [
        'label' => __('Logo Size (px)', 'loophaus'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => [
            'min' => 80,
            'max' => 300,
            'step' => 10,
        ],
    ]);

    // Header Background Color
    $wp_customize->add_setting('header_bg_color', [
        'default' => '#ffffff',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', [
        'label' => __('Header Background Color', 'loophaus'),
        'section' => 'colors',
    ]));
}
add_action('customize_register', 'loophaus_customize_register');

// Output custom CSS
function loophaus_customize_css() {
    ?>
    <style type="text/css">
        .logo-wrapper {
            max-width: <?php echo get_theme_mod('logo_size', '160'); ?>px;
        }
        .site-header {
            background-color: <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'loophaus_customize_css');

// Add this to help debug REST API issues
add_filter('rest_url', function($url) {
    write_log('REST URL: ' . $url);
    return $url;
});
