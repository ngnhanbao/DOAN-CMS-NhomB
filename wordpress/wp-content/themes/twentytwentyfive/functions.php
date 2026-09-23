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
		'1.0.0'
	);

	// Custom Footer CSS
	wp_enqueue_style(
		'group-c-footer',
		get_template_directory_uri() . '/assets/css/group-c-footer.css',
		array(),
		'1.0.0'
	);

	// Custom Post Detail CSS
	wp_enqueue_style(
		'group-c-detail',
		get_template_directory_uri() . '/assets/css/group-c-detail.css',
		array(),
		'1.0.0'
	);
}

add_action('wp_enqueue_scripts', 'group_c_enqueue_assets');

function my_custom_widgets_init()
{
	register_sidebar(array(
		'name' => 'Khu vực Widget của tôi', // Tên hiển thị trong trang quản trị
		'id' => 'my-custom-sidebar', // ID dùng để gọi ra template (viết thường, không dấu, cách nhau bằng gạch ngang)
		'description' => 'Thêm các widget vào đây để hiển thị ra ngoài website.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
// Móc hàm my_custom_widgets_init vào hook widgets_init của WordPress
add_action('widgets_init', 'my_custom_widgets_init');

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

// --- SHORTCODE HIỂN THỊ KẾT QUẢ TÌM KIẾM ---
function tdc_search_results_shortcode()
{
	$search_query = get_search_query();

	if (empty($search_query)) {
		return '';
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$query = new WP_Query(array(
		's' => $search_query,
		'post_type' => 'post',
		'posts_per_page' => 10,
		'paged' => $paged
	));

	if (!$query->have_posts()) {
		return '';
	}

	$output = '<style>
        .tdc-search-list { display: flex; flex-direction: column; gap: 20px; font-family: sans-serif; margin-top: 30px; }
        .tdc-search-item { display: flex; border: 1px solid #eaeaea; background: #fff; align-items: stretch; }
        .tdc-search-thumbnail { width: 250px; flex-shrink: 0; }
        .tdc-search-thumbnail img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .tdc-search-content-wrapper { display: flex; padding: 20px; flex: 1; align-items: stretch; }
        .tdc-search-date { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; border-right: 1px solid #eaeaea; padding-right: 20px; margin-right: 20px; min-width: 80px; }
        .tdc-search-day { font-size: 48px; font-weight: 700; font-family: "Times New Roman", Times, serif; line-height: 1; color: #333; }
        .tdc-search-month { font-size: 12px; text-transform: uppercase; color: #888; margin-top: 5px; letter-spacing: 0.5px; }
        .tdc-search-text { flex: 1; }
        .tdc-search-title { margin: 0 0 10px 0; font-size: 18px; line-height: 1.4; }
        .tdc-search-title a { color: #0056b3; text-decoration: none; text-transform: uppercase; font-weight: 700; }
        .tdc-search-title a:hover { color: #003d82; text-decoration: underline; }
        .tdc-search-excerpt { font-size: 14px; color: #555; line-height: 1.5; margin: 0; }
        
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

		$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'medium_large') : 'https://via.placeholder.com/250x180?text=No+Image';

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
            font-family: sans-serif;
        }
        .tdc-post-nav-item {
            display: flex;
            align-items: center;
        }
        .tdc-post-nav-date-box {
            display: inline-flex;
            align-items: center;
            font-family: "Times New Roman", Times, serif;
            min-width: 65px;
            margin-right: 25px;
            user-select: none;
        }
        .tdc-post-nav-date-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 1px solid #777;
            padding-bottom: 1px;
            margin-right: 3px;
        }
        .tdc-post-nav-day {
            font-size: 15px;
            line-height: 1;
            color: #333;
        }
        .tdc-post-nav-month {
            font-size: 15px;
            line-height: 1;
            color: #333;
            margin-top: 2px;
        }
        .tdc-post-nav-year {
            font-size: 15px;
            line-height: 1;
            color: #333;
            margin-top: -8px;
        }
        .tdc-post-nav-title {
            font-size: 16px;
            margin: 0;
            line-height: 1.4;
            font-weight: normal;
        }
        .tdc-post-nav-title a {
            color: #333333;
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
        $output .= '  <div class="tdc-post-nav-date-box">';
        $output .= '    <div class="tdc-post-nav-date-stack">';
        $output .= '      <span class="tdc-post-nav-day">' . esc_html($day) . '</span>';
        $output .= '      <span class="tdc-post-nav-line"></span>';
        $output .= '      <span class="tdc-post-nav-month">' . esc_html($month) . '</span>';
        $output .= '    </div>';
        $output .= '    <span class="tdc-post-nav-year">' . esc_html($year) . '</span>';
        $output .= '  </div>';
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


// Tự động gán hình ảnh nét độc đáo cho các bài viết
require_once get_template_directory() . '/auto_attach_images.php';

// Tự động tạo 3 đến 4 bình luận cho mỗi bài viết
require_once get_template_directory() . '/auto_insert_comments.php';






