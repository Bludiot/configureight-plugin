<?php
/**
 * General options fields
 *
 * @package    Configure 8 Settings
 * @subpackage Views
 * @since      1.0.0
 */

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Interface Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Interface' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="user_toolbar"><?php $L->p( 'User Toolbar' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="user_toolbar" name="user_toolbar">
				<option value="true" <?php echo ( $this->getValue( 'user_toolbar' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'user_toolbar' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Displayed only to logged-in users.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="to_top_button"><?php $L->p( 'To Top Button' ); ?></label>
		<div class="col-sm-10">
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
		<div class="col-sm-10">
			<select class="form-select" id="page_loader" name="page_loader">
				<option value="false" <?php echo ( $this->getValue( 'page_loader' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
				<option value="true" <?php echo ( $this->getValue( 'page_loader' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'A full-screen display that hides the web page until it is fully loaded.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loader_text"><?php $L->p( 'Loading Text' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="loader_text" name="loader_text" value="<?php echo $this->getValue( 'loader_text' ) ?>" placeholder="<?php $L->p( 'Enter text' ); ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The text to display on the loading screen.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loader_bg_color"><?php $L->p( 'Background Color' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="loader_bg_color" name="loader_bg_color" value="<?php echo $this->getValue( 'loader_bg_color' ) ?>" placeholder="<?php $L->p( 'Enter text' ); ?>" />
			<small class="form-text text-muted"><?php $L->p( 'Enter a hexadecimal color code or a color name.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loader_text_color"><?php $L->p( 'Text Color' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="loader_text_color" name="loader_text_color" value="<?php echo $this->getValue( 'loader_text_color' ) ?>" placeholder="<?php $L->p( 'Enter text' ); ?>" />
			<small class="form-text text-muted"><?php $L->p( 'Enter a hexadecimal color code or a color name.' ); ?></small>
		</div>
	</div>
</fieldset>
