/* header.php */
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <!-- Logo -->
                <div class="logo-wrapper">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else { ?>
                        <a href="<?php echo home_url(); ?>" class="site-title">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php } ?>
                </div>
                
                <!-- Navigation -->
                <nav class="main-navigation">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_class' => 'primary-menu',
                        'container' => false,
                    ]);
                    ?>
                </nav>

                <!-- Search -->
                <div class="header-search">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <input type="search" class="search-field" placeholder="Search products..." value="<?php echo get_search_query(); ?>" name="s">
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>

                <!-- Actions -->
                <div class="header-actions">
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="account-link">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
