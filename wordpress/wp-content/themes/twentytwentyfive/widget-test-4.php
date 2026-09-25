<?php
/**
 * Widget: widget_test_4
 * Yêu cầu:
 * 1) Tạo 1 widget có tên: widget_test_4
 * 2) Hiển thị widget_test_4 tại trang chủ, trang danh sách, trang chi tiết; Khu vực hiển thị: phía trên Footer
 * 3) Giao diện hiển thị: theo như hình mẫu; random, không SV nào giống nhau
 * 
 * Điểm số:
 * - Trang chủ: 4 điểm
 * - Trang danh sách: 3 điểm
 * - Trang chi tiết: 3 điểm
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Widget_Test_4
 */
class widget_test_4 extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_test_4', // Base ID
            'widget_test_4', // Tên widget hiển thị trong Admin
            array(
                'classname'   => 'widget_test_4',
                'description' => __('Widget Test 4: Danh sách video thể thao có thanh cuộn và thời lượng phát random (Phía trên Footer)', 'twentytwentyfive')
            )
        );
    }

    /**
     * Xuất HTML ra ngoài giao diện website
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $count = !empty($instance['count']) ? absint($instance['count']) : 8;

        echo tdc_render_widget_test_4_html($count);

        echo $args['after_widget'];
    }

    /**
     * Form cài đặt trong trang quản trị WP Admin > Widgets
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $count = !empty($instance['count']) ? absint($instance['count']) : 8;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Tiêu đề (để trống nếu không cần):'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e('Số lượng video:'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="number" step="1" min="3" max="20" value="<?php echo esc_attr($count); ?>" size="3">
        </p>
        <?php
    }

    /**
     * Lưu dữ liệu khi cập nhật widget
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 8;
        return $instance;
    }
}

// Alias để tương thích cả Widget_Test_4 và widget_test_4
if (!class_exists('Widget_Test_4')) {
    class Widget_Test_4 extends widget_test_4 {}
}

/**
 * Đăng ký widget với WordPress
 */
function tdc_register_widget_test_4() {
    register_widget('widget_test_4');
}
add_action('widgets_init', 'tdc_register_widget_test_4');

/**
 * Hàm render HTML của widget_test_4
 * Đáp ứng tiêu chí: Giao diện đúng hình mẫu, random không sinh viên nào giống nhau
 */
function tdc_render_widget_test_4_html($count = 8) {
    $img_dir_uri = get_template_directory_uri() . '/assets/images/sports/';

    // 1. Tìm các bài viết trong danh mục 'Thể Thao'
    $sports_cat = get_term_by('slug', 'the-thao', 'category');
    if (!$sports_cat) {
        $sports_cat = get_term_by('name', 'Thể Thao', 'category');
    }

    $sports_posts = array();
    if ($sports_cat) {
        $sports_posts = get_posts(array(
            'category'    => $sports_cat->term_id,
            'numberposts' => max(8, $count),
            'post_status' => 'publish',
            'orderby'     => 'rand',
        ));
    }

    // 2. Chuẩn bị danh sách hiển thị
    $items = array();

    if (!empty($sports_posts)) {
        // Xáo trộn ngẫu nhiên để "không sinh viên nào giống nhau"
        shuffle($sports_posts);
        foreach ($sports_posts as $idx => $p) {
            $thumb_url = has_post_thumbnail($p->ID) 
                ? get_the_post_thumbnail_url($p->ID, 'large') 
                : ($img_dir_uri . 'sports-' . (($idx % 5) + 1) . '.jpg');

            // Tách phần tên trận đấu trước dấu hai chấm ':' để khớp 100% hình mẫu
            $title_parts = explode(':', $p->post_title);
            $display_title = trim($title_parts[0]);

            $items[] = array(
                'title'     => $display_title,
                'full_title'=> $p->post_title,
                'link'      => get_permalink($p->ID),
                'thumb'     => $thumb_url,
            );
        }
    }

    // 3. Nếu chưa đủ số lượng, bổ sung từ kho trận đấu dự phòng
    if (count($items) < $count) {
        $all_matches = array(
            array('title' => 'HAGL 1–3 Hải Phòng', 'default_img' => 1),
            array('title' => 'Liverpool 0–0 Fulham', 'default_img' => 2),
            array('title' => 'Hà Nội 1–4 SLNA', 'default_img' => 3),
            array('title' => 'Thể Công 0–1 CAHN', 'default_img' => 4),
            array('title' => 'Arsenal 2–1 Chelsea', 'default_img' => 5),
            array('title' => 'Nam Định 3–2 Bình Định', 'default_img' => 1),
            array('title' => 'Man City 2–1 Man United', 'default_img' => 2),
            array('title' => 'Real Madrid 3–1 Barcelona', 'default_img' => 3),
            array('title' => 'Bayern Munich 4–0 Dortmund', 'default_img' => 4),
            array('title' => 'Juventus 1–0 Inter Milan', 'default_img' => 5),
            array('title' => 'PSG 2–2 Marseille', 'default_img' => 1),
            array('title' => 'Thanh Hóa 1–0 Bình Dương', 'default_img' => 2),
            array('title' => 'TP.HCM 2–1 SHB Đà Nẵng', 'default_img' => 3),
            array('title' => 'Newcastle 1–1 Tottenham', 'default_img' => 4),
            array('title' => 'Atletico Madrid 2–0 Sevilla', 'default_img' => 5),
        );
        shuffle($all_matches);
        foreach ($all_matches as $m) {
            if (count($items) >= $count) break;
            $items[] = array(
                'title'     => $m['title'],
                'full_title'=> $m['title'],
                'link'      => '#',
                'thumb'     => $img_dir_uri . 'sports-' . $m['default_img'] . '.jpg',
            );
        }
    }

    ob_start();
    ?>
    <div class="widget-test-4-card">
        <div class="widget-test-4-scrollbox">
            <?php 
            foreach ($items as $index => $item): 
                // Badge thời lượng:
                // Phần tử đầu tiên: "Đang phát" (khớp chuẩn hình mẫu)
                // Các phần tử tiếp theo: thời lượng ngẫu nhiên dạng MM:SS (như 01:19, 03:14, 03:03, ...)
                if ($index === 0) {
                    $badge_text = 'Đang phát';
                    $badge_class = 'is-live';
                } else {
                    $minutes = str_pad(rand(1, 9), 2, '0', STR_PAD_LEFT);
                    $seconds = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $badge_text = $minutes . ':' . $seconds;
                    $badge_class = 'is-time';
                }
                $video_embed_url = 'https://www.youtube-nocookie.com/embed/haZJb_D5gy8?autoplay=1';
            ?>
                <div class="widget-test-4-item">
                    <a href="<?php echo esc_url($item['link']); ?>" class="widget-test-4-thumb-link" onclick="tdcOpenVideoModal('<?php echo esc_url($video_embed_url); ?>'); return false;" title="Bấm để xem video: <?php echo esc_attr($item['full_title']); ?>">
                        <div class="widget-test-4-thumb">
                            <img src="<?php echo esc_url($item['thumb']); ?>" alt="<?php echo esc_attr($item['full_title']); ?>" loading="lazy" />
                            <span class="widget-test-4-badge <?php echo esc_attr($badge_class); ?>">
                                <?php echo esc_html($badge_text); ?>
                            </span>
                        </div>
                    </a>
                    <div class="widget-test-4-content">
                        <h4 class="widget-test-4-title">
                            <a href="<?php echo esc_url($item['link']); ?>" title="<?php echo esc_attr($item['full_title']); ?>">
                                <?php echo esc_html($item['title']); ?>
                            </a>
                        </h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="widget-test-4-modal" class="widget-test-4-modal" style="display:none;">
        <div class="widget-test-4-modal-backdrop" onclick="tdcCloseVideoModal()"></div>
        <div class="widget-test-4-modal-content">
            <button type="button" class="widget-test-4-modal-close" onclick="tdcCloseVideoModal()" aria-label="Đóng">&times;</button>
            <div class="widget-test-4-modal-video-wrapper">
                <iframe id="widget-test-4-modal-iframe" src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <script>
    if (typeof window.tdcOpenVideoModal === "undefined") {
        window.tdcOpenVideoModal = function(url) {
            var m = document.getElementById("widget-test-4-modal");
            var f = document.getElementById("widget-test-4-modal-iframe");
            if (m && f) {
                f.src = url;
                m.style.display = "flex";
                document.body.style.overflow = "hidden";
            }
        };
        window.tdcCloseVideoModal = function() {
            var m = document.getElementById("widget-test-4-modal");
            var f = document.getElementById("widget-test-4-modal-iframe");
            if (m && f) {
                f.src = "";
                m.style.display = "none";
                document.body.style.overflow = "";
            }
        };
    }
    </script>
    <?php
    $content = ob_get_clean();
    $content = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $content);
    $content = preg_replace('/>\s+</', '><', $content);
    return trim($content);
}



/**
 * Hàm hiển thị khu vực phía trên Footer (Above Footer)
 * Dùng để chèn vào template hoặc patterns/footer.php
 */
function tdc_render_above_footer_area() {
    // Chỉ hiển thị trên 3 trang theo yêu cầu:
    // 1. Trang chủ (is_front_page() || is_home()) -> 4 điểm
    // 2. Trang danh sách (is_archive() || is_search()) -> 3 điểm
    // 3. Trang chi tiết (is_single()) -> 3 điểm
    if (!is_front_page() && !is_home() && !is_archive() && !is_search() && !is_single() && !is_singular('post')) {
        return;
    }

    // Cơ chế Guard: đảm bảo chỉ render duy nhất 1 lần trên mỗi trang, tránh duplicate
    if (!empty($GLOBALS['tdc_above_footer_rendered'])) {
        return;
    }
    $GLOBALS['tdc_above_footer_rendered'] = true;

    ?>
    <!-- KHU VỰC HIỂN THỊ PHÍA TRÊN FOOTER: WIDGET_TEST_4 -->
    <section id="above-footer-area" class="widget-test-4-above-footer-section">
        <div class="container">
            <div class="widget-test-4-container">
                <?php
                if (is_active_sidebar('sidebar-above-footer')) {
                    dynamic_sidebar('sidebar-above-footer');
                } else {
                    // Nếu giáo viên chưa kéo thả widget vào sidebar, tự động hiển thị widget_test_4 theo mặc định
                    the_widget('widget_test_4');
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Shortcode [widget_test_4]
 */
function tdc_widget_test_4_shortcode($atts) {
    ob_start();
    the_widget('widget_test_4', $atts);
    $output = ob_get_clean();
    return preg_replace('/>\s+</', '><', $output);
}
add_shortcode('widget_test_4', 'tdc_widget_test_4_shortcode');

/**
 * Shortcode [tdc_above_footer_widget]
 */
function tdc_above_footer_widget_shortcode() {
    ob_start();
    tdc_render_above_footer_area();
    $output = ob_get_clean();
    return preg_replace('/>\s+</', '><', $output);
}
add_shortcode('tdc_above_footer_widget', 'tdc_above_footer_widget_shortcode');

