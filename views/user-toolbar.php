<?php
/**
 * User toolbar
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Navigation
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	svg_icon,
	plugin_sidebars_count
};

// Edit page link.
$edit_link = '';
if ( 'page' == $url->whereAmI() ) {

	// Page slug.
	$slug = $url->slug();
	if ( $site->pageNotFound() ) {
		$site_not_found = $site->pageNotFound();

		// Error page if current URL is 404.
		if ( $url->notFound() ) {
			$error = buildPage( $site_not_found );
			$slug  = $error->slug();
		}
	}
	$edit_link = DOMAIN_ADMIN . 'edit-content/' . $slug;
}

// View page link.
$view_slug = '';
$view_page = '';
if ( str_contains( $url->slug(), 'edit-content' ) ) {
	$view_slug = str_replace( 'edit-content/', '', $url->slug() );
	$view_page = DOMAIN_BASE . $view_slug;
}

$view_text = '';
if ( str_contains( $url->slug(), 'edit-content' ) ) {
	$view_text = ( $page->isStatic() ? $L->get( 'View Page' ) : $L->get( 'View Post' ) );
}

// Get a username or fallback.
$user = new User( Session :: get( 'username' ) );
$name = $L->get( 'profile-link-default' );

if ( $user->nickname() ) {
	$name = $user->nickname();
} elseif ( $user->firstName() ) {
	$name = $user->firstName();
}

// User avatar & profile link.
if ( $user->profilePicture() ) {
	$avatar  = $user->profilePicture();
	$profile = sprintf(
		'%sedit-user/%s',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
} else {
	$avatar  = DOMAIN_THEME . 'assets/images/avatar-default.png';
	$profile = sprintf(
		'%sedit-user/%s#picture',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
}

?>
<section id="user-toolbar" class="user-toolbar" data-admin-user-toolbar>
	<nav class="user-toolbar-nav toolbar-user-action">
		<ul class="user-toolbar-nav-list">
			<?php if ( 'admin' == $url->whereAmI() ) : ?>
			<li class="top-level-item">
				<a target="_blank" href="<?php echo DOMAIN_BASE; ?>" title="<?php $L->p( 'View Site' ); ?>">
					<?php svg_icon( 'home' ); ?><span class="top-level-text"><?php $L->p( 'Site' ); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php svg_icon( 'gauge' ); ?><span class="top-level-text"><?php $L->p( 'Admin' ); ?></span><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php $L->p( 'Dashboard' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'about';?>"><?php $L->p( 'System' ); ?></a>
					</li>

					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'developers';?>"><?php $L->p( 'Server' ); ?></a>
					</li>
				</ul>
			</li>
			<?php else : ?>
			<li class="top-level-item">
				<a href="<?php echo DOMAIN_ADMIN . 'dashboard'; ?>"><?php svg_icon( 'gauge' ); ?><span class="top-level-text"><?php $L->p( 'Dashboard' ); ?></span></a>
			</li>
			<?php endif; ?>

			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'content';?>"><?php svg_icon( 'file' ); ?><span class="top-level-text"><?php $L->p( 'Content' ); ?></span><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'new-content'; ?>"><?php echo ucwords( $L->get( 'Compose' ) ); ?></a>
					</li>

					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'content'; ?>"><?php $L->p( 'Pages' ); ?></a>
					</li>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'categories'; ?>"><?php $L->p( 'Categories' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( str_contains( $url->slug(), 'edit-content' ) ) : ?>
					<li class="top-level-item">
						<a href="<?php echo $view_page; ?>"><?php echo $view_text; ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>

			<?php if ( str_contains( $url->slug(), 'edit-content' ) ) : ?>
			<li class="top-level-item">
				<a href="<?php echo $view_page; ?>"><?php svg_icon( 'eye' ); ?><span class="top-level-text"><?php echo $view_text; ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( 'page' == $url->whereAmI() ) : ?>
			<li class="top-level-item">
				<a href="<?php echo $edit_link; ?>"><?php svg_icon( 'pencil' ); ?><span class="top-level-text"><?php echo ( 'page' == $page->isStatic() ? $L->get( 'Edit Page' ) : $L->get( 'Edit Post' ) ); ?></span></a>
			</li>
			<?php endif; ?>

			<?php if ( checkRole( [ 'admin' ], false ) && 'admin' == $url->whereAmI() ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php svg_icon( 'gear' ); ?><span class="top-level-text"><?php $L->p( 'Manage' ); ?></span><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php $L->p( 'Settings' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'users'; ?>"><?php $L->p( 'Users' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugins'; ?>"><?php $L->p( 'Plugins' ); ?></a>
					</li>
					<?php endif; ?>

					<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'themes'; ?>"><?php $L->p( 'Themes' ); ?></a>
					</li>
					<?php endif; ?>

					<?php
					if (
						checkRole( [ 'admin' ], false ) &&
						plugin()
					) : ?>
					<li>
						<a href="<?php echo plugin()->plugin_url(); ?>"><?php $L->p( 'Options' ); ?></a>
					</li>
					<?php endif; ?>
				</ul>
			</li>
			<?php elseif ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item">
				<a href="<?php echo plugin()->plugin_url(); ?>"><?php svg_icon( 'gear' ); ?><span class="top-level-text"><?php $L->p( 'Options' ); ?></span></a>
			</li>
			<?php endif; ?>
			<?php
			if (
				checkRole( [ 'admin', 'editor' ], false ) &&
				'admin' == $url->whereAmI() &&
				plugin_sidebars_count() > 0
			) : ?>
			<li class="top-level-item has-submenu">
				<a class="nav-link" href="<?php echo DOMAIN_ADMIN . 'settings'; ?>"><?php svg_icon( 'banner-v' ); ?><span class="top-level-text"><?php $L->p( 'Features' ); ?></span><?php svg_icon( 'angle-down' ); ?></a>
				<ul>
					<?php
					foreach ( $plugins['adminSidebar'] as $link ) {
						if ( 'theme' == $link->type() ) {
							// continue;
						}
						printf(
							'<li>%s</li>',
							$link->adminSidebar()
						);
					} ?>
				</ul>
			</li>
			<?php endif; ?>
			<?php if ( checkRole( [ 'admin' ], false ) ) : ?>
			<li class="top-level-item has-submenu">
				<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className(); ?>"><?php svg_icon( 'book-open' ); ?><span class="top-level-text"><?php $L->p( 'Help' ); ?></span><?php svg_icon( 'angle-down' ); ?></a>

				<ul>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className(); ?>"><?php $L->p( 'Options Guide' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=colors'; ?>"><?php $L->p( 'Colors Reference' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=fonts'; ?>"><?php $L->p( 'Fonts Reference' ); ?></a>
					</li>
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=database'; ?>"><?php $L->p( 'Options Database' ); ?></a>
					</li>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</nav>
	<nav class="user-toolbar-nav toolbar-user-info">
		<ul class="user-toolbar-nav-list">
			<li class="top-level-item has-submenu">
				<a id="profile-link" href="<?php echo $profile; ?>">
					<img class="avatar user-avatar user toolbar-avatar user-toolbar-avatar" src="<?php echo $avatar; ?>" width="24"> <span><?php echo $name; ?></span>
				</a>

				<ul class="user-actions-sublist">
					<li>
						<a href="<?php echo DOMAIN_ADMIN . 'edit-user/' . $login->username(); ?>"><?php $L->p( 'Your Profile' ); ?></a>
					</li>

					<li>
						<a id="toolbar-logout" href="<?php echo DOMAIN_ADMIN . 'logout'; ?>"><?php $L->p( 'Log Out' ); ?></a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</section>
