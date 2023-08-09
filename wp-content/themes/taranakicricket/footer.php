<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<a class="top">
    <span class="fa fa-chevron-up"></span>
</a>
<section class="sponsors-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 nopadding">
                <h2>Thank you to our sponsors</h2>
                <p>If you are interested in becoming a sponsor, call Ryan - <a href="tel:<?=formatPhoneNumber(get_option('phone'))?>"><?=get_option('phone')?></a></p>
                <?=do_shortcode('[sponsors]')?>
            </div>
        </div>
    </div>
</section>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 footer-col-1">
                <h3>Taranaki Cricket</h3>
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'tca-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'fallback_cb'     => '',
                        'menu_id'         => 'tca-menu',
                    )
                ); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 footer-col-2">
                <h3>Fixtures & Results</h3>
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'fixtures-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'fallback_cb'     => '',
                        'menu_id'         => 'fixtures-menu',
                    )
                ); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 footer-col-3">
                <h3>Representative</h3>
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'rep-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'fallback_cb'     => '',
                        'menu_id'         => 'rep-menu',
                    )
                ); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 footer-col-4">
                <h3>Join Our Newsletter</h3>
                <!-- Begin Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://taranakicricket.us14.list-manage.com/subscribe/post?u=4d9dec7d9186252f74fd4dc78&amp;id=53cde6c8ce" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">

                            <div class="mc-field-group">
                                <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="email">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4d9dec7d9186252f74fd4dc78_53cde6c8ce" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Sign up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>
                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                <!--End mc_embed_signup-->
                <?=socialMedia()?>
            </div>
        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="col-12">
            &copy; Copyright <?=date('Y')?> <?=get_bloginfo('name')?> <i>-</i> <span>Custom website by <a href="https://www.azwebsolutions.co.nz/" target="_blank">A-Z Web Solutions Ltd</a></span>
        </div>
        <div class="col-12">
            <a href="<?=get_page_link(392)?>" class="sitemap">Sitemap</a>
        </div>
    </div>
</section>
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?=get_stylesheet_directory_uri()?>/includes/slick-carousel/slick/slick.js"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/noframework.waypoints.min.js" type="text/javascript"></script>
<script src="<?=get_stylesheet_directory_uri()?>/js/theme.js" type="text/javascript"></script>
</body>
</html>

