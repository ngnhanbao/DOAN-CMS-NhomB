<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

if (!function_exists('twentytwentyfive_post_format_setup')):
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup()
	{
		add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
	}
endif;
add_action('after_setup_theme', 'twentytwentyfive_post_format_setup');

if (!function_exists('twentytwentyfive_editor_style')):
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style()
	{
		add_editor_style('assets/css/editor-style.css');
	}
endif;
add_action('after_setup_theme', 'twentytwentyfive_editor_style');

if (!function_exists('twentytwentyfive_enqueue_styles')):
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles()
	{
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri($src),
			array(),
			wp_get_theme()->get('Version')
		);
		wp_style_add_data(
			'twentytwentyfive-style',
			'path',
			get_parent_theme_file_path($src)
		);
	}
endif;
add_action('wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles');

if (!function_exists('twentytwentyfive_block_styles')):
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles()
	{
		register_block_style(
			'core/list',
			array(
				'name' => 'checkmark-list',
				'label' => __('Checkmark', 'twentytwentyfive'),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action('init', 'twentytwentyfive_block_styles');

if (!function_exists('twentytwentyfive_pattern_categories')):
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories()
	{

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label' => __('Pages', 'twentytwentyfive'),
				'description' => __('A collection of full page layouts.', 'twentytwentyfive'),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label' => __('Post formats', 'twentytwentyfive'),
				'description' => __('A collection of post format patterns.', 'twentytwentyfive'),
			)
		);
	}
endif;
add_action('init', 'twentytwentyfive_pattern_categories');

if (!function_exists('twentytwentyfive_register_block_bindings')):
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings()
	{
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label' => _x('Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive'),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action('init', 'twentytwentyfive_register_block_bindings');

if (!function_exists('twentytwentyfive_format_binding')):
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding()
	{
		$post_format_slug = get_post_format();

		if ($post_format_slug && 'standard' !== $post_format_slug) {
			return get_post_format_string($post_format_slug);
		}
	}
endif;

/**
 * Load assets for Group C custom header.
 */
function group_c_enqueue_assets()
{

	// Bootstrap CSS
	wp_enqueue_style(
		'group-c-bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
		array(),
		'5.3.3'
	);

	// Bootstrap JS
	wp_enqueue_script(
		'group-c-bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.3',
		true
	);

	// Font Awesome
	wp_enqueue_style(
		'group-c-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);

	// Custom Header CSS
	wp_enqueue_style(
		'group-c-header',
		get_template_directory_uri() . '/assets/css/group-c-header.css',
		array(),
		'1.0.0'
	);


	// Custom Search Form CSS
	wp_enqueue_style(
		'group-c-search',
		get_template_directory_uri() . '/assets/css/group-c-search.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-search.css') ? filemtime(get_template_directory() . '/assets/css/group-c-search.css') : '1.0.0'
	);

	// Custom Footer CSS
	wp_enqueue_style(
		'group-c-footer',
		get_template_directory_uri() . '/assets/css/group-c-footer.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-footer.css') ? filemtime(get_template_directory() . '/assets/css/group-c-footer.css') : '1.0.0'
	);

	// Custom Post Detail CSS
	wp_enqueue_style(
		'group-c-detail',
		get_template_directory_uri() . '/assets/css/group-c-detail.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-detail.css') ? filemtime(get_template_directory() . '/assets/css/group-c-detail.css') : '1.0.0'
	);

	// Custom Comments Form CSS
	wp_enqueue_style(
		'group-c-comments',
		get_template_directory_uri() . '/assets/css/group-c-comments.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-comments.css') ? filemtime(get_template_directory() . '/assets/css/group-c-comments.css') : '1.0.1'
	);

	// Custom Categories List CSS (Module #9)
	wp_enqueue_style(
		'group-c-categories',
		get_template_directory_uri() . '/assets/css/group-c-categories.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-categories.css') ? filemtime(get_template_directory() . '/assets/css/group-c-categories.css') : '1.0.0'
	);
}

add_action('wp_enqueue_scripts', 'group_c_enqueue_assets');

function my_custom_widgets_init()
{
	register_sidebar(array(
		'name' => 'Khu vực Widget của tôi', // Tên hiển thị trong trang quản trị
		'id' => 'my-custom-sidebar', // ID dùng để gọi ra template
		'description' => 'Thêm các widget vào đây để hiển thị ra ngoài website.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	// Sidebar Phía trên Footer
	register_sidebar(array(
		'name'          => 'Phía trên Footer',
		'id'            => 'above-footer',
		'description'   => 'Khu vực Widget hiển thị phía trên Footer.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	// Sidebar dành riêng cho cột Trái của Trang chi tiết (Categories #9)
	register_sidebar(array(
		'name' => 'Sidebar Chi tiết - Trái (Categories #9)',
		'id' => 'sidebar-detail-left',
		'description' => 'Kéo thả widget Categories List vào đây để hiển thị ở cột bên trái trang chi tiết.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	// Sidebar dành riêng cho cột Phải của Trang chi tiết (Recent Post #10)
	register_sidebar(array(
		'name' => 'Sidebar Chi tiết - Phải (Recent Post #10)',
		'id' => 'sidebar-detail-right',
		'description' => 'Kéo thả widget Recent Posts vào đây để hiển thị ở cột bên phải trang chi tiết.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	// --- CÁC KHU VỰC WIDGET CHO FOOTER (MODULE #3) ---
	// Footer #1 (Cột 1)
	register_sidebar(array(
		'name'          => 'Footer #1',
		'id'            => 'footer-1',
		'description'   => 'Khu vực Widget cho Cột 1 của Footer (Mặc định: Quick links)',
		'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));

	// Footer #2 (Cột 2)
	register_sidebar(array(
		'name'          => 'Footer #2',
		'id'            => 'footer-2',
		'description'   => 'Khu vực Widget cho Cột 2 của Footer (Mặc định: Quick links)',
		'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));

	// Footer #3 (Cột 3)
	register_sidebar(array(
		'name'          => 'Footer #3',
		'id'            => 'footer-3',
		'description'   => 'Khu vực Widget cho Cột 3 của Footer (Mặc định: Quick links)',
		'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));
}
// Móc hàm my_custom_widgets_init vào hook widgets_init của WordPress
add_action('widgets_init', 'my_custom_widgets_init');

// Kích hoạt hỗ trợ Widgets trong bảng điều khiển Quản trị (wp-admin)
function twentytwentyfive_enable_widgets_support()
{
	add_theme_support('widgets');
	add_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'twentytwentyfive_enable_widgets_support');

// Nạp stylesheet Categories, Comments & Footer vào Admin để xem trước trong màn hình Widgets
function group_c_admin_category_assets($hook)
{
	if ($hook === 'widgets.php' || $hook === 'customize.php') {
		wp_enqueue_style(
			'group-c-categories-admin',
			get_template_directory_uri() . '/assets/css/group-c-categories.css',
			array(),
			file_exists(get_template_directory() . '/assets/css/group-c-categories.css') ? filemtime(get_template_directory() . '/assets/css/group-c-categories.css') : '1.0.0'
		);
		wp_enqueue_style(
			'group-c-footer-admin',
			get_template_directory_uri() . '/assets/css/group-c-footer.css',
			array(),
			file_exists(get_template_directory() . '/assets/css/group-c-footer.css') ? filemtime(get_template_directory() . '/assets/css/group-c-footer.css') : '1.0.0'
		);
		wp_enqueue_style(
			'group-c-comments-admin',
			get_template_directory_uri() . '/assets/css/group-c-comments.css',
			array(),
			file_exists(get_template_directory() . '/assets/css/group-c-comments.css') ? filemtime(get_template_directory() . '/assets/css/group-c-comments.css') : '1.0.0'
		);
	}
}
add_action('admin_enqueue_scripts', 'group_c_admin_category_assets');
add_action('enqueue_block_editor_assets', function () {
	wp_enqueue_style(
		'group-c-categories-block-editor',
		get_template_directory_uri() . '/assets/css/group-c-categories.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-categories.css') ? filemtime(get_template_directory() . '/assets/css/group-c-categories.css') : '1.0.0'
	);
	wp_enqueue_style(
		'group-c-footer-block-editor',
		get_template_directory_uri() . '/assets/css/group-c-footer.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-footer.css') ? filemtime(get_template_directory() . '/assets/css/group-c-footer.css') : '1.0.0'
	);
	wp_enqueue_style(
		'group-c-comments-block-editor',
		get_template_directory_uri() . '/assets/css/group-c-comments.css',
		array(),
		file_exists(get_template_directory() . '/assets/css/group-c-comments.css') ? filemtime(get_template_directory() . '/assets/css/group-c-comments.css') : '1.0.0'
	);
});

// --- WIDGET QUICK LINKS CHO BẢNG ĐIỀU KHIỂN ADMIN (FOOTER MODULE #3) ---
class TDC_Quick_Links_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'tdc_quick_links_widget',
			'Liên kết nhanh - Quick Links',
			array('description' => 'Hiển thị danh sách liên kết nhanh Quick links với mũi tên kép chuẩn giao diện Footer.')
		);
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : 'Quick links';
		$links = !empty($instance['links']) ? $instance['links'] : "Home | /\nAbout | #\nFAQ | #\nGet Started | #\nVideos | #";
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
				name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
				value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('links')); ?>">Danh sách liên kết (mỗi dòng một mục: <code>Tên | URL</code>):</label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('links')); ?>"
				name="<?php echo esc_attr($this->get_field_name('links')); ?>" rows="6"><?php echo esc_textarea($links); ?></textarea>
		</p>
		<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : 'Quick links';
		$instance['links'] = (!empty($new_instance['links'])) ? sanitize_textarea_field($new_instance['links']) : '';
		return $instance;
	}

	public function widget($args, $instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : 'Quick links';
		$links_text = !empty($instance['links']) ? $instance['links'] : "Home | /\nAbout | #\nFAQ | #\nGet Started | #\nVideos | #";

		echo $args['before_widget'];
		echo '<h5 class="widget-title">' . esc_html($title) . '</h5>';
		echo '<ul class="list-unstyled quick-links">';

		$lines = explode("\n", $links_text);
		foreach ($lines as $line) {
			$line = trim($line);
			if (empty($line)) continue;
			$parts = explode('|', $line, 2);
			$label = trim($parts[0]);
			$url   = isset($parts[1]) ? trim($parts[1]) : '#';
			if ($url === '/') $url = home_url('/');

			echo '<li>';
			echo '  <a href="' . esc_url($url) . '">';
			echo '    <i class="fa-solid fa-angles-right arrow-icon"></i>' . esc_html($label);
			echo '  </a>';
			echo '</li>';
		}

		echo '</ul>';
		echo $args['after_widget'];
	}
}

function register_tdc_quick_links_widget()
{
	register_widget('TDC_Quick_Links_Widget');
}
add_action('widgets_init', 'register_tdc_quick_links_widget');

// Tạo shortcode [tdc_news] để hiển thị danh sách bài viết như thiết kế
function tdc_custom_news_shortcode($atts)
{
	$atts = shortcode_atts(array(
		'posts' => 5, // Số lượng bài viết
	), $atts, 'tdc_news');

	$query = new WP_Query(array(
		'post_type' => 'post',
		'posts_per_page' => $atts['posts'],
		'post_status' => 'publish',
	));

	if (!$query->have_posts()) {
		return '<p>Không có bài viết nào.</p>';
	}

	// CSS được nhúng trực tiếp để đảm bảo hiển thị ngay lập tức
	$output = '<style>
        .tdc-news-list { display: flex; flex-direction: column; gap: 15px; font-family: sans-serif; }
        .tdc-news-item { display: flex; border: 1px solid #eaeaea; background: #fff; padding: 15px; align-items: stretch; }
        .tdc-news-date { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; border-right: 1px solid #eaeaea; padding-right: 20px; margin-right: 20px; min-width: 75px; }
        .tdc-day { font-size: 42px; font-weight: 700; font-family: "Times New Roman", Times, serif; line-height: 1; color: #333; }
        .tdc-month { font-size: 11px; text-transform: uppercase; color: #888; margin-top: 5px; letter-spacing: 0.5px; }
        .tdc-news-content { flex: 1; }
        .tdc-title { margin: 0 0 10px 0; font-size: 16px; line-height: 1.4; }
        .tdc-title a { color: #0056b3; text-decoration: none; text-transform: uppercase; font-weight: 700; }
        .tdc-title a:hover { color: #003d82; text-decoration: underline; }
        .tdc-excerpt { font-size: 14px; color: #555; line-height: 1.5; margin: 0; }
    </style>';

	$output .= '<div class="tdc-news-list">';

	while ($query->have_posts()) {
		$query->the_post();
		$day = get_the_time('d');
		$month = get_the_time('m');
		$title = get_the_title();
		$link = get_permalink();
		$excerpt = wp_trim_words(get_the_excerpt(), 20, ' [...]');

		$output .= '<div class="tdc-news-item">';
		$output .= '  <div class="tdc-news-date">';
		$output .= '    <span class="tdc-day">' . $day . '</span>';
		$output .= '    <span class="tdc-month">THÁNG ' . $month . '</span>';
		$output .= '  </div>';
		$output .= '  <div class="tdc-news-content">';
		$output .= '    <h3 class="tdc-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';
		$output .= '    <p class="tdc-excerpt">' . esc_html($excerpt) . '</p>';
		$output .= '  </div>';
		$output .= '</div>';
	}

	wp_reset_postdata();
	$output .= '</div>';

	return $output;
}
add_shortcode('tdc_news', 'tdc_custom_news_shortcode');

// --- TẠO WIDGET TRỰC QUAN TRONG BẢNG ĐIỀU KHIỂN ---
class TDC_News_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'tdc_news_widget', // ID cơ sở của widget
			'Danh sách Tin tức (TDC)', // Tên widget sẽ hiển thị
			array('description' => 'Kéo thả để hiển thị danh sách tin tức với ngày tháng lớn.')
		);
	}

	// Hiển thị widget ra ngoài trang web
	public function widget($args, $instance)
	{
		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}

		$posts_count = !empty($instance['posts']) ? $instance['posts'] : 5;

		$query = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => $posts_count,
			'post_status' => 'publish',
		));

		if ($query->have_posts()) {
			echo '<style>
                .tdc-news-list { display: flex; flex-direction: column; gap: 15px; font-family: sans-serif; }
                .tdc-news-item { display: flex; border: 1px solid #eaeaea; background: #fff; padding: 15px; align-items: stretch; }
                .tdc-news-date { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; border-right: 1px solid #eaeaea; padding-right: 20px; margin-right: 20px; min-width: 75px; }
                .tdc-day { font-size: 42px; font-weight: 700; font-family: "Times New Roman", Times, serif; line-height: 1; color: #333; }
                .tdc-month { font-size: 11px; text-transform: uppercase; color: #888; margin-top: 5px; letter-spacing: 0.5px; }
                .tdc-news-content { flex: 1; }
                .tdc-title { margin: 0 0 10px 0; font-size: 16px; line-height: 1.4; }
                .tdc-title a { color: #0056b3; text-decoration: none; text-transform: uppercase; font-weight: 700; }
                .tdc-title a:hover { color: #003d82; text-decoration: underline; }
                .tdc-excerpt { font-size: 14px; color: #555; line-height: 1.5; margin: 0; }
            </style>';

			echo '<div class="tdc-news-list">';
			while ($query->have_posts()) {
				$query->the_post();
				$day = get_the_time('d');
				$month = get_the_time('m');
				$title = get_the_title();
				$link = get_permalink();
				$excerpt = wp_trim_words(get_the_excerpt(), 20, ' [...]');

				echo '<div class="tdc-news-item">';
				echo '  <div class="tdc-news-date">';
				echo '    <span class="tdc-day">' . $day . '</span>';
				echo '    <span class="tdc-month">THÁNG ' . $month . '</span>';
				echo '  </div>';
				echo '  <div class="tdc-news-content">';
				echo '    <h3 class="tdc-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';
				echo '    <p class="tdc-excerpt">' . esc_html($excerpt) . '</p>';
				echo '  </div>';
				echo '</div>';
			}
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<p>Không có bài viết nào.</p>';
		}

		echo $args['after_widget'];
	}

	// Form cấu hình trong trang quản trị
	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : 'Tin mới nhất';
		$posts = !empty($instance['posts']) ? $instance['posts'] : 5;
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề Widget:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
				name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
				value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts')); ?>">Số lượng bài viết hiển thị:</label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts')); ?>"
				name="<?php echo esc_attr($this->get_field_name('posts')); ?>" type="number" step="1" min="1"
				value="<?php echo esc_attr($posts); ?>" size="3">
		</p>
		<?php
	}

	// Lưu dữ liệu cập nhật
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['posts'] = (!empty($new_instance['posts'])) ? absint($new_instance['posts']) : 5;
		return $instance;
	}
}

// Đăng ký Widget với WordPress
function register_tdc_news_widget()
{
	register_widget('TDC_News_Widget');
}
add_action('widgets_init', 'register_tdc_news_widget');

// --- WIDGET CATEGORIES CHO BẢNG ĐIỀU KHIỂN ADMIN (MODULE #9) ---
class TDC_Categories_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct(
			'tdc_categories_widget',
			'Chuyên mục - Categories List (TDC #9)',
			array('description' => 'Hiển thị danh sách chuyên mục chuẩn giao diện FIT TDC với dải sọc và chấm vàng.')
		);
	}

	public function form($instance)
	{
		$title   = !empty($instance['title']) ? $instance['title'] : 'Categories';
		$number  = !empty($instance['number']) ? $instance['number'] : 10;
		$orderby = !empty($instance['orderby']) ? $instance['orderby'] : 'name';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
				name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
				value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Số lượng chuyên mục:</label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
				name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number"
				value="<?php echo esc_attr($number); ?>" min="1" max="50">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>">Sắp xếp theo:</label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>"
				name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
				<option value="name" <?php selected($orderby, 'name'); ?>>Tên (A-Z)</option>
				<option value="id" <?php selected($orderby, 'id'); ?>>Thứ tự tạo (ID)</option>
				<option value="count" <?php selected($orderby, 'count'); ?>>Số lượng bài viết</option>
			</select>
		</p>
		<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title']   = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : 'Categories';
		$instance['number']  = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 10;
		$instance['orderby'] = (!empty($new_instance['orderby'])) ? sanitize_text_field($new_instance['orderby']) : 'name';
		return $instance;
	}

	public function widget($args, $instance)
	{
		$title   = !empty($instance['title']) ? $instance['title'] : 'Categories';
		$number  = !empty($instance['number']) ? $instance['number'] : 10;
		$orderby = !empty($instance['orderby']) ? $instance['orderby'] : 'name';

		echo $args['before_widget'];
		echo tdc_categories_render_html(array(
			'title'   => $title,
			'number'  => $number,
			'orderby' => $orderby,
		));
		echo $args['after_widget'];
	}
}

function register_tdc_categories_widget()
{
	register_widget('TDC_Categories_Widget');
}
add_action('widgets_init', 'register_tdc_categories_widget');

/**
 * Hàm dựng giao diện Categories Card (Module #9) chuẩn thiết kế FIT TDC
 */
function tdc_categories_render_html($args = array())
{
	$title   = !empty($args['title']) ? $args['title'] : 'Categories';
	$number  = !empty($args['number']) ? absint($args['number']) : 10;
	$orderby = !empty($args['orderby']) ? $args['orderby'] : 'name';

	$categories = get_categories(array(
		'number'     => $number,
		'orderby'    => $orderby,
		'order'      => 'ASC',
		'hide_empty' => false,
		'exclude'    => array(1), // Ẩn chuyên mục mặc định 'Uncategorized' nếu có các chuyên mục khác
	));

	if (empty($categories)) {
		$categories = get_categories(array(
			'number'     => $number,
			'orderby'    => $orderby,
			'order'      => 'ASC',
			'hide_empty' => false,
		));
	}

	$html = '<div class="tdc-categories-card">';
	$html .= '  <h3 class="tdc-categories-title">' . esc_html($title) . '</h3>';
	$html .= '  <div class="tdc-stripe-divider"></div>';
	$html .= '  <ul class="tdc-categories-list">';

	if (!empty($categories)) {
		foreach ($categories as $cat) {
			$html .= '<li>';
			$html .= '  <span class="tdc-bullet"></span>';
			$html .= '  <a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
			$html .= '</li>';
		}
	} else {
		$html .= '<li><span class="tdc-bullet"></span><span>' . esc_html__('Chưa có chuyên mục', 'twentytwentyfive') . '</span></li>';
	}

	$html .= '  </ul>';
	$html .= '</div>';

	return $html;
}

/**
 * Shortcode [tdc_categories] cho Categories List (Module #9)
 */
function tdc_categories_shortcode($atts)
{
	$atts = shortcode_atts(array(
		'title'   => 'Categories',
		'number'  => 10,
		'orderby' => 'name',
	), $atts, 'tdc_categories');

	return tdc_categories_render_html($atts);
}
add_shortcode('tdc_categories', 'tdc_categories_shortcode');

/**
 * Shortcode [tdc_sidebar_detail_left] cho cột bên trái trang chi tiết
 * Hiển thị widget trong sidebar-detail-left nếu có, hoặc mặc định hiển thị Categories Card
 */
function tdc_sidebar_detail_left_shortcode()
{
	ob_start();
	if (is_active_sidebar('sidebar-detail-left')) {
		dynamic_sidebar('sidebar-detail-left');
	} else {
		echo tdc_categories_render_html();
	}
	return ob_get_clean();
}
add_shortcode('tdc_sidebar_detail_left', 'tdc_sidebar_detail_left_shortcode');

/**
 * Shortcode [tdc_sidebar_detail_right] cho cột bên phải trang chi tiết
 * Hiển thị widget trong sidebar-detail-right nếu có, hoặc mặc định hiển thị Recent Posts
 */
function tdc_sidebar_detail_right_shortcode()
{
	ob_start();
	if (is_active_sidebar('sidebar-detail-right')) {
		dynamic_sidebar('sidebar-detail-right');
	} else {
		the_widget('TDC_Custom_Recent_Posts_Widget', array('number' => 3));
	}
	return ob_get_clean();
}
add_shortcode('tdc_sidebar_detail_right', 'tdc_sidebar_detail_right_shortcode');

/**
 * Bộ lọc render_block cho core/categories:
 * Đảm bảo bất kể khi nào người dùng thêm Block "Categories List" trong Widget Admin hay Gutenberg,
 * nó đều tự động hiển thị chuẩn giao diện FIT TDC với dải sọc và chấm vàng.
 */
add_filter('render_block', function ($block_content, $block) {
	if (isset($block['blockName']) && $block['blockName'] === 'core/categories') {
		return tdc_categories_render_html();
	}
	return $block_content;
}, 10, 2);


// --- SHORTCODE HIỂN THỊ KẾT QUẢ TÌM KIẾM ---
function tdc_search_results_shortcode()
{
	$search_query = get_search_query();

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$query_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'paged'          => $paged
	);
	if (!empty($search_query)) {
		$query_args['s'] = $search_query;
	}
	$query = new WP_Query($query_args);

	if (!$query->have_posts()) {
		return '<div class="tdc-no-search-results" style="padding:25px;text-align:center;color:#666;background:#fff;border:1px solid #eaeaea;">Không tìm thấy bài viết nào phù hợp.</div>';
	}

	$output = '<style>
        .tdc-search-list { display: flex; flex-direction: column; gap: 20px; font-family: sans-serif; margin-top: 0; }
        .tdc-search-item { display: flex; border: 1px solid #eaeaea; background: #fff; align-items: stretch; }
        .tdc-search-thumbnail { width: 190px; min-width: 190px; flex-shrink: 0; }
        .tdc-search-thumbnail img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .tdc-search-content-wrapper { display: flex; padding: 15px 18px; flex: 1; align-items: stretch; min-width: 0; }
        .tdc-search-date { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; border-right: 1px solid #eaeaea; padding-right: 15px; margin-right: 15px; min-width: 65px; }
        .tdc-search-day { font-size: 38px; font-weight: 700; font-family: "Times New Roman", Times, serif; line-height: 1; color: #333; }
        .tdc-search-month { font-size: 11px; text-transform: uppercase; color: #888; margin-top: 5px; letter-spacing: 0.5px; }
        .tdc-search-text { flex: 1; min-width: 0; }
        .tdc-search-title { margin: 0 0 8px 0; font-size: 16px; line-height: 1.4; }
        .tdc-search-title a { color: #0056b3; text-decoration: none; text-transform: uppercase; font-weight: 700; }
        .tdc-search-title a:hover { color: #003d82; text-decoration: underline; }
        .tdc-search-excerpt { font-size: 13.5px; color: #555; line-height: 1.5; margin: 0; }
        
        @media (max-width: 768px) {
            .tdc-search-item { flex-direction: column; }
            .tdc-search-thumbnail { width: 100%; height: 200px; }
            .tdc-search-content-wrapper { flex-direction: column; }
            .tdc-search-date { border-right: none; border-bottom: 1px solid #eaeaea; padding-right: 0; padding-bottom: 15px; margin-right: 0; margin-bottom: 15px; flex-direction: row; gap: 10px; align-items: baseline; }
        }
        
        .tdc-pagination { display: flex; gap: 10px; margin-top: 30px; }
        .tdc-pagination a, .tdc-pagination span { padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #333; }
        .tdc-pagination span.current { background: #0056b3; color: white; border-color: #0056b3; }
    </style>';

	$output .= '<div class="tdc-search-list">';

	while ($query->have_posts()) {
		$query->the_post();
		$day = get_the_time('d');
		$month = get_the_time('m');
		$title = get_the_title();
		$link = get_permalink();
		$excerpt = wp_trim_words(get_the_excerpt(), 25, ' [...]');

		$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'medium_large') : get_theme_file_uri('assets/images/typewriter.webp');

		$output .= '<div class="tdc-search-item">';

		$output .= '  <div class="tdc-search-thumbnail">';
		$output .= '    <a href="' . esc_url($link) . '"><img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($title) . '"></a>';
		$output .= '  </div>';

		$output .= '  <div class="tdc-search-content-wrapper">';
		$output .= '    <div class="tdc-search-date">';
		$output .= '      <span class="tdc-search-day">' . $day . '</span>';
		$output .= '      <span class="tdc-search-month">THÁNG ' . $month . '</span>';
		$output .= '    </div>';
		$output .= '    <div class="tdc-search-text">';
		$output .= '      <h3 class="tdc-search-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h3>';
		$output .= '      <p class="tdc-search-excerpt">' . esc_html($excerpt) . '</p>';
		$output .= '    </div>';
		$output .= '  </div>';

		$output .= '</div>';
	}

	$output .= '</div>';

	$output .= '<div class="tdc-pagination">';
	$output .= paginate_links(array(
		'total' => $query->max_num_pages,
		'current' => $paged,
		'prev_text' => '&laquo; Trước',
		'next_text' => 'Sau &raquo;',
	));
	$output .= '</div>';

	wp_reset_postdata();
	return $output;
}
add_shortcode('tdc_search_results', 'tdc_search_results_shortcode');

/**
 * Filter search query title format for Group C search style
 */
add_filter('render_block', function($block_content, $block) {
    if (isset($block['blockName']) && $block['blockName'] === 'core/query-title' && isset($block['attrs']['type']) && $block['attrs']['type'] === 'search') {
        $query = get_search_query();
        return sprintf(
            '<h1 class="wp-block-query-title group-c-search-title"><span class="group-c-search-label">Search:</span> <span class="group-c-search-keyword">"%s"</span></h1>',
            esc_html($query)
        );
    }
    return $block_content;
}, 10, 2);

/**
 * Đăng ký khu vực Widget riêng cho Search (4) theo đúng chuẩn bài giảng
 */
function register_search_widget_4() {
    register_sidebar( array(
        'name'          => 'Search Widget #4',
        'id'            => 'search-widget-4',
        'description'   => 'Khu vực Widget hiển thị ô tìm kiếm cho phần Search (4)',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_search_widget_4' );

/**
 * Shortcode [tdc_prev_next_post] cho phần (7) Prev - Next Post
 */
function tdc_prev_next_post_shortcode() {
    if (!is_single()) {
        return '';
    }

    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if (!$prev_post && !$next_post) {
        return '';
    }

    $output = '<style>
        .tdc-post-nav-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin: 30px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .tdc-post-nav-item {
            display: flex;
            align-items: center;
        }
        .tdc-post-nav-date-box {
            width: 50px;
            height: 50px;
            min-width: 50px;
            max-width: 50px;
            background: #f0be1a;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #222222;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
            margin-right: 18px;
            flex-shrink: 0;
            box-sizing: border-box;
            user-select: none;
            font-family: "Times New Roman", Times, Georgia, serif;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            cursor: pointer;
            padding: 0;
            overflow: hidden;
        }
        .tdc-post-nav-item:hover .tdc-post-nav-date-box {
            transform: scale(1.06);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.18);
        }
        .tdc-post-nav-date-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1;
            margin-right: 2px;
            border-bottom: none !important;
            padding: 0;
        }
        .tdc-post-nav-day {
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            color: #222222;
            text-align: center;
            margin: 0;
            padding: 0;
            display: block;
        }
        .tdc-post-nav-line {
            display: block;
            width: 14px;
            height: 1px;
            background-color: #222222 !important;
            margin: 2px 0;
            border: none !important;
            padding: 0;
        }
        .tdc-post-nav-month {
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            color: #222222;
            text-align: center;
            margin: 0;
            padding: 0;
            display: block;
        }
        .tdc-post-nav-year {
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            color: #222222;
            margin: 0 0 0 3px;
            align-self: center;
            white-space: nowrap;
            display: inline-block;
        }
        .tdc-post-nav-title {
            font-size: 16px;
            margin: 0;
            line-height: 1.4;
            font-weight: 400;
        }
        .tdc-post-nav-title a {
            color: #222222;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .tdc-post-nav-title a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>';

    $output .= '<div class="tdc-post-nav-list">';

    $posts_to_show = array_filter(array($prev_post, $next_post));
    foreach ($posts_to_show as $p) {
        $day = get_the_date('d', $p->ID);
        $month = get_the_date('m', $p->ID);
        $year = get_the_date('y', $p->ID);
        $title = get_the_title($p->ID);
        $link = get_permalink($p->ID);

        $output .= '<div class="tdc-post-nav-item">';
        $output .= '  <a href="' . esc_url($link) . '" class="tdc-post-nav-date-box" title="' . esc_attr($title) . '">';
        $output .= '    <div class="tdc-post-nav-date-stack">';
        $output .= '      <span class="tdc-post-nav-day">' . esc_html($day) . '</span>';
        $output .= '      <span class="tdc-post-nav-line"></span>';
        $output .= '      <span class="tdc-post-nav-month">' . esc_html($month) . '</span>';
        $output .= '    </div>';
        $output .= '    <span class="tdc-post-nav-year">' . esc_html($year) . '</span>';
        $output .= '  </a>';
        $output .= '  <h4 class="tdc-post-nav-title"><a href="' . esc_url($link) . '">' . esc_html($title) . '</a></h4>';
        $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('tdc_prev_next_post', 'tdc_prev_next_post_shortcode');

/**
 * Đăng ký khu vực Widget riêng cho Comments (12) theo đúng chuẩn bài giảng
 */
/**
 * Đăng ký khu vực Widget riêng cho Archive (11) theo chuẩn bài giảng
 */
function register_archive_sidebar_11() {
    register_sidebar( array(
        'name'          => 'Archive Sidebar #11',
        'id'            => 'sidebar-archive-11',
        'description'   => 'Khu vực Widget hiển thị danh sách Lưu trữ cho phần Archive (11)',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_archive_sidebar_11' );

/**
 * Shortcode [tdc_archive] cho phần (11) Archive
 */
function tdc_archive_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Archive'
    ), $atts, 'tdc_archive');

    $output = '<style>
        .tdc-archive-widget-11 {
            font-family: Arial, sans-serif;
            margin-bottom: 25px;
        }
        .tdc-archive-title-11 {
            font-size: 18px;
            font-weight: 500;
            color: #333333;
            margin: 0 0 4px 0;
        }
        .tdc-archive-line-11 {
            width: 45px;
            height: 2px;
            background-color: #777777;
            margin-bottom: 12px;
        }
        .tdc-archive-list-11 {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .tdc-archive-list-11 li {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .tdc-archive-list-11 li:last-child {
            border-bottom: none;
        }
        .tdc-archive-list-11 li a {
            color: #337ab7;
            text-decoration: none;
            font-size: 15px;
        }
        .tdc-archive-list-11 li a:hover {
            color: #23527c;
            text-decoration: underline;
        }
    </style>';

    $output .= '<div class="tdc-archive-widget-11">';
    if (!empty($atts['title'])) {
        $output .= '<h3 class="tdc-archive-title-11">' . esc_html($atts['title']) . '</h3>';
        $output .= '<div class="tdc-archive-line-11"></div>';
    }
    $output .= '<ul class="tdc-archive-list-11">';

    $categories = get_categories(array('number' => 5, 'orderby' => 'count', 'order' => 'DESC'));
    if (!empty($categories)) {
        foreach ($categories as $cat) {
            $output .= '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a></li>';
        }
    } else {
        $output .= '<li><a href="#">Tháng 09 năm 2026</a></li>';
    }

    $output .= '</ul></div>';
    return $output;
}
add_shortcode('tdc_archive', 'tdc_archive_shortcode');

/**
 * Đăng ký khu vực Widget riêng cho Comments (12) theo đúng chuẩn bài giảng
 */
function register_comments_sidebar_12() {
    register_sidebar( array(
        'name'          => 'Comments Sidebar #12',
        'id'            => 'sidebar-comments-12',
        'description'   => 'Khu vực Widget hiển thị danh sách bình luận cho phần Comments (12)',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_comments_sidebar_12' );

/**
 * Shortcode [tdc_recent_comments] cho phần (12) Comments
 * Khung hiển thị khớp 100% hình ảnh slide bài giảng (media_1790126661322.png)
 */
function tdc_recent_comments_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 5,
        'title' => 'Comments'
    ), $atts, 'tdc_recent_comments');

    $output = '<style>
        .tdc-comments-widget-12 {
            font-family: Arial, sans-serif;
            margin-bottom: 25px;
        }
        .tdc-comments-title-12 {
            font-size: 18px;
            font-weight: 500;
            color: #333333;
            margin: 0 0 4px 0;
        }
        .tdc-comments-line-12 {
            width: 45px;
            height: 2px;
            background-color: #777777;
            margin-bottom: 12px;
        }
        .tdc-comments-list-12 {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .tdc-comments-item-12 {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .tdc-comments-item-12:last-child {
            border-bottom: none;
        }
        .tdc-comments-item-12 a {
            color: #337ab7;
            text-decoration: none;
            font-size: 15px;
            display: block;
        }
        .tdc-comments-item-12 a:hover {
            color: #23527c;
            text-decoration: underline;
        }
    </style>';

    $output .= '<div class="tdc-comments-widget-12">';
    if (!empty($atts['title'])) {
        $output .= '<h3 class="tdc-comments-title-12">' . esc_html($atts['title']) . '</h3>';
        $output .= '<div class="tdc-comments-line-12"></div>';
    }
    $output .= '<ul class="tdc-comments-list-12">';

    $comments = get_comments(array(
        'number' => $atts['count'],
        'status' => 'approve'
    ));

    if (!empty($comments)) {
        foreach ($comments as $comment) {
            $text = wp_strip_all_tags($comment->comment_content);
            $link = get_comment_link($comment);
            $output .= '<li class="tdc-comments-item-12">';
            $output .= '  <a href="' . esc_url($link) . '">' . esc_html($text) . '</a>';
            $output .= '</li>';
        }
    } else {
        // Mẫu bình luận chính xác theo hình ảnh slide (media_1790126661322.png)
        $sample_comments = array(
            'Bài viết hay quá',
            'Cảm ơn tác giả',
            'Bài viết thật hữu ích'
        );

        foreach ($sample_comments as $text) {
            $output .= '<li class="tdc-comments-item-12">';
            $output .= '  <a href="#">' . esc_html($text) . '</a>';
            $output .= '</li>';
        }
    }

    $output .= '</ul></div>';
    return $output;
}
add_shortcode('tdc_recent_comments', 'tdc_recent_comments_shortcode');

/**
 * Tạo Widget TDC Comments cho Quản trị viên
 */
class TDC_Comments_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'tdc_comments_widget',
            'Bình luận mới nhất (TDC #12)',
            array('description' => 'Kéo thả để hiển thị danh sách bình luận mới nhất ở Sidebar #12.')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : 'Comments';
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        echo do_shortcode('[tdc_recent_comments count="' . esc_attr($count) . '" title="' . esc_attr($title) . '"]');
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Comments';
        $count = !empty($instance['count']) ? $instance['count'] : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Số lượng bình luận:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="number" value="<?php echo esc_attr($count); ?>" min="1" max="10">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 5;
        return $instance;
    }
}
function register_tdc_comments_widget() {
    register_widget('TDC_Comments_Widget');
}
add_action('widgets_init', 'register_tdc_comments_widget');

/**
 * =========================================================
 * MODULE #14: COMMENTS CHO TRANG DANH SÁCH / TÌM KIẾM
 * Thiết kế bong bóng hội thoại (Speech Bubble) chuẩn Image 1
 * =========================================================
 */

/**
 * 1. Xử lý gửi bình luận nhanh từ form Module 14
 */
add_action('init', 'tdc_handle_module_14_comment_submit');
function tdc_handle_module_14_comment_submit() {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tdc_action']) && $_POST['tdc_action'] === 'submit_module_14_comment') {
        if (!isset($_POST['tdc_comment_nonce']) || !wp_verify_nonce($_POST['tdc_comment_nonce'], 'tdc_comment_action')) {
            return;
        }

        $author = sanitize_text_field($_POST['author_name']);
        $content = sanitize_textarea_field($_POST['comment_content']);

        if (!empty($author) && !empty($content)) {
            $latest_posts = get_posts(array('numberposts' => 1, 'post_status' => 'publish'));
            $post_id = !empty($latest_posts) ? $latest_posts[0]->ID : 1;

            wp_insert_comment(array(
                'comment_post_ID'      => $post_id,
                'comment_author'       => $author,
                'comment_author_email' => sanitize_email(sanitize_title($author) . '@example.com'),
                'comment_content'      => $content,
                'comment_type'         => 'comment',
                'comment_approved'     => 1,
                'comment_date'         => current_time('mysql'),
            ));

            $redirect = wp_get_referer() ? wp_get_referer() : $_SERVER['REQUEST_URI'];
            $redirect = add_query_arg('comment_submitted', '1', remove_query_arg('comment_submitted', $redirect));
            wp_safe_redirect($redirect);
            exit;
        }
    }
}

/**
 * 2. Hàm dựng giao diện bình luận dạng bong bóng chat (Speech Bubble) chuẩn Image 1
 */
function tdc_module_14_comments_render($args = array()) {
    $title = !empty($args['title']) ? $args['title'] : 'Comments';
    $count = !empty($args['count']) ? absint($args['count']) : 3;

    $comments = get_comments(array(
        'number' => $count,
        'status' => 'approve',
        'order'  => 'DESC',
    ));

    $display_list = array();
    if (!empty($comments)) {
        foreach ($comments as $comm) {
            $display_list[] = array(
                'author'  => $comm->comment_author ? $comm->comment_author : 'Anonymous',
                'content' => wp_strip_all_tags($comm->comment_content),
                'avatar'  => get_avatar_url($comm, array('size' => 96)),
            );
        }
    }

    // Nếu chưa có hoặc ít hơn 3 bình luận, bổ sung mẫu chuẩn theo Image 1
    if (count($display_list) < 3) {
        $default_samples = array(
            array(
                'author'  => 'John Doe',
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'avatar'  => '',
            ),
            array(
                'author'  => 'Jane Doe',
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'avatar'  => '',
            ),
            array(
                'author'  => 'John Doe',
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'avatar'  => '',
            ),
        );

        while (count($display_list) < 3) {
            $display_list[] = $default_samples[count($display_list)];
        }
    }

    ob_start();
    ?>
    <div class="tdc-module-14-comments">
        <h3 class="tdc-module-14-title"><?php echo esc_html($title); ?></h3>
        <div class="tdc-module-14-divider"></div>

        <?php if (!empty($_GET['comment_submitted'])): ?>
            <div class="tdc-alert-success" style="background:#e6f4ea; color:#137333; padding:10px 14px; border-radius:4px; margin-bottom:15px; font-size:13.5px; border:1px solid #ceead6;">
                ✓ Bình luận của bạn đã được đăng thành công!
            </div>
        <?php endif; ?>

        <div class="tdc-comments-bubble-list">
            <?php foreach ($display_list as $item): ?>
                <div class="tdc-comment-bubble-item">
                    <div class="tdc-comment-avatar">
                        <?php if (!empty($item['avatar'])): ?>
                            <img src="<?php echo esc_url($item['avatar']); ?>" alt="<?php echo esc_attr($item['author']); ?>" />
                        <?php else: ?>
                            <svg viewBox="0 0 24 24" width="28" height="28" fill="#9ca3af"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        <?php endif; ?>
                    </div>
                    <div class="tdc-comment-bubble-card">
                        <div class="tdc-comment-bubble-header">
                            <span class="tdc-comment-author-name"><?php echo esc_html($item['author']); ?></span>
                        </div>
                        <div class="tdc-comment-bubble-body">
                            <p class="tdc-comment-text"><?php echo esc_html($item['content']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="tdc-comment-input-box">
            <h4 class="tdc-input-box-title">Thêm bình luận mới</h4>
            <form method="post" action="" class="tdc-comment-form">
                <?php wp_nonce_field('tdc_comment_action', 'tdc_comment_nonce'); ?>
                <input type="hidden" name="tdc_action" value="submit_module_14_comment" />
                <div class="tdc-form-group">
                    <input type="text" name="author_name" placeholder="Họ và tên của bạn..." required class="tdc-form-control" />
                </div>
                <div class="tdc-form-group">
                    <textarea name="comment_content" placeholder="Nhập nội dung bình luận..." rows="3" required class="tdc-form-control"></textarea>
                </div>
                <div class="tdc-form-group" style="text-align: right; margin-bottom: 0;">
                    <button type="submit" class="tdc-btn-comment-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * 3. Shortcode [tdc_module_14_comments]
 */
function tdc_module_14_comments_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Comments',
        'count' => 3,
    ), $atts, 'tdc_module_14_comments');

    return tdc_module_14_comments_render($atts);
}
add_shortcode('tdc_module_14_comments', 'tdc_module_14_comments_shortcode');

/**
 * 4. Widget Module #14 Comments cho Admin
 */
class TDC_Comments_Module_14_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'tdc_comments_module_14_widget',
            'Bình luận (TDC #14)',
            array('description' => 'Hiển thị danh sách bình luận dạng bong bóng hội thoại và form nhập thông tin (Module #14).')
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Comments';
        $count = !empty($instance['count']) ? absint($instance['count']) : 3;

        echo $args['before_widget'];
        echo tdc_module_14_comments_render(array(
            'title' => $title,
            'count' => $count
        ));
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Comments';
        $count = !empty($instance['count']) ? absint($instance['count']) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Số lượng bình luận:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="number" value="<?php echo esc_attr($count); ?>" min="1" max="10">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : 'Comments';
        $instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 3;
        return $instance;
    }
}
function register_tdc_comments_module_14_widget() {
    register_widget('TDC_Comments_Module_14_Widget');
}
add_action('widgets_init', 'register_tdc_comments_module_14_widget');

/**
 * 5. Đăng ký các khu vực Widget Sidebar cho Trang Danh Sách / Tìm Kiếm (Search Page)
 */
function register_search_sidebars() {
    register_sidebar( array(
        'name'          => 'Search Sidebar - Trái (#13)',
        'id'            => 'sidebar-search-left-13',
        'description'   => 'Khu vực Widget cột trái (Module #13) cho trang danh sách / tìm kiếm.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Search Sidebar - Phải / Comments (#14)',
        'id'            => 'sidebar-comments-14',
        'description'   => 'Khu vực Widget cột phải hiển thị bình luận (Module #14) cho trang danh sách / tìm kiếm.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Search Bottom - Dưới (#15)',
        'id'            => 'sidebar-search-bottom-15',
        'description'   => 'Khu vực Widget phía dưới (Module #15) cho trang danh sách / tìm kiếm.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action('widgets_init', 'register_search_sidebars');

/**
 * 6. Tự động tương thích: nếu người dùng thêm block Bình luận (core/comments) vào widget hoặc trang tìm kiếm,
 * tự động hiển thị giao diện Module 14 chuẩn bong bóng hội thoại (Speech Bubble).
 */
add_filter('render_block', function($block_content, $block) {
    if (!empty($block['blockName']) && $block['blockName'] === 'core/comments') {
        if (is_search() || empty(trim(strip_tags($block_content)))) {
            return tdc_module_14_comments_render();
        }
    }
    return $block_content;
}, 10, 2);

/**
 * 7. Shortcodes cho layout Trang tìm kiếm / danh sách (Image 2)
 */
function tdc_sidebar_search_left_shortcode() {
    ob_start();
    if (is_active_sidebar('sidebar-search-left-13')) {
        dynamic_sidebar('sidebar-search-left-13');
    }
    return ob_get_clean();
}
add_shortcode('tdc_sidebar_search_left', 'tdc_sidebar_search_left_shortcode');

function tdc_sidebar_search_right_shortcode() {
    ob_start();
    if (is_active_sidebar('sidebar-comments-14')) {
        dynamic_sidebar('sidebar-comments-14');
    }
    $sidebar_output = ob_get_clean();

    // Nếu sidebar không có widget hoặc widget sinh ra rỗng (chẳng hạn block comments mặc định của WP bị rỗng trên trang search)
    if (empty(trim(strip_tags($sidebar_output)))) {
        return tdc_module_14_comments_render();
    }
    return $sidebar_output;
}
add_shortcode('tdc_sidebar_search_right', 'tdc_sidebar_search_right_shortcode');

function tdc_sidebar_search_bottom_shortcode() {
    ob_start();
    if (is_active_sidebar('sidebar-search-bottom-15')) {
        dynamic_sidebar('sidebar-search-bottom-15');
    }
    return ob_get_clean();
}
add_shortcode('tdc_sidebar_search_bottom', 'tdc_sidebar_search_bottom_shortcode');

require_once get_template_directory() . '/widget-recent-posts.php';
require_once get_template_directory() . '/widget-numbered-posts.php';
require_once get_template_directory() . '/widget-test-4.php';
