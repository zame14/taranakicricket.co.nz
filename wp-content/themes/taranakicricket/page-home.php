<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
?>
    <div class="wrapper" id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 nopadding">
                    <div class="home-banner-wrapper">
                        <?=get_the_post_thumbnail($post->ID, 'full')?>
                        <div class="title-wrapper">
                            <h1>Taranaki <span>Cricket</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="container">
            <div class="row">
                <div class="col-12">
                    <main class="site-main" id="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
            </div><!-- .row -->
        </div><!-- #content -->
    </div><!-- #page-wrapper -->
    <section class="locations">
        <div class="container">
            <div class="row">
                <div class="col-12 center-heading">
                    <h2>Contact TCA</h2>
                </div>
            </div>
            <?= do_shortcode('[locations]') ?>
        </div>
    </section>
<?php get_footer(); ?>