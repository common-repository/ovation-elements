<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template4';


wp_enqueue_style('ova-elems-style4', OVA_ELEMS_URL . 'assets/css/style4.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-4-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-4-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
// Override the default Font Awesome version for template 4
wp_dequeue_style('font-awesome');
wp_enqueue_style('ova-elems-font-awesome-template4', OVA_ELEMS_URL . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
//end


// Fetch selected posts
$selected_posts = maybe_unserialize(get_post_meta($post_id, '_ova_elems_selected_posts_template4', true));

//i add 
// Retrieve existing data for static settings
$_ova_elems_static_settings_template4 = get_post_meta($post_id, '_ova_elems_static_settings_template4', true);
$_ova_elems_static_settings_template4 = $_ova_elems_static_settings_template4 ? maybe_unserialize($_ova_elems_static_settings_template4) : array();
//end 

// Extract settings
$instagram_url = isset($_ova_elems_static_settings_template4['instagram_url']) ? esc_url($_ova_elems_static_settings_template4['instagram_url']) : '';

$youtube_url = isset($_ova_elems_static_settings_template4['youtube_url']) ? esc_url($_ova_elems_static_settings_template4['youtube_url']) : '';
$basketball_url = isset($_ova_elems_static_settings_template4['basketball_url']) ? esc_url($_ova_elems_static_settings_template4['basketball_url']) : '';
$twitter_url = isset($_ova_elems_static_settings_template4['twitter_url']) ? esc_url($_ova_elems_static_settings_template4['twitter_url']) : '';
$mini_description = isset($_ova_elems_static_settings_template4['mini_description']) ? esc_html($_ova_elems_static_settings_template4['mini_description']) : '';
$corner_posts_count = isset($_ova_elems_static_settings_template4['corner_posts_count']) ? intval($_ova_elems_static_settings_template4['corner_posts_count']) : 1;


$corner_posts_category = isset($_ova_elems_static_settings_template4['corner_posts_category']) ? intval($_ova_elems_static_settings_template4['corner_posts_category']) : '';
$corner_posts_order = isset($_ova_elems_static_settings_template4['corner_posts_order']) ? sanitize_text_field($_ova_elems_static_settings_template4['corner_posts_order']) : 'asc';

// Fetch corner posts
$corner_posts = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => $corner_posts_count,
        'cat' => $corner_posts_category,
        'order' => $corner_posts_order,
        'orderby' => 'date'
    )
);
// Start building the output

?>

<section class="oe-news-slider">
    <div class="oe-inner-wrap">
        <div class="social-media-wrap">
            <div class="oe-icons-container">
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['facebook_url'] ?? '#'); ?>"><i
                            class="fa-brands fa-facebook-f"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['instagram_url'] ?? '#'); ?>"><i
                            class="fa-brands fa-instagram"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['youtube_url'] ?? '#'); ?>"><i
                            class="fa-brands fa-youtube"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['basketball_url'] ?? '#'); ?>"><i
                            class="fa-solid fa-basketball"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['twitter_url'] ?? '#'); ?>"><i
                            class="fa-brands fa-twitter"></i></a></div>
            </div>
            <div class="follow-title">
                Follow Us
            </div>
        </div>

        <div class="slide-outer">
            <!-- Slider content -->
            <div class="slider-wrapper">
                <?php
                // Fetch and display selected posts
                if (!empty($selected_posts)) {
                    foreach ($selected_posts as $post_id) {
                        $post = get_post($post_id);
                        if ($post) {
                            $post_author = get_the_author_meta('display_name', $post->post_author);
                            $post_date = get_the_date('d-M-Y', $post_id);
                            $post_time = get_the_time('H:i', $post_id);
                            $post_content = apply_filters('the_content', $post->post_content);
                            ?>
                            <div class="content-wrapper">
                                <div class="offer-tag">
                                    <?php echo esc_html($post->post_title); ?>
                                </div>
                                <h1 class="heading">
                                    <?php echo esc_html($post->post_title); ?>
                                </h1>
                                <div class="theme-para">
                                    <?php echo esc_html($post_content); ?>
                                </div>
                                <div class="slider-meta">
                                    <div class="meta-item">
                                        <span class="item">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <p class="text"><?php echo esc_html($post_author); ?></p>
                                    </div>
                                    <div class="meta-item">
                                        <span class="item">
                                            <i class="fa-solid fa-calendar"></i>
                                        </span>
                                        <p class="text"><?php echo esc_html($post_date); ?></p>
                                    </div>
                                    <div class="meta-item">
                                        <span class="item">
                                            <i class="fa-solid fa-clock"></i>
                                        </span>
                                        <p class="text"><?php echo esc_html($post_time); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <div class="slider-nav">
                    <?php
                    // Example navigation items (use real URLs or image sources)
                    ?>
                    <div class="oe-slider-controls">
                        <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                        <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <?php foreach ($selected_posts as $post_id): ?>
                        <div class="nav-item">
                            <div class="nav-item-img">
                                <?php
                                // Fetch post thumbnail or a default image
                                $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
                                ?>
                                <img src="<?php echo esc_url($thumbnail ?: 'default-image-url'); ?>" alt="">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <div class="banner-below">
                <div class="text">
                    <p class="description">
                        <?php echo esc_html($_ova_elems_static_settings_template4['mini_description']); ?>
                    </p>
                </div>
                <div class="live-reporting">
                    <a href="#" class="play-btn"><i class="fa-solid fa-play"></i></a>
                    <div class="live-inner">
                        <small>live</small>
                        Live Reporting
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent-news-sidebar">
        <div class="sidebar-heading">
            <h3>Recent News</h3>
        </div>
        <div class="news-outer">
            <?php
            // Display corner posts
            if ($corner_posts->have_posts()) {
                while ($corner_posts->have_posts()) {
                    $corner_posts->the_post();
                    ?>
                    <div class="news-item">
                        <div class="news-item-img">
                            <?php
                            $news_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                            ?>
                            <img src="<?php echo esc_url($news_thumbnail ?: 'default-news-image-url'); ?>"
                                alt="news feature image">
                        </div>
                        <div class="news-intem-inner">
                            <h4 class="title">
                                <?php the_title(); ?>
                            </h4>
                            <div class="news-meta">
                                <div class="news-meta-item">
                                    <span class="news-item-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <p class="news-text"><?php the_author(); ?></p>
                                </div>
                                <div class="news-meta-item">
                                    <span class="news-item-icon">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                    <p class="news-text"><?php echo get_the_date('d-M-Y'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>

</section>