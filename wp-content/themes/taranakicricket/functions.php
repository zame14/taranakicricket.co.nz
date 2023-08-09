<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Sponsor.php');
require_once('modal/class.Location.php');
require_once('modal/class.Setting.php');
require_once('modal/class.Newsletter.php');
require_once('modal/class.Competition.php');
require_once('modal/class.Player.php');
require_once('modal/class.Club.php');
require_once('modal/class.Record.php');
require_once('modal/class.Programme.php');
require_once('modal/class.Blog.php');
require_once('modal/class.Category.php');
require_once('modal/class.WPAjax.php');
require_once(STYLESHEETPATH . '/includes/WPBakeryHook.php');
loadVCTemplates();
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    //wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
//add_filter( 'vc_load_default_templates', 'p_vc_load_default_templates' ); // Hook in
function p_vc_load_default_template( $data ) {
    return array();
}
add_action('init', 'tca_register_menus');
function tca_register_menus() {
    register_nav_menus(
        Array(
            'tca-menu' => __('TCA Menu'),
            'fixtures-menu' => __('Fixtures Menu'),
            'rep-menu' => __('Rep Menu'),
        )
    );
}
add_image_size( 'feature', 300, 270, true);
add_image_size( 'profile', 600, 800, true);
add_image_size( 'logo', 300, 300, true);
add_image_size( 'action', 575);
add_image_size( 'grid', 600, 400, true);
add_image_size( 'news', 600, 450, true);
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;
}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'cancellation', // Option ID
        'Default no cancellations msg', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'cancellation' // Should match Option ID
        )
    );
    add_settings_field( // Option 1
        'mobile', // Option ID
        'Mobile Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'mobile' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'facebook', // Option ID
        'Facebook Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'facebook' // Should match Option ID
        )
    );
    add_settings_field( // Option 2
        'insta', // Option ID
        'Instagram', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'insta' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','cancellation', 'esc_attr');
    register_setting('general','facebook', 'esc_attr');
    register_setting('general','insta', 'esc_attr');
    //register_setting('general','phone2', 'esc_attr');
    //register_setting('general','mobile', 'esc_attr');
    //register_setting('general','email', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}
function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}
function template_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Cancellations Widget', 'understrap' ),
        'id'            => 'cancellationswidget',
        'description'   => 'Area for cancellation message',
        'before_widget'  => '<div class="cancellations-message">',
        'after_widget'   => '</div><!-- .footer-widget -->',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>',
    ) );
}
function getSponsors() {
    $sponsors = Array();
    $posts_array = get_posts([
        'post_type' => 'sponsor',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $sponsor = new Sponsor($post);
        $sponsors[] = $sponsor;
    }
    return $sponsors;
}
function sponsors_shortcode()
{
    $html = '
    <div class="sponsor-wrapper inner-wrapper">
        <div class="sponsor">';
        foreach(getSponsors() as $sponsor) {
            if($sponsor->getLink() <> "") {
                $html .= '<div><a href="' . $sponsor->getLink() . '" target="_blank">' . $sponsor->output() . '</a></div>';
            } else {
                $html .= '<div>' . $sponsor->output() . '</div>';
            }
        }
        $html .= '
        </div>
    </div>';
    return $html;
}
add_shortcode('sponsors', 'sponsors_shortcode');

function getLocations() {
    $locations = Array();
    $posts_array = get_posts([
        'post_type' => 'location',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $location = new Location($post);
        $locations[] = $location;
    }
    return $locations;
}
function locations_shortcode()
{
    $html = '
    <div class="row row-eq-height justify-content-center">';
    foreach(getLocations() as $location)
    {
        $html .= '
        <div class="col-12 col-md-4 outer-wrapper">
            <div class="location-wrapper">
                <div class="map-wrapper">
                    <iframe src="' . $location->getMap() . '" width="767" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="inner-wrapper">
                    <strong>
                        ' . $location->getTitle() . '
                    </strong>
                    ' . $location->getContent() . '
                </div>
            </div>
        </div>';
    }
    $html .= '
    </div>';
    return $html;
}
add_shortcode('locations', 'locations_shortcode');
function hideGoogleMaps() {
    global $post;
    $setting = new Setting($post->ID);
    if($setting->hideGoogleMaps() == 1) {
        return true;
    } else {
        return false;
    }
}
function breadcrumb_shortcode() {
    global $post;
    $this_page = get_the_title($post->ID);
    $cate = get_queried_object();
    if(isset($cate->term_id)) {
        $this_page = $cate->name;
    }
    $parent = get_menu_parent( 2 );
    $post_type = get_post_type($post->ID);
    $html = '
    <div class="breadcrumb">
        <ul>
            <li><a href="' . get_page_link(4) . '">Home</a></li>';
            if($parent) {
                $html .= '<li><a href="javascript:;">' . $parent->post_title . '</a></li>';
            }
            if($post_type == "post") {
                $html .= '<li><a href="' . get_page_link(2560) . '">Latest News</a></li>';
            }
            if(isset($cate->term_id)) {
                $html .= '<li><a href="javascript:;">Register</a></li>';
            } else {
                if($post_type == "programme") {
                    $programme = new Programme($post->ID);
                    $category = $programme->getCategory();
                    $html .= '<li><a href="' . $category->slug() . '">' . $category->getTitle() . '</a></li>';
                }
            }
            $html .= '
            <li>' . $this_page . '</li>
        </ul>
    </div>';

    return $html;
}
add_shortcode('breadcrumb', 'breadcrumb_shortcode');
function get_menu_parent( $menu ) {
    global $post;
    $post_id        = $post->ID;
    $menu_items     = wp_get_nav_menu_items( $menu );
    $parent_item_id = wp_filter_object_list( $menu_items, array( 'object_id' => $post_id ), 'and', 'menu_item_parent' );

    if ( ! empty( $parent_item_id ) ) {
        $parent_item_id = array_shift( $parent_item_id );
        $parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );

        if ( ! empty( $parent_post_id ) ) {
            $parent_post_id = array_shift( $parent_post_id );

            return get_post( $parent_post_id );
        }
    }

    return false;
}
function getNewsletters() {
    $newsletters = Array();
    $posts_array = get_posts([
        'post_type' => 'newsletter',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'DESC'
    ]);
    foreach ($posts_array as $post) {
        $newsletter = new Newsletter($post);
        $newsletters[] = $newsletter;
    }
    return $newsletters;
}
function newsletters_shortcode() {
    $newsletters = getNewsletters();
    $html = '<ul class="newsletters">';
    foreach($newsletters as $newsletter) {
        $html .= '<li><a href="' . $newsletter->getNewsletter() . '" target="_blank">' . $newsletter->getTitle() . '</a></li>';
    }
    $html .= '</ul>';

    return $html;
}
add_shortcode('newsletters', 'newsletters_shortcode');
function getPlayers($post_type) {
    $players = Array();
    $posts_array = get_posts([
        'post_type' => "' . $post_type . '",
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $naki = new Player($post);
        $players[] = $naki;
    }
    return $players;
}
function mens_shortcode()
{
    $html = '
    <div class="row justify-content-center">';
    foreach (getPlayers('taranaki-men') as $men)
    {
        $imageid = getImageID($men->getProfileImage());
        $img = wp_get_attachment_image_src($imageid, 'profile');
        $html .= '
        <div class="col-12 col-sm col-md-4 col-lg-3 player-profile">
            <a href="' . $men->link() . '">
                <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $men->getTitle() . '" />
                </div>
                <div class="content-wrapper">
                    <div class="title">
                        ' . $men->getTitle() . '
                    </div>
                    <div class="playing-role">
                        ' . $men->getRole() . '
                    </div>                    
                </div>
            </a>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('taranaki_men', 'mens_shortcode');

function womens_shortcode()
{
    $html = '
    <div class="row justify-content-center">';
    foreach (getPlayers('taranaki-women') as $women)
    {
        $imageid = getImageID($women->getProfileImage());
        $img = wp_get_attachment_image_src($imageid, 'profile');
        $html .= '
        <div class="col-12 col-sm col-md-4 col-lg-3 player-profile">
            <a href="' . $women->link() . '">
                <div class="image-wrapper">
                    <img src="' . $img[0] . '" alt="' . $women->getTitle() . '" />
                </div>
                <div class="content-wrapper">
                    <div class="title">
                        ' . $women->getTitle() . '
                    </div>
                    <div class="playing-role">
                        ' . $women->getRole() . '
                    </div>                    
                </div>
            </a>
        </div>';
    }
    $html .= '
    </div>';

    return $html;
}
add_shortcode('taranaki_women', 'womens_shortcode');
function socialMedia() {
    $html = '
    <ul class="social-media">
        <li><a href="' . get_option('facebook') . '" target="_blank"><span class="fa fa-facebook-square"></span></a></li>';
        if(get_option('insta') <> "")
        {
            $html .= '<li><a href="' . get_option('insta') . '" target="_blank"><span class="fa fa-instagram"></span></a></li>';
        }
        $html .= '
    </ul>';

    return $html;
}
function getClubs() {
    $clubs = Array();
    $posts_array = get_posts([
        'post_type' => 'club',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $club = new Club($post);
        $clubs[] = $club;
    }
    return $clubs;
}
function getHonours() {
    $records = Array();
    $posts_array = get_posts([
        'post_type' => 'record',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'DESC'
    ]);
    foreach ($posts_array as $post) {
        $record = new Record($post);
        $records[] = $record;
    }
    return $records;
}
function getHonoursByType($type) {
    $records = Array();
    $posts_array = get_posts([
        'post_type' => 'record',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'wpcf-honours-type',
                'value' => $type
            ]
        ],
    ]);
    foreach ($posts_array as $post) {
        $record = new Record($post);
        $records[] = $record;
    }
    return $records;
}
add_action('cred_submit_complete', 'my_success_action',10,2);
function my_success_action($post_id, $form_data)
{
    if ($form_data['id']==504) {

        $new_title = $_POST['wpcf-player'] . ' vs ' . $_POST['wpcf-opponent'];
        //collect data and define new title
        $my_post = array(
            'ID'               => $post_id,
            'post_title'=> $new_title
        );
        // Update the post into the database
        wp_update_post( $my_post );
    }

}
function getHonoursBoard_shortcode()
{
    $html = '
    <div class="honours-wrapper">
        <div class="form-group search-wrapper">
            <label>Search</label>
            <input type="text" class="search form-control" placeholder="What player are you looking for?" />
            <div class="filter-wrapper">
                <label>Filter by</label>
                <ul>
                    <li><a href="javascript:;" onclick="filterRecords(1)" class="filter-bat">batting</a></li>
                    <li><a href="javascript:;" onclick="filterRecords(2)" class="filter-bowl">bowling</a></li>
                    <li><a href="' . get_page_link(492) . '" class="reset">reset</a></li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped results">
                <thead>
                <tr>
                    <th scope="col">Year</th>
                    <th scope="col">Player</th>
                    <th scope="col">Performance</th>
                    <th scope="col">VS</th>
                    <th scope="col">Scorecard</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="5"><i class="fa fa-warning"></i> No player found</td>
                </tr>                
                </thead>
                <tbody>';
                foreach (getHonours() as $record)
                {
                    $html .= '
                    <tr>
                        <td>' . $record->getYear() . '</td>
                        <td>' . $record->getPlayer() . '</td>
                        <td>' . $record->getPerformance() . '</td>
                        <td>' . $record->getOpponent() . '</td>
                        <td>' . $record->getScorecard() . '</td>
                    </tr>';
                }
                $html .= '
                </tbody>
            </table>
        </div>
    </div>';

    return $html;
}
add_shortcode('honours-board', 'getHonoursBoard_shortcode');
function getProductByCategory($term_id)
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'programme',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'programme-category',
                'field' => 'term_id',
                'terms' => $term_id
            )
        )
    ]);
    foreach ($posts_array as $post) {
        $programme = new Programme($post);
        $arr[] = $programme;
    }
    return $arr;
}
function getBlogs($limit)
{
    $blogs = Array();
    $posts_array = get_posts([
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => $limit,
        'orderby' => 'post_date',
        'order' => 'DESC'
    ]);
    foreach ($posts_array as $post) {
        $Blog = new Blog($post);
        $blogs[] = $Blog;
    }
    return $blogs;
}
function newsFeed_shortcode()
{
    global $post;
    $html = '';
    $html = '<div class="news-feed-wrapper">';
    foreach (getBlogs(3) as $blog) {
        $html .= '<div class="inner-wrapper">
            <div class="image-wrapper">
                ' . $blog->getFeatureImage('news') . '
            </div>
            <div class="content-wrapper">
                <div class="date-wrapper">
                    <span class="fa fa-clock-o"></span> ' . $blog->getPostDate() . '
                </div>
                <h3>' . $blog->getTitle() . '</h3>
                <div class="snippet">
                    ' . $blog->getCustomField('post-snippet') . '
                </div>
                <a href="' . $blog->link() . '">read more</a>
            </div>
        </div>';
    }
    $html .= '
    </div>
    <div class="m-see-all">
        <a href="' . get_page_link(2560) . '" class="btn btn-primary">see all</a>
    </div>';
    return $html;
}
add_shortcode('news_feed','newsFeed_shortcode');
function latestNews_shortcode()
{
    $html = '<div class="row justify-content-center row-eq-height">';
    foreach (getBlogs(-1) as $blog) {
        $html .= '<div class="col-12 col-sm-6 col-lg-4 blog-panel">
            <div class="inner-wrapper">
                <div class="image-wrapper">
                    ' . $blog->getFeatureImage('news') . '
                </div>
                <div class="content-wrapper">
                    <div class="date-wrapper">
                        <span class="fa fa-clock-o"></span> ' . $blog->getPostDate() . '
                    </div>
                    <h3>' . $blog->getTitle() . '</h3>
                    <div class="snippet">
                        ' . $blog->getCustomField('post-snippet') . '
                    </div>
                </div>
                <div class="btn-wrapper">
                    <a href="' . $blog->link() . '">read more</a>
                </div>
            </div>
        </div>';
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('latest_news','latestNews_shortcode');
function programmesMenu_shortcode() {
    $html = '';
    $arr = get_terms( array(
        'taxonomy' => 'programme-category',
        'hide_empty' => false,
        'parent' => 0
    ) );
    foreach($arr as $object) {
        $category = new Category($object->term_id);
        $slug = $category->slug() . '/';
        $html .= '
        <li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page">
            <a href="' . $slug . '" class="mega-menu-link">' . $category->getTitle() . '</a>
        </li>';
    }
    return $html;
}
add_shortcode('programme_menu', 'programmesMenu_shortcode');

function hide_meta_box_attributes( $hidden, $screen) {

    $hidden[] = 'wpassetcleanup_asset_list';
    return $hidden;

}
add_filter('hidden_meta_boxes', 'hide_meta_box_attributes', 10, 2);
add_filter( 'get_user_option_meta-box-order_page', 'metabox_order' );
function metabox_order( $order ) {
    return array(
        'normal' => join(
            ",",
            array(       // vvv  Arrange here as you desire
                'wpb_visual_composer',
                'wpcf-group-custom-page-fields',
                'wpseo_meta',
                'pa-single-admin-analytics',
            )
        ),
    );
}
/**************** Ajax **************************/
add_action('wp_head', function() {
    echo '<script type="text/javascript">
       var ajaxurl = "' . admin_url('admin-ajax.php') . '";
     </script>';
});
add_action('wp_ajax_ajax', function() {
    $WPAjax = new WPAjax($_GET['call']);
});
add_action('wp_ajax_nopriv_ajax', function() {
    $WPAjax = new WPAjax($_GET['call']);
});