<?php
/**
 * The template displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
get_header();
?>
    <section class="blog flexbox max-width margin-top-20 margin-bottom-50">
        <div class="blog-banner">
            <div class="blog-banner-content">
                <p>The Blog</p>
                <h1>Your source for great insights</h1>
            </div>
        </div>
        <div class="container-box blog-content pt-50 pb-50">
            <!-- list of categories in mobile-->
            <?php
            get_template_part('template-parts/blog/mobile', 'category' );
            ?>
            <div class="row-in-desktop">
                <div class="col-left">
                    <?php

                    // Start the Loop.
                    while ( have_posts() ) :
                        the_post();
                        // get the view for each post
                        include get_stylesheet_directory() . '/tmpl-loops/loop-single-post-full.php';
                    endwhile; // End the loop.
                    ?>
                </div>
                <!-- right column -->
                <?php
                get_template_part('template-parts/blog/block', 'right-column' );
                ?>
            </div>
        </div>
    </section>
<?php
get_footer();
