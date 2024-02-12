<?php
/**
 * Configure 8 Options page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Colors\{
	picker_colors_light,
	picker_colors_dark
};

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . $this->className();

// Database page URL.
$database_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=database';

?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$guide_page}'>theme guide</a> page. Go to the <a href='{$database_page}'>options database</a> page." ); ?></p>
</div>

<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="general" aria-selected="false" href="#general"><?php $L->p( 'General' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="header" aria-selected="false" href="#header"><?php $L->p( 'Header' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="nav" aria-selected="false" href="#nav"><?php $L->p( 'Menu' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="media" aria-selected="false" href="#media"><?php $L->p( 'Media' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="loop" aria-selected="false" href="#loop"><?php $L->p( 'Loop' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="loop" aria-selected="false" href="#page"><?php $L->p( 'Page' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="sidebar" aria-selected="false" href="#sidebar"><?php $L->p( 'Sidebar' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="footer" aria-selected="false" href="#footer"><?php $L->p( 'Footer' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="style" aria-selected="false" href="#style"><?php $L->p( 'Style' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="meta" aria-selected="false" href="#meta"><?php $L->p( 'Meta' ); ?></a>
		</li>
	</ul>

	<div id="general" class="tab-pane" role="tabpanel" aria-labelledby="general">
		<?php include( $this->phpPath() . '/views/fields-general.php' ); ?>
	</div>
	<div id="header" class="tab-pane" role="tabpanel" aria-labelledby="header">
		<?php include( $this->phpPath() . '/views/fields-header.php' ); ?>
	</div>
	<div id="nav" class="tab-pane" role="tabpanel" aria-labelledby="nav">
		<?php include( $this->phpPath() . '/views/fields-navigation.php' ); ?>
	</div>
	<div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
		<?php include( $this->phpPath() . '/views/fields-media.php' ); ?>
	</div>
	<div id="loop" class="tab-pane" role="tabpanel" aria-labelledby="loop">
		<?php include( $this->phpPath() . '/views/fields-loop.php' ); ?>
	</div>
	<div id="page" class="tab-pane" role="tabpanel" aria-labelledby="page">
		<?php include( $this->phpPath() . '/views/fields-page.php' ); ?>
	</div>
	<div id="sidebar" class="tab-pane" role="tabpanel" aria-labelledby="sidebar">
		<?php include( $this->phpPath() . '/views/fields-sidebar.php' ); ?>
	</div>
	<div id="footer" class="tab-pane" role="tabpanel" aria-labelledby="footer">
		<?php include( $this->phpPath() . '/views/fields-footer.php' ); ?>
	</div>
	<div id="style" class="tab-pane" role="tabpanel" aria-labelledby="style">
		<?php include( $this->phpPath() . '/views/fields-style.php' ); ?>
	</div>
	<div id="meta" class="tab-pane" role="tabpanel" aria-labelledby="meta">
		<?php include( $this->phpPath() . '/views/fields-meta.php' ); ?>
	</div>
</div>
<?php if ( 'default' != $this->admin_theme() ) : ?>
<div class="hide-if-js no-js-message" style="padding-top: 2rem;">
	<h3><?php $L->p( 'Action Required!' ); ?></h3>
	<p><?php $L->p( 'Please enable JavaScript to display the options form.' ); ?></p>
</div>
<?php endif; ?>

<script>
jQuery(document).ready( function($) {

	// Tooltips.
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
	$( '.image-in-album' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});

	// General color picker.
	$( '.custom-color' ).spectrum({
		type            : "component",
		showAlpha       : false,
		showPalette     : true,
		palette         : [
			['<?php echo implode( "', '", picker_colors_light() ); ?>'],
			['<?php echo implode( "', '", picker_colors_dark() ); ?>']
		],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : true,
	});
	$( '.custom-color' ).show();

	// Selected class for image uploads.
	$( '.bookmark-select-label' ).click( function() {
		$( '.bookmark-select-label' ).removeClass( 'selected' );
		$(this).addClass( 'selected' );
	});
	$( '.logo-standard-select-label' ).click( function() {
		$( '.logo-standard-select-label' ).removeClass( 'selected' );
		$(this).addClass( 'selected' );
	});
	$( '.cover-select-label' ).click( function() {
		$(this).toggleClass( 'selected' );
	});
});
</script>
