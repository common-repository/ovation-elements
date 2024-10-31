<?php

add_action('wp_ajax_ova_elems_get_posts_for_slider', 'ova_elems_get_posts_for_slider');
add_action('wp_ajax_nopriv_ova_elems_get_posts_for_slider', 'ova_elems_get_posts_for_slider');

function ova_elems_get_posts_for_slider() {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );
    $posts = get_posts($args);

    $options = '';
    foreach ($posts as $post) {
        $options .= sprintf(
            '<option value="%d">%s</option>',
            esc_attr($post->ID),
            esc_html($post->post_title)
        );
    }

    echo wp_kses($options, array(
        'option' => array(
            'value' => array()
        )
    ));
    
    
    wp_die(); 
}


function ova_elems_get_categories() {

    $url = OVA_ELEMS_LICENSE_ENDPOINT . 'getCollections';
    $data = [];
    $args = [
        'method'    => 'POST',
        'body'      => json_encode($data),
        'headers'   => [
            'Content-Type' => 'application/json',
        ]
    ];
    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        echo json_encode(array(
            'status'    => false,
            'code'      => 100,
            'data'      => array(),
            'msg'       => $response->get_error_message()
        ));
        exit;
    } else {
        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);

        echo json_encode(array(
            'status'    => true,
            'code'      => 200,
            'data'      => isset($data['data']) ? $data['data'] : array(),
            'msg'       => 'Collections data retrieved'
        ));
        exit;
    }
}
add_action('wp_ajax_ova_elems_get_categories', 'ova_elems_get_categories');
add_action('wp_ajax_nopriv_ova_elems_get_categories', 'ova_elems_get_categories');

function ova_elems_get_templates() {

    $url = OVA_ELEMS_LICENSE_ENDPOINT . 'getFilteredProducts';

    $handle = isset($_POST['handle']) ? $_POST['handle'] : '';
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $cursor = isset($_POST['cursor']) ? $_POST['cursor'] : null;

    $data = [
        "collectionHandle" => $handle,
        "productHandle" => $search,
        "paginationParams" => [
            "first" => 9,
            "afterCursor" => $cursor,
            "beforeCursor" => null,
            "reverse" => true
        ]
    ];

    $args = [
        'method'    => 'POST',
        'body'      => json_encode($data),
        'headers'   => [
            'Content-Type' => 'application/json',
        ]
    ];

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        echo json_encode(array(
            'status'    => false,
            'code'      => 100,
            'data'      => array(),
            'msg'       => $response->get_error_message()
        ));
        exit;
    } else {

        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);

        echo json_encode(array(
            'status'    => true,
            'code'      => 200,
            'data'      => isset($data['data']) ? $data['data'] : array(),
            'msg'       => 'Templates data retrieved'
        ));
        exit;
    }
}
add_action('wp_ajax_ova_elems_get_templates', 'ova_elems_get_templates');
add_action('wp_ajax_nopriv_ova_elems_get_templates', 'ova_elems_get_templates');