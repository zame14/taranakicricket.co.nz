<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/5/2022
 * Time: 8:03 PM
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
    <div class="wrapper" id="page-wrapper">
        <div id="content" class="container">
            <div class="row">
                <div class="col-12">
                    <main class="site-main" id="main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?=get_template_part('loop-templates/content', 'programme')?>
                    <?php endwhile; // end of the loop. ?>
                    </main>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();