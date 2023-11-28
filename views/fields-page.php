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

					<option value="h2" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'h2' ); ?></option>

					<option value="h3" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'h3' ); ?></option>

					<option value="h4" <?php echo ( $this->getValue( 'related_heading_el' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'h4' ); ?></option>
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
