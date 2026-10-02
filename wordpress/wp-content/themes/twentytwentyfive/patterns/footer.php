<?php
/**
 * Title: Footer
 * Slug: twentytwentyfive/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Custom 3-column footer with Quick links, widget support, social icons, and copyright.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */
?>

<?php
// Hiển thị widget_test_4 tại khu vực phía trên Footer (Trang chủ, Trang danh sách, Trang chi tiết)
if (function_exists('tdc_render_above_footer_area')) {
	tdc_render_above_footer_area();
}
?>

<!-- Khu vực hiển thị: phía trên Footer (Widget_Test_4) -->
<?php if ( is_front_page() || is_home() || is_archive() || is_category() || is_tag() || is_tax() || is_search() || is_single() ): ?>
	<div id="widget_test_4_area" class="widget-test-4-area" style="width: 96%; max-width: 1400px; margin: 30px auto; padding: 15px 10px;">
		<?php 
		if ( is_active_sidebar( 'widget_test_4' ) ) {
			dynamic_sidebar( 'widget_test_4' );
		} elseif ( is_active_sidebar( 'above-footer' ) ) {
			dynamic_sidebar( 'above-footer' );
		} else {
			the_widget( 'Widget_Test_4' );
		}
		?>
	</div>
<?php endif; ?>

<!-- Khu vực hiển thị: phía trên Footer (TDC_Widget_Test_4) -->
<?php if (is_home() || is_front_page() || is_archive() || is_search() || is_single()): ?>
<section class="tdc-above-footer-area" style="padding: 40px 0; background: #fff; border-top: 1px solid #eaeaea;">
    <div class="container">
        <?php 
        if (is_active_sidebar('above-footer')) {
            dynamic_sidebar('above-footer'); 
        } else {
            the_widget('TDC_Widget_Test_4', array('title' => 'Widget Test 4', 'number' => 5));
        }
        ?>
    </div>
</section>
<?php endif; ?>

<!-- Khu vực hiển thị: Widget Last Posts -->
<?php if ( is_search() ): ?>
<section class="tdc-above-footer-area" style="padding: 40px 0; background: #fff; border-top: 1px solid #eaeaea;">
    <div class="container">
        <?php 
        the_widget('TDC_Widget_Last_Posts', array('title' => 'Latest News', 'number' => 3));
        ?>
    </div>
</section>
<?php endif; ?>

<section id="footer">
	<div class="container">
		<div class="row">
			<!-- Column 1: Footer #1 -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<?php if (is_active_sidebar('footer-1')): ?>
					<?php dynamic_sidebar('footer-1'); ?>
				<?php else: ?>
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-angles-right arrow-icon"></i>Home</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>About</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>FAQ</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Get Started</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Videos</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 2: Footer #2 -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<?php if (is_active_sidebar('footer-2')): ?>
					<?php dynamic_sidebar('footer-2'); ?>
				<?php else: ?>
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-angles-right arrow-icon"></i>Home</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>About</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>FAQ</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Get Started</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Videos</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 3: Footer #3 -->
			<div class="col-12 col-md-4 mb-4 mb-md-0">
				<?php if (is_active_sidebar('footer-3')): ?>
					<?php dynamic_sidebar('footer-3'); ?>
				<?php else: ?>
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-angles-right arrow-icon"></i>Home</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>About</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>FAQ</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Get Started</a></li>
						<li><a href="#"><i class="fa-solid fa-angles-right arrow-icon"></i>Imprint</a></li>
					</ul>
				<?php endif; ?>
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
			<div class="col-12 text-center">
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