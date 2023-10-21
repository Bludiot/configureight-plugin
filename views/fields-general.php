<?php
/**
 * General options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Cover image background value.
$loader_bg_default = $this->loader_bg_default();
$loader_bg_color   = $loader_bg_default;
if ( ! empty( $this->getValue( 'loader_bg_color' ) ) ) {
	$loader_bg_color = $this->getValue( 'loader_bg_color' );
}

// Cover image text value.
$loader_text_default = $this->loader_text_default();
$loader_text_color   = $loader_text_default;
if ( ! empty( $this->getValue( 'loader_text_color' ) ) ) {
	$loader_text_color = $this->getValue( 'loader_text_color' );
}
?>

<script>
// Spectrum color pickers.
jQuery(document).ready( function($) {

	// Page loader options.
	$( '#page_loader' ).on( 'change', function() {
    	var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#loader_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#loader_options' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#loader_options" ).fadeOut( 250 );
		}
    });

	// Cover image background.
	$( '#loader_bg_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#loader_bg_color' ).show();

	$( '#loader_bg_color_default' ).click( function() {
		$( '#loader_bg_color' ).spectrum( 'set', $( '#loader_bg_default' ).val() );
	});

	// Cover image text.
	$( '#loader_text_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#loader_text_color' ).show();

	$( '#loader_text_color_default' ).click( function() {
		$( '#loader_text_color' ).spectrum( 'set', $( '#loader_text_default' ).val() );
	});
});
</script>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Interface Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Interface' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="user_toolbar"><?php $L->p( 'User Toolbar' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="user_toolbar" name="user_toolbar">
				<option value="true" <?php echo ( $this->getValue( 'user_toolbar' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'user_toolbar' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Displayed only to logged-in users.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="related_posts"><?php $L->p( 'Related Posts' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="related_posts" name="related_posts">
				<option value="true" <?php echo ( $this->getValue( 'related_posts' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'related_posts' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Show related posts on singular post pages.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="to_top_button"><?php $L->p( 'To Top Button' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="to_top_button" name="to_top_button">
				<option value="true" <?php echo ( $this->getValue( 'to_top_button' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'to_top_button' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a button to scroll to the top of the page.' ); ?></small>
		</div>
	</div>

</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Loading Screen' ) ] ); ?>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Loader' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="page_loader"><?php $L->p( 'Loading Screen' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="page_loader" name="page_loader">
				<option value="false" <?php echo ( $this->getValue( 'page_loader' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
				<option value="true" <?php echo ( $this->getValue( 'page_loader' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'A full-screen display that hides the web page until it is fully loaded.' ); ?></small>
		</div>
	</div>

	<div id="loader_options" style="display: <?php echo ( $this->getValue( 'page_loader' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_text"><?php $L->p( 'Loading Text' ); ?></label>
			<div class="col-sm-4">
				<input type="text" id="loader_text" name="loader_text" value="<?php echo $this->getValue( 'loader_text' ); ?>" placeholder="<?php $L->p( 'Loading&hellip;' ); ?>" />
				<small class="form-text text-muted"><?php $L->p( 'The text to display on the loading screen.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_bg_color"><?php $L->p( 'Background Color' ); ?></label>
			<div class="col-sm-4 row">
				<input class="color-picker" id="loader_bg_color" name="loader_bg_color" value="<?php echo $loader_bg_color; ?>" />
				<input id="loader_bg_default" type="hidden" value="<?php echo $loader_bg_default; ?>" />
				<span class="btn btn-secondary btn-sm" id="loader_bg_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_text_color"><?php $L->p( 'Text Color' ); ?></label>
			<div class="col-sm-4 row">
				<input class="color-picker" id="loader_text_color" name="loader_text_color" value="<?php echo $loader_text_color; ?>" />
				<input id="loader_text_default" type="hidden" value="<?php echo $loader_text_default; ?>" />
				<span class="btn btn-secondary btn-sm" id="loader_text_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>
</fieldset>
