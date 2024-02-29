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

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	has_error_widgets
};

// Get the search plugin object.
$placeholder = $this->error_search_holder();
if ( getPlugin( 'Search_Forms' ) ) {
	$search      = new Search_Forms;
	$min_chars   = $search->min_chars();
	$placeholder = $L->get( "Enter at least {$min_chars} characters." );
}

?>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Post/Page Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Post/Page Options' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="posts_nav"><?php $L->p( 'Posts Navigation' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="posts_nav" name="posts_nav">
				<option value="true" <?php echo ( $this->getValue( 'posts_nav' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'posts_nav' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Show the previous/next post navigation. Not available on static pages.' ); ?></small>
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
				<small class="form-text"><?php $L->p( 'The style of posts navigation.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="posts_nav_icon"><?php $L->p( 'Navigation Icon' ); ?></label>
			<div class="col-sm-10">
				<div class="field-has-buttons">
					<select class="form-select" id="posts_nav_icon" name="posts_nav_icon">

						<option value="none" <?php echo ( $this->getValue( 'posts_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None' ); ?></option>

						<option value="arrow" <?php echo ( $this->getValue( 'posts_nav_icon' ) === 'arrow' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow' ); ?></option>

						<option value="angle" <?php echo ( $this->getValue( 'posts_nav_icon' ) === 'angle' ? 'selected' : '' ); ?>><?php $L->p( 'Angle' ); ?></option>

						<option value="angles" <?php echo ( $this->getValue( 'posts_nav_icon' ) === 'angles' ? 'selected' : '' ); ?>><?php $L->p( 'Double Angle' ); ?></option>
					</select>
					<span class="btn btn-secondary btn-md hide-if-no-js" onClick="$('#posts_nav_icon').val('<?php echo $this->dbFields['posts_nav_icon']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'Directional characters are adjusted for language direction.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<?php if ( $site->homepage() ) : ?>
<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Front Page Slider' ) ] ); ?>

<p><?php $L->p( 'Display a slider/carousel of select posts at the top of the static front page.' ); ?></p>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Front Page Slider' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="posts_slider"><?php $L->p( 'Display Slider' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="posts_slider" name="posts_slider">
				<option value="true" <?php echo ( $this->getValue( 'posts_slider' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'posts_slider' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Content without a cover image will be skipped.' ); ?></small>
		</div>
	</div>

	<div id="slider_options" style="display: <?php echo ( $this->getValue( 'posts_slider' ) === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_content"><?php $L->p( 'Slider Content' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_content" name="slider_content">

					<option value="recent" <?php echo ( $this->getValue( 'slider_content' ) === 'recent' ? 'selected' : '' ); ?>><?php $L->p( 'Recent Posts' ); ?></option>

					<option value="static" <?php echo ( $this->getValue( 'slider_content' ) === 'static' ? 'selected' : '' ); ?>><?php $L->p( 'Static Pages' ); ?></option>
				</select>
			</div>
		</div>

		<div id="slider_number_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'slider_content' ) === 'recent' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="slider_number"><?php $L->p( 'Number of Posts' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="slider_number_value"><?php echo ( $this->getValue( 'slider_number' ) ? $this->getValue( 'slider_number' ) : $this->dbFields['slider_number'] ); ?></span></span>
					<input type="range" class="form-control-range custom-range custom-range" onInput="$('#slider_number_value').html($(this).val())" id="slider_number" name="slider_number" value="<?php echo $this->getValue( 'slider_number' ); ?>" min="1" max="12" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#slider_number_value').text('<?php echo $this->dbFields['slider_number']; ?>');$('#slider_number').val('<?php echo $this->dbFields['slider_number']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'The maximum number of posts to display, starting with the most recent.' ); ?></small>
			</div>
		</div>

		<div id="slider_pages_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'slider_content' ) === 'static' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="slider_pages"><?php $L->p( 'Pages in Slider' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php $L->p( 'Which static pages shall display in the front page slider. Only pages with a cover image set are eligible for the slider. At least one page is required.' ); ?></small>

				<div id="slider-pages" class="multi-check-wrap">

					<?php

					$static  = buildStaticPages();
					if ( isset( $static[0] ) ) : foreach ( $static as $page ) :

						// Skip pages with no cover image.
						if ( ! $page->coverImage() ) {
							continue;
						}

						if ( $page->slug() === $site->pageNotFound() ) {
							echo '';
						} else {
							printf(
								'<label class="check-label-wrap" for="page-%s"><input type="checkbox" name="slider_pages[]" id="page-%s" value="%s" %s> %s</label>',
								$page->key(),
								$page->key(),
								$page->key(),
								( is_array( $this->slider_pages() ) && in_array( $page->key(), $this->slider_pages() ) ? 'checked' : '' ),
								$page->title()
							);
						}
					endforeach; endif; ?>
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_animate"><?php $L->p( 'Animation' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_animate" name="slider_animate">
					<option value="fade" <?php echo ( $this->getValue( 'slider_animate' ) === 'fade' ? 'selected' : '' ); ?>><?php $L->p( 'Fade' ); ?></option>
					<option value="slide" <?php echo ( $this->getValue( 'slider_animate' ) === 'slide' ? 'selected' : '' ); ?>><?php $L->p( 'Slide' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'The transition between slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_duration"><?php $L->p( 'Duration' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="slider_duration_value"><?php echo ( $this->getValue( 'slider_duration' ) ? $this->getValue( 'slider_duration' ) : $this->dbFields['slider_duration'] ); ?></span><span id="slider_duration_units">s</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#slider_duration_value').html($(this).val())" id="slider_duration" name="slider_duration" value="<?php echo $this->getValue( 'slider_duration' ); ?>" min="1" max="6" step="0.5" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#slider_duration_value').text('<?php echo $this->dbFields['slider_duration']; ?>');$('#slider_duration').val('<?php echo $this->dbFields['slider_duration']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'The duration in seconds for which each slide displays.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_icon"><?php $L->p( 'Loading Icon' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_icon" name="slider_icon">

					<option value="spinner-dots" <?php echo ( $this->getValue( 'slider_icon' ) === 'spinner-dots' ? 'selected' : '' ); ?>><?php $L->p( 'Dots Circle' ); ?></option>

					<option value="spinner-dashes" <?php echo ( $this->getValue( 'slider_icon' ) === 'spinner-dashes' ? 'selected' : '' ); ?>><?php $L->p( 'Dashes Circle' ); ?></option>

					<option value="spinner-third" <?php echo ( $this->getValue( 'slider_icon' ) === 'spinner-third' ? 'selected' : '' ); ?>><?php $L->p( 'Third Circle' ); ?></option>

					<option value="none" <?php echo ( $this->getValue( 'slider_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Icon' ); ?></option>
				</select>
				<small class="form-text">
					<?php $L->p( 'Choose the style of icon to display below the text.' ); ?>
				</small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_arrows"><?php $L->p( 'Previous/Next Icons' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_arrows" name="slider_arrows">

					<option value="arrow" <?php echo ( $this->getValue( 'slider_arrows' ) === 'arrow' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow' ); ?></option>

					<option value="angle" <?php echo ( $this->getValue( 'slider_arrows' ) === 'angle' ? 'selected' : '' ); ?>><?php $L->p( 'Angle' ); ?></option>

					<option value="angles" <?php echo ( $this->getValue( 'slider_arrows' ) === 'angles' ? 'selected' : '' ); ?>><?php $L->p( 'Double Angle' ); ?></option>

					<option value="none" <?php echo ( $this->getValue( 'slider_arrows' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Display directional icons to navigate slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_dots"><?php $L->p( 'Slide Dots' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_dots" name="slider_dots">
					<option value="true" <?php echo ( $this->getValue( 'slider_dots' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
					<option value="false" <?php echo ( $this->getValue( 'slider_dots' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Display a row of dots to navigate slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_link_text"><?php $L->p( 'Link Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="slider_link_text" name="slider_link_text" value="<?php echo $this->getValue( 'slider_link_text' ); ?>" placeholder="<?php $L->p( 'Read More' ); ?>" />
				<small class="form-text"><?php $L->p( 'The slide text to display for the link to the content if not set in the content\'s custom field.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>
<?php endif; ?>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Related Posts' ) ] ); ?>

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
			<small class="form-text"><?php $L->p( 'Show related posts on singular post pages.' ); ?></small>
		</div>
	</div>

	<div id="related_options" style="display: <?php echo ( $this->getValue( 'related_posts' ) === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="max_related"><?php $L->p( 'Maximum Posts' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="max_related_value"><?php echo ( $this->getValue( 'max_related' ) ? $this->getValue( 'max_related' ) : $this->dbFields['max_related'] ); ?></span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#max_related_value').html($(this).val())" id="max_related" name="max_related" value="<?php echo $this->getValue( 'max_related' ); ?>" min="1" max="9" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#max_related_value').text('<?php echo $this->dbFields['max_related']; ?>');$('#max_related').val('<?php echo $this->dbFields['max_related']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php $L->p( 'The number of related posts to display.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_heading"><?php $L->p( 'Related Heading' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="related_heading" name="related_heading" value="<?php echo $this->getValue( 'related_heading' ); ?>" placeholder="<?php $L->p( 'Related Posts' ); ?>" />
				<small class="form-text"><?php $L->p( 'The text of the related posts heading. Save as empty for no heading.' ); ?></small>
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
				<small class="form-text"><?php $L->p( 'The heading element to use for related posts.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_style"><?php $L->p( 'Related Style' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="related_style" name="related_style">

					<option value="list" <?php echo ( $this->getValue( 'related_style' ) === 'list' ? 'selected' : '' ); ?>><?php $L->p( 'List' ); ?></option>

					<option value="grid" <?php echo ( $this->getValue( 'related_style' ) === 'grid' ? 'selected' : '' ); ?>><?php $L->p( 'Grid' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Presentation style for related posts.' ); ?></small>
			</div>
		</div>
	</div>

</fieldset>

<?php

// If a 404 page has been set in Settings > Advanced.
if ( $site->pageNotFound() && has_error_widgets() ) :

?>
<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( '404 Error Template' ) ] ); ?>
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
			<small class="form-text"><?php $L->p( 'Whether and where to display user suggestion widgets on the custom 404 error page.' ); ?></small>
		</div>
	</div>

	<div id="error_widget_options" style="display: <?php echo ( $this->getValue( 'error_widgets' ) != 'content' ? 'block' : 'none' ); ?>;">

		<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Error Page Options' ) ] ); ?>

		<p><?php $L->p( 'Choose which widgets to display and how to display them.' ); ?></p>

		<div class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

			<ul class="nav nav-tabs" id="nav-tabs" role="tablist">

				<?php if ( getPLugin( 'Search_Forms' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="search" aria-selected="false" href="#search"><?php $L->p( 'Search' ); ?></a>
				</li>
				<?php endif; ?>

				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="pages" aria-selected="false" href="#pages"><?php $L->p( 'Pages' ); ?></a>
				</li>

				<?php if ( getPLugin( 'Categories_Lists' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="categories" aria-selected="false" href="#categories"><?php $L->p( 'Categories' ); ?></a>
				</li>
				<?php endif; ?>

				<?php if ( getPLugin( 'Tags_Lists' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="tags" aria-selected="false" href="#tags"><?php $L->p( 'Tags' ); ?></a>
				</li>
				<?php endif; ?>
			</ul>

			<?php if ( getPLugin( 'Search_Forms' ) ) : ?>
			<div id="search" class="tab-pane" role="tabpanel" aria-labelledby="search">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Search Form' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_search"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_search" name="error_search">
							<option value="true" <?php echo ( $this->getValue( 'error_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php $L->p( 'Display a search form on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_search_options">
					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_label"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_label" name="error_search_label" value="<?php echo $this->getValue( 'error_search_label' ); ?>" placeholder="<?php $L->p( 'Search' ); ?>" />
							<small class="form-text"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
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
							<small class="form-text"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_holder"><?php $L->p( 'Placeholder' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_holder" name="error_search_holder" value="<?php echo $this->getValue( 'error_search_holder' ); ?>" placeholder="<?php echo $placeholder; ?>" />
							<small class="form-text"><?php $L->p( 'Save as blank for no placeholder.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn"><?php $L->p( 'Form Button' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_search_btn" name="error_search_btn">
								<option value="true" <?php echo ( $this->getValue( 'error_search_btn' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
								<option value="false" <?php echo ( $this->getValue( 'error_search_btn' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
							</select>
							<small class="form-text"><?php $L->p( 'Display the search submit button.' ); ?></small>
						</div>
					</div>

					<div id="error_search_btn_text_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'error_search_btn' ) === true ? 'flex' : 'none' ); ?>;">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn_text"><?php $L->p( 'Button Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_btn_text" name="error_search_btn_text" value="<?php echo $this->getValue( 'error_search_btn_text' ); ?>" placeholder="<?php $L->p( 'Submit' ); ?>" />
							<small class="form-text"><?php $L->p( 'Text will not display if replaced by a search icon in General options but will remain as screen reader text.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div id="pages" class="tab-pane" role="tabpanel" aria-labelledby="pages">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Static Pages List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_static"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_static" name="error_static">
							<option value="true" <?php echo ( $this->getValue( 'error_static' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_static' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php $L->p( 'Display a linked list of pages on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_static_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_static_title" name="error_static_title" value="<?php echo $this->getValue( 'error_static_title' ); ?>" placeholder="<?php $L->p( 'Pages' ); ?>" />
							<small class="form-text"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
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
							<small class="form-text"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_static_dir" name="error_static_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_static_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_static_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>

			<?php if ( getPLugin( 'Categories_Lists' ) ) : ?>
			<div id="categories" class="tab-pane" role="tabpanel" aria-labelledby="categories">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Categories List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_cats"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_cats" name="error_cats">
							<option value="true" <?php echo ( $this->getValue( 'error_cats' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_cats' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php $L->p( 'Display a linked list of categories on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_cats_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_cats_title" name="error_cats_title" value="<?php echo $this->getValue( 'error_cats_title' ); ?>" placeholder="<?php $L->p( 'Categories' ); ?>" />
							<small class="form-text"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
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
							<small class="form-text"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_cats_dir" name="error_cats_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_cats_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_cats_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( getPLugin( 'Tags_Lists' ) ) : ?>
			<div id="tags" class="tab-pane" role="tabpanel" aria-labelledby="tags">

				<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Tags List' ) ] ); ?>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_tags"><?php $L->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_tags" name="error_tags">
							<option value="true" <?php echo ( $this->getValue( 'error_tags' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( $this->getValue( 'error_tags' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php $L->p( 'Display a linked list of tags on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_tags_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_title"><?php $L->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_tags_title" name="error_tags_title" value="<?php echo $this->getValue( 'error_tags_title' ); ?>" placeholder="<?php $L->p( 'Post Tags' ); ?>" />
							<small class="form-text"><?php $L->p( 'Save as blank for no heading.' ); ?></small>
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
							<small class="form-text"><?php $L->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_dir"><?php $L->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_tags_dir" name="error_tags_dir">
								<option value="horz" <?php echo ( $this->getValue( 'error_tags_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php $L->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( $this->getValue( 'error_tags_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php $L->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php $L->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</fieldset>
<?php endif;
