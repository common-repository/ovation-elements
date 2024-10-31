<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Edit Slider Page

if (!isset($_GET['post']) || !absint($_GET['post'])) {
    wp_die(esc_html__('Invalid post ID.'));
}

$post_id = absint($_GET['post']);
$post = get_post($post_id);

if (!$post || $post->post_type != 'ova_elems') {
    wp_die(esc_html__('Invalid slider post.', 'ovation-elements'));
}

// Retrieve existing data for slides
$slides = get_post_meta($post_id, '_ova_elems_slides', true);
$slides = $slides ? maybe_unserialize($slides) : array();

// Retrieve existing data for static settings
$static_settings = get_post_meta($post_id, '_ova_elems_static_settings', true);
$static_settings = $static_settings ? maybe_unserialize($static_settings) : array();

?>

<?php

$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-1.png';
?>

<!-- Display Template Image -->
<div id="ovs-edit-page">
<div class="template-edit-img">
    <div class="ovs-edit-template-img">
    <img src="<?php echo esc_url($template1_image_url); ?>" alt="Business Slider Template" class="template-preview-image" />
   
    <h2>Business Slider Template</h2>
    </div>
</div>
</div>
<!-- end -->

<div class="wrap">
<div class="container-custom">

    <h1 class="editor-heading">Edit Slider</h1>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>
        <input type="hidden" name="action" value="save_ova_elems_data" />
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />

        <div id="slider-slides">
            <?php if (empty($slides)): ?>
                <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                    <h3 class="slider-form-heading">Slide 1</h3>
                    <div class="form-group">
                        <label for="slide_image_0">Image:</label>
                        <input type="hidden" id="slide_image_0" name="slide_images[]" />
                        <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                        <button type="button" class="upload_image_button button mt-2">Upload Image:</button>
                    </div>
                    <div class="form-group">
                        <label for="slide_title_0">Title:</label>
                        <input type="text" id="slide_title_0" name="slide_titles[]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_description_0">Description:</label>
                        <textarea id="slide_description_0" name="slide_descriptions[]" rows="3"
                            class="form-control"></textarea>
                    </div>

                    <!-- <div class="form-group"> 
                        <label for="slide_head_tag_0">Head Tag</label>
                        <input type="text" id="slide_head_tag_0" name="slide_head_tags[]" class="form-control" />
                    </div> -->

                    <div class="form-group half">
                        <label for="slide_button_text_0">Button Text:</label>
                        <input type="text" id="slide_button_text_0" name="slide_button_texts[]" class="form-control" />
                    </div>
                    <div class="form-group half">
                        <label for="slide_button_url_0">Button URL:</label>
                        <input type="url" id="slide_button_url_0" name="slide_button_urls[]" class="form-control" />
                    </div>
                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                </div>
            <?php endif; ?>

            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide-container mb-4 p-3 border rounded" data-index="<?php echo esc_attr($index); ?>">
                <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                    <div class="form-group">
                    <label for="slide_image_<?php echo esc_attr($index); ?>">Upload Image:</label>
                    <input type="hidden" id="slide_image_<?php echo esc_attr($index); ?>" name="slide_images[]"
                            value="<?php echo esc_attr($slide['image_id']); ?>" />
                        <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                            style="max-width: 100px; max-height: 100px; display: block;" />
                        <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Image</button>
                    </div>
                    <div class="form-group">
                    <label for="slide_title_<?php echo esc_attr($index); ?>">Title:</label>
                    <input type="text" id="slide_title_<?php echo esc_attr($index); ?>" name="slide_titles[]"
                            value="<?php echo esc_attr($slide['title']); ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                    <label for="slide_description_<?php echo esc_attr($index); ?>">Description:</label>
                    <textarea id="slide_description_<?php echo esc_attr($index); ?>" name="slide_descriptions[]" rows="3"
                            class="form-control"><?php echo esc_textarea($slide['description']); ?></textarea>
                    </div>

                    <div class="form-group">
                    <label for="slide_head_tag_<?php echo esc_attr($index); ?>">Head Tag</label>
                    <input type="text" id="slide_head_tag_<?php echo esc_attr($index); ?>" name="slide_head_tags[]" value="<?php echo esc_attr($slide['head_tag']); ?>" class="form-control">
                        </div>
                    <div class="form-group half">
                        <label for="slide_button_text_<?php echo esc_attr($index); ?>">Button Text:</label>
                        <input type="text" id="slide_button_text_<?php echo esc_attr($index); ?>" name="slide_button_texts[]"
                            value="<?php echo esc_attr($slide['button_text']); ?>" class="form-control" />
                    </div>
                    <div class="form-group half">
                    <label for="slide_button_url_<?php echo esc_attr($index); ?>">Button URL:</label>
                    <input type="url" id="slide_button_url_<?php echo esc_attr($index); ?>" name="slide_button_urls[]"
                            value="<?php echo esc_url($slide['button_url']); ?>" class="form-control" />
                    </div>
                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" id="add_slide_button" class="btn btn-success">Add Slide</button>

        <h2 class="editor-heading">Static Settings</h2>
        <div class="static-container mb-4 p-3 border rounded">
        

                <!-- new add  -->
                <div class="form-group">
    <label for="instagram_url">Instagram URL:</label>
    <input type="url" id="instagram_url" name="instagram_url" class="form-control"
           value="<?php echo esc_url(isset($static_settings['instagram_url']) ? $static_settings['instagram_url'] : ''); ?>" />
</div>

<div class="form-group">
    <label for="youtube_url">YouTube URL:</label>
    <input type="url" id="youtube_url" name="youtube_url" class="form-control"
           value="<?php echo esc_url(isset($static_settings['youtube_url']) ? $static_settings['youtube_url'] : ''); ?>" />
</div>

<div class="form-group">
    <label for="facebook_url">Facebook URL:</label>
    <input type="url" id="facebook_url" name="facebook_url" class="form-control"
           value="<?php echo esc_url(isset($static_settings['facebook_url']) ? $static_settings['facebook_url'] : ''); ?>" />
</div>

<div class="form-group">
    <label for="basketball_url">Dribbble URL:</label>
    <input type="url" id="basketball_url" name="basketball_url" class="form-control"
           value="<?php echo esc_url(isset($static_settings['basketball_url']) ? $static_settings['basketball_url'] : ''); ?>" />
</div>

<div class="form-group">
    <label for="twitter_url">Twitter URL:</label>
    <input type="url" id="twitter_url" name="twitter_url" class="form-control"
           value="<?php echo esc_url(isset($static_settings['twitter_url']) ? $static_settings['twitter_url'] : ''); ?>" />
</div>

                           <!-- end  -->

            <div class="form-group">
                <label for="slide_mini_title_0">Mini Title:</label>
                <input type="text" id="slide_mini_title_0" name="slide_mini_titles[]" class="form-control"
                    value="<?php echo esc_attr($static_settings['mini_titles'][0] ?? ''); ?>" />
            </div>
            
            <div class="form-group">
                <label for="slide_mini_description_0">Mini Description:</label>
                <textarea id="slide_mini_description_0" name="slide_mini_descriptions[]" rows="2"
                    class="form-control"><?php echo esc_textarea($static_settings['mini_descriptions'][0] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="slide_mini_title2_0">Mini Title 2:</label>
                <input type="text" id="slide_mini_title2_0" name="slide_mini_title2[]" class="form-control"
                    value="<?php echo esc_attr($static_settings['mini_title2'][0] ?? ''); ?>" />
            </div>


            <div class="form-group">
                <label for="slide_mini_description2_0">Mini Description 2:</label>
                <textarea id="slide_mini_description2_0" name="slide_mini_description2[]" rows="2"
                    class="form-control"><?php echo esc_textarea($static_settings['mini_description2'][0] ?? ''); ?></textarea>
            </div>


            <div class="form-group mini  d-flex gap-3">
                <label for="slide_mini_image_1_0">Mini Title 1 Image:</label>
                <input type="hidden" id="slide_mini_image_1_0" name="slide_mini_images_1[]"
                    value="<?php echo esc_attr($static_settings['mini_images_1'][0] ?? ''); ?>" />
                <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][0] ?? '')); ?>"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_1'][0]) ? 'none' : 'block'; ?>;" />
                <button type="button"
                    class="upload_mini_image_1_button button mt-2 upload_image_button">Upload
                    Image</button>
            </div>
            <div class="form-group mini  d-flex gap-3">
                <label for="slide_mini_image_2_0">Mini Title 2 Image:</label>
                <input type="hidden" id="slide_mini_image_2_0" name="slide_mini_images_2[]"
                    value="<?php echo esc_attr($static_settings['mini_images_2'][0] ?? ''); ?>" />
                <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0] ?? '')); ?>"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_2'][0]) ? 'none' : 'block'; ?>;" />
                <button type="button mini"
                    class="upload_mini_image_2_button button upload_image_button">Upload
                    Image</button>
            </div>
            <div class="form-group mini d-flex gap-3">
                <label for="slide_corner_images_0">Upload Client Image:</label>
                <input type="hidden" id="slide_corner_images_0" name="slide_corner_images[]"
                    value="<?php echo esc_attr(implode(',', $static_settings['corner_images'] ?? [])); ?>" />
                <div class="corner-images-container">
                    <?php
                    if (!empty($static_settings['corner_images'])) {
                        foreach ($static_settings['corner_images'] as $image_id) {
                            echo '<img src="' . esc_url(wp_get_attachment_url($image_id)) . '" style="max-width: 100px; max-height: 100px; display: inline-block; margin-right: 10px;" />';
                        }
                    }
                    ?>
                </div>
                <button type="button" class="upload_corner_images_button button upload_image_button">Upload
                    Image</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Slider</button>
    </form>
</div>
</div>