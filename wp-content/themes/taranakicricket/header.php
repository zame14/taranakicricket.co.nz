<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=PT+Sans:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="site" id="page">
    <section id="top-bar"></section>
    <section id="header">
        <a name="top"></a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 nopadding">
                    <a href="<?=get_home_url()?>" class="m-logo"><img src="<?=get_stylesheet_directory_uri()?>/images/logo.png" alt="Taranaki Cricket Association" /></a>
                    <div id="tca-menu-wrapper">
                        <div class="main-nav wrapper-fluid wrapper-navbar" id="wrapper-navbar">
                            <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                        'menu_class' => 'nav navbar-nav',
                                        'fallback_cb' => '',
                                        'menu_id' => 'main-menu'
                                    )
                                );
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>