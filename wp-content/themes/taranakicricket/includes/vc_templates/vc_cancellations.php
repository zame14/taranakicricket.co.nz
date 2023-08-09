<?php
vc_map( array(
    "name" => __("Cancellations"),
    "base" => "cancellations",
    "category" => __('Content'),
    'icon' => '',
    'description' => 'Add a cancellation message',
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Cancellation Message"),
            "param_name" => "message",
        )
    )
));
add_shortcode( 'cancellations', 'cancellations_shortcode' );
function cancellations_shortcode($atts) {
    date_default_timezone_set('Pacific/Auckland');
    $args = shortcode_atts( array(
        'message' => ''
    ), $atts);
    if($args['message'])
    {
        // cancellation message, must be raining
        $msg = $args['message'];
        $class = "rain";
    } else {
        // must be sunny
        $msg =  get_option('cancellation');
        $class = "sun";
    }
    $html = '
    <section class="cancellations-wrapper">
        <div class="row">
            <div class="col-12">
                <h2>Cancellations</h2>
            </div>
            <div class="col-12">
                <div class="inner-wrapper ' . $class . '">
                    <p>' . $msg . '</p>
                    <div class="date">last updated: ' . date('d/m/y') . '</div>
                </div>
            </div>
        </div>   
    </section>';

    return $html;
}