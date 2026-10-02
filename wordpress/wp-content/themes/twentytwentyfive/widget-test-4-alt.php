<?php
// Kiểm tra nếu gọi trực tiếp thì exit
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// widget_test_4_alt (Dành cho giao diện Đừng bỏ lỡ)
function register_widget_test_4_alt_sidebar() {
    register_sidebar( array(
        'name'          => 'Phía trên Footer (Đừng bỏ lỡ)',
        'id'            => 'sidebar-above-footer-alt',
        'description'   => 'Khu vực hiển thị widget Đừng bỏ lỡ phía trên Footer',
        'before_widget' => '<div id="%1$s" class="widget widget-test-4-item %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title" style="display:none;">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_widget_test_4_alt_sidebar' );


function render_widget_test_4_alt_html( $custom_title = 'Đừng bỏ lỡ', $posts_count = 9 ) {
    $title = ! empty( $custom_title ) ? $custom_title : 'Đừng bỏ lỡ';
    $count = ! empty( $posts_count ) ? intval( $posts_count ) : 9;

    $query = new WP_Query( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    $output = '<div class="wt4-container">';
    $output .= '<h2 class="wt4-header"><span class="wt4-header-text">' . esc_html( $title ) . '</span></h2>';
    $output .= '<div class="wt4-grid">';

    $index = 1;

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_title = get_the_title();
            $post_link  = get_permalink();

            $output .= '<div class="wt4-item">';
            $output .= '    <span class="wt4-number">' . $index . '</span>';
            $output .= '    <div class="wt4-content">';
            $output .= '        <h3 class="wt4-title"><a href="' . esc_url( $post_link ) . '" title="' . esc_attr( $post_title ) . '">' . esc_html( $post_title ) . '</a></h3>';
            $output .= '    </div>';
            $output .= '</div>';

            $index++;
        }
        wp_reset_postdata();
    }

    $output .= '</div>'; // .wt4-grid
    $output .= '</div>'; // .wt4-container

    return $output;
}

// 2. Tạo Widget có tên: Widget_Test_4_Alt
class Widget_Test_4_Alt extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_test_4_alt', // Base ID của widget
            'widget_test_4_alt', // Tên widget hiển thị trong Dashboard
            array(
                'description' => 'Widget Đừng bỏ lỡ hiển thị 9 bài viết'
            )
        );
    }

    // Hiển thị nội dung Widget ra ngoài giao diện
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Đừng bỏ lỡ';
        $posts_count = ! empty( $instance['posts'] ) ? intval( $instance['posts'] ) : 9;

        echo render_widget_test_4_alt_html( $title, $posts_count );
        echo $args['after_widget'];
    }

    // Form cấu hình trong Admin
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Đừng bỏ lỡ';
        $posts = ! empty( $instance['posts'] ) ? $instance['posts'] : 9;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                   type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>">Số lượng bài viết (mặc định 9):</label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" 
                   name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>" 
                   type="number" step="1" min="1" max="30" value="<?php echo esc_attr( $posts ); ?>" size="3">
        </p>
        <p><small>Bài viết mới nhất.</small></p>
        <?php
    }

    // Cập nhật cấu hình
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : 'Đừng bỏ lỡ';
        $instance['posts'] = ( ! empty( $new_instance['posts'] ) ) ? absint( $new_instance['posts'] ) : 9;
        return $instance;
    }
}

// Đăng ký Widget_Test_4_Alt với WordPress
function register_custom_widget_test_4_alt() {
    register_widget( 'Widget_Test_4_Alt' );
}
add_action( 'widgets_init', 'register_custom_widget_test_4_alt' );

// Hàm được footer gọi để hiển thị (tùy chọn)
function tdc_render_above_footer_area_alt() {
    // Hiển thị khung của Widget Test 4 (Đừng bỏ lỡ)
    echo '<section id="above-footer-area-alt" class="widget-test-4-above-footer-section" style="margin-bottom:40px; padding:20px 0;">';
    echo '<div class="container">';
    echo '<div class="widget-test-4-container">';
    
    // Kiểm tra xem user có kéo widget vào sidebar 'sidebar-above-footer-alt' chưa
    if (is_active_sidebar('sidebar-above-footer-alt')) {
        dynamic_sidebar('sidebar-above-footer-alt');
    } else {
        // Nếu chưa kéo, render mặc định widget
        the_widget('Widget_Test_4_Alt');
    }
    
    echo '</div>';
    echo '</div>';
    echo '</section>';
}
