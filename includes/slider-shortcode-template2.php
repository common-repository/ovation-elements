<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


global $ova_elems_template;
$ova_elems_template = 'template2';

wp_enqueue_style('ova-elems-style2', OVA_ELEMS_URL . 'assets/css/style2.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-2-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-2-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
//end
?>

<section class="oe-travel-slider" >
    <div class="oe-travel-slider-after">
        <div class="oe-inner-wrap">
            <div class="social-media-wrap">
                <div class="oe-icons-container">
                        <div class="icons"><a href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"><i class="fa-brands fa-facebook-f"></i></a></div>
                        <div class="icons"><a href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"><i class="fa-brands fa-instagram"></i></a></div>
                        <div class="icons"><a href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"><i class="fa-brands fa-youtube"></i></a></div>
                        <div class="icons"><a href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"><i class="fa-solid fa-basketball"></i></a></div>
                        <div class="icons"><a href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"><i class="fa-brands fa-twitter"></i></a></div>

                </div>
                <div class="follow-title">Follow Us</div>
            </div>
            <div class="oe-slider-clients">
                <div class="client-images">
                    <div class="oe-slider-add-icon"><i class="fa-solid fa-plus"></i></div>
                    <?php if (!empty($corner_images)): ?>
                        <?php foreach ($corner_images as $image_id): ?>
                            <div class="img-holder"><img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>"
                                    alt="Client Image"></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    Happy Clients
                </div>
            </div>
            <div class="oe-travel-slider-inner">
                <div class="oe-travel-heading">
                    <h2>Travel</h2>
                </div>
                <div class="oe-travel-banner-wrap">
                    <div class="oe-travel-slider-main"
                        style="background-image: url('<?php echo esc_url(wp_get_attachment_url($slides[0]['image_id'])); ?>');">
                        <div class="oe-travel-slider-content">
                            <span class="heading-tag"><?php echo esc_html($slides[0]['head_tag']); ?></span>
                            <h1><?php echo esc_html($slides[0]['title']); ?></h1>
                            <p class="banner-para"><?php echo esc_html($slides[0]['description']); ?></p>
                            <a href="<?php echo esc_url($slides[0]['button_url']); ?>"
                                class="theme-btn"><?php echo esc_html($slides[0]['button_text']); ?></a>
                        </div>
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="oe-banner-img <?php echo $index === 0 ? 'active' : ''; ?>"
                                data-bg-image="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>">
                                <span class="heading-tag"><?php echo esc_html($slide['head_tag']); ?></span>
                                <h1><?php echo esc_html($slide['title']); ?></h1>
                                <p class="banner-para"><?php echo esc_html($slide['description']); ?></p>
                                <a href="<?php echo esc_url($slide['button_url']); ?>"
                                    class="theme-btn"><?php echo esc_html($slide['button_text']); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <div class="oe-travel-slider-custom-nav">
                        <div class="banner-nav-top">
                            <div class="oe-travel-slider-inner-wrap">
                                <?php foreach ($slides as $index => $slide): ?>
                                    <div class="oe-travel-nav-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="nav-dot"><img
                                                src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                                alt="Banner Image"></div>
                                                <div class="slide-count"><?php echo esc_html(sprintf('%02d.', $index + 1)); ?></div>
                                        <div class="slide-title"><?php echo esc_html($slide['title']); ?></div>
                                    </div>
                                <?php endforeach; ?>

                                <div class="oe-travel-slider-content">
                   
                  
                   <p class="banner-para"><?php echo esc_html($static_settings['mini_description2'][0]); ?></p>
                   
               </div>

                            </div>
                        </div>
                        <div class="oe-slider-controls">
                            <a href="#" class="prev"><i class="fa-solid fa-chevron-left"></i></a>
                            <a href="#" class="next"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section>