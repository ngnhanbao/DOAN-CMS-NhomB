<?php
/**
 * Custom Widget hiển thị danh sách bài viết theo thiết kế (Thumbnail bên trái, tiêu đề bên phải)
 * Dành cho phần "Đừng bỏ lỡ" hoặc tương tự.
 */
class TDC_Widget_Custom_News extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tdc_widget_custom_news',
            'TDC Custom News (Đừng bỏ lỡ)',
            array('description' => 'Hiển thị bài viết với thumbnail bên trái, tiêu đề bên phải.')
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? $instance['title'] : '';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;

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
            echo '<style>
                .tdc-widget-custom-news-list {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    font-family: Arial, sans-serif;
                }
                .tdc-widget-custom-news-item {
                    display: flex;
                    align-items: flex-start;
                    gap: 15px;
                    padding-bottom: 15px;
                    border-bottom: 1px solid #eee;
                }
                .tdc-widget-custom-news-item:last-child {
                    border-bottom: none;
                    padding-bottom: 0;
                }
                .tdc-widget-custom-news-thumb {
                    width: 140px;
                    height: 90px;
                    flex-shrink: 0;
                    overflow: hidden;
                }
                .tdc-widget-custom-news-thumb img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }
                .tdc-widget-custom-news-title {
                    font-size: 16px;
                    line-height: 1.4;
                    margin: 0;
                    font-weight: 500;
                }
                .tdc-widget-custom-news-title a {
                    color: #333;
                    text-decoration: none;
                }
                .tdc-widget-custom-news-title a:hover {
                    color: #0056b3;
                }
            </style>';

            echo '<div class="tdc-widget-custom-news-list">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();

                echo '<div class="tdc-widget-custom-news-item">';
                echo '  <div class="tdc-widget-custom-news-thumb">';
                
                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(null, 'medium') . '</a>';
                } else {
                    echo '<a href="' . get_permalink() . '"><img src="' . get_theme_file_uri('assets/images/placeholder.webp') . '" alt=""></a>';
                }
                
                echo '  </div>';
                echo '  <h4 class="tdc-widget-custom-news-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                echo '</div>';
            }
            wp_reset_postdata();
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề (để trống nếu không muốn hiển thị):</label>
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
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        return $instance;
    }
}

function register_tdc_widget_custom_news()
{
    register_widget('TDC_Widget_Custom_News');
}
add_action('widgets_init', 'register_tdc_widget_custom_news');
