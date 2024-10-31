<?php
function ova_elems_shortcode_handler($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'id' => '', // Default to empty, meaning no default slider ID
    ), $atts, 'ova_elems');

    // Validate the ID
    $post_id = intval($atts['id']);
    if (!$post_id) {
        return 'Invalid Slider ID.';
    }

    // Get the slider post
    $post = get_post($post_id);
    if (!$post || $post->post_type != 'ova_elems') {
        return 'Slider not found.';
    }

    // Retrieve existing data
    $slides = get_post_meta($post_id, '_ova_elems_slides', true);
    $slides = $slides ? maybe_unserialize($slides) : array();

    $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);

    // Retrieve existing data for static settings
    $static_settings = get_post_meta($post_id, '_ova_elems_static_settings', true);
    $static_settings = $static_settings ? maybe_unserialize($static_settings) : array();
    $corner_images = isset($static_settings['corner_images']) ? $static_settings['corner_images'] : array();

    // Start building the output
    ob_start();
    // Include the appropriate template file
    switch ($template_id) {
        case 1:
            include plugin_dir_path(__FILE__) . 'slider-shortcode-template1.php';
            break;
        case 2:
            include plugin_dir_path(__FILE__) . 'slider-shortcode-template2.php';
            break;
        case 3:
            include plugin_dir_path(__FILE__) . 'slider-shortcode-template3.php';
            break;
        case 4:
            include plugin_dir_path(__FILE__) . 'slider-shortcode-template4.php';
            break;
        case 5:
            include plugin_dir_path(__FILE__) . 'slider-shortcode-template5.php';
            break;
        default:
            return 'Template not found.';
    }
    return ob_get_clean();
}