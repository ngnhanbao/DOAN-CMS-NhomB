<?php
/**
 * Custom Widget hiển thị danh sách dạng đánh số 2 cột (Giống VnExpress Xem nhiều)
 * Áp dụng cho (11) Archive / Bài viết mới nhất
 */
class TDC_Numbered_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tdc_numbered_posts',
            'TDC Numbered Posts (VnExpress Style)',
            array('description' => 'Hiển thị danh sách bài viết mới (hoặc Archive) dạng đánh số lớn 2 cột.')
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? $instance['title'] : 'Xem nhiều';
        $number = !empty($instance['number']) ? absint($instance['number']) : 8;

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
                .tdc-numbered-widget {
                    font-family: Arial, sans-serif;
                    margin-bottom: 25px;
                }
                .tdc-numbered-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 0 30px;
                }
                .tdc-numbered-item {
                    display: flex;
                    align-items: flex-start;
                    padding: 12px 0;
                    border-bottom: 1px solid #f0f0f0;
                }
                .tdc-numbered-item.no-border {
                    border-bottom: none;
                }
                .tdc-numbered-rank {
                    font-size: 38px;
                    font-weight: bold;
                    font-family: Georgia, "Times New Roman", serif;
                    color: #111;
                    margin-right: 15px;
                    line-height: 0.8;
                    margin-top: 4px;
                    min-width: 25px;
                }
                .tdc-numbered-content {
                    flex: 1;
                }
                .tdc-numbered-content a {
                    color: #444;
                    text-decoration: none;
                    font-size: 14px;
                    line-height: 1.4;
                    display: block;
                }
                .tdc-numbered-content a:hover {
                    color: #0056b3;
                }
                @media (max-width: 768px) {
                    .tdc-numbered-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>';

            echo '<div class="tdc-numbered-widget">';
            echo '  <div class="tdc-numbered-grid">';
            
            $count = 1;
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                
                // Hide bottom border for the last row (if 2 cols, it's the last 2 items)
                $no_border_class = ($count > $number - 2) ? ' no-border' : '';
                
                echo '    <div class="tdc-numbered-item' . $no_border_class . '">';
                echo '      <div class="tdc-numbered-rank">' . $count . '</div>';
                echo '      <div class="tdc-numbered-content">';
                echo '          <a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                echo '      </div>';
                echo '    </div>';
                
                $count++;
            }
            wp_reset_postdata();

            echo '  </div>';
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Xem nhiều';
        $number = !empty($instance['number']) ? absint($instance['number']) : 8;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Số lượng bài hiển thị:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="2"
                   value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 8;
        return $instance;
    }
}

function register_tdc_numbered_posts_widget()
{
    register_widget('TDC_Numbered_Posts_Widget');
}
add_action('widgets_init', 'register_tdc_numbered_posts_widget');
