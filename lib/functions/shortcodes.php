<?php
// Use shortcodes in widgets
add_filter('widget_text', 'do_shortcode');
function bookitme_appointments($atts, $content = null) {
    extract(shortcode_atts(array(
                'width' => '',
                'height' => '',
                'url' => '',
                    ), $atts));

//Set default values when not came in from shortcode     
    $lod = get_option('bookitme_appointment_options');
    if (!$width)
        $width = $lod['inp_calendar_width'];
    if (!$height)
        $height = $lod['inp_calendar_height'];
    if (!$url)
        $url = $lod['inp_calendar_url'];
    $output['calendar'] = '<iframe src="' . $url . '" width="' . $width . '" height="' . $height . '" frameborder="0" align="baseline" scrolling="yes" name="booking-appointments"></iframe>';    
    return $output['calendar'];
}
add_shortcode('bookitme_appointments', 'bookitme_appointments');
?>