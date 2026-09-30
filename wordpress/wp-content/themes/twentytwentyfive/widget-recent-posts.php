<?php
/**
 * Custom Widget cho Recent Posts (Bài viết mới nhất) theo thiết kế
 */
class TDC_Custom_Recent_Posts_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'tdc_custom_recent_posts',
            'TDC Recent Posts (Tùy chỉnh)',
            array('description' => 'Hiển thị bài viết mới nhất với giao diện tùy chỉnh (Nền xanh, cột ngày tháng bên trái).')
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? $instance['title'] : '';
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
            echo '<style>
                @import url("https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@100..900&display=swap");
                .tdc-recent-posts-widget {
                    background-color: #55b5b1;
                    color: #fff;
                    font-family: sans-serif;
                }
                .tdc-recent-posts-list {
                    padding: 20px;
                }                
                .smooch-sans-400 {
                    font-family: "Smooch Sans", sans-serif;
                    font-optical-sizing: auto;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 25px;
                }
                .tdc-recent-post-item {
                    display: flex;
                    align-items: center;
                    margin-bottom: 20px;
                }
                .tdc-recent-post-item:last-child {
                    margin-bottom: 0;
                }
                .tdc-recent-posts-widget .tdc-recent-post-date {
                    display: flex;
                    align-items: center;
                    margin-right: 20px;
                    font-size: 15px;
                    line-height: 1.1;
                }
                .tdc-recent-posts-widget .tdc-date-left {
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                }
                .tdc-recent-posts-widget .tdc-date-day {
                    font-size: 30px;
                    font-weight: 800;
                    font-family: serif;
                    color: #ffffff;
                    padding-bottom: 3px;
                }
                .tdc-recent-posts-widget .tdc-date-month {
                    font-size: 30px;
                    font-weight: 800;
                    font-family: serif;
                    color: #ffffff;
                    padding-top: 3px;
                    border-top: 1px solid #fff;
                }
                .tdc-recent-posts-widget .tdc-date-year {
                    font-size: 30px;
                    font-weight: 800;
                    font-family: serif;
                    color: #ffffff;
                    margin-left: 5px;
                }
                .tdc-recent-post-title {
                    flex: 1;
                }
                .tdc-recent-post-title a {
                    color: #fff;
                    text-decoration: none;
                    line-height: 1.4;
                }
                .tdc-recent-post-title a:hover {
                    text-decoration: underline;
                }
                .tdc-recent-posts-all {
                    background-color: rgba(255, 255, 255, 0.15);
                    text-align: center;
                    padding: 20px;
                }
                .tdc-recent-posts-all a {
                    color: #fff;
                    font-weight: bold;
                    text-decoration: none;
                    text-transform: uppercase;
                    font-size: 14px;
                    display: block;
                }
            </style>';

            echo '<div class="tdc-recent-posts-widget">';
            echo '  <div class="tdc-recent-posts-list">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();

                $day = get_the_time('d');
                $month = get_the_time('m');
                $year = get_the_time('y');

                echo '    <div class="tdc-recent-post-item">';
                echo '      <div class="tdc-recent-post-date">';
                echo '          <div class="tdc-date-left">';
                echo '              <span class="tdc-date-day ">' . $day . '</span>';
                echo '              <span class="tdc-date-month ">' . $month . '</span>';
                echo '          </div>';
                echo '          <span class="tdc-date-year ">- ' . $year . '</span>';
                echo '      </div>';
                echo '      <div class="tdc-recent-post-title smooch-sans-400">';
                echo '          <a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                echo '      </div>';
                echo '    </div>';
            }
            wp_reset_postdata();
            echo '  </div>';

            $posts_page_id = get_option('page_for_posts');
            $all_news_link = $posts_page_id ? get_permalink($posts_page_id) : home_url('/?post_type=post');

            echo '  <div class="tdc-recent-posts-all">';
            echo '      <a href="' . esc_url($all_news_link) . '">XEM TẤT CẢ TIN TỨC</a>';
            echo '  </div>';
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề (để trống nếu không muốn hiển
                thị):</label>
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

function register_tdc_custom_recent_posts_widget()
{
    register_widget('TDC_Custom_Recent_Posts_Widget');
}
add_action('widgets_init', 'register_tdc_custom_recent_posts_widget');
