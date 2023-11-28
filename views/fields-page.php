<?php
/**
 * Page options fields
 *
 * For singular posts & pages, not in loop.
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Default related posts values.
$max_related_default = $this->max_related_default();

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Post/Page Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Pages' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="related_posts"><?php $L->p( 'Related Posts' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="related_posts" name="related_posts">
				<option value="true" <?php echo ( $this->getValue( 'related_posts' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'related_posts' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Show related posts on singular post pages.' ); ?></small>
		</div>
	</div>

	<div id="related_options" style="display: <?php echo ( $this->getValue( 'related_posts' ) === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="max_related"><?php $L->p( 'Maximum Posts' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="max_related_value"><?php echo ( $this->getValue( 'max_related' ) ? $this->getValue( 'max_related' ) : $max_related_default ); ?></span></span>
					<input type="range" class="form-control-range" onInput="$('#max_related_value').html($(this).val())" id="max_related" name="max_related" value="<?php echo $this->getValue( 'max_related' ); ?>" min="1" max="9" step="1" />
					<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#max_related_value').text('<?php echo $max_related_default; ?>');$('#max_related').val('<?php echo $max_related_default; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text text-muted form-range-small"><?php $L->p( 'The number of related posts to display.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_heading"><?php $L->p( 'Related Heading' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="related_heading" name="related_heading" value="<?php echo $this->getValue( 'related_heading' ); ?>" placeholder="<?php $L->p( 'Related Posts' ); ?>" />
				<small class="form-text text-muted"><?php $L->p( 'The text of the related posts heading.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_heading_el"><?php $L->p( 'Heading Level' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="related_heading_el" name="related_heading_el">

					<option value="h2" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'H2' ); ?></option>

					<option value="h3" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'H3' ); ?></option>

					<option value="h4" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'H4' ); ?></option>
				</select>
				<small class="form-text text-muted"><?php $L->p( 'The heading element to use for related posts.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_style"><?php $L->p( 'Related Style' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="related_style" name="related_style">

					<option value="list" <?php echo ( $this->getValue( 'related_style' ) === 'list' ? 'selected' : '' ); ?>><?php $L->p( 'List' ); ?></option>

					<option value="grid" <?php echo ( $this->getValue( 'related_style' ) === 'grid' ? 'selected' : '' ); ?>><?php $L->p( 'Grid' ); ?></option>
				</select>
				<small class="form-text text-muted"><?php $L->p( 'Presentation style for related posts.' ); ?></small>
			</div>
		</div>
	</div>

</fieldset>
