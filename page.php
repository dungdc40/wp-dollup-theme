<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
if(!get_field('tf_is_react_dashboard_page') && !get_field('tf_is_react_landing_page')):
?>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php

                // Start the Loop.
                while ( have_posts() ) :
                    the_post();
                ?>
                    <div class="blog-banner">
                        <div class="blog-banner-content">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>

                <?php
                    get_template_part( 'template-parts/content/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                endwhile; // End the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- #content -->
<?php
endif;
get_footer();
