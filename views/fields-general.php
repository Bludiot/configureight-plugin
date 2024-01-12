<?php
/**
 * General options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Cover image background value.
$loader_bg_default = $this->dbFields['loader_bg_color'];
$loader_bg_color   = $loader_bg_default;
if ( ! empty( $this->getValue( 'loader_bg_color' ) ) ) {
	$loader_bg_color = $this->getValue( 'loader_bg_color' );
}

// Cover image text value.
$loader_text_default = $this->dbFields['loader_text_color'];
$loader_text_color   = $loader_text_default;
if ( ! empty( $this->getValue( 'loader_text_color' ) ) ) {
	$loader_text_color = $this->getValue( 'loader_text_color' );
}

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Interface Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Interface' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="user_toolbar"><?php $L->p( 'User Toolbar' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="user_toolbar" name="user_toolbar">
				<option value="enabled" <?php echo ( $this->getValue( 'user_toolbar' ) === 'enabled' ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<?php

				// Backend & frontend options only if Configure 8 is the admin theme.
				if ( 'configureight' == $site->adminTheme() ) : ?>
				<option value="backend" <?php echo ( $this->getValue( 'user_toolbar' ) === 'backend' ? 'selected' : '' ); ?>><?php $L->p( 'Backend Only' ); ?></option>
				<option value="frontend" <?php echo ( $this->getValue( 'user_toolbar' ) === 'frontend' ? 'selected' : '' ); ?>><?php $L->p( 'Frontend Only' ); ?></option>
				<?php endif; ?>

				<option value="disabled" <?php echo ( $this->getValue( 'user_toolbar' ) === 'disabled' ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Displayed only to logged-in users.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="to_top_button"><?php $L->p( 'To Top Button' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="to_top_button" name="to_top_button">
				<option value="true" <?php echo ( $this->getValue( 'to_top_button' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'to_top_button' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Display a button to scroll to the top of the page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="show_options"><?php $L->p( 'Dashboard Options' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="show_options" name="show_options">
				<option value="true" <?php echo ( $this->getValue( 'show_options' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'show_options' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Display a list of options and their values on the dashboard.' ); ?></small>
		</div>
	</div>

</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Loading Screen' ) ] ); ?>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Loader' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="page_loader"><?php $L->p( 'Loading Screen' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="page_loader" name="page_loader" <?php echo ( $this->debug_mode() ? 'disabled' : '' ); ?>>
				<option value="false" <?php echo ( $this->page_loader() === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
				<option value="true" <?php echo ( $this->page_loader() === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
			</select>
			<?php if ( $this->debug_mode() ) : ?>
			<small class="form-text text-danger"><?php $L->p( 'Option disabled while site is in debug mode.' ); ?></small>
			<?php else : ?>
			<small class="form-text"><?php $L->p( 'A full-screen display that hides the web page until it is fully loaded. Disabled when site is in debug mode.' ); ?></small>
			<?php endif; ?>
		</div>
	</div>

	<div id="loader_options" style="display: <?php echo ( $this->getValue( 'page_loader' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_text"><?php $L->p( 'Loading Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="loader_text" name="loader_text" value="<?php echo $this->getValue( 'loader_text' ); ?>" placeholder="<?php echo $this->dbFields['loader_text']; ?>" />
				<small class="form-text"><?php $L->p( 'The text to display on the loading screen.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_icon"><?php $L->p( 'Loading Icon' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="loader_icon" name="loader_icon">

					<option value="spinner-dots" <?php echo ( $this->getValue( 'loader_icon' ) === 'spinner-dots' ? 'selected' : '' ); ?>><?php $L->p( 'Dots Circle' ); ?></option>

					<option value="spinner-dashes" <?php echo ( $this->getValue( 'loader_icon' ) === 'spinner-dashes' ? 'selected' : '' ); ?>><?php $L->p( 'Dashes Circle' ); ?></option>

					<option value="spinner-third" <?php echo ( $this->getValue( 'loader_icon' ) === 'spinner-third' ? 'selected' : '' ); ?>><?php $L->p( 'Third Circle' ); ?></option>

					<option value="none" <?php echo ( $this->getValue( 'loader_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Icon' ); ?></option>
				</select>
				<small class="form-text">
					<?php $L->p( 'Choose the style of icon to display below the text.' ); ?>
				</small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_bg_color"><?php $L->p( 'Background' ); ?></label>
			<div class="col-sm-10 row color-picker-wrap">
				<input class="color-picker" id="loader_bg_color" name="loader_bg_color" value="<?php echo $loader_bg_color; ?>" />
				<input id="loader_bg_default" class="screen-reader-text" type="hidden" value="<?php echo $loader_bg_default; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_bg_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_text_color"><?php $L->p( 'Text Color' ); ?></label>
			<div class="col-sm-10 row color-picker-wrap">
				<input class="color-picker" id="loader_text_color" name="loader_text_color" value="<?php echo $loader_text_color; ?>" />
				<input id="loader_text_default" class="screen-reader-text" type="hidden" value="<?php echo $loader_text_default; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_text_color_default"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>
</fieldset>

<?php
// Search settings page URL.
$search_settings = DOMAIN_ADMIN . 'configure-plugin/Search_Forms';

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Search Forms' ) ] ); ?>

<?php if ( getPlugin( 'Search_Forms' ) ) : ?>
<div class="form-field form-group row">
	<label class="form-label col-sm-2 col-form-label" for="search_plugin_info"><?php $L->p( 'Search Plugin' ); ?></label>
	<div id="search_plugin_info" class="col-sm-10">
		<p><?php $L->p( "The Search Form plugin, developed for the Configure 8 theme, is installed. To manage the sidebar search form, go to the <a href='{$search_settings}'>search form settings</a> page." ); ?></p>

		<p><?php $L->p( 'The following options are specific to the Configure 8 theme so they are not part of the Search Form plugin.' ); ?></p>
	</div>
</div>
<?php endif; ?>

<fieldset>
	<legend class="screen-reader-text"><?php $L->p( 'Search Options' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="search_icon"><?php $L->p( 'Search Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="search_icon" name="search_icon">
				<option value="true" <?php echo ( $this->getValue( 'search_icon' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'search_icon' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Replace the search form submit text with a search icon.' ); ?></small>
		</div>
	</div>
</fieldset>
