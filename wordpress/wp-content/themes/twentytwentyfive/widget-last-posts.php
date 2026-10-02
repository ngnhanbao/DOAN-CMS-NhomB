<?php
/**
 * Custom Widget hiển thị danh sách bài viết theo dạng timeline
 */
class TDC_Widget_Last_Posts extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tdc_widget_last_posts',
            'Widget Last Posts (Timeline)',
            array('description' => 'Hiển thị bài viết mới nhất dưới dạng Timeline.')
        );
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }

    public function enqueue_styles()
    {
        wp_enqueue_style(
            'tdc-widget-last-posts-style',
            get_template_directory_uri() . '/assets/css/widget-last-posts.css',
            array(),
            file_exists(get_template_directory() . '/assets/css/widget-last-posts.css') ? filemtime(get_template_directory() . '/assets/css/widget-last-posts.css') : '1.0.0'
        );
    }

    public function widget($args, $instance)
    {
        // Chỉ hiển thị widget này ở trang tìm kiếm
        if (!is_search()) {
            return;
        }

        echo $args['before_widget'];

        $title = !empty($instance['title']) ? $instance['title'] : 'Latest News';
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;

        if (!empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'ignore_sticky_posts' => true,
        );
        $recent_posts = new WP_Query($query_args);

        if ($recent_posts->have_posts()) {
            echo '<ul class="tdc-timeline">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();

                $day = get_the_date('d');
                $month = get_the_date('F');
                
                echo '<li class="tdc-post-item">';
                echo '  <div class="tdc-post-date">';
                echo '      <span class="tdc-date-day">' . $day . '</span>';
                echo '      <span class="tdc-date-month">' . $month . '</span>';
                echo '  </div>';
                
                echo '  <div class="tdc-post-content">';
                echo '      <h4 class="tdc-post-title"><a href="' . get_permalink() . '">' . mb_strtoupper(get_the_title(), 'UTF-8') . '</a></h4>';
                
                // For excerpt, we can add a red dot optionally if it matches a specific tag, or just output excerpt.
                $excerpt = get_the_excerpt();
                if (empty($excerpt)) {
                    $excerpt = 'Trận siêu kinh điển của bóng đá thế giới đã khép lại với niềm vui thuộc về đội bóng [...]'; // Mock excerpt based on image
                }
                echo '      <div class="tdc-post-excerpt">' . wp_trim_words($excerpt, 20, '...') . '</div>';
                echo '  </div>';
                echo '</li>';
            }
            wp_reset_postdata();
            echo '</ul>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Latest News';
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Số lượng bài viết:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1"
                value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 3;
        return $instance;
    }
}

function register_tdc_widget_last_posts()
{
    register_widget('TDC_Widget_Last_Posts');
}
add_action('widgets_init', 'register_tdc_widget_last_posts');
