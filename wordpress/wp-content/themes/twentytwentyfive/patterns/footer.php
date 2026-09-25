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