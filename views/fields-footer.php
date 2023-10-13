<?php
/**
 * Footer options fields
 *
 * @package    Configure 8 Settings
 * @subpackage Views
 * @since      1.0.0
 */

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Footer Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Footer' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="copyright"><?php $L->p( 'Copyright Line' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="copyright" name="copyright">
				<option value="true" <?php echo ( $this->getValue( 'copyright' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'copyright' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a copyright line at the bottom of each web page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="copy_date"><?php $L->p( 'Copyright Date' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="copy_date" name="copy_date">
				<option value="true" <?php echo ( $this->getValue( 'copy_date' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'copy_date' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Only displayed if the copyright line is displayed.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="copy_text"><?php $L->p( 'Copyright Text' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="copy_text" name="copy_text" value="<?php echo $this->getValue( 'copy_text' ) ?>" placeholder="<?php $L->p( 'Enter text' ); ?>" />
			<small class="form-text text-muted">
				<code style="user-select: all;">%copy%</code>
				<code style="user-select: all;">%year%</code>
			</small>
		</div>
	</div>
</fieldset>
