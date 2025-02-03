<?php
/**
 * Template Name: Front Page
 * 
 * This is the template for the front page of the Loophaus eco materials marketplace.
 */

get_header(); ?>

<main class="front-page">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1><?php echo get_theme_mod('hero_title', 'Eco Building Materials'); ?></h1>
                <p><?php echo get_theme_mod('hero_subtitle', 'Sustainable solutions for modern construction'); ?></p>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="featured-categories">
        <div class="container">
            <div class="category-grid">
                <?php
                $categories = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'number' => 3
                ]);

                foreach ($categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image = wp_get_attachment_url($thumbnail_id);
                ?>
                    <div class="category-card">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <?php endif; ?>
                        <h3><?php echo esc_html($category->name); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Recently Added Products -->
    <section class="recent-products">
        <div class="container">
            <h2>Recently Added Products</h2>
            <div class="product-grid">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <?php 
                    $about_image = get_theme_mod('about_section_image');
                    if ($about_image) : ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="About Loophaus">
                    <?php endif; ?>
                </div>
                <div class="about-text">
                    <h2><?php echo get_theme_mod('about_section_title', 'About Loophaus'); ?></h2>
                    <p><?php echo get_theme_mod('about_section_text', 'Your trusted source for eco-friendly building materials.'); ?></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>