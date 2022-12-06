<?php
/**
 * Template Name: HK Blog Archives
 * Template Post Type: page

 * @package storefront
 */

get_header();


// LOOP
global $post;
$post_slug = $post->post_name; // get the page slug to enter it in the QUERY
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'paged' => $paged,
    'post_status' => array('publish'),
);

$loop = new WP_Query( $args );
?>

<section class="blog flexbox max-width margin-top-20 margin-bottom-50">
    <div class="blog-banner">
        <img src="<?= get_stylesheet_directory_uri()?>/img/banner-blog.png"/>
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
                if ( $loop->have_posts() ) :
                    while ( $loop->have_posts() ) : $loop->the_post();
                        include get_stylesheet_directory() . '/tmpl-loops/loop-single-post.php';
                    endwhile;
                    echo '<div class="block-btn pb-50">';
                    echo '<div>';
                    previous_posts_link( __( 'Previous', 'textdomain' ) );
                    echo '</div><div>';
                    next_posts_link( __( 'Next', 'textdomain' ), $loop->max_num_pages );
                    echo '</div></div>';
                else:
                    _e( 'Sorry, no posts matched your criteria.', 'ninjacators' );
                endif;
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <!-- right column -->
            <?php
            get_template_part('template-parts/blog/block', 'right-column' );
            ?>
        </div>
    </div>


</section>


<?php get_footer(); ?>
