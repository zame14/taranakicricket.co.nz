<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $post;
$blog = new Blog($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h1><?=$blog->getTitle()?></h1>
                    <?=do_shortcode('[breadcrumb]')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-date-wrapper">
                    <span class="fa fa-clock-o"></span> <?=$blog->getPostDate()?>
                </div>
            </div>
            <div class="col-12">
                <?php
                the_content();
                ?>
            </div>
        </div>
    </div>
</article>