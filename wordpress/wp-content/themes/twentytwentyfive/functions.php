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
function tdc_custom_news_shortcode($atts) {
    $atts = shortcode_atts(array(
        'posts' => 5, // Số lượng bài viết
    ), $atts, 'tdc_news');

    $query = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => $atts['posts'],
        'post_status'    => 'publish',
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
