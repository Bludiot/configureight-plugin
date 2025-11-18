<?php
/**
 * Admin theme notice
 *
 * Warns to deactivate the Configure 8 admin theme
 * before activating another theme. Only appears
 * on the Themes admin screen.
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	lang
};

// Close icon SVG.
$close_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"/></svg>';

?>
<script>
jQuery(document).ready( function($) {
	$( 'html, body' ).scrollTop( 0 );
	$( '.admin-theme-notice .close-modal' ).click( function(e) {
		e.preventDefault();
		$( 'html' ).removeClass( 'no-scroll' );
		$( '.admin-theme-notice-modal' ).removeClass( 'show' );
	});
});
</script>

<style>
/**
 * The no-scroll class is conditionally added
 * by Configure 8 admin theme.
 */
html.js.no-scroll {
	max-height: 100vh;
	overflow: hidden;
}

.admin-theme-notice-modal {
	display: none;
}

.admin-theme-notice-modal.show {
	display: flex !important;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	max-height: 100vh;
}

.no-js .admin-theme-notice-modal {
	display: none !important;
}

.admin-theme-notice {
	position: relative;
	padding: 2rem;
	background-color: #ffffff;
}

.admin-theme-notice .close {
	position: absolute;
	top: 1rem;
	right: 1rem;
	cursor: pointer;
}

.admin-theme-notice h3 {
	margin: 0;
}
</style>
<div id="jsshadow" class="admin-theme-notice-modal show">
	<div class="admin-theme-notice">
		<button id="close-admin-theme-notice" class="button close close-modal svg-icon" role="image"><?php echo $close_icon; ?></button><span class="screen-reader-text"><?php lang()->p( 'Close Notice Window' ); ?></span>
		<h3><?php lang()->p( 'Notice' ); ?></h3>
		<p><?php lang()->p( 'Please change the admin theme option to Default Theme or Styles Only before activating another theme.' ); ?></p>

		<?php
		if ( checkRole( [ 'admin' ], false ) ) : ?>
		<p><a href="<?php echo HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $this->className() . '#style'; ?>"><?php lang()->p( 'See Options' ); ?></a> | <a href="#" class="close-modal"><?php lang()->p( 'Close' ); ?></a> </p>
		<?php endif; ?>
	</div>
</div>
