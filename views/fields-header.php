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

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Header Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Header' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_title"><?php $L->p( 'Website Title' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_title" name="site_title">
				<option value="true" <?php echo ( $this->getValue( 'site_title' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_title' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Title will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_slogan"><?php $L->p( 'Website Slogan' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_slogan" name="site_slogan">
				<option value="true" <?php echo ( $this->getValue( 'site_slogan' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_slogan' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Slogan will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<div class="form-label col-sm-2 col-form-label"><?php $L->p( 'Logo Image' ); ?></div>
		<div class="col-sm-10 row image-field-buttons">
			<label id="logo_upload_button" for="logo_upload" class="btn <?php echo ( $site->logo() ? 'btn-light' : 'btn-primary' ) ?> btn-md button"><span id="logo_upload_button_text"><?php echo ( $site->logo() ? $logo_filename : $L->get( 'Upload&nbsp;Image' ) ); ?></span><input id="logo_upload" class="screen-reader-text" type="file" name="inputFile"></label>
			<button id="remove_logo" type="button" class="btn <?php echo ( $site->logo() ? 'btn-danger' : 'btn-light' ) ?> btn-md button" <?php echo ( $site->logo() ? '' : 'disabled' ); ?>><?php $L->p( 'Remove&nbsp;Image' ); ?></button>
		</div>
		<script>
			$( '#remove_logo' ).on( 'click', function() {

				// Stop if confirmation is cancelled.
				if ( ! confirm( '<?php $L->p( 'Are you sure you want to remove the logo?' ); ?>' ) ) { return; };

				// AJAX remove the image file and reset the database value.
				bluditAjax.removeLogo();

				// Modify field markup.
				$(this).removeClass( 'btn-danger' ).addClass( 'btn-light' ).attr( 'disabled', 'disabled' );
				$( '#logo_upload_button' ).removeClass( 'btn-light' ).addClass( 'btn-primary' );
				$( '#logo_upload_button_text' ).html( '<?php $L->p( 'Upload&nbsp;Image' ); ?>' );
				$( '#logo_preview_desktop' ).attr( 'src', '' ).attr( 'alt', '<?php $L->p( 'No logo uploaded' ); ?>' );
				$( '#logo_preview_mobile' ).attr( 'src', '' ).attr( 'alt', '<?php $L->p( 'No logo uploaded' ); ?>' );
			});

			$( '#logo_upload' ).on( 'change', function() {

				var formData = new FormData();

				formData.append( 'tokenCSRF', tokenCSRF );
				formData.append( 'inputFile', $(this)[0] . files[0] );
				$.ajax( {
					url   : HTML_PATH_ADMIN_ROOT + "ajax/logo-upload",
					type  : "POST",
					data  : formData,
					cache : false,
					contentType : false,
					processData : false
				} ).done( function(data) {

					if ( data.status == 0 ) {
						$( '#remove_logo' ).removeClass( 'btn-light' ).addClass( 'btn-danger' ).removeAttr( 'disabled' );
						$( '#logo_upload_button' ).removeClass( 'btn-primary' ).addClass( 'btn-light' );
						$( '#logo_upload_button_text' ).html( data.filename );
						$( '#logo_preview_desktop' ).attr( 'src', data.absoluteURL + '?time=' + Math.random() ).attr( 'alt', '<?php $L->p( 'Desktop logo preview' ); ?>' );
						$( '#logo_preview_mobile' ).attr( 'src', data.absoluteURL + '?time=' + Math.random() ).attr( 'alt', '<?php $L->p( 'Mobile logo preview' ); ?>' );
					} else {
						showAlert( data.message );
					}
				});
			});
		</script>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_std"><?php $L->p( 'Logo Width, Desktop' ); ?></label>
		<div class="col-sm-10">
			<figure>
				<img id="logo_preview_desktop" class="img-fluid img-thumbnail" alt="<?php echo ( $site->logo() ? $L->get( 'Desktop logo preview' ) : $L->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( $site->logo() ? DOMAIN_UPLOADS . $site->logo( false ) . '?version=' . time() : '' ); ?>" width="<?php echo $this->getValue( 'logo_width_std' ); ?>" />
			</figure>
			<div class="form-range-controls row">
				<span class="form-range-value px-range-value"><span id="logo_width_std_value"><?php echo $this->getValue( 'logo_width_std' ); ?></span><span id="logo_width_std_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_std_value').html($(this).val());$('#logo_preview_desktop').css('width',$(this).val()+'px');" id="logo_width_std" name="logo_width_std" value="<?php echo $this->getValue( 'logo_width_std' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_std_value').text('<?php echo $this->dbFields['logo_width_std']; ?>');$('#logo_width_std').val('<?php echo $this->dbFields['logo_width_std']; ?>');$('#logo_preview_desktop').css('width','<?php echo $this->dbFields['logo_width_std']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_mob"><?php $L->p( 'Logo Width, Mobile' ); ?></label>
		<div class="col-sm-10">
			<figure>
				<img id="logo_preview_mobile" class="img-fluid img-thumbnail" alt="<?php echo ( $site->logo() ? $L->get( 'Mobile logo preview' ) : $L->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( $site->logo() ? DOMAIN_UPLOADS . $site->logo( false ) . '?version=' . time() : '' ); ?>" width="<?php echo $this->getValue( 'logo_width_mob' ); ?>" />
			</figure>
			<div class="form-range-controls row">
				<span class="form-range-value px-range-value"><span id="logo_width_mob_value"><?php echo $this->getValue( 'logo_width_mob' ); ?></span><span id="logo_width_mob_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_mob_value').html($(this).val());$('#logo_preview_mobile').css('width',$(this).val()+'px');" id="logo_width_mob" name="logo_width_mob" value="<?php echo $this->getValue( 'logo_width_mob' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_mob_value').text('<?php echo $this->dbFields['logo_width_mob']; ?>');$('#logo_width_mob').val('<?php echo $this->dbFields['logo_width_mob']; ?>');$('#logo_preview_mobile').css('width','<?php echo $this->dbFields['logo_width_mob']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_sticky"><?php $L->p( 'Sticky Header' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_sticky" name="header_sticky">
				<option value="true" <?php echo ( $this->getValue( 'header_sticky' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_sticky' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Makes the branding and navigation stick to the top of the viewport.' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Navigation Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Navigation' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pos"><?php $L->p( 'Navigation Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_pos" name="main_nav_pos">

				<option value="right" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'right' ? 'selected' : '' ); ?>><?php $L->p( 'Right of Site Branding' ); ?></option>

				<option value="left" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'left' ? 'selected' : '' ); ?>><?php $L->p( 'Left of Site Branding' ); ?></option>

				<option value="above" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'above' ? 'selected' : '' ); ?>><?php $L->p( 'Above Site Branding' ); ?></option>

				<option value="below" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'below' ? 'selected' : '' ); ?>><?php $L->p( 'Below Site Branding' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Right and left options will be reversed for right-to-left languages.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_icon"><?php $L->p( 'Menu Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_icon" name="main_nav_icon">

				<option value="bars" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'bars' ? 'selected' : '' ); ?>><?php $L->p( 'Bars' ); ?></option>

				<option value="dots" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'dots' ? 'selected' : '' ); ?>><?php $L->p( 'Dots' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None (Text)' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The icon to toggle the mobile menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="max_nav_items"><?php $L->p( 'Maximum Items' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="max_nav_items" name="max_nav_items" value="<?php echo $this->getValue( 'max_nav_items' ); ?>" placeholder="<?php echo $this->dbFields['max_nav_items']; ?>" />
			<small class="form-text text-muted"><?php $L->p( 'Enter 0 for no limit to navigation items.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop"><?php $L->p( 'Loop Nav Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_loop" name="main_nav_loop">

				<option value="before" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'before' ? 'selected' : '' ); ?>><?php $L->p( 'Before Pages' ); ?></option>

				<option value="after" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'after' ? 'selected' : '' ); ?>><?php $L->p( 'After Pages' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Link' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the posts loop, blog or news.' ); ?></small>
		</div>
	</div>

	<div id="main_nav_loop_label_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'main_nav_loop' ) != 'none' ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop_label"><?php $L->p( 'Loop Link Label' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="main_nav_loop_label" name="main_nav_loop_label" value="<?php echo $this->getValue( 'main_nav_loop_label' ); ?>" placeholder="<?php echo $this->dbFields['main_nav_loop_label']; ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The label for the loop link in the main navigation.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_home"><?php $L->p( 'Home Nav Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_home" name="main_nav_home">
				<option value="true" <?php echo ( $this->getValue( 'main_nav_home' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'main_nav_home' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the home page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_search"><?php $L->p( 'Search Button' ); ?></label>
		<div class="col-sm-10">
			<?php

			// If the Search plugin is installed and activated.
			if ( getPlugin( 'Search_Forms' ) ) : ?>
			<select class="form-select" id="header_search" name="header_search">
				<option value="true" <?php echo ( $this->getValue( 'header_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a search icon in the navigation to toggle the header search bar.' ); ?></small>
			<?php

			// If the Search plugin is installed and not activated.
			elseif ( class_exists( 'Search_Forms' ) ) : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please activate the Search Forms plugin:' ),
					DOMAIN_ADMIN . 'install-plugin/Search_Forms',
					DOMAIN_ADMIN . 'install-plugin/Search_Forms'
				); ?>
			<?php

			// If the Search plugin is not installed in bl-plugins.
			else : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please download, install, and activate the Search Forms plugin:' ),
					'https://github.com/Bludiot/searchforms',
					$L->get( 'GitHub Repository' )
				); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_social"><?php $L->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_social" name="header_social">
				<option value="true" <?php echo ( $this->getValue( 'header_social' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_social' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
</fieldset>
