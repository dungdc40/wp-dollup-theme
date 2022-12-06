<?php
/**
 * The template for displaying Right column (category + trending post + video thumbnail) part in both Mobile & Desktop Display
 *
 * @package WordPress
 * @subpackage Topshelftrades
 * @since Topshelftrades 1.0
 */
?>

<div class="col-right ">
    <!-- list of categories in desktop -->
    <div class="list-box categories_list font-rale content-desktop">
        <h6 class="title">Categories</h6>
        <ul>
            <li> <a href="/"> All </a></li>
            <?php wp_list_categories( array(
                'orderby'       => 'name',
                'show_count'    => true,
                'title_li'      => '',
                'exclude'    => array(),
                'style'               => 'list',
                'hide_empty'          => 1,
                'hide_title_if_empty' => false,
            ) ); ?>
        </ul>
    </div>
    <!-- list of trending posts in both mobile & desktop -->
    <div class="list-box trending_post">
        <h6 class="title">Trending Posts</h6>
        <div>
            <?php
            $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
            while ( $popularpost->have_posts() ) : $popularpost->the_post();
                echo '<div class="trending-post">';
                if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                    the_post_thumbnail(array(80,80));
                }
                echo '<div> <a class="trending-post__title"  href="';
                the_permalink();
                echo '">';
                the_title();

                echo '</a></div>';
                echo '</div>';
            endwhile;
            ?>

        </div>
    </div>



</div>
