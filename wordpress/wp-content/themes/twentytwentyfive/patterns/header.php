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
				 MENU (Lấy từ Admin -> Appearance -> Menus)
				 ========================= -->
			<div class="group-c-categories">
				<?php
				// Hiển thị menu có tên là 'CMS' mà bạn đã tạo trong Admin
				if ( has_nav_menu('primary') ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'cms-menu-list', // Tên class để bạn dễ viết CSS
						'fallback_cb'    => false,
					) );
				} else {
					wp_nav_menu( array(
						'menu'           => 'CMS', // Gọi thẳng tên menu nếu theme chưa đăng ký location
						'container'      => false,
						'menu_class'     => 'cms-menu-list',
						'fallback_cb'    => false,
					) );
				}
				?>
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
				 ACCOUNT DROPDOWN (Áp dụng Bootstrap Dropdown)
				 ========================= -->
			<div class="group-c-account dropdown">

				<button type="button" class="group-c-account-button dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa-solid fa-circle-user"></i>
					<span>Account</span>
				</button>

				<!-- Dropdown Menu Bootstrap -->
				<div class="dropdown-menu dropdown-menu-right group-c-account-dropdown">

					<?php if (is_user_logged_in()): ?>
						<!-- Người dùng đã đăng nhập -->
						<a class="dropdown-item" href="<?php echo esc_url(admin_url()); ?>">Dashboard</a>
						<a class="dropdown-item" href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">Đăng xuất</a>
					<?php else: ?>
						<!-- Người dùng chưa đăng nhập -->
						<a class="dropdown-item" href="<?php echo esc_url(wp_login_url()); ?>">Đăng nhập</a>
						<a class="dropdown-item" href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
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