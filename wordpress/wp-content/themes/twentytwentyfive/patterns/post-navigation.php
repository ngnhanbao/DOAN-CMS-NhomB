<?php
/**
 * Title: Post navigation
 * Slug: twentytwentyfive/post-navigation
 * Categories: text
 * Description: Next and previous post links with custom date format.
 * Block Types: core/post-navigation-link
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<div class="tdc-post-nav-wrapper">
	<?php
	if ( function_exists( 'tdc_prev_next_post_shortcode' ) ) {
		echo tdc_prev_next_post_shortcode();
	}
	?>
</div>