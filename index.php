<?php get_header(); ?>

<main class="site-main">
    <!-- Hero Banner -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome to Loophaus</h1>
                <p class="hero-subtitle">Discover sustainable building materials and solutions.</p>
                <!-- Hero buttons from Figma design -->
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary">Shop Now</a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories (3 boxes from Figma) -->
    <section class="featured-categories">
        <div class="container">
            <div class="category-grid">
                <?php
                $featured_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'number' => 3,
                    'parent' => 0
                ));

                foreach ($featured_categories as $category) :
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image = wp_get_attachment_url($thumbnail_id);
                ?>
                    <div class="category-card">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" class="category-image">
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
            <div class="product-slider">
                <?php
                $recent_products_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                
                $recent_products = new WP_Query($recent_products_args);
                
                if ($recent_products->have_posts()) :
                    while ($recent_products->have_posts()) : $recent_products->the_post();
                ?>
                    <div class="product-card">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-image">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium', ['class' => 'img-fluid']);
                                }
                                ?>
                            </div>
                            <div class="product-details">
                                <h4><?php the_title(); ?></h4>
                                <?php echo wc_get_product(get_the_ID())->get_price_html(); ?>
                            </div>
                        </a>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
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
                $featured_products_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field' => 'name',
                            'terms' => 'featured'
                        )
                    )
                );
                
                $featured_products = new WP_Query($featured_products_args);
                
                if ($featured_products->have_posts()) :
                    while ($featured_products->have_posts()) : $featured_products->the_post();
                ?>
                    <div class="product-card">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-image">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium', ['class' => 'img-fluid']);
                                }
                                ?>
                            </div>
                            <div class="product-details">
                                <h4><?php the_title(); ?></h4>
                                <?php echo wc_get_product(get_the_ID())->get_price_html(); ?>
                            </div>
                        </a>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- About Section with Image -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    <?php 
                    $about_image = get_theme_mod('home_about_image');
                    if ($about_image) :
                    ?>
                        <img src="<?php echo esc_url($about_image); ?>" alt="About Loophaus" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="about-content">
                    <h2><?php echo get_theme_mod('home_about_title', 'About Loophaus'); ?></h2>
                    <div class="about-text">
                        <?php echo wpautop(get_theme_mod('home_about_text', 'Your journey to sustainable building starts here.')); ?>
                    </div>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Stay Updated</h2>
                <p>Subscribe to our newsletter for the latest eco-friendly building materials and sustainability tips.</p>
                <?php 
                if (shortcode_exists('contact-form-7')) {
                    echo do_shortcode('[contact-form-7 id="YOUR_FORM_ID" title="Newsletter Signup"]');
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>