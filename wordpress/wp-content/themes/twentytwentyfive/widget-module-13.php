<?php


class TDC_Module_13_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tdc_module_13_widget',
            'Module 13 - Posts Column',
            array('description' => 'Hiển thị bài viết dạng cột (Tiêu đề, Ảnh, Mô tả) cho Sidebar #13.')
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
                .tdc-module-13-list {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 30px;
                    font-family: Arial, sans-serif;
                }
                @media (max-width: 991px) {
                    .tdc-module-13-list {
                        grid-template-columns: 1fr;
                    }
                }
                .tdc-module-13-item {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                .tdc-module-13-title {
                    font-size: 15px;
                    margin: 0;
                    color: #555;
                    font-weight: 600;
                    padding-bottom: 8px;
                    position: relative;
                }
                .tdc-module-13-title::after {
                    content: "";
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 35px;
                    height: 2px;
                    background-color: #ccc;
                }
                .tdc-module-13-title a {
                    color: #555;
                    text-decoration: none;
                }
                .tdc-module-13-title a:hover {
                    color: #0056b3;
                }
                .tdc-module-13-thumb {
                    width: 100%;
                    aspect-ratio: 16 / 9;
                    overflow: hidden;
                    background: #f5f5f5;
                    border: 1px solid #eaeaea;
                }
                     .tdc-module-13-thumb img {
                    width: 100%;
                    height: 100%;
                    display: block;
                    object-fit: cover;
                }
                .tdc-module-13-excerpt {
                    font-size: 13px;
                    color: #666;
                    line-height: 1.5;
                    margin: 0;
                }
            </style>';
            echo '<div class="tdc-module-13-list">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                echo '<div class="tdc-module-13-item">';
                echo '  <h4 class="tdc-module-13-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
                echo '  <div class="tdc-module-13-thumb">';

                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(null, 'medium') . '</a>';
                } else {
                    echo '<a href="' . get_permalink() . '"><img src="' . get_theme_file_uri('assets/images/placeholder.webp') . '" alt="" style="min-height: 150px;"></a>';
                }

                echo '  </div>';
                echo '  <p class="tdc-module-13-excerpt">' . wp_trim_words(get_the_excerpt(), 25, '...') . '</p>';
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
function register_tdc_module_13_widget()
{
    register_widget('TDC_Module_13_Widget');
}
add_action('widgets_init', 'register_tdc_module_13_widget');