<?php
/**
 * Media options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Modal window background value.
$modal_bg_default = $this->modal_bg_default();
$modal_bg_color   = $modal_bg_default;
if ( ! empty( $this->getValue( 'modal_bg_color' ) ) ) {
	$modal_bg_color = $this->getValue( 'modal_bg_color' );
}

// Cover image background value.
$cover_overlay_default = $this->cover_overlay_default();
$cover_overlay   = $cover_overlay_default;
if ( ! empty( $this->getValue( 'cover_overlay' ) ) ) {
	$cover_overlay = $this->getValue( 'cover_overlay' );
}

// Cover image text value.
$cover_text_default = $this->cover_text_default();
$cover_text_color   = $cover_text_default;
if ( ! empty( $this->getValue( 'cover_text_color' ) ) ) {
	$cover_text_color = $this->getValue( 'cover_text_color' );
}

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Media Options' ) ] ); ?>
<fieldset>
	<legend class="screen-reader-text"><?php $L->p( 'Media' ); ?></legend>

	<p><?php $L->p( 'Image upload fields coming for bookmark icon (favicon) and default cover image. For now, the options require you to add the images to the theme\'s assets/images directory or to the bl-content/uploads directory. The theme will look first in the bl-content/uploads directory.' ); ?></p>

	<p><?php $L->p( 'For both the bookmark icon and the default cover fields, simply add the filename & extension (e.g. favicon.png or cover.jpg).' ); ?></p>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_favicon"><?php $L->p( 'Bookmark Icon' ); ?></label>
		<div class="col-sm-4">
			<input type="text" id="site_favicon" name="site_favicon" value="<?php echo $this->getValue( 'site_favicon' ); ?>" placeholder="<?php $L->p( 'favicon.png;' ); ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The image that appears in browser tabs and that is used when saving a page to a mobile screen.' ); ?></small>
		</div>
		<?php if ( ! is_null( $this->favicon_src() ) ) : ?>
		<div class="col-sm-2">
			<a href="<?php echo $this->favicon_src(); ?>" target="_blank" rel="noopener noreferrer">
				<img class="image-field-preview" src="<?php echo $this->favicon_src(); ?>" alt="Bookmark Icon" />
			</a>
		</div>
		<?php else : ?>
		<p class="text-muted"><strong><?php $L->p( 'Image file not found.' ); ?></strong></p>
		<?php endif; ?>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="modal_bg_color"><?php $L->p( 'Modal Background' ); ?></label>
		<div class="col-sm-10">
			<div class="row color-picker-wrap">
				<input class="color-picker" id="modal_bg_color" name="modal_bg_color" value="<?php echo $modal_bg_color; ?>" />
				<input id="modal_bg_default" class="screen-reader-text" type="hidden" value="<?php echo $modal_bg_default; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="modal_bg_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
			<p><small class="form-text text-muted"><?php $L->p( 'Background color for modal (pop-up) windows.' ); ?></small></p>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Cover Images' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Cover Images' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="default_cover"><?php $L->p( 'Default Cover' ); ?></label>
		<div class="col-sm-4">
			<input type="text" id="default_cover" name="default_cover" value="<?php echo $this->getValue( 'default_cover' ); ?>" placeholder="<?php $L->p( 'cover.jpg' ); ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The image used on loop pages and used when a page has no cover image set.' ); ?></small>
		</div>
		<?php if ( ! is_null( $this->cover_src() ) ) : ?>
		<div class="col-sm-2">
			<a href="<?php echo $this->cover_src(); ?>" target="_blank" rel="noopener noreferrer">
				<img class="image-field-preview" src="<?php echo $this->cover_src(); ?>" alt="Default Cover" />
			</a>
		</div>
		<?php else : ?>
		<p class="text-muted"><strong><?php $L->p( 'Image file not found.' ); ?></strong></p>
		<?php endif; ?>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_overlay"><?php $L->p( 'Overlay Color' ); ?></label>
		<div class="col-sm-10 row color-picker-wrap">
			<input class="color-picker" id="cover_overlay" name="cover_overlay" value="<?php echo $cover_overlay; ?>" />
			<input id="cover_overlay_default" class="screen-reader-text" type="hidden" value="<?php echo $cover_overlay_default; ?>" />
			<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_overlay_default_button"><?php $L->p( 'Default' ); ?></span>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_text_color"><?php $L->p( 'Text Color' ); ?></label>
		<div class="col-sm-10 row color-picker-wrap">
			<input class="color-picker" id="cover_text_color" name="cover_text_color" value="<?php echo $cover_text_color; ?>" />
			<input id="cover_text_default" class="screen-reader-text" type="hidden" value="<?php echo $cover_text_default; ?>" />
			<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_text_color_default"><?php $L->p( 'Default' ); ?></span>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_text_shadow"><?php $L->p( 'Text Shadow' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_text_shadow" name="cover_text_shadow">
				<option value="true" <?php echo ( $this->getValue( 'cover_text_shadow' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'cover_text_shadow' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Shadow behind overlay text can provide needed contrast.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_icon"><?php $L->p( 'Down Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_icon" name="cover_icon">

				<option value="angle-down" <?php echo ( $this->getValue( 'cover_icon' ) === 'angle-down' ? 'selected' : '' ); ?>><?php $L->p( 'Angle' ); ?></option>

				<option value="angle-down-light" <?php echo ( $this->getValue( 'cover_icon' ) === 'angle-down-light' ? 'selected' : '' ); ?>><?php $L->p( 'Angle Light' ); ?></option>

				<option value="angles-down" <?php echo ( $this->getValue( 'cover_icon' ) === 'angles-down' ? 'selected' : '' ); ?>><?php $L->p( 'Double Angle' ); ?></option>

				<option value="angles-down-light" <?php echo ( $this->getValue( 'cover_icon' ) === 'angles-down-light' ? 'selected' : '' ); ?>><?php $L->p( 'Double Angle Light' ); ?></option>

				<option value="arrow-down" <?php echo ( $this->getValue( 'cover_icon' ) === 'arrow-down' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow' ); ?></option>

				<option value="arrow-down-light" <?php echo ( $this->getValue( 'cover_icon' ) === 'arrow-down-light' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow Light' ); ?></option>
			</select>
			<small class="form-text text-muted">
				<?php $L->p( 'Choose the style of icon to scroll to content. For full-screen covers only.' ); ?>
			</small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Thumbnail Images' ) ] ); ?>
<p><?php $L->p( 'Duplicate of the thumbnail options under Settings > Images.' ); ?></p>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Thumbnail Images' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_width"><?php $L->p( 'Width' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_width" name="thumb_width" value="<?php echo $this->thumb_width(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_width').val('<?php echo $this->thumb_width_default(); ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted"><?php $L->p( 'Thumbnail width in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_height"><?php $L->p( 'Height' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_height" name="thumb_height" value="<?php echo $this->thumb_height(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_height').val('<?php echo $this->thumb_height_default(); ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted"><?php $L->p( 'Thumbnail height in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_quality"><?php $L->p( 'Quality' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_quality" name="thumb_quality" value="<?php echo $this->thumb_quality(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_quality').val('<?php echo $this->thumb_quality_default(); ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted"><?php $L->p( 'Thumbnail quality in percentage (%).' ); ?></small>
		</div>
	</div>

</fieldset>
