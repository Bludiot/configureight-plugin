<?php
/**
 * Footer options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

$copy_text_placeholder = sprintf(
	'© %s %s. %s',
	date( 'Y' ),
	$site->title(),
	$L->get( 'All rights reserved.' )
);
?>

<script>
jQuery(document).ready( function($) {

	// Sidebar options.
	$( '#footer_social' ).on( 'change', function() {
    	var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#ftr_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#ftr_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#ftr_social_heading_wrap" ).fadeOut( 250 );
		}
    });

	// Copyright options.
	$( '#copyright' ).on( 'change', function() {
    	var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#copyright_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#copy_date' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#copyright_options" ).fadeOut( 250 );
		}
    });
});
</script>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Footer Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Footer' ); ?></legend>

	<?php if ( Theme :: socialNetworks() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="footer_social"><?php $L->p( 'Social Links' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="footer_social" name="footer_social">
				<option value="true" <?php echo ( $this->getValue( 'footer_social' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'footer_social' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display the navigation menu for links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>

	<div id="ftr_social_heading_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'footer_social' ) === true ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="ftr_social_heading"><?php $L->p( 'Social Heading Text' ); ?></label>
		<div class="col-sm-4">
			<input type="text" id="ftr_social_heading" name="ftr_social_heading" value="<?php echo $this->getValue( 'ftr_social_heading' ) ?>" placeholder="<?php $L->p( 'Social Links' ); ?>" />
		</div>
	</div>
	<?php endif; ?>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="copyright"><?php $L->p( 'Copyright Line' ); ?></label>
		<div class="col-sm-4">
			<select class="form-select" id="copyright" name="copyright">
				<option value="true" <?php echo ( $this->getValue( 'copyright' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'copyright' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a copyright line at the bottom of each web page.' ); ?></small>
		</div>
	</div>

	<div id="copyright_options" style="display: <?php echo ( $this->getValue( 'copyright' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="copy_date"><?php $L->p( 'Copyright Date' ); ?></label>
			<div class="col-sm-4">
				<select class="form-select" id="copy_date" name="copy_date">
					<option value="true" <?php echo ( $this->getValue( 'copy_date' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
					<option value="false" <?php echo ( $this->getValue( 'copy_date' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
				</select>
				<small class="form-text text-muted"><?php $L->p( 'Only displayed if the copyright line is displayed.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="copy_text"><?php $L->p( 'Copyright Text' ); ?></label>
			<div class="col-sm-4">
				<input type="text" id="copy_text" name="copy_text" value="<?php echo $this->getValue( 'copy_text' ) ?>" placeholder="<?php echo $copy_text_placeholder; ?>" />
				<small class="form-text text-muted">
					<code class="select">%copy%</code>
					<code class="select">%year%</code>
				</small>
			</div>
		</div>
	</div>
</fieldset>
