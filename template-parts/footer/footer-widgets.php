<?php
/**
 * Displays the footer widget area
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?>

<div class="flexbox footer-socket flex-row-container">

    <div class="flexbox_item">
        <span class="column-heading f-size-18">Products</span>
        <?php
        if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu-1') ) {
            wp_nav_menu( array(
                'sort_column' => 'menu_order',
                'container' => 'ul',
                'menu_id' => 'footer-menu-1',
                'menu_class' => 'nav',
                'theme_location' => 'footer-menu-1'
            ));
        }
        ?>
    </div>

    <div class="flexbox_item">
        <span class="column-heading f-size-18">Menu Header</span>
        <?php
        if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu-2') ) {
            wp_nav_menu( array(
                'sort_column' => 'menu_order',
                'container' => 'ul',
                'menu_id' => 'footer-menu-2',
                'menu_class' => 'nav',
                'theme_location' => 'footer-menu-2'
            ));
        }
        ?>
    </div>


    <div class="flexbox_item">
        <span class="column-heading f-size-18">Company</span>
        <?php
        if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu-3') ) {
            wp_nav_menu( array(
                'sort_column' => 'menu_order',
                'container' => 'ul',
                'menu_id' => 'footer-menu-3',
                'menu_class' => 'nav',
                'theme_location' => 'footer-menu-3'
            ));
        }
        ?>
    </div>

    <div class="flexbox_item">
        <span class="column-heading f-size-18">Support</span>
        <?php
        if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu-4') ) {
            wp_nav_menu( array(
                'sort_column' => 'menu_order',
                'container' => 'ul',
                'menu_id' => 'footer-menu-4',
                'menu_class' => 'nav',
                'theme_location' => 'footer-menu-4'
            ));
        }
        ?>
    </div>
</div>
