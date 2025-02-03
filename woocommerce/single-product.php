<?php
get_header();
?>

<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="product-detail">
            <h1><?php the_title(); ?></h1>
            <div class="product-image"><?php the_post_thumbnail(); ?></div>
            <div class="product-description"><?php the_content(); ?></div>
            <div class="product-price"><?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?></div>
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
    <?php endwhile; ?>
</div>

<?php
get_footer();
?>