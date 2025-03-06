<?php
/**
 * Loop options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

 use function CFE_Plugin\{
	is_rtl,
	is_static_loop
};

?>

<h2 class="form-heading"><?php $L->p( 'Posts Loop Options' ); ?></h2>

<fieldset>

<p><?php $L->p( 'The posts loop is serialized, non-static content; the blog/news feature of the website. This includes the main posts index as well as posts filtered by category or tag. Search pages are also a loop but not all of these options apply to site search.' ); ?></p>

	<legend class="screen-reader-text"><?php $L->p( 'Posts Loop' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_title"><?php $L->p( 'Loop Title' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="loop_title" name="loop_title" value="<?php echo $this->getValue( 'loop_title' ); ?>" placeholder="<?php echo ( $this->getValue( 'loop_type' ) === 'news' ? $L->get( 'News' ) : $L->get( 'Blog' ) ); ?>" />
			<small class="form-text">
				<?php $L->p( 'The title of posts loop pages. Defaults to the type of loop, Blog or News.' ); ?>
				<br />
				<?php $L->p( 'This setting is overridden if a static page is used for the loop (not home page).' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_description"><?php $L->p( 'Loop Description' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="loop_description" name="loop_description" value="<?php echo $this->getValue( 'loop_description' ); ?>" placeholder="" />
			<small class="form-text">
				<?php $L->p( 'The description of posts loop pages.' ); ?>
				<br />
				<?php $L->p( 'This setting is overridden if a static page is used for the loop (not home page).' ); ?>
			</small>
		</div>
	</div>

	<?php if ( ! is_static_loop() && $this->cover_src() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_cover"><?php $L->p( 'Cover Image' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_cover" name="loop_cover">

				<option value="standard" <?php echo ( $this->getValue( 'loop_cover' ) === 'standard' ? 'selected' : '' ); ?>><?php $L->p( 'Standard Cover Each Page' ); ?></option>

				<option value="first" <?php echo ( $this->getValue( 'loop_cover' ) === 'first' ? 'selected' : '' ); ?>><?php $L->p( 'Standard Cover First Page' ); ?></option>

				<option value="full_first" <?php echo ( $this->getValue( 'loop_cover' ) === 'full_first' ? 'selected' : '' ); ?>><?php $L->p( 'Full Cover First Page, Standard After' ); ?></option>

				<option value="full_first_none" <?php echo ( $this->getValue( 'loop_cover' ) === 'full_first_none' ? 'selected' : '' ); ?>><?php $L->p( 'Full Cover First Page, None After' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'loop_cover' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Cover Image' ); ?></option>
			</select>
			<small class="form-text">
				<?php $L->p( 'Choose how the cover image is displayed in posts loop pages. Does not apply to taxonomy & search pages.' ); ?>
			</small>
		</div>
	</div>
	<?php endif; ?>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_type"><?php $L->p( 'Loop Type' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_type" name="loop_type">

				<option value="blog" <?php echo ( $this->getValue( 'loop_type' ) === 'blog' ? 'selected' : '' ); ?>><?php $L->p( 'Blog' ); ?></option>

				<option value="news" <?php echo ( $this->getValue( 'loop_type' ) === 'news' ? 'selected' : '' ); ?>><?php $L->p( 'News' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Choose the type of posts. Used in Schema tags for SEO.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_style"><?php $L->p( 'Posts Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_style" name="loop_style">

				<option value="list" <?php echo ( $this->getValue( 'loop_style' ) === 'list' ? 'selected' : '' ); ?>><?php $L->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( $this->getValue( 'loop_style' ) === 'grid' ? 'selected' : '' ); ?>><?php $L->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( $this->getValue( 'loop_style' ) === 'full' ? 'selected' : '' ); ?>><?php $L->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php $L->p( 'Choose the style of post content in the main loop.' ); ?>
				<br /><?php $L->p( 'See Settings > General > Advanced in the admin menu to set the number pf articles per page.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_break"><?php $L->p( 'Post Content Breaks' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_break" name="loop_break">
				<option value="true" <?php echo ( $this->getValue( 'loop_break' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_break' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Allow teaser text with a read more link. Does not apply to list and grid displays. Post needs a read more tag inserted by the content editor.' ); ?></small>
		</div>
	</div>

	<div id="content-break-options">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loop_break_text"><?php $L->p( 'Content Break Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="loop_break_text" name="loop_break_text" value="<?php echo $this->getValue( 'loop_break_text' ); ?>" placeholder="<?php echo $this->dbFields['loop_break_text']; ?>" />
				<small class="form-text"><?php $L->p( 'The read more link text.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loop_break_icon"><?php $L->p( 'Content Break Icon' ); ?></label>
			<div class="col-sm-10">
				<div class="field-has-buttons">
					<select class="form-select" id="loop_break_icon" name="loop_break_icon">

						<option value="arrow" <?php echo ( $this->getValue( 'loop_break_icon' ) === 'arrow' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow' ); ?> ( <?php echo ( is_rtl() ? '←' : '→' ); ?> )</option>

						<option value="angle" <?php echo ( $this->getValue( 'loop_break_icon' ) === 'angle' ? 'selected' : '' ); ?>><?php $L->p( 'Angle' ); ?> ( &gt; )</option>

						<option value="angles" <?php echo ( $this->getValue( 'loop_break_icon' ) === 'angles' ? 'selected' : '' ); ?>><?php $L->p( 'Double Angle' ); ?> ( &#8811; )</option>

						<option value="none" <?php echo ( $this->getValue( 'loop_break_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None' ); ?></option>
					</select>
				</div>
				<small class="form-text"><?php $L->p( 'Directional characters are adjusted for language direction.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cat_style"><?php $L->p( 'Category Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cat_style" name="cat_style">

				<option value="inherit" <?php echo ( $this->getValue( 'cat_style' ) === 'inherit' ? 'selected' : '' ); ?>><?php $L->p( 'Inherit from Loop' ); ?></option>

				<option value="list" <?php echo ( $this->getValue( 'cat_style' ) === 'list' ? 'selected' : '' ); ?>><?php $L->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( $this->getValue( 'cat_style' ) === 'grid' ? 'selected' : '' ); ?>><?php $L->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( $this->getValue( 'cat_style' ) === 'full' ? 'selected' : '' ); ?>><?php $L->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php $L->p( 'Choose the style of post content in category loops.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="tag_style"><?php $L->p( 'Tag Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="tag_style" name="tag_style">

				<option value="inherit" <?php echo ( $this->getValue( 'tag_style' ) === 'inherit' ? 'selected' : '' ); ?>><?php $L->p( 'Inherit from Loop' ); ?></option>

				<option value="list" <?php echo ( $this->getValue( 'tag_style' ) === 'list' ? 'selected' : '' ); ?>><?php $L->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( $this->getValue( 'tag_style' ) === 'grid' ? 'selected' : '' ); ?>><?php $L->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( $this->getValue( 'tag_style' ) === 'full' ? 'selected' : '' ); ?>><?php $L->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php $L->p( 'Choose the style of post content in tag loops.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_paged"><?php $L->p( 'Loop Pagination' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_paged" name="loop_paged">

				<option value="numerical" <?php echo ( $this->getValue( 'loop_paged' ) === 'numerical' ? 'selected' : '' ); ?>><?php $L->p( 'Numerical' ); ?></option>

				<option value="prev_next" <?php echo ( $this->getValue( 'loop_paged' ) === 'prev_next' ? 'selected' : '' ); ?>><?php $L->p( 'Previous/Next' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Choose the style of navigation between pages loops.' ); ?></small>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php $L->p( 'Loop Details Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Loop Details' ); ?></legend>

	<p class="form-text"><?php $L->p( 'These options only affect posts in the main loop. Display may vary by loop style when viewing a single page.' ); ?></p>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_byline"><?php $L->p( 'Author Byline' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_byline" name="loop_byline">
				<option value="true" <?php echo ( $this->getValue( 'loop_byline' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_byline' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_date"><?php $L->p( 'Post Date' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_date" name="loop_date">
				<option value="true" <?php echo ( $this->getValue( 'loop_date' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_date' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_word_count"><?php $L->p( 'Word Count' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_word_count" name="loop_word_count">
				<option value="true" <?php echo ( $this->getValue( 'loop_word_count' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_word_count' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_read_time"><?php $L->p( 'Read Time' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_read_time" name="loop_read_time">
				<option value="true" <?php echo ( $this->getValue( 'loop_read_time' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_read_time' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_icons"><?php $L->p( 'Icons' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_icons" name="loop_icons">
				<option value="true" <?php echo ( $this->getValue( 'loop_icons' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'loop_icons' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Display category and tags icons.' ); ?></small>
		</div>
	</div>
</fieldset>
