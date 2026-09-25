<?php
/**
 * Title: Comments
 * Slug: twentytwentyfive/comments
 * Description: Comments area with comments list, pagination, and comment form.
 * Categories: text
 * Block Types: core/comments
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:comments {"className":"wp-block-comments-query-loop","style":{"spacing":{"margin":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-comments wp-block-comments-query-loop"
	style="margin-top:var(--wp--preset--spacing--70);margin-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-x-large-font-size"><?php esc_html_e('Comments', 'twentytwentyfive'); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:comments-title {"level":3,"fontSize":"large"} /-->
	<!-- wp:comment-template -->
	<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
		<div class="wp-block-group">
			<!-- wp:avatar {"size":50} /-->
			<!-- wp:group -->
			<div class="wp-block-group">
				<!-- wp:comment-date /-->
				<!-- wp:comment-author-name /-->
				<!-- wp:comment-content /-->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group">
					<!-- wp:comment-edit-link /-->
					<!-- wp:comment-reply-link /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
	<!-- /wp:comment-template -->

	<!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<!-- wp:comments-pagination-previous /-->
	<!-- wp:comments-pagination-next /-->
	<!-- /wp:comments-pagination -->

	<?php
	$comment_args = array(
		// 1. Tạo phần Header dạng Tab "Make a Post"
		'title_reply_before' => '<div class="tdc-make-post-card"><div class="tdc-card-header"><span class="tdc-tab-active">',
		'title_reply' => 'Make a Post',
		'title_reply_after' => '</span></div><div class="tdc-card-body">',

		// 2. Tùy biến ô Textarea với placeholder "What are you thinking..."
		'comment_field' => '<div class="tdc-form-group"><textarea id="comment" name="comment" class="tdc-comment-textarea" placeholder="What are you thinking..." rows="4" required></textarea></div>',

		// 3. Tùy biến nút "share" màu xanh ở góc phải
		'submit_button' => '<div class="tdc-submit-wrapper"><button type="submit" name="%1$s" id="%2$s" class="tdc-btn-share">%4$s</button></div>',
		'label_submit' => 'share',
		'submit_field' => '%1$s %2$s</div></div>', // Đóng thẻ tdc-card-body & tdc-make-post-card
	
		// 4. Ẩn các dòng chữ thừa mặc định của WordPress
		'logged_in_as' => '',
		'comment_notes_before' => '',
	);

	comment_form($comment_args);
	?>

</div>
<!-- /wp:comments -->