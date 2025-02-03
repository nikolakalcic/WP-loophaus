<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
                <h1><?php echo pll__('Discover Sustainable Building Materials'); ?></h1>
                <p class="hero-subtitle"><?php echo pll__('Your trusted source for eco-friendly construction solutions'); ?></p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(get_permalink(pll_get_post(wc_get_page_id('shop')))); ?>" class="btn btn-primary"><?php echo pll__('Shop Now'); ?></a>
                    <a href="<?php echo esc_url(get_permalink(pll_get_post(get_page_by_path('about-us')->ID))); ?>" class="btn btn-outline"><?php echo pll__('Learn More'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="featured-categories">
        <div class="container">
            <h2 class="section-title">Featured Categories</h2>
            <div class="category-grid">
                <?php
                $featured_categories = get_terms([
                    'taxonomy' => 'product_cat',
                    'number' => 3,
                    'parent' => 0,
                    'meta_query' => [
                        [
                            'key' => 'featured',
                            'value' => 'yes'
                        ]
                    ]
                ]);

                foreach ($featured_categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image = wp_get_attachment_url($thumbnail_id);
                    $category_link = get_term_link($category, 'product_cat');
                ?>
                    <a href="<?php echo esc_url($category_link); ?>" class="category-card">
                        <div class="category-image">
                            <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="category-content">
                            <h3><?php echo esc_html($category->name); ?></h3>
                            <span class="category-link">View Products</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Recently Added Products -->
    <section class="recent-products">
        <div class="container">
            <h2 class="section-title">Recently Added Products</h2>
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
                        global $product;
                ?>
                    <div class="product-card">
                        <a href="<?php the_permalink(); ?>" class="product-link">
                            <div class="product-image">
                                <?php echo woocommerce_get_product_thumbnail('woocommerce_thumbnail'); ?>
                                <div class="product-overlay">
                                    <span class="view-product">View Product</span>
                                </div>
                            </div>
                            <div class="product-details">
                                <h3 class="product-title"><?php the_title(); ?></h3>
                                <div class="product-price"><?php echo $product->get_price_html(); ?></div>
                                <?php if ($product->is_in_stock()) : ?>
                                    <div class="product-stock in-stock">In Stock</div>
                                <?php else : ?>
                                    <div class="product-stock out-of-stock">Out of Stock</div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="section-footer">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-outline-dark">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
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
                        global $product;
                ?>
                    <div class="product-card">
                        <a href="<?php the_permalink(); ?>" class="product-link">
                            <div class="product-image">
                                <?php echo woocommerce_get_product_thumbnail('woocommerce_thumbnail'); ?>
                                <div class="product-overlay">
                                    <span class="view-product">View Product</span>
                                </div>
                            </div>
                            <div class="product-details">
                                <h3 class="product-title"><?php the_title(); ?></h3>
                                <div class="product-price"><?php echo $product->get_price_html(); ?></div>
                                <?php if ($product->is_in_stock()) : ?>
                                    <div class="product-stock in-stock">In Stock</div>
                                <?php else : ?>
                                    <div class="product-stock out-of-stock">Out of Stock</div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="section-footer">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-outline-dark">View All Featured</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2 class="section-title"><?php echo get_theme_mod('about_section_title', 'About Loophaus'); ?></h2>
                    <div class="about-text">
                        <?php echo wpautop(get_theme_mod('about_section_text', 'Your trusted source for eco-friendly building materials.')); ?>
                    </div>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="btn btn-outline-dark">Learn More</a>
                </div>
                <div class="about-image">
                    <?php 
                    $about_image = get_theme_mod('about_section_image');
                    if ($about_image) : ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="About Loophaus">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>