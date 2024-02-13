<?php
/**
 * Header options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Default values.
$logo_filename = '';
if ( $site->logo() ) {
	$logo_filename = str_replace( DOMAIN_UPLOADS, '', $site->logo() );
}

?>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Header Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Header' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_title"><?php $L->p( 'Website Title' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_title" name="site_title">
				<option value="true" <?php echo ( $this->getValue( 'site_title' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_title' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Title will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_logo"><?php $L->p( 'Website Slogan' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_slogan" name="site_slogan">
				<option value="true" <?php echo ( $this->getValue( 'site_slogan' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_slogan' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Slogan will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo-standard-select"><?php $L->p( 'Standard Logo' ); ?></label>
		<div class="col-sm-10">
			<p><?php $L->p( 'The standard logo image displays in the site header when it has a solid background.' ); ?></p>

			<div id="logo-tabs" class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

				<ul class="nav nav-tabs" id="logo-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-select" aria-selected="false" href="#logo-standard-select"><?php $L->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-upload" aria-selected="false" href="#logo-standard-upload"><?php $L->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-album" aria-selected="false" href="#logo-standard-album"><?php $L->p( 'Album' ); ?></a>
					</li>
				</ul>
				<div id="logo-standard-select" role="tabpanel" aria-labelledby="logo-standard-select">
					<p><?php $L->p( 'Select one from uploaded logo images.' ); ?></p>
					<?php echo $logos_std->select_images( $logo_std ); ?>
				</div>

				<div id="logo-standard-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-standard-upload">

					<p><?php $L->p( 'Drag & drop images or click to browse. Allowed file types: .png, .gif, .jpg, .jpeg' ); ?></p>

					<div class="dropzone" id="logo-standard-upload"></div>

					<div id="logo-standard-upload-notice" style="display: none;">
						<p><?php $L->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a logo image.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php $L->p( 'Refresh' ); ?></button></p>
					</div>

				</div>

				<div id="logo-standard-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-standard-album">
					<p><?php $L->p( 'Manage uploaded logo images.' ); ?></p>
					<div id="logo-standard-album-wrap"><?php echo $logos_std->manage_images( $logo_std ); ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo-cover-select"><?php $L->p( 'Cover Logo' ); ?></label>
		<div class="col-sm-10">
			<p><?php $L->p( 'The cover logo image displays in the site header when it has a full-screen cover image. If no cover logo is selected then the standard logo will be used with full-screen covers.' ); ?></p>

			<div id="logo-tabs" class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

				<ul class="nav nav-tabs" id="logo-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-select" aria-selected="false" href="#logo-cover-select"><?php $L->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-upload" aria-selected="false" href="#logo-cover-upload"><?php $L->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-album" aria-selected="false" href="#logo-cover-album"><?php $L->p( 'Album' ); ?></a>
					</li>
				</ul>
				<div id="logo-cover-select" role="tabpanel" aria-labelledby="logo-cover-select">
					<p><?php $L->p( 'Select one from uploaded logo images.' ); ?></p>
					<?php echo $logos_cover->select_images( $logo_cover ); ?>
				</div>

				<div id="logo-cover-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-cover-upload">

					<p><?php $L->p( 'Drag & drop images or click to browse. Allowed file types: .png, .gif, .jpg, .jpeg' ); ?></p>

					<div class="dropzone" id="logo-cover-upload"></div>

					<div id="logo-cover-upload-notice" style="display: none;">
						<p><?php $L->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a logo image.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php $L->p( 'Refresh' ); ?></button></p>
					</div>

				</div>

				<div id="logo-cover-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-cover-album">
					<p><?php $L->p( 'Manage uploaded logo images. Click image to view full size.' ); ?></p>
					<div id="logo-cover-album-wrap"><?php echo $logos_cover->manage_images( $logo_cover ); ?></div>
				</div>
			</div>
		</div>
	</div>

	<div id="logo_fields" style="display: <?php echo ( $site->logo() ? 'block' : 'none' ); ?>;">
		<div id="logo_width_std_wrap" class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_width_std"><?php $L->p( 'Logo Width, Desktop' ); ?></label>
			<div class="col-sm-10">
				<figure>
					<img id="logo_preview_desktop" class="img-fluid img-thumbnail" alt="<?php echo ( $this->standard_logo_src() ? $L->get( 'Desktop logo preview' ) : $L->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( $this->standard_logo_src() ? $this->standard_logo_src() : '' ); ?>" width="<?php echo $this->getValue( 'logo_width_std' ); ?>" />
				</figure>
				<div class="form-range-controls row">
					<span class="form-range-value px-range-value"><span id="logo_width_std_value"><?php echo $this->getValue( 'logo_width_std' ); ?></span><span id="logo_width_std_units">px</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#logo_width_std_value').html($(this).val());$('#logo_preview_desktop').css('width',$(this).val()+'px');" id="logo_width_std" name="logo_width_std" value="<?php echo $this->getValue( 'logo_width_std' ); ?>" min="0" max="320" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_std_value').text('<?php echo $this->dbFields['logo_width_std']; ?>');$('#logo_width_std').val('<?php echo $this->dbFields['logo_width_std']; ?>');$('#logo_preview_desktop').css('width','<?php echo $this->dbFields['logo_width_std']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
			</div>
		</div>

		<div id="logo_width_mob_wrap" class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_width_mob"><?php $L->p( 'Logo Width, Mobile' ); ?></label>
			<div class="col-sm-10">
				<figure>
					<img id="logo_preview_mobile" class="img-fluid img-thumbnail" alt="<?php echo ( $this->standard_logo_src() ? $L->get( 'Mobile logo preview' ) : $L->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( $this->standard_logo_src() ? $this->standard_logo_src() : '' ); ?>" width="<?php echo $this->getValue( 'logo_width_mob' ); ?>" />
				</figure>
				<div class="form-range-controls row">
					<span class="form-range-value px-range-value"><span id="logo_width_mob_value"><?php echo $this->getValue( 'logo_width_mob' ); ?></span><span id="logo_width_mob_units">px</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#logo_width_mob_value').html($(this).val());$('#logo_preview_mobile').css('width',$(this).val()+'px');" id="logo_width_mob" name="logo_width_mob" value="<?php echo $this->getValue( 'logo_width_mob' ); ?>" min="0" max="320" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_mob_value').text('<?php echo $this->dbFields['logo_width_mob']; ?>');$('#logo_width_mob').val('<?php echo $this->dbFields['logo_width_mob']; ?>');$('#logo_preview_mobile').css('width','<?php echo $this->dbFields['logo_width_mob']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_location"><?php $L->p( 'Logo Placement' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="logo_location" name="logo_location">
					<option value="before" <?php echo ( $this->getValue( 'logo_location' ) === 'before' ? 'selected' : '' ); ?>><?php $L->p( 'Before Text' ); ?></option>

					<option value="above" <?php echo ( $this->getValue( 'logo_location' ) === 'above' ? 'selected' : '' ); ?>><?php $L->p( 'Above Text' ); ?></option>

					<option value="below" <?php echo ( $this->getValue( 'logo_location' ) === 'below' ? 'selected' : '' ); ?>><?php $L->p( 'Below Text' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Where to place the logo in the header branding section.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_sticky"><?php $L->p( 'Sticky Header' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_sticky" name="header_sticky">
				<option value="true" <?php echo ( $this->getValue( 'header_sticky' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_sticky' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Makes the branding and navigation stick to the top of the viewport. Not for mobile screens.' ); ?></small>
		</div>
	</div>
</fieldset>

<script>
$( function() {
	$( '.delete-logo-standard' ).bind( 'click', function() {
		if ( ! confirm( '<?php $L->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteStandardLogo(this);
	});
});
$( function() {
	$( '.delete-logo-cover' ).bind( 'click', function() {
		if ( ! confirm( '<?php $L->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteCoverLogo(this);
	});
});

function deleteStandardLogo(el) {
	$.post( logo.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#logo-standard-image-' + $(el).data( 'number' );
		let select = '#logo-standard-select-item-' + $(el).data( 'number' );
		let input  = '#logo-standard-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450 );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : logo.L.error,
			content : logo.L.deleteImageError
		});
	});
}
function deleteCoverLogo(el) {
	$.post( logo.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#logo-cover-image-' + $(el).data( 'number' );
		let select = '#logo-cover-select-item-' + $(el).data( 'number' );
		let input  = '#logo-cover-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450 );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : logo.L.error,
			content : logo.L.deleteImageError
		});
	});
}
</script>
