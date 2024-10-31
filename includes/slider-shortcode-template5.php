<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Set a global variable to indicate the current template
global $ova_elems_template;
$ova_elems_template = 'template5';

// Total slides count
$total_slides = count($slides);
$activeSlideIndex = $static_settings['active_slide_index'] ?? 0;

wp_enqueue_style('ova-elems-style5', OVA_ELEMS_URL . 'assets/css/style5.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-5-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-5-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
?>

<body>
<section class="oe-circular-slider">
    <div class="oe-circular-slider-after">
        <div class="oe-inner-wrap">
            <div class="nav-position-helper">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide-outer <?php echo $index === 0 ? 'active' : ''; ?>"
                        style="background-image: url('<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>');">
                        <div class="after-holder">
                        <div class="content-wrapper">
                            <div class="offer-tag">
                                <?php echo esc_html($slide['head_tag']); ?>
                            </div>
                            <!-- Title -->
                            <h1 class="heading">
                                <?php echo esc_html($slide['title']); ?>
                            </h1>

                            <!-- Description -->
                            <div class="theme-para">
                                <?php echo esc_html($slide['description']); ?>
                            </div>
                            <!-- Active slide number -->
                            <div class="slide-number">
                            <?php echo esc_html(sprintf('%02d', $index + 1)); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="oe-slider-controls-prev">
                    <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                </div>
                <div class="oe-slider-controls-next">
                    <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>

            <div class="nav-wrapper">
                <div class="triangle left" style="--r:3px;"></div>
                <!-- Thumbnails -->
                <div class="slider-nav">
                    <?php foreach ($slides as $index => $slide): ?>
                        <div class="nav-item" data-index="<?php echo esc_attr($index); ?>">
                            <div class="item-img">
                                <?php
                                $thumbnail_url = wp_get_attachment_url($slide['thumbnail_image_id']);
                                if ($thumbnail_url): ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>"
                                        alt="<?php echo esc_attr($slide['thumbnail_title']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="item-name">
                                <?php echo esc_html($slide['thumbnail_title']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="triangle right" style="--r:3px;"></div>
            </div>

            <div class="slider-counter">
                <!-- Active slide count -->
                <span class="current-slide">
                    <?php echo sprintf('%02d', 1); // Example for current slide ?>
                </span>
                <!-- Total slide count -->
                <span class="total-slides">
                    <?php echo esc_html(sprintf('%02d', $total_slides)); ?>
                </span>
            </div>
        </div>
    </div>
</section>
