<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Edit Slider Page5

if (!isset($_GET['post']) || !absint($_GET['post'])) {
    wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
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
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-5.png';
?>

<!-- Display Template Image -->
<div id="ovs-edit-page">
<div class="template-edit-img">
    <div class="ovs-edit-template-img">
    <img src="<?php echo esc_url($template1_image_url); ?>" alt="Business Slider Template" class="template-preview-image" />
   
    <h2>Food Slider Template</h2>
    </div>
</div>
</div>
<!-- end -->

<div class="wrap">
    <h1>Edit Slider</h1>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>
        <input type="hidden" name="action" value="save_ova_elems_data" />
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />

        <div id="slider-slides">
            <?php if (empty($slides)): ?>
                <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                    <h3>Slide 1</h3>
                    <div class="form-group">
                        <label for="slide_image_0">Image</label>
                        <input type="hidden" id="slide_image_0" name="slide_images[]" />
                        <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                        <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Image</button>
                    </div>
                    <div class="form-group">
                        <label for="slide_title_0">Title</label>
                        <input type="text" id="slide_title_0" name="slide_titles[]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_description_0">Description</label>
                        <textarea id="slide_description_0" name="slide_descriptions[]" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="slide_button_text_0">Button Text</label>
                        <input type="text" id="slide_button_text_0" name="slide_button_texts[]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_button_url_0">Button URL</label>
                        <input type="url" id="slide_button_url_0" name="slide_button_urls[]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_thumbnail_image_0">Thumbnail Image</label>
                        <input type="hidden" id="slide_thumbnail_image_0" name="slide_thumbnail_images[]" />
                        <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                        <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail Image</button>
                    </div>

                    <div class="form-group">
                        <label for="slide_thumbnail_title_0">Thumbnail Title</label>
                        <input type="text" id="slide_thumbnail_title_0" name="slide_thumbnail_titles[]" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="slide_head_tag_0">Head Tag</label>
                        <small class="form-text text-muted">Please enter a relevant head text for the slide. It will display above the title.</small>
                        <input type="text" id="slide_head_tag_0" name="slide_head_tags[]" class="form-control" />
                    </div>


                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                </div>
            <?php endif; ?>

            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide-container mb-4 p-3 border rounded" data-index="<?php echo esc_attr($index); ?>">
                    <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                    <div class="form-group">
                        <label for="slide_image_<?php echo esc_attr($index); ?>">Upload Slider Image</label>
                        <input type="hidden" id="slide_image_<?php echo esc_attr($index); ?>" name="slide_images[]" value="<?php echo esc_attr($slide['image_id']); ?>" />
                        <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>" style="max-width: 100px; max-height: 100px; display: block;" />
                        <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Image</button>
                    </div>
                    <div class="form-group">
                        <label for="slide_title_<?php echo esc_attr($index); ?>">Title</label>
                        <input type="text" id="slide_title_<?php echo esc_attr($index); ?>" name="slide_titles[]" value="<?php echo esc_attr($slide['title']); ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_description_<?php echo esc_attr($index); ?>">Description</label>
                        <textarea id="slide_description_<?php echo esc_attr($index); ?>" name="slide_descriptions[]" rows="3" class="form-control"><?php echo esc_textarea($slide['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="slide_button_text_<?php echo esc_attr($index); ?>">Button Text</label>
                        <input type="text" id="slide_button_text_<?php echo esc_attr($index); ?>" name="slide_button_texts[]" value="<?php echo esc_attr($slide['button_text']); ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_button_url_<?php echo esc_attr($index); ?>">Button URL</label>
                        <input type="url" id="slide_button_url_<?php echo esc_attr($index); ?>" name="slide_button_urls[]" value="<?php echo esc_url($slide['button_url']); ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="slide_thumbnail_image_<?php echo esc_attr($index); ?>">Thumbnail Image</label>
                        <input type="hidden" id="slide_thumbnail_image_<?php echo esc_attr($index); ?>" name="slide_thumbnail_images[]" value="<?php echo esc_attr($slide['thumbnail_image_id']); ?>" />
                        <img src="<?php echo esc_url(wp_get_attachment_url($slide['thumbnail_image_id'])); ?>" style="max-width: 100px; max-height: 100px; display: block;" />
                        <button type="button" class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail Image</button>
                    </div>
                    <div class="form-group">
                        <label for="slide_thumbnail_title_<?php echo esc_attr($index); ?>">Thumbnail Title</label>
                        <input type="text" id="slide_thumbnail_title_<?php echo esc_attr($index); ?>" name="slide_thumbnail_titles[]" value="<?php echo esc_attr($slide['thumbnail_title']); ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="slide_head_tag_<?php echo esc_attr($index); ?>">Head Tag</label>
                        <input type="text" id="slide_head_tag_<?php echo esc_attr($index); ?>" name="slide_head_tags[]" value="<?php echo esc_attr($slide['head_tag']); ?>" class="form-control" />
                    </div>


                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" id="add_slide_button" class="btn btn-success">Add Slide</button>

        <button type="submit" class="btn btn-primary">Save Slider</button>
    </form>
</div>