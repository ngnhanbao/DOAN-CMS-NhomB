<?php
/**
 * Title: Header
 * Slug: twentytwentyfive/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Group C header matching sample design.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 */
?>

<header class="group-c-header">
	<nav class="navbar group-c-navbar">
		<div class="group-c-header-container">

			<!-- =========================
				 LEFT SECTION: Logo, Home Tab, Search Form
				 ========================= -->
			<div class="header-left">
				<!-- GROUP C LOGO -->
				<a class="group-c-logo" href="<?php echo esc_url(home_url('/')); ?>">
					Group C
				</a>

				<!-- HOME TAB -->
				<a class="group-c-home" href="<?php echo esc_url(home_url('/')); ?>">
					Home
				</a>

				<!-- SEARCH FORM -->
				<form class="group-c-search" method="get" action="<?php echo esc_url(home_url('/')); ?>" onsubmit="return validationGroupRearch(this);">
					<input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search">
					<button type="submit">Submit</button>
				</form>
			</div>

			<!-- =========================
				 RIGHT SECTION: Categories, Menu Icon, Search Icon, Account Dropdown
				 ========================= -->
			<div class="header-right">
				<!-- MENU / CATEGORIES (From WP Admin -> Menus -> 'CMS') -->
				<div class="group-c-categories">
					<?php
					if ( has_nav_menu('primary') ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'cms-menu-list',
							'fallback_cb'    => false,
						) );
					} else {
						wp_nav_menu( array(
							'menu'           => 'CMS',
							'container'      => false,
							'menu_class'     => 'cms-menu-list',
							'fallback_cb'    => false,
						) );
					}
					?>
				</div>

				<!-- ACTION BUTTONS: Menu, Search, Account -->
				<div class="group-c-actions">
					<!-- MENU ICON -->
					<div class="group-c-icon-item">
						<button type="button" class="group-c-action-btn" aria-label="Menu">
							<i class="fa-solid fa-ellipsis"></i>
							<span>Menu</span>
						</button>
					</div>

					<!-- SEARCH ICON -->
					<div class="group-c-icon-item">
						<a href="<?php echo esc_url(home_url('/?s=')); ?>" class="group-c-action-btn" aria-label="Search">
							<i class="fa-solid fa-magnifying-glass"></i>
							<span>Search</span>
						</a>
					</div>

					<!-- ACCOUNT DROPDOWN -->
					<div class="group-c-account dropdown">
						<button type="button" class="group-c-action-btn group-c-account-button dropdown-toggle" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="groupCAccountDropdown">
							<i class="fa-solid fa-circle-user account-avatar-icon"></i>
							<span class="account-label">Account <i class="fa-solid fa-caret-down account-caret"></i></span>
						</button>

						<!-- Dropdown Menu Bootstrap -->
						<div class="dropdown-menu dropdown-menu-end group-c-account-dropdown" aria-labelledby="groupCAccountDropdown">
							<?php if (is_user_logged_in()): ?>
								<!-- Người dùng đã đăng nhập -->
								<a class="dropdown-item" href="<?php echo esc_url(admin_url()); ?>">
									<i class="fa-solid fa-gauge-high"></i> Dashboard
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">
									<i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
								</a>
							<?php else: ?>
								<!-- Người dùng chưa đăng nhập -->
								<a class="dropdown-item" href="<?php echo esc_url(wp_login_url()); ?>">
									<i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
								</a>
								<a class="dropdown-item" href="<?php echo esc_url(wp_registration_url()); ?>">
									<i class="fa-solid fa-user-plus"></i> Đăng ký
								</a>
							<?php endif; ?>
						</div>
					</div>
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