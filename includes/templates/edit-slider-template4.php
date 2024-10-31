<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Ensure valid post ID
if (!isset($_GET['post']) || !absint($_GET['post'])) {
    wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
}

$post_id = absint($_GET['post']);
$post = get_post($post_id);

if (!$post || $post->post_type != 'ova_elems') {
    wp_die(esc_html__('Invalid slider post.', 'ovation-elements'));
}

// Retrieve existing data for template 4
$template_id = get_post_meta($post_id, '_ova_elems_template_id', true);

$selected_posts = get_post_meta($post_id, '_ova_elems_selected_posts_template4', true);
$selected_posts = $selected_posts ? maybe_unserialize($selected_posts) : array();

$static_settings = get_post_meta($post_id, '_ova_elems_static_settings_template4', true);
$static_settings = $static_settings ? maybe_unserialize($static_settings) : array();
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-4.png';
?>

<!-- Display Template Image -->
<div id="ovs-edit-page">
<div class="template-edit-img">
    <div class="ovs-edit-template-img">
    <img src="<?php echo esc_url($template1_image_url); ?>" alt="Business Slider Template" class="template-preview-image" />
   
    <h2>News Slider Template</h2>
    </div>
</div>
</div>
<!-- end -->

<div class="wrap">
    <h1>Edit Slider</h1>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="save_ova_elems_template4_data" />
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />
        <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>

        <!-- Slide Selection -->
       

        <!-- i add  -->

        <div id="slider-slides">
    <?php if (!empty($selected_posts)) : ?>
        <?php foreach ($selected_posts as $index => $post_id) : ?>
            <div class="slide-container mb-4 p-3 border rounded" data-index="<?php echo esc_attr($index); ?>">
                <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="select_post_<?php echo esc_attr($index); ?>">Select Post</label>
                    <select id="select_post_<?php echo esc_attr($index); ?>" name="selected_posts[]" class="form-control" style="width: 100%;">
                        <?php
                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => -1,
                            );
                            $posts = get_posts($args);
                            foreach ($posts as $post) {
                                $selected = ($post->ID == $post_id) ? 'selected' : ''; ?>
                               <option value="<?php echo esc_attr($post->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($post->post_title); ?></option>
                            <?php }
                        ?>
                    </select>
                </div>
                <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


        <!-- end  -->

        <button type="button" id="add_slide_button" class="btn btn-secondary">Add Slide</button>
        
        <!-- Static Settings -->
        <div class="form-group mt-4">
            <label for="instagram_url">Instagram URL</label>
            <input type="url" id="instagram_url" name="instagram_url" class="form-control" value="<?php echo isset($static_settings['instagram_url']) ? esc_url($static_settings['instagram_url']) : ''; ?>" />
        </div>
        <div class="form-group">
            <label for="youtube_url">YouTube URL</label>
            <input type="url" id="youtube_url" name="youtube_url" class="form-control" value="<?php echo isset($static_settings['youtube_url']) ? esc_url($static_settings['youtube_url']) : ''; ?>" />
        </div>
        <div class="form-group">
            <label for="basketball_url">Dribbble URL</label>
            <input type="url" id="basketball_url" name="basketball_url" class="form-control" value="<?php echo isset($static_settings['basketball_url']) ? esc_url($static_settings['basketball_url']) : ''; ?>" />
        </div>
        <div class="form-group">
            <label for="twitter_url">Twitter URL</label>
            <input type="url" id="twitter_url" name="twitter_url" class="form-control" value="<?php echo isset($static_settings['twitter_url']) ? esc_url($static_settings['twitter_url']) : ''; ?>" />
        </div>

        <!-- Mini Description -->
        <div class="form-group">
            <label for="mini_description">Mini Description</label>
            <textarea id="mini_description" name="mini_description" class="form-control"><?php echo isset($static_settings['mini_description']) ? esc_textarea($static_settings['mini_description']) : ''; ?></textarea>
        </div>

        <!-- Right Corner Posts -->
       

        <!-- new add -->

        <div class="form-group mt-4">
    <label for="corner_posts_count">Number of Corner Posts</label>
    <select id="corner_posts_count" name="corner_posts_count" class="form-control">
        <?php for ($i = 1; $i <= 7; $i++) : ?>
            <option value="<?php echo esc_attr($i); ?>" <?php echo isset($static_settings['corner_posts_count']) ? selected($static_settings['corner_posts_count'], $i, false) : ''; ?>>
                <?php echo esc_html($i); ?>
            </option>
        <?php endfor; ?>
    </select>
</div>

<div class="form-group">
    <label for="corner_posts_category">Display Posts by Category</label>
    <select id="corner_posts_category" name="corner_posts_category" class="form-control">
        <option value=""><?php esc_html_e('Select Category', 'ovation-elements'); ?></option>
        <?php
        $categories = get_categories();
        foreach ($categories as $category) {
            echo '<option value="' . esc_attr($category->term_id) . '" ' . (isset($static_settings['corner_posts_category']) ? selected($static_settings['corner_posts_category'], $category->term_id, false) : '') . '>' . esc_html($category->name) . '</option>';
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="corner_posts_order">Order Posts by Date</label>
    <select id="corner_posts_order" name="corner_posts_order" class="form-control">
        <option value="asc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'asc', false) : ''; ?>><?php esc_html_e('Ascending', 'ovation-elements'); ?></option>
        <option value="desc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'desc', false) : ''; ?>><?php esc_html_e('Descending', 'ovation-elements'); ?></option>
    </select>
</div>


        <!-- end -->

        <button type="submit" class="btn btn-primary">Save Slider</button>
    </form>
</div>

