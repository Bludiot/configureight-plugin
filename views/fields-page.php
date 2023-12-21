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

// Get the search plugin object.
$placeholder = $this->error_search_holder();
if ( getPlugin( 'Search_Forms' ) ) {
	$search      = new Search_Forms;
	$min_chars   = $search->min_chars();
	$placeholder = $L->get( "Enter at least {$min_chars} characters." );
}

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Post/Page Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Post/Page Options' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="posts_nav"><?php $L->p( 'Posts Navigation' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="posts_nav" name="posts_nav">
				<option value="true" <?php echo ( $this->getValue( 'posts_nav' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'posts_nav' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Show the previous/next post navigation. Not available on static pages.' ); ?></small>
		</div>
	</div>

	<div id="posts_nav_wrap" style="display: <?php echo ( $this->getValue( 'posts_nav' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="posts_nav_type"><?php $L->p( 'Posts Nav Type' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="posts_nav_type" name="posts_nav_type">
					<option value="buttons" <?php echo ( $this->getValue( 'posts_nav_type' ) === 'buttons' ? 'selected' : '' ); ?>><?php $L->p( 'Buttons' ); ?></option>
					<option value="titles" <?php echo ( $this->getValue( 'posts_nav_type' ) === 'titles' ? 'selected' : '' ); ?>><?php $L->p( 'Titles' ); ?></option>
				</select>
				<small class="form-text text-muted"><?php $L->p( 'The style of posts navigation.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Related Posts' ) ] ); ?>

<p><?php $L->p( 'The related posts section is not displayed on static pages.' ); ?></p>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Show Related' ); ?></legend>

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
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#max_related_value').text('<?php echo $max_related_default; ?>');$('#max_related').val('<?php echo $max_related_default; ?>');"><?php $L->p( 'Default' ); ?></span>
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

<?php

// If a 404 page has been set in Settings > Advanced.
if ( $site->pageNotFound() ) :

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( '404 Error Template' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( '404 Error' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="error_widgets"><?php $L->p( '404 Widgets' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="error_widgets" name="error_widgets">
				<option value="below" <?php echo ( $this->getValue( 'error_widgets' ) === 'below' ? 'selected' : '' ); ?>><?php $L->p( 'Below Content' ); ?></option>
				<option value="above" <?php echo ( $this->getValue( 'error_widgets' ) === 'above' ? 'selected' : '' ); ?>><?php $L->p( 'Above Content' ); ?></option>
				<option value="no_content" <?php echo ( $this->getValue( 'error_widgets' ) === 'no_content' ? 'selected' : '' ); ?>><?php $L->p( 'No Content' ); ?></option>
				<option value="content" <?php echo ( $this->getValue( 'error_widgets' ) === 'content' ? 'selected' : '' ); ?>><?php $L->p( 'Content Only' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Whether and where to display user suggestion widgets on the custom 404 error page.' ); ?></small>
		</div>
	</div>

	<div id="error_widget_options" style="display: <?php echo ( $this->getValue( 'error_widgets' ) != 'content' ? 'block' : 'none' ); ?>;">

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Error Page Options' ) ] ); ?>

		<p><?php $L->p( 'Choose which widgets to display and how to display them.' ); ?></p>

		<div class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

			<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="search" aria-selected="false" href="#search"><?php $L->p( 'Search' ); ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="pages" aria-selected="false" href="#pages"><?php $L->p( 'Pages' ); ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="categories" aria-selected="false" href="#categories"><?php $L->p( 'Categories' ); ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="tags" aria-selected="false" href="#tags"><?php $L->p( 'Tags' ); ?></a>
				</li>
			</ul>

			<div id="search" class="tab-pane" role="tabpanel" aria-labelledby="search">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Search Form' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_search"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_search" name="error_search">
							<option value="true" <?php echo ( $this->getValue( 'error_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text text-muted"><?php $L->p( 'Display a search form on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_search_options">
					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_label"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_label" name="error_search_label" value="<?php echo $this->getValue( 'error_search_label' ); ?>" placeholder="<?php $L->p( 'Search' ); ?>" />
							<small class="form-text text-muted"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_heading"><?php $L->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_search_heading" name="error_search_heading">
								<option value="h2" <?php echo ( $this->getValue( 'error_search_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( $this->getValue( 'error_search_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( $this->getValue( 'error_search_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'H4' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_holder"><?php $L->p( 'Placeholder' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_holder" name="error_search_holder" value="<?php echo $this->getValue( 'error_search_holder' ); ?>" placeholder="<?php echo $placeholder; ?>" />
							<small class="form-text text-muted"><?php $L->p( 'Save as blank for no placeholder.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn"><?php $L->p( 'Form Button' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_search_btn" name="error_search_btn">
								<option value="true" <?php echo ( $this->getValue( 'error_search_btn' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
								<option value="false" <?php echo ( $this->getValue( 'error_search_btn' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Display the search submit button.' ); ?></small>
						</div>
					</div>

					<div id="error_search_btn_text_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'error_search_btn' ) === true ? 'flex' : 'none' ); ?>;">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn_text"><?php $L->p( 'Button Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_btn_text" name="error_search_btn_text" value="<?php echo $this->getValue( 'error_search_btn_text' ); ?>" placeholder="<?php $L->p( 'Submit' ); ?>" />
						</div>
					</div>
				</div>
			</div>

			<div id="pages" class="tab-pane" role="tabpanel" aria-labelledby="pages">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Static Pages List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_static"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_static" name="error_static">
							<option value="true" <?php echo ( $this->getValue( 'error_static' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_static' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text text-muted"><?php $L->p( 'Display a linked list of pages on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_static_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_static_title" name="error_static_title" value="<?php echo $this->getValue( 'error_static_title' ); ?>" placeholder="<?php $L->p( 'Pages' ); ?>" />
							<small class="form-text text-muted"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_heading"><?php $L->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_static_heading" name="error_static_heading">
								<option value="h2" <?php echo ( $this->getValue( 'error_static_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( $this->getValue( 'error_static_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( $this->getValue( 'error_static_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'H4' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_static_dir" name="error_static_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_static_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_static_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>

			<div id="categories" class="tab-pane" role="tabpanel" aria-labelledby="categories">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Categories List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_cats"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_cats" name="error_cats">
							<option value="true" <?php echo ( $this->getValue( 'error_cats' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_cats' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text text-muted"><?php $L->p( 'Display a linked list of categories on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_cats_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_cats_title" name="error_cats_title" value="<?php echo $this->getValue( 'error_cats_title' ); ?>" placeholder="<?php $L->p( 'Categories' ); ?>" />
							<small class="form-text text-muted"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_heading"><?php $L->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_cats_heading" name="error_cats_heading">
								<option value="h2" <?php echo ( $this->getValue( 'error_cats_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( $this->getValue( 'error_cats_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( $this->getValue( 'error_cats_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'H4' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_cats_dir" name="error_cats_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_cats_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_cats_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>

			<div id="tags" class="tab-pane" role="tabpanel" aria-labelledby="tags">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Tags List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_tags"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_tags" name="error_tags">
							<option value="true" <?php echo ( $this->getValue( 'error_tags' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_tags' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text text-muted"><?php $L->p( 'Display a linked list of tags on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_tags_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_tags_title" name="error_tags_title" value="<?php echo $this->getValue( 'error_tags_title' ); ?>" placeholder="<?php $L->p( 'Post Tags' ); ?>" />
							<small class="form-text text-muted"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_heading"><?php $L->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_tags_heading" name="error_tags_heading">
								<option value="h2" <?php echo ( $this->getValue( 'error_tags_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php $L->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( $this->getValue( 'error_tags_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php $L->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( $this->getValue( 'error_tags_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php $L->p( 'H4' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_tags_dir" name="error_tags_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_tags_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_tags_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text text-muted"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</fieldset>
<?php endif;
