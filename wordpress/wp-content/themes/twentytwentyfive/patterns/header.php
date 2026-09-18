<?php if (is_active_sidebar('my-custom-sidebar')): ?>
	<div class="my-sidebar-wrapper">
		<?php dynamic_sidebar('my-custom-sidebar'); ?>
	</div>
<?php endif; ?>


<?php
/**
 * Title: Header
 * Slug: twentytwentyfive/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Site header with site title and navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<?php
/**
 * Title: Header
 * Slug: twentytwentyfive/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Group C header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 */
?>

<header class="group-c-header">

	<nav class="navbar">

		<div class="container-fluid">

			<!-- =========================
				 GROUP C
				 ========================= -->
			<a class="group-c-logo" href="<?php echo esc_url(home_url('/')); ?>">
				Group C
			</a>


			<!-- =========================
				 HOME
				 ========================= -->
			<a class="group-c-home" href="<?php echo esc_url(home_url('/')); ?>">
				Home
			</a>


			<!-- =========================
				 SEARCH FORM
				 ========================= -->
			<form class="group-c-search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
				onsubmit="return validationGroupRearch(this);">

				<input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search">

				<button type="submit">
					Submit
				</button>

			</form>


			<!-- =========================
				 CATEGORIES
				 LẤY TỪ DATABASE
				 ========================= -->
			<div class="group-c-categories">

				<?php
				$categories = get_categories(
					array(
						'hide_empty' => false,
					)
				);

				foreach ($categories as $category):
					?>

					<a href="<?php echo esc_url(
						get_category_link($category->term_id)
					); ?>">
						<?php echo esc_html($category->name); ?>
					</a>

				<?php endforeach; ?>

			</div>


			<!-- =========================
				 MENU ICON
				 KHÔNG XỬ LÝ THEO YÊU CẦU
				 ========================= -->
			<div class="group-c-icon-item">

				<button type="button">

					<i class="fa-solid fa-ellipsis"></i>

					<span>
						Menu
					</span>

				</button>

			</div>


			<!-- =========================
				 SEARCH ICON
				 ========================= -->
			<div class="group-c-icon-item">

				<button type="button">

					<i class="fa-solid fa-magnifying-glass"></i>

					<span>
						Search
					</span>

				</button>

			</div>


			<!-- =========================
				 ACCOUNT DROPDOWN
				 ========================= -->
			<div class="group-c-account">

				<button type="button" class="group-c-account-button">

					<i class="fa-solid fa-circle-user"></i>

					<span>
						Account
					</span>

					<i class="fa-solid fa-caret-down"></i>

				</button>


				<!-- Dropdown -->
				<div class="group-c-account-dropdown">

					<?php if (is_user_logged_in()): ?>

						<!-- Người dùng đã đăng nhập -->

						<a href="<?php echo esc_url(
							admin_url()
						); ?>">
							Dashboard
						</a>

						<a href="<?php echo esc_url(
							wp_logout_url(
								home_url('/')
							)
						); ?>">
							Đăng xuất
						</a>

					<?php else: ?>

						<!-- Người dùng chưa đăng nhập -->

						<a href="<?php echo esc_url(
							wp_login_url()
						); ?>">
							Đăng nhập
						</a>

						<a href="<?php echo esc_url(
							wp_registration_url()
						); ?>">
							Đăng ký
						</a>

					<?php endif; ?>

				</div>

			</div>

		</div>

	</nav>

</header>
<script>
	function validationGroupRearch(form) {
		const input = form.querySelector('input[name="s"]');
		if (!input || input.value.trim() === '') {
			alert('Vui lòng nhập từ khóa tìm kiếm!');
			input.focus();
			return false;
		}
		return true; // Cho phép gửi form
	}
</script>