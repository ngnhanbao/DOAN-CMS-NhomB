<?php
/**
 * Title: Footer
 * Slug: twentytwentyfive/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Custom 3-column footer with comments, categories, last posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Query 1: Comments (Recent Comments)
$footer_comments = get_comments(array(
	'number'      => 5,
	'status'      => 'approve',
	'post_status' => 'publish',
));

// Query 2: Categories
$footer_categories = get_categories(array(
	'number'     => 5,
	'orderby'    => 'count',
	'order'      => 'DESC',
	'hide_empty' => false,
));

// Query 3: Last Posts (Recent Posts)
$footer_posts = wp_get_recent_posts(array(
	'numberposts' => 5,
	'post_status' => 'publish',
));
?>

<section id="footer">
	<div class="container">
		<div class="row">
			<!-- Column 1: Comments -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<h5>Comments</h5>
				<ul class="list-unstyled quick-links">
					<?php if (!empty($footer_comments)): ?>
						<?php foreach ($footer_comments as $c): ?>
							<?php 
							$comment_text = wp_strip_all_tags($c->comment_content);
							$display_text = $c->comment_author . ': ' . $comment_text;
							$comment_url = get_comment_link($c->comment_ID);
							?>
							<li>
								<a href="<?php echo esc_url($comment_url); ?>" title="<?php echo esc_attr($display_text); ?>">
									<i class="fa-solid fa-angles-right arrow-icon"></i><?php echo esc_html(wp_trim_words($display_text, 5, '...')); ?>
								</a>
							</li>
						<?php endforeach; ?>
					<?php else: ?>
						<li><span class="empty-notice"><i class="fa-solid fa-angles-right arrow-icon"></i>Chưa có bình luận</span></li>
					<?php endif; ?>
				</ul>
			</div>

			<!-- Column 2: Categories -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<h5>Categories</h5>
				<ul class="list-unstyled quick-links">
					<?php if (!empty($footer_categories)): ?>
						<?php foreach ($footer_categories as $cat): ?>
							<li>
								<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" title="<?php echo esc_attr($cat->name); ?>">
									<i class="fa-solid fa-angles-right arrow-icon"></i><?php echo esc_html($cat->name); ?> (<?php echo intval($cat->count); ?>)
								</a>
							</li>
						<?php endforeach; ?>
					<?php else: ?>
						<li><span class="empty-notice"><i class="fa-solid fa-angles-right arrow-icon"></i>Chưa có chuyên mục</span></li>
					<?php endif; ?>
				</ul>
			</div>

			<!-- Column 3: Last Posts -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<h5>Last posts</h5>
				<ul class="list-unstyled quick-links">
					<?php if (!empty($footer_posts)): ?>
						<?php foreach ($footer_posts as $p): ?>
							<li>
								<a href="<?php echo esc_url(get_permalink($p['ID'])); ?>" title="<?php echo esc_attr($p['post_title']); ?>">
									<i class="fa-solid fa-angles-right arrow-icon"></i><?php echo esc_html(wp_trim_words($p['post_title'], 6, '...')); ?>
								</a>
							</li>
						<?php endforeach; ?>
					<?php else: ?>
						<li><span class="empty-notice"><i class="fa-solid fa-angles-right arrow-icon"></i>Chưa có bài viết</span></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<!-- Social Icons -->
		<div class="row">
			<div class="col-12 text-center">
				<ul class="social">
					<li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
					<li><a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
					<li><a href="#" aria-label="Google Plus"><i class="fa-brands fa-google-plus-g"></i></a></li>
					<li><a href="#" aria-label="Email"><i class="fa-solid fa-envelope"></i></a></li>
				</ul>
			</div>
		</div>

		<!-- Divider & Information -->
		<div class="footer-divider"></div>
		<div class="row">
			<div class="col-12">
				<p class="footer-bottom-info">
					<a href="#">National Transaction Corporation</a> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]
				</p>
				<p class="footer-copyright">
					&copy; All right Reversed. <a href="#">Sunlimetech</a>
				</p>
			</div>
		</div>
	</div>
</section>