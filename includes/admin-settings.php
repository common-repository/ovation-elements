<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register Post Type
function ova_elems_post_type()
{
    $labels = array(
        'name' => 'Sliders',
        'singular_name' => 'Slider',
        'menu_name' => 'Sliders',
        'name_admin_bar' => 'Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Slider',
        'new_item' => 'New Slider',
        'edit_item' => 'Edit Slider',
        'view_item' => 'View Slider',
        'all_items' => 'All Sliders',
        'search_items' => 'Search Sliders',
        'not_found' => 'No sliders found.',
        'not_found_in_trash' => 'No sliders found in Trash.',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'ova_elems'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title', 'editor'), // Only title and editor are used
    );
    register_post_type('ova_elems', $args);
}
add_action('init', 'ova_elems_post_type');

// Add Meta Box
function ova_elems_add_meta_boxes()
{
    add_meta_box(
        'ova_elems_settings',
        'Slider Settings',
        'ova_elems_meta_box_callback',
        'ova_elems',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ova_elems_add_meta_boxes');


// Add Edit Template Page
function ova_elems_add_edit_page()
{
    add_submenu_page(
        '',
        'Edit Slider Template',
        'Edit Slider Template',
        'manage_options',
        'edit_slider_template',
        'ova_elems_edit_slider_template_page'
    );
}
add_action('admin_menu', 'ova_elems_add_edit_page');


//i add 
// Redirect to Select Template Page for Add New

function ova_elems_redirect_add_new()
{
    global $pagenow;
    if ($pagenow == 'post-new.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'ova_elems') {
        wp_redirect(admin_url('edit.php?post_type=ova_elems&page=select-template'));
        exit;
    }
}
add_action('admin_init', 'ova_elems_redirect_add_new');

// added new menue 

function ova_elems_slider_add_menu_pages()
{


    add_menu_page(
        'Ovation Elements',
        'Ovation Elements',
        'manage_options',
        'ovation_elements',
        'ova_elems_slider_dashboard_page', // Dashboard callback function
        'dashicons-admin-multisite',
        6 // Position in the menu
    );
    add_submenu_page(
        'ovation_elements',
        'Select Template',
        'Select Template',
        'manage_options',
        'select-template',
        'ova_elems_slider_select_template_page'
    );


    add_submenu_page(
        'ovation_elements',
        'All Sliders',
        'All Sliders',
        'manage_options',
        'edit.php?post_type=ova_elems',
        ''
    );



    add_submenu_page(
        'edit.php?post_type=ova_elems',
        'Select Template',
        'Select Template',
        'manage_options',
        'select-template',
        'ova_elems_slider_select_template_page'
    );

    // Add different edit pages for each template
    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 1',
        'Edit Slider Template 1',
        'manage_options',
        'edit-slider-template-template1',
        'ova_elems_edit_page_template1'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 2',
        'Edit Slider Template 2',
        'manage_options',
        'edit-slider-template-template2',
        'ova_elems_edit_page_template2'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 3',
        'Edit Slider Template 3',
        'manage_options',
        'edit-slider-template-template3',
        'ova_elems_edit_page_template3'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 4',
        'Edit Slider Template 4',
        'manage_options',
        'edit-slider-template-template4',
        'ova_elems_edit_page_template4'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 5',
        'Edit Slider Template 5',
        'manage_options',
        'edit-slider-template-template5',
        'ova_elems_edit_page_template5'
    );


}
add_action('admin_menu', 'ova_elems_slider_add_menu_pages');


// hide notice n ads
function ova_elems_hide_admin_notices() {
    $screen = get_current_screen();
    $ova_plugin_pages = [
        'ovation_elements',
        'select-template',
        'edit-slider-template-template1',
        'edit-slider-template-template2',
        'edit-slider-template-template3',
        'edit-slider-template-template4',
        'edit-slider-template-template5',
    ];

    foreach ($ova_plugin_pages as $ova_page) {
        if (strpos($screen->id, $ova_page) !== false) {
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
            break;
        }
    }
}
add_action('admin_head', 'ova_elems_hide_admin_notices');


//add for dashboard page 
function ova_elems_slider_dashboard_page() { 
    ?>
     <div class="outer-container">
     <div class="ov-plugin-top" id="ov-top">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="227" height="72"
                viewBox="0 0 227 72">
                <defs>
                    <clipPath id="clip-path">
                        <rect id="Rectangle_191" data-name="Rectangle 191" width="61.162" height="59.822" fill="none" />
                    </clipPath>
                </defs>
                <g id="Group_28" data-name="Group 28" transform="translate(-199 -74)">
                    <g id="Group_14" data-name="Group 14" transform="translate(199 82.219)">
                        <g id="Group_13" data-name="Group 13" clip-path="url(#clip-path)">
                            <path id="Path_42" data-name="Path 42"
                                d="M120.213,0H105.239a6.554,6.554,0,0,0-6.545,6.548V29.911a6.553,6.553,0,0,0,6.545,6.545H120.19a6.553,6.553,0,0,0,6.545-6.545V8.441Zm1.851,29.911a1.873,1.873,0,0,1-1.873,1.87H105.239a1.871,1.871,0,0,1-1.87-1.87V6.548a1.873,1.873,0,0,1,1.87-1.873h13.626V7.143a1.243,1.243,0,0,0,1.172,1.3h2.026Z"
                                transform="translate(-66.652)" fill="#0023c4" />
                            <path id="Path_43" data-name="Path 43"
                                d="M14.208,115.5V96.339a4.208,4.208,0,0,1,4.208-4.208h-7.01A4.208,4.208,0,0,0,7.2,96.339V115.5a4.208,4.208,0,0,0,4.208,4.208h7.01a4.208,4.208,0,0,1-4.208-4.208"
                                transform="translate(-4.861 -62.22)" fill="#cee1f2" />
                            <path id="Path_44" data-name="Path 44"
                                d="M6.545,19.727H21.029c3.609,0,6.545-2.478,6.545-5.525V5.526C27.574,2.479,24.638,0,21.029,0H6.545C2.936,0,0,2.479,0,5.526V14.2c0,3.047,2.936,5.525,6.545,5.525M4.674,5.526a1.747,1.747,0,0,1,1.872-1.58H21.029A1.747,1.747,0,0,1,22.9,5.526V14.2a1.746,1.746,0,0,1-1.872,1.58H6.545A1.746,1.746,0,0,1,4.674,14.2Z"
                                transform="translate(0 -0.001)" fill="#0023c4" />
                            <path id="Path_45" data-name="Path 45"
                                d="M6.545,117.181H21.029a6.553,6.553,0,0,0,6.545-6.545V91.478a6.553,6.553,0,0,0-6.545-6.545H6.545A6.553,6.553,0,0,0,0,91.478v19.158a6.553,6.553,0,0,0,6.545,6.545m-1.872-25.7a1.874,1.874,0,0,1,1.872-1.872H21.029A1.874,1.874,0,0,1,22.9,91.478v19.158a1.874,1.874,0,0,1-1.872,1.872H6.545a1.874,1.874,0,0,1-1.872-1.872Z"
                                transform="translate(0 -57.359)" fill="#0023c4" />
                            <path id="Path_46" data-name="Path 46"
                                d="M41.509,69.206a1.868,1.868,0,1,1-1.868-1.868,1.868,1.868,0,0,1,1.868,1.868"
                                transform="translate(-25.51 -45.476)" fill="#0023c4" />
                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="1.529" cy="1.529" r="1.529"
                                transform="translate(6.21 22.201)" fill="none" stroke="#0023c4" stroke-width="2" />
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="1.529" cy="1.529" r="1.529"
                                transform="translate(18.995 22.201)" fill="none" stroke="#0023c4" stroke-width="2" />
                            <path id="Path_47" data-name="Path 47"
                                d="M121.567,142.655a1.826,1.826,0,0,0-1.946,1.676v.876a2.01,2.01,0,0,1-1.825,2.152H101.579a2.01,2.01,0,0,1-1.825-2.152v-5.1a2.011,2.011,0,0,1,1.825-2.155h4.352a1.694,1.694,0,1,0,0-3.351H100.5c-2.669,0-4.834,2.56-4.834,5.719v4.676c0,3.158,2.165,5.718,4.834,5.718h18.373c2.669,0,4.834-2.56,4.834-5.718v-.661a1.826,1.826,0,0,0-1.946-1.676Z"
                                transform="translate(-64.608 -90.899)" fill="#ff5cf4" />
                            <path id="Path_48" data-name="Path 48"
                                d="M154.746,122.715l-5.808-6.031a.67.67,0,0,0-1.152.465v2.9h-.223a8.721,8.721,0,0,0-8.711,8.711v1.34a.661.661,0,0,0,.522.641.585.585,0,0,0,.147.018.693.693,0,0,0,.612-.381,7.328,7.328,0,0,1,6.592-4.074h1.062v2.9a.67.67,0,0,0,1.152.465l5.808-6.031a.671.671,0,0,0,0-.93"
                                transform="translate(-93.772 -78.663)" fill="#ff5cf4" />
                            <path id="Path_49" data-name="Path 49"
                                d="M63.3,27.955l.755-.755-.755-.755a.12.12,0,0,1,.17-.17l.84.84a.12.12,0,0,1,0,.17l-.84.84a.12.12,0,0,1-.17-.17"
                                transform="translate(-42.724 -17.721)" fill="#ff5cf4" />
                            <path id="Path_50" data-name="Path 50"
                                d="M63.3,27.955l.755-.755-.755-.755a.12.12,0,0,1,.17-.17l.84.84a.12.12,0,0,1,0,.17l-.84.84a.12.12,0,0,1-.17-.17Z"
                                transform="translate(-42.724 -17.721)" fill="none" stroke="#ff5cf4" stroke-width="1" />
                            <path id="Path_51" data-name="Path 51"
                                d="M17.964,27.955a.12.12,0,0,1-.17.17l-.84-.84a.12.12,0,0,1,0-.17l.84-.84a.12.12,0,0,1,.17.17l-.755.755Z"
                                transform="translate(-11.427 -17.721)" fill="#ff5cf4" />
                            <path id="Path_52" data-name="Path 52"
                                d="M17.964,27.955a.12.12,0,0,1-.17.17l-.84-.84a.12.12,0,0,1,0-.17l.84-.84a.12.12,0,0,1,.17.17l-.755.755Z"
                                transform="translate(-11.427 -17.721)" fill="none" stroke="#ff5cf4" stroke-width="1" />
                        </g>
                    </g>
                    <text id="OVATION_ELEMENTS" data-name="OVATION
                            ELEMENTS" transform="translate(275 74)" fill="#0023c4" font-size="30" font-family="SegoeUI-Bold, Segoe UI"
                        font-weight="700">
                        <tspan x="0" y="32">OVATION</tspan>
                        <tspan x="0" y="64">ELEMENTS</tspan>
                    </text>
                </g>
            </svg>
            <a href="<?php echo esc_url('https://wordpress.org/support/plugin/ovation-elements/'); ?>" class="ov-header-review-btn" target="_blank" rel="noopener noreferrer">Review
                Now</a>
        </div>
     <!-- <div class="container mt-5"> -->
      <!-- Tabs Navigation -->
      <ul class="nav nav-tabs" id="ova_elems_ovationSliderTabs" role="tablist" style="background-image:url('<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/images/nav-background.png'); ?>');">

      <li class="nav-item">
                <a class="nav-link active" id="ova_elems_tab1-tab" data-toggle="tab" href="#ova_elems_tab1" role="tab" aria-controls="ova_elems_tab1" aria-selected="true">Dashboard</a>
            </li>
        <li class="nav-item">
          <a class="nav-link" id="ova_elems_tab2-tab" data-toggle="tab" href="#ova_elems_tab2" role="tab" aria-controls="ova_elems_tab2" aria-selected="false">Block Themes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ova_elems_tab3-tab" data-toggle="tab" href="#ova_elems_tab3" role="tab" aria-controls="ova_elems_tab3" aria-selected="false">Post Type</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ova_elems_tab4-tab" data-toggle="tab" href="#ova_elems_tab4" role="tab" aria-controls="ova_elems_tab4" aria-selected="false">Page Builder</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ova_elems_tab5-tab" data-toggle="tab" href="#ova_elems_tab5" role="tab" aria-controls="ova_elems_tab5" aria-selected="false">Sliders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ova_elems_tab6-tab" data-toggle="tab" href="#ova_elems_tab6" role="tab" aria-controls="ova_elems_tab6" aria-selected="false">Support</a>
        </li>
      </ul>
  
      <!-- Tabs Content -->
      <div class="tab-content" id="ova_elems_ovationSliderTabsContent">
        <div class="tab-pane fade show active" id="ova_elems_tab1" role="tabpanel" aria-labelledby="ova_elems_tab1-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab1.php'); ?>
        </div>
  
        <div class="tab-pane fade" id="ova_elems_tab2" role="tabpanel" aria-labelledby="ova_elems_tab2-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab5.php'); ?>
        </div>
  
        <div class="tab-pane fade" id="ova_elems_tab3" role="tabpanel" aria-labelledby="ova_elems_tab3-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab3.php'); ?>
        </div>
  
        <div class="tab-pane fade" id="ova_elems_tab4" role="tabpanel" aria-labelledby="ova_elems_tab4-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab4.php'); ?>
        </div>
  
        <div class="tab-pane fade" id="ova_elems_tab5" role="tabpanel" aria-labelledby="ova_elems_tab5-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab2.php'); ?>
        </div>
  
        <div class="tab-pane fade" id="ova_elems_tab6" role="tabpanel" aria-labelledby="ova_elems_tab6-tab">
          <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab6.php'); ?>
        </div>
      </div>
    </div>
    <?php
}

//end

//addded for tabs end 



// Handle Template Selection and Redirect to Edit Page
function ova_elems_handle_template_selection()
{
    if (!current_user_can('edit_posts')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'ovation-elements'));
    }

      // Verify nonce
  

    if (isset($_GET['template_id'])) {
        $template_id = absint($_GET['template_id']);

        // Create a new post of type 'ova_elems'
        $post_id = wp_insert_post(
            array(
                'post_title' => 'New Slider', // Default title, can be updated later
                'post_type' => 'ova_elems',
                'post_status' => 'publish',
            )
        );

        // Save the template ID as post meta
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_ova_elems_template_id', $template_id);

            // Redirect to  edit page
            wp_redirect(admin_url('edit.php?post_type=ova_elems&page=edit_slider_template&post=' . $post_id));
            exit;
        }
    }

    wp_redirect(admin_url('edit.php?post_type=ova_elems&page=select-template'));
    exit;
}
add_action('admin_post_select_template', 'ova_elems_handle_template_selection');


// Add columns to the post list
function ova_elems_add_custom_columns($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key == 'title') {
            $new_columns['custom_template'] = 'Template';
            $new_columns['shortcode'] = 'Shortcode'; // Adding new column for shortcode
        }
    }
    return $new_columns;
}
add_filter('manage_ova_elems_posts_columns', 'ova_elems_add_custom_columns');

// Populate custom columns with data
function ova_elems_custom_column_data($column, $post_id)
{
    if ($column == 'custom_template') {
        $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
        echo $template_id ? 'Template ' . esc_html($template_id) : 'N/A';
    } elseif ($column == 'shortcode') {
        $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
        if ($template_id) {
            echo '[ova-elems-slider-template id="' . esc_attr($post_id) . '"]';
        } else {
            echo 'N/A';
        }
    }
}
add_action('manage_ova_elems_posts_custom_column', 'ova_elems_custom_column_data', 10, 2);


//end 



add_action('admin_menu', 'ova_elems_register_edit_page');
function ova_elems_register_edit_page()
{
    add_menu_page(
        'Edit Slider Template',
        //'Edit Slider',
        'manage_options',
        'edit-slider-template',
        'ova_elems_edit_page_callback'
    );
}

function ova_elems_edit_page_callback()
{
    // Include the edit page file
    include (plugin_dir_path(__FILE__) . 'templates/edit-slider-template.php');


}

//new one i add

function ova_elems_edit_page_template1()
{
    include (plugin_dir_path(__FILE__) . 'templates/edit-slider-template1.php');
}

function ova_elems_edit_page_template2()
{
    include (plugin_dir_path(__FILE__) . 'templates/edit-slider-template2.php');
}

function ova_elems_edit_page_template3()
{
    include (plugin_dir_path(__FILE__) . 'templates/edit-slider-template3.php');
}

function ova_elems_edit_page_template4()
{
    include (plugin_dir_path(__FILE__) . 'templates/edit-slider-template4.php');
}

function ova_elems_edit_page_template5() {
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template5.php');
}

//end 

//new redirect_to_edit_link
add_action('admin_init', 'ova_elems_redirect_to_edit_page');
function ova_elems_redirect_to_edit_page()
{
    global $pagenow;
    if ($pagenow == 'post.php' && isset($_GET['post']) && get_post_type(absint($_GET['post'])) == 'ova_elems') {
        $post_id = intval($_GET['post']);
        $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
        switch ($template_id) {
            case 1:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template1&post=' . $post_id));
                break;
            case 2:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template2&post=' . $post_id));
                break;
            case 3:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template3&post=' . $post_id));
                break;
            case 4:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template4&post=' . $post_id));
                break;
            case 5:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template5&post=' . $post_id));
                break;
                default:
                wp_redirect(admin_url('admin.php?page=edit-slider-template&post=' . $post_id));
                break;
        }
        exit;
    }
}

//edit 

add_filter('post_row_actions', 'ova_elems_edit_link', 10, 2);
function ova_elems_edit_link($actions, $post)
{
    if ($post->post_type == 'ova_elems') {
        $template_id = get_post_meta($post->ID, '_ova_elems_template_id', true);
        switch ($template_id) {
            case 1:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template1&post=' . $post->ID);
                break;
            case 2:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template2&post=' . $post->ID);
                break;
            case 3:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template3&post=' . $post->ID);
                break;
            case 4:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template4&post=' . $post->ID);
                break;
            case 5:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template5&post=' . $post->ID);
                break;
                default:
                $edit_link = admin_url('admin.php?page=edit-slider-template&post=' . $post->ID);
                break;
        }
        $actions['edit'] = '<a href="' . esc_url($edit_link) . '">Edit</a>';
    }
    return $actions;
}
//end


// Template Selection Page
function ova_elems_slider_select_template_page()
{
    ?>
    <div class="wrap">
        <div class="heading-container">
            <div class="container-custom">
                <h1>Select a Template</h1>
            </div>
        </div>
        <div class="container-custom">
            <div class="row">
                <?php
                $templates = array(
                    array('id' => 1, 'title' => 'Business Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-1.png'),
                    array('id' => 2, 'title' => 'Travel Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-2.png'),
                    array('id' => 3, 'title' => 'Ecommerce Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-3.png'),
                    array('id' => 4, 'title' => 'News Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-4.png'),
                    array('id' => 5, 'title' => 'Food Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-5.png'),
                );
                foreach ($templates as $template) {
                    ?>
                    <div class="col-md-4 col-lg-4 col-12 mb-4">
                        <div class="slider-card" style="">
                            <div class="slider-image">
                                <img class="card-img-top" src="<?php echo esc_url($template['image']); ?>"
                                    alt="<?php echo esc_attr($template['title']); ?>">
                            </div>
                            <div class="heading-wrapper mt-2">
                                <h5 class="card-title"><?php echo esc_html($template['title']); ?></h5>
                                <a href="<?php echo esc_url(admin_url('admin-post.php?action=create_ova_elems&template_id=' . $template['id'])); ?>"
                                    class="btn btn-primary">Select Template</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

//new handle  slider 

function ova_elems_handle_create_slider()
{
    if (!current_user_can('edit_posts')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'ovation-elements'));
    }

    if (isset($_GET['template_id'])) {
        $template_id = absint($_GET['template_id']);

        // Create a new post of type 'ova_elems'
        $post_id = wp_insert_post(
            array(
                'post_title' => 'New Slider', // Default title, can be updated later
                'post_type' => 'ova_elems',
                'post_status' => 'publish',
            )
        );

        // Save the template ID as post meta
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_ova_elems_template_id', $template_id);

            // Redirect to the specific edit page based on template ID
            switch ($template_id) {
                case 1:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template1&post=' . $post_id));
                    break;
                case 2:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template2&post=' . $post_id));
                    break;
                case 3:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template3&post=' . $post_id));
                    break;
                case 4:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template4&post=' . $post_id));
                    break;
                case 5:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template5&post=' . $post_id));
                    break;
                default:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template&post=' . $post_id));
                    break;
            }
            exit;
        }
    }

    wp_redirect(admin_url('admin.php?page=select-template'));
    exit;
}
add_action('admin_post_create_ova_elems', 'ova_elems_handle_create_slider');

function ova_elems_save_data(){
    
    if (!isset($_POST['ova_elems_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ova_elems_nonce'])), 'ova_elems_save_meta_boxes_data')) {
        wp_die(esc_html__('Nonce verification failed.', 'ovation-elements'));
    }

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
    }

    // Retrieve and sanitize slide data
    $slides = [];
    $slide_titles = isset($_POST['slide_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_titles'])) : [];
    $slide_descriptions = isset($_POST['slide_descriptions']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_descriptions'])) : [];
    $slide_images = isset($_POST['slide_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_images'])) : [];
    $slide_button_texts = isset($_POST['slide_button_texts']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_button_texts'])) : [];
    $slide_button_urls = isset($_POST['slide_button_urls']) ? array_map('esc_url_raw', wp_unslash($_POST['slide_button_urls'])) : [];
    $slide_thumbnail_images = isset($_POST['slide_thumbnail_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_thumbnail_images'])) : [];
    $slide_thumbnail_titles = isset($_POST['slide_thumbnail_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_thumbnail_titles'])) : [];
    
    $slide_head_tags = isset($_POST['slide_head_tags']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_head_tags'])) : [];


    foreach ($slide_titles as $index => $title) {
        $slides[] = [
            'title' => $title,
            'description' => $slide_descriptions[$index] ?? '',
            'image_id' => $slide_images[$index] ?? '',
            'button_text' => $slide_button_texts[$index] ?? '',
            'button_url' => $slide_button_urls[$index] ?? '',
            'thumbnail_image_id' => $slide_thumbnail_images[$index] ?? '',
            'thumbnail_title' => $slide_thumbnail_titles[$index] ?? '',
            'head_tag' => $slide_head_tags[$index] ?? '',
        ];
    }

    update_post_meta($post_id, '_ova_elems_slides', maybe_serialize($slides));

    // Retrieve and sanitize static settings data
    $static_settings = [];
    $slide_corner_images = isset($_POST['slide_corner_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_corner_images'])) : [];
    $slide_mini_titles = isset($_POST['slide_mini_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_titles'])) : [];
    $slide_mini_descriptions = isset($_POST['slide_mini_descriptions']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_mini_descriptions'])) : [];
    $slide_mini_title2 = isset($_POST['slide_mini_title2']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_title2'])) : [];
    $slide_mini_description2 = isset($_POST['slide_mini_description2']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_mini_description2'])) : [];
    
    $slide_email = isset($_POST['slide_email']) ? sanitize_email(wp_unslash($_POST['slide_email'])) : '';
    $slide_no = isset($_POST['slide_no']) ? sanitize_text_field(wp_unslash($_POST['slide_no'])) : '';
    
    $background_color = isset($_POST['background_color']) ? sanitize_hex_color(wp_unslash($_POST['background_color'])) : '';
    
    $slide_mini_images_1 = isset($_POST['slide_mini_images_1']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_images_1'])) : [];
    $slide_mini_images_2 = isset($_POST['slide_mini_images_2']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_images_2'])) : [];
    
    $instagram_url = isset($_POST['instagram_url']) ? esc_url_raw(wp_unslash($_POST['instagram_url'])) : '';
    $facebook_url = isset($_POST['facebook_url']) ? esc_url_raw(wp_unslash($_POST['facebook_url'])) : '';
    $youtube_url = isset($_POST['youtube_url']) ? esc_url_raw(wp_unslash($_POST['youtube_url'])) : '';
    $basketball_url = isset($_POST['basketball_url']) ? esc_url_raw(wp_unslash($_POST['basketball_url'])) : '';
    $twitter_url = isset($_POST['twitter_url']) ? esc_url_raw(wp_unslash($_POST['twitter_url'])) : '';    

    $static_settings = [
        'corner_images' => $slide_corner_images,
        'mini_titles' => $slide_mini_titles,
        'mini_descriptions' => $slide_mini_descriptions,
        'mini_title2' => $slide_mini_title2,
        'mini_description2' => $slide_mini_description2,


        'slide_email'  => $slide_email,
        'slide_no'     => $slide_no,

        'background_color'     => $background_color,

        'mini_images_1' => $slide_mini_images_1,
        'mini_images_2' => $slide_mini_images_2,
        'instagram_url' => $instagram_url,
        'facebook_url'  =>  $facebook_url,
        'youtube_url' => $youtube_url,
        'basketball_url' => $basketball_url,
        'twitter_url' => $twitter_url,
    ];

    update_post_meta($post_id, '_ova_elems_static_settings', maybe_serialize($static_settings));

    // Redirect to the edit page after saving
    wp_redirect(admin_url('edit.php?post_type=ova_elems'));
    exit;
}
add_action('admin_post_save_ova_elems_data', 'ova_elems_save_data');



//templat4 save data 

function ova_elems_save_template4_data() {
    // Verify nonce
    if (!isset($_POST['ova_elems_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ova_elems_nonce'])), 'ova_elems_save_meta_boxes_data')) {
        wp_die(esc_html__('Nonce verification failed.', 'ovation-elements'));
    }

    // Get post ID
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
    }

    // Sanitize and save selected posts
    $selected_posts = isset($_POST['selected_posts']) ? array_map('intval', (array)$_POST['selected_posts']) : array();
    update_post_meta($post_id, '_ova_elems_selected_posts_template4', maybe_serialize($selected_posts));

    // Sanitize and save static settings
    $static_settings = array(
        'instagram_url' => isset($_POST['instagram_url']) ? esc_url_raw(wp_unslash($_POST['instagram_url'])) : '',
        'youtube_url' => isset($_POST['youtube_url']) ? esc_url_raw(wp_unslash($_POST['youtube_url'])) : '',
        'basketball_url' => isset($_POST['basketball_url']) ? esc_url_raw(wp_unslash($_POST['basketball_url'])) : '',
        'twitter_url' => isset($_POST['twitter_url']) ? esc_url_raw(wp_unslash($_POST['twitter_url'])) : '',
        'mini_description' => isset($_POST['mini_description']) ? sanitize_textarea_field(wp_unslash($_POST['mini_description'])) : '',
        'corner_posts_count' => isset($_POST['corner_posts_count']) ? absint(wp_unslash($_POST['corner_posts_count'])) : 1,
        'corner_posts_category' => isset($_POST['corner_posts_category']) ? absint(wp_unslash($_POST['corner_posts_category'])) : '',
        'corner_posts_order' => isset($_POST['corner_posts_order']) ? sanitize_text_field(wp_unslash($_POST['corner_posts_order'])) : 'asc',
    );    
    update_post_meta($post_id, '_ova_elems_static_settings_template4', maybe_serialize($static_settings));

   
    wp_redirect(admin_url('edit.php?post_type=ova_elems'));
}
add_action('admin_post_save_ova_elems_template4_data', 'ova_elems_save_template4_data');


//end 


//for shortcode 

function ova_elems_template_shortcode($atts){
    return ova_elems_shortcode_handler($atts);
}

add_shortcode('ova-elems-slider-template', 'ova_elems_template_shortcode');

//for stylesheets according to different templates add

function ova_elems_enqueue_styles() {
global $ova_elems_template;

    // Enqueue common styles and scripts
    wp_enqueue_style('ova-elems-google-fonts-montserrat-outfit', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap', array(), OVA_ELEMS_VER, '');
    wp_enqueue_style('ova-elems-font-awesome', OVA_ELEMS_URL . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
}

add_action('wp_enqueue_scripts', 'ova_elems_enqueue_styles' , 10 );

//end