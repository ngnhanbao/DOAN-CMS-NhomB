<?php
/**
 * Title: TDC Post Detail
 * Slug: twentytwentyfive/post-detail
 * Categories: text
 * Block Types: core/post-content
 * Description: Single post detail template matching FIT TDC style.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

$post_id    = get_the_ID();
$post_title = get_the_title();
$day        = get_the_time('d');
$month      = get_the_time('m');
$year       = get_the_time('y');
?>

<article class="tdc-detail-article">
	<!-- Header: Title + Date Badge -->
	<header class="tdc-detail-header">
		<h1 class="tdc-detail-title"><?php echo esc_html($post_title); ?></h1>
		<div class="tdc-date-badge" title="<?php echo esc_attr(get_the_date()); ?>">
			<div class="tdc-date-badge-inner">
				<div class="tdc-date-fraction">
					<span class="tdc-badge-day"><?php echo esc_html($day); ?></span>
					<span class="tdc-badge-dash"></span>
					<span class="tdc-badge-month"><?php echo esc_html($month); ?></span>
				</div>
				<span class="tdc-badge-year">'<?php echo esc_html($year); ?></span>
			</div>
		</div>
	</header>

	<!-- Decorative Divider with Down Arrow -->
	<div class="tdc-detail-divider">
		<span class="tdc-arrow-down"></span>
	</div>

	<?php if (has_post_thumbnail()): ?>
		<div class="tdc-detail-featured-image">
			<?php the_post_thumbnail('large'); ?>
		</div>
	<?php endif; ?>

	<!-- Post Content -->
	<div class="tdc-detail-content">
		<?php the_content(); ?>
	</div>
</article>
