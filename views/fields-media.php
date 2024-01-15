<?php
/**
 * Media options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Colors\{
	color_schemes,
	hex_to_rgb
};

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';

// Color schemes.
$colors = color_schemes();
$custom_from = $this->custom_scheme_from();

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Media Options' ) ] ); ?>
<fieldset>
	<legend class="screen-reader-text"><?php $L->p( 'Media' ); ?></legend>

	<p><?php $L->p( 'Image upload fields coming for bookmark icon (favicon) and default cover image. For now, the options require you to use complete URLs, such as to CDN images, add the images to the theme\'s assets/images directory, or add to the bl-content/uploads directory. The theme will look first in the bl-content/uploads directory if not using an external image.' ); ?></p>

	<p><?php $L->p( 'For both the bookmark icon and the default cover fields, simply add the URL, or add filename & extension (e.g. favicon.png or cover.jpg).' ); ?></p>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_favicon"><?php $L->p( 'Bookmark Icon' ); ?></label>
		<div class="col-sm-4">
			<input type="text" id="site_favicon" name="site_favicon" value="<?php echo $this->getValue( 'site_favicon' ); ?>" placeholder="<?php $L->p( 'favicon.png;' ); ?>" />
			<small class="form-text"><?php $L->p( 'The image that appears in browser tabs and that is used when saving a page to a mobile screen.' ); ?></small>
		</div>
		<?php if ( ! is_null( $this->favicon_src() ) ) : ?>
		<div class="col-sm-2">
			<a href="<?php echo $this->favicon_src(); ?>" target="_blank" rel="noopener noreferrer">
				<img class="image-field-preview" src="<?php echo $this->favicon_src(); ?>" alt="Bookmark Icon" />
			</a>
		</div>
		<?php else : ?>
		<p class=""><strong><?php $L->p( 'Image file not found.' ); ?></strong></p>
		<?php endif; ?>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="modal_bg_color"><?php $L->p( 'Modal Background' ); ?></label>
		<div class="col-sm-10">
			<div class="row color-picker-wrap">
				<input class="color-picker" id="modal_bg_color" name="modal_bg_color" value="<?php echo $this->modal_bg_color(); ?>" />
				<input id="modal_bg_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['modal_bg_color']; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="modal_bg_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
			<p><small class="form-text"><?php $L->p( 'Background color for modal (pop-up) windows.' ); ?></small></p>
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
			<small class="form-text"><?php $L->p( 'The image used on loop pages and used when a page has no cover image set.' ); ?></small>
		</div>
		<?php if ( ! is_null( $this->cover_src() ) ) : ?>
		<div class="col-sm-2">
			<a href="<?php echo $this->cover_src(); ?>" target="_blank" rel="noopener noreferrer">
				<img class="image-field-preview" src="<?php echo $this->cover_src(); ?>" alt="Default Cover" />
			</a>
		</div>
		<?php else : ?>
		<p class=""><strong><?php $L->p( 'Image file not found.' ); ?></strong></p>
		<?php endif; ?>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_style"><?php $L->p( 'Cover Color Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_style" name="cover_style">
				<option value="overlay" <?php echo ( $this->getValue( 'cover_style' ) === 'overlay' ? 'selected' : '' ); ?>><?php $L->p( 'Color Overlay' ); ?></option>
				<option value="blend" <?php echo ( $this->getValue( 'cover_style' ) === 'blend' ? 'selected' : '' ); ?>><?php $L->p( 'Color Blend' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Cover images can have a simple overlay or blend with a color.' ); ?></small>
		</div>
	</div>

	<div id="cover_overlay_wrap" style="display: <?php echo ( $this->getValue( 'cover_style' ) === 'overlay' ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_desaturate"><?php $L->p( 'Desaturate' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value px-range-value"><span id="cover_desaturate_value"><?php echo ( $this->getValue( 'cover_desaturate' ) ? $this->getValue( 'cover_desaturate' ) : $this->dbFields['cover_desaturate'] ); ?></span><span id="cover_desaturate_units">%</span></span>
					<input type="range" class="form-control-range" onInput="$('#cover_desaturate_value').html($(this).val())" id="cover_desaturate" name="cover_desaturate" value="<?php echo $this->getValue( 'cover_desaturate' ); ?>" min="0" max="100" step="1" />
					<span id="cover_desaturate_reset" class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#cover_desaturate_value').text('<?php echo $this->dbFields['cover_desaturate']; ?>');$('#cover_desaturate').val('<?php echo $this->dbFields['cover_desaturate']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'Percentage to desaturate images. Set 100% for full grayscale (black & white).' ); ?></small>
			</div>
		</div>

		<div id="cover-desaturate-use-wrap" class="form-field form-group row" style="display: <?php echo ( $this->cover_desaturate() > 0 ? 'flex' : 'none' ); ?>">
			<label class="form-label col-sm-2 col-form-label" for="cover_desaturate_use"><?php $L->p( 'Desaturate Usage' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php $L->p( 'Where to apply desaturation to cover images.' ); ?></small>

				<div id="cover-desaturate-use" class="multi-check-wrap">

					<label class="check-label-wrap" for="desaturate_covers"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_covers" value="covers" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'covers', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Page Covers' ); ?></label>

					<?php if ( $this->posts_slider() ) : ?>
					<label class="check-label-wrap" for="desaturate_slider"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_slider" value="slider" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'slider', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Front Page Slider' ); ?></label>
					<?php endif; ?>

					<label class="check-label-wrap" for="desaturate_loop"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_loop" value="loop" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'loop', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Main Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_cat"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_cat" value="cat" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'cat', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Category Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_tag"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_tag" value="tag" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'tag', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Tag Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_search"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_search" value="search" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'search', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Search Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_related"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_related" value="related" <?php echo ( is_array( $this->cover_desaturate_use() ) && in_array( 'related', $this->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Related Posts' ); ?></label>
				</div>
				<small class="form-text"><?php $L->p( '' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_overlay"><?php $L->p( 'Overlay Color' ); ?></label>
			<div class="col-sm-10 row color-picker-wrap">
				<input class="color-picker" id="cover_overlay" name="cover_overlay" value="<?php echo $this->cover_overlay(); ?>" />
				<input id="cover_overlay_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['cover_overlay']; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_overlay_default_button"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div id="cover_blend_wrap" style="display: <?php echo ( $this->getValue( 'cover_style' ) === 'blend' ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_blend"><?php $L->p( 'Blend Color' ); ?></label>
			<div class="col-sm-10">
				<div class="row color-picker-wrap">
					<input class="color-picker" id="cover_blend" name="cover_blend" value="<?php echo $this->cover_blend(); ?>" />
					<input id="cover_blend_default" class="screen-reader-text" type="hidden" value="<?php echo ( isset( $colors[$custom_from]['cover'] ) ? $colors[$custom_from]['cover'] : $colors[$custom_from]['light']['three'] ); ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_blend_default_button"><?php $L->p( 'Reset' ); ?></span>
				</div>
				<p class="m-0"><?php $L->p( "Go to the <a href='{$colors_page}'>color scheme reference</a> page for more colors from the current scheme." ); ?></p>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_blend_use"><?php $L->p( 'Color Blend Usage' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php $L->p( 'Where to apply color blend to cover images.' ); ?></small>

				<div id="cover-blend-use-wrap" class="multi-check-wrap">
					<label class="check-label-wrap" for="blend_covers"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_covers" value="covers" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'covers', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Page Covers' ); ?></label>

					<label id="blend_slider_label" class="check-label-wrap" for="blend_slider" style="display: <?php echo ( $this->posts_slider() ? 'inline-block' : 'none' ); ?>"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_slider" value="slider" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'slider', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Front Page Slider' ); ?></label>

					<label class="check-label-wrap" for="blend_loop"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_loop" value="loop" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'loop', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Main Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_cat"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_cat" value="cat" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'cat', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Category Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_tag"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_tag" value="tag" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'tag', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Tag Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_search"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_search" value="search" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'search', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Search Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_related"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_related" value="related" <?php echo ( is_array( $this->cover_blend_use() ) && in_array( 'related', $this->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php $L->p( 'Related Posts' ); ?></label>
				</div>
				<small class="form-text"><?php $L->p( 'At least one option is required. Select "Color Overlay" style above to fully disable color blend.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_text_color"><?php $L->p( 'Text Color' ); ?></label>
		<div class="col-sm-10 row color-picker-wrap">
			<input class="color-picker" id="cover_text_color" name="cover_text_color" value="<?php echo $this->cover_text_color(); ?>" />
			<input id="cover_text_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['cover_text_color']; ?>" />
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
			<small class="form-text"><?php $L->p( 'Shadow behind overlay text can provide needed contrast.' ); ?></small>
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
			<small class="form-text">
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
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_width').val('<?php echo $this->dbFields['thumb_width']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'Thumbnail width in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_height"><?php $L->p( 'Height' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_height" name="thumb_height" value="<?php echo $this->thumb_height(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_height').val('<?php echo $this->dbFields['thumb_height']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'Thumbnail height in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_quality"><?php $L->p( 'Quality' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_quality" name="thumb_quality" value="<?php echo $this->thumb_quality(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_quality').val('<?php echo $this->dbFields['thumb_quality']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'Thumbnail quality in percentage (%).' ); ?></small>
		</div>
	</div>

</fieldset>
