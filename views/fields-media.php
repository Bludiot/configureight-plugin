<?php
/**
 * Media options fields
 *
 * @package    Configure 8 Settings
 * @subpackage Views
 * @since      1.0.0
 */

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Media Options' ) ] ); ?>
<fieldset>
	<legend class="screen-reader-text"><?php $L->p( 'Media' ); ?></legend>

	<p><?php $L->p( 'Image upload fields coming for bookmark icon (favicon) and default cover image.' ); ?></p>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Cover Images' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Cover Images' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_bg_color"><?php $L->p( 'Background Color' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="cover_bg_color" name="cover_bg_color" value="<?php echo $this->getValue( 'cover_bg_color' ) ?>" placeholder="#000000" />
			<small class="form-text text-muted"><?php $L->p( 'Enter a hexadecimal color, including hashtag.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_bg_opacity"><?php $L->p( 'Text Color' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="cover_bg_opacity" name="cover_bg_opacity" value="<?php echo $this->getValue( 'cover_bg_opacity' ) ?>" placeholder="0.5" />
			<small class="form-text text-muted"><?php $L->p( 'Enter a number to the tenth decimal between 0 and 1. For example: 0.5' ); ?></small>
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
