<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="wrapper" id="page-wrapper">
    <div id="content" class="container">
        <div class="row">
            <div class="col-12">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'loop-templates/content', 'single' ); ?>
                            <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>
                        <?php endwhile; // end of the loop. ?>
                    </main>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- #content -->
    <div class="container-fluid">
        <div class="row blog-navigation">
            <div class="col-12">
                <ul class="plain">
                    <li><a href="<?=get_page_link(2560)?>" class="listing"><span class="fa fa-th"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
