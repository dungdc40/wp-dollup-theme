<?php
/**
 * Displays the main header for Traderfundrr
 *
 * @package WordPress
 * @subpackage Traderfundrr
 * @since Traderfundrr 1.0
 */
?>

<header id="masthead" class="site-header-container">
    <div class="site-header container-box flex-row-container">
        <div class="header-logo-mobile">
            <?php
            $logo = get_field('logo', 'option');
            if ($logo) {
                echo "<a href='".get_site_url()."'><img class='logo' src='{$logo['url']}' /></a>";
            }
            ?>
            <img class='mobile-menu-toggle'
                 src='<?= get_stylesheet_directory_uri() . '/img/hamburger-btn.png'; ?>'/>
        </div>
        <div class="header-logo">
            <?php
            $logo = get_field('logo', 'option');
            if ($logo) {
                echo "<a href='".get_site_url()."'><img class='logo' src='{$logo['url']}' /></a>";
            }
            ?>
        </div>
        <div class="header-nav">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container' => null,
                    'menu_id' => 'menu',
                    'menu_class' => null,
                )
            );
            ?>
        </div>
    </div>
</header><!-- #masthead -->

<div class="header-nav-mobile">
    <?php
    wp_nav_menu(
        array(
            'theme_location' 		=> 'primary',
            'container'				=> null,
            'menu_id' 				=> 'menu',
            'menu_class' 			=> null,
        )
    );
    ?>
</div>