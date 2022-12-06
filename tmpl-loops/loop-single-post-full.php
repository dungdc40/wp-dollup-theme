<article class="post single-post">
    <div class="featured-image">
        <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" />
    </div>

    <?php
    $publishedDate = strtotime( get_the_date() );
    $date = date('F j, Y', $publishedDate);
    $terms = get_the_category();
    ?>
    <div class="post-meta flex-row-container">
        <div class="post-categories pt-20 pb-20">
            <img src="<?= get_stylesheet_directory_uri()?>/img/icn-category.png"/>&nbsp;&nbsp;
            <?php
            foreach ($terms as $i => $term) {
                echo '<a href="' . get_term_link($term) . '">' . ucfirst($term->name) . '</a>';
                if($i < count($terms) - 1) {
                    echo '&nbsp; • &nbsp;';
                }
            }
            ?>
        </div>
        <div class="post-categories">
            <img src="<?= get_stylesheet_directory_uri()?>/img/icn-comment.png"/>&nbsp
            <?= get_comments_number($post); ?>&nbsp;&nbsp;&nbsp;
            <img src="<?= get_stylesheet_directory_uri()?>/img/icn-clock.png"/>&nbsp
            <?= $date; ?>
        </div>
    </div><!-- /post-meta -->

    <h3 class="post-title">
        <a href="<?= get_permalink();?>" class="font-rale">
            <?php the_title() ?>
        </a>
    </h3><!-- /post-content -->
    <hr class="post-divider" />
    <div class="post-excerpt">
        <?php the_content(); ?>
    </div>
</article>
