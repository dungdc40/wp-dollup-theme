<?php
/**
 * The template for displaying Category part in Mobile Display
 *
 * @package WordPress
 * @subpackage Topshelftrades
 * @since Topshelftrades 1.0
 */
?>
        <div class="content-mobile">
            <div class="list-box categories_list font-rale">
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
        </div>