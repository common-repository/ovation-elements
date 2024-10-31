<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template3';

wp_enqueue_style('ova-elems-style3', OVA_ELEMS_URL . 'assets/css/style3.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-3-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-3-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
//end
?>
<section class="oe-circular-slider">
    <div class="oe-circular-slider-after">
        <div class="oe-inner-wrap">
            <div class="social-media-wrap">
                <div class="oe-icons-container">
                    <div class="icons"><a href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"><i
                                class="fa-brands fa-facebook-f"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"><i
                                class="fa-brands fa-instagram"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"><i
                                class="fa-brands fa-youtube"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"><i
                                class="fa-solid fa-basketball"></i></a></div>
                    <div class="icons"><a href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"><i
                                class="fa-brands fa-twitter"></i></a></div>
                </div>
                <div class="follow-title">Follow Us</div>
            </div>
            <div class="oe-circular-slider-inner">
                <div class="oe-travel-heading">
                    <h2>Travel</h2>
                </div>
                <div class="oe-travel-banner-wrap">
                    <div class="oe-slier-3-min-header-heading">
                        <div class="oe-circular-slider-main">
                            <?php foreach ($slides as $index => $slide): ?>
                                <div class="oe-banner-img <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <span class="heading-tag">New Arrival</span>
                                    <h1><?php echo esc_html($slide['title']); ?></h1>
                                    <p class="banner-para"><?php echo esc_html($slide['description']); ?></p>
                                    <div class="oe-circular-slider-custom-nav">
                                        <a href="<?php echo esc_url($slide['button_url']); ?>"
                                            class="theme-btn"><?php echo esc_html($slide['button_text']); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="oe-slider-controls">
                                <a href="#" class="prev"><i class="fa-solid fa-chevron-left"></i></a>
                                <a href="#" class="next"><i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="oe-slider-businessInfo-inner">
                            <div class="additional-info">
                                <div class="info-wrap">
                                    <i class="fa-solid fa-envelope"></i>
                                    <div class="info">
                                    <?php echo esc_attr($static_settings['slide_email']); ?>
                                    </div>
                                </div>
                                <div class="info-wrap">
                                    <i class="fa-solid fa-phone"></i>
                                    <div class="info"><?php echo esc_attr($static_settings['slide_no']); ?></div>
                                </div>
                            </div>
                            <?php if (!empty($static_settings['mini_titles']) && !empty($static_settings['mini_images_1'])): ?>
                                <?php foreach ($static_settings['mini_titles'] as $index => $title): ?>
                                    <div class="information-card">
                                        <div class="icon">
                                            <?php if (!empty($static_settings['mini_images_1'][$index])): ?>
                                                <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][$index])); ?>"
                                                    alt="<?php echo esc_attr($title); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="info-inner">
                                            <h3 class="heading"><?php echo esc_html($title); ?></h3>
                                            <p class="description">
                                                <?php echo esc_html($static_settings['mini_descriptions'][$index] ?? ''); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!empty($static_settings['mini_title2']) || !empty($static_settings['mini_description2'])): ?>
                                <div class="information-card">
                                    <div class="icon">
                                        <?php if (!empty($static_settings['mini_images_2'][0])): ?>
                                            <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0])); ?>"
                                                alt="<?php echo esc_attr($static_settings['mini_title2'][0]); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="info-inner">
                                        <h3 class="heading"><?php echo esc_html($static_settings['mini_title2'][0]); ?></h3>
                                        <p class="description">
                                            <?php echo esc_html($static_settings['mini_description2'][0]); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="banner-right">
                        <div class="circle-holder">
                            <div class="circular-slider">
                                <?php foreach ($slides as $index => $slide): ?>
                                    <div class="item-wrapper <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="item-image">
                                            <div class="item-number"><?php echo esc_html($index + 1); ?></div>
                                            <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                                alt="item image">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

