/* footer.php */
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <?php if (has_custom_logo()) {
                        the_custom_logo();
                    } else { ?>
                        <div class="site-title"><?php bloginfo('name'); ?></div>
                    <?php } ?>
                    <p class="site-description"><?php bloginfo('description'); ?></p>
                </div>
                
                <div class="footer-navigation">
                    <nav class="footer-menu">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footer',
                            'menu_class' => 'footer-menu-list',
                            'depth' => 1,
                        ]);
                        ?>
                    </nav>
                </div>
                
                <div class="footer-social">
                    <h4><?php esc_html_e('Follow Us', 'loophaus'); ?></h4>
                    <div class="social-links">
                        <?php
                        $social_links = [
                            'facebook' => get_theme_mod('facebook_url'),
                            'instagram' => get_theme_mod('instagram_url'),
                            'twitter' => get_theme_mod('twitter_url'),
                        ];
                        
                        foreach ($social_links as $platform => $url) {
                            if ($url) {
                                echo '<a href="' . esc_url($url) . '" class="social-link ' . esc_attr($platform) . '" target="_blank" rel="noopener noreferrer">';
                                echo '<span class="screen-reader-text">' . esc_html($platform) . '</span>';
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    <?php
                    echo sprintf(
                        esc_html__('© %1$s %2$s. All rights reserved.', 'loophaus'),
                        date('Y'),
                        get_bloginfo('name')
                    );
                    ?>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>