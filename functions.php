<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Common theme functions.
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

// Add support for Woo
require get_template_directory() . '/inc/woocommerce.php';

add_theme_support('post-thumbnails');
add_theme_support('title-tag');

//https://stackoverflow.com/questions/4771611/wordpress-child-theme-adding-secondary-menu
add_action('init', 'tf_register_menus');
function tf_register_menus()
{
    register_nav_menu('primary', __('Primary'));
    register_nav_menu('footer', __('Footer'));
}

/**
 * Enqueue scripts and styles.
 */
function tf_custom_scripts()
{
    // Default
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Main js file
    wp_enqueue_script('theme-main', get_stylesheet_directory_uri() . '/js/main.js', ['jquery'], false, true);
}
add_action('wp_enqueue_scripts', 'tf_custom_scripts');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'     => 'Theme Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}
