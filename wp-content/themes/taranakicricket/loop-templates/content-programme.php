<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/23/2023
 * Time: 12:13 PM
 */
global $post;
$programme = new Programme($post->ID);
$category = $programme->getCategory();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <div class="col-12">
            <div class="page-title">
                <h1><?=$programme->getTitle()?></h1>
                <?=do_shortcode('[breadcrumb]')?>
            </div>
        </div>
        <div class="col-12">
            <?php
            the_content();
            ?>
        </div>
        <div class="col-12">
            <a href="<?=$category->slug()?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;Back</a>
        </div>
    </div>
</article>