<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Set a global variable to indicate the current template
global $ova_elems_template;
$ova_elems_template = 'template1';



wp_enqueue_style('ova-elems-style1', OVA_ELEMS_URL . 'assets/css/style.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-1-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-1-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
?>
<section class="oe-coperate-slider">
    <div class="inner-wrap">
        <div class="slide-counter-wrap">
            <div class="counter-wrap">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="count <?php echo $index === 0 ? 'active' : ''; ?>"><?php echo esc_html($index + 1); ?></div>
                <?php endforeach; ?>
            </div>
            <div class="social-media-wrap">
                <div class="follow-title">Follow Us</div>
                <div class="oe-icons-container">
                    <div class="icons"><a href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"><i class="fa-brands fa-facebook-f"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"><i class="fa-brands fa-instagram"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"><i class="fa-brands fa-youtube"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"><i class="fa-solid fa-basketball"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"><i class="fa-brands fa-twitter"></i></a></div>
                </div>
            </div>
        </div>
        <div class="oe-slider-outer">
            <div class="oe-slider-main-wrapper">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="slider-main-image">
                            <?php if (!empty($slide['image_id'])): ?>
                                <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>" alt="<?php echo esc_attr($slide['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="oe-slider-content">
                            <?php if (!empty($slide['title'])): ?>
                                <h1><?php echo esc_html($slide['title']); ?></h1>
                            <?php endif; ?>
                            <?php if (!empty($slide['description'])): ?>
                                <p><?php echo esc_html($slide['description']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])): ?>
                                <a href="<?php echo esc_url($slide['button_url']); ?>" class="theme-btn"><?php echo esc_html($slide['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="oe-slider-businessInfo">
                <div class="oe-slider-businessInfo-inner">
                    <?php if (!empty($static_settings['mini_titles']) && !empty($static_settings['mini_images_1'])): ?>
                        <?php foreach ($static_settings['mini_titles'] as $index => $title): ?>
                            <div class="information-card">
                                <div class="icon">
                                    <?php if (!empty($static_settings['mini_images_1'][$index])): ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][$index])); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="info-inner">
                                    <h3 class="heading"><?php echo esc_html($title); ?></h3>
                                    <p class="description"><?php echo esc_html($static_settings['mini_descriptions'][$index] ?? ''); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($static_settings['mini_title2']) || !empty($static_settings['mini_description2'])): ?>
                        <div class="information-card">
                            <div class="icon">
                                <?php if (!empty($static_settings['mini_images_2'][0])): ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0])); ?>" alt="<?php echo esc_attr($static_settings['mini_title2'][0]); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="info-inner">
                                <h3 class="heading"><?php echo esc_html($static_settings['mini_title2'][0]); ?></h3>
                                <p class="description"><?php echo esc_html($static_settings['mini_description2'][0]); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                <div class="oe-slider-controls">
                    <a href="#" class="prev"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="#" class="next"><i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="oe-slider-clients">
                <div class="client-images">
                    <div class="oe-slider-add-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <?php if (!empty($corner_images)): ?>
                        <?php foreach ($corner_images as $image_id): ?>
                            <div class="img-holder">
                                <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" alt="Corner Image">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    Happy Clients
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    
</style>

<?





?>