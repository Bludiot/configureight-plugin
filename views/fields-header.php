<?php
/**
 * Header options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Header Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Header' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_title"><?php $L->p( 'Website Title' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_title" name="site_title">
				<option value="true" <?php echo ( $this->getValue( 'site_title' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_title' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Title will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_slogan"><?php $L->p( 'Website Slogan' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_slogan" name="site_slogan">
				<option value="true" <?php echo ( $this->getValue( 'site_slogan' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'site_slogan' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Slogan will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_std"><?php $L->p( 'Logo Width, Desktop' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value"><span id="logo_width_std_value"><?php echo ( $this->getValue( 'logo_width_std' ) ? $this->getValue( 'logo_width_std' ) : 60 ); ?></span><span id="logo_width_std_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_std_value').html($(this).val())" id="logo_width_std" name="logo_width_std" value="<?php echo $this->getValue( 'logo_width_std' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#logo_width_std_value').text('60');$('#logo_width_std').val('60');">Default</span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_mob"><?php $L->p( 'Logo Width, Mobile' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value"><span id="logo_width_mob_value"><?php echo ( $this->getValue( 'logo_width_mob' ) ? $this->getValue( 'logo_width_mob' ) : 80 ); ?></span><span id="logo_width_mob_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_mob_value').html($(this).val())" id="logo_width_mob" name="logo_width_mob" value="<?php echo $this->getValue( 'logo_width_mob' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#logo_width_mob_value').text('80');$('#logo_width_mob').val('80');">Default</span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Navigation Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Navigation' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pos"><?php $L->p( 'Navigation Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_pos" name="main_nav_pos">

				<option value="right" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'right' ? 'selected' : '' ); ?>><?php $L->p( 'Right of Site Branding' ); ?></option>

				<option value="left" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'left' ? 'selected' : '' ); ?>><?php $L->p( 'Left of Site Branding' ); ?></option>

				<option value="above" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'above' ? 'selected' : '' ); ?>><?php $L->p( 'Above Site Branding' ); ?></option>

				<option value="below" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'below' ? 'selected' : '' ); ?>><?php $L->p( 'Below Site Branding' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Right and left options will be reversed for right-to-left languages.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="max_nav_items"><?php $L->p( 'Maximum Items' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="max_nav_items" name="max_nav_items" value="<?php echo $this->getValue( 'max_nav_items' ) ?>" placeholder="0" />
			<small class="form-text text-muted"><?php $L->p( 'Enter 0 for no limit to navigation items.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop"><?php $L->p( 'Loop Nav Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_loop" name="main_nav_loop">
				<option value="true" <?php echo ( $this->getValue( 'main_nav_loop' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'main_nav_loop' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the posts loop (blog or news) when loop is not on the home page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_home"><?php $L->p( 'Home Nav Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_home" name="main_nav_home">
				<option value="true" <?php echo ( $this->getValue( 'main_nav_home' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'main_nav_home' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the home page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_search"><?php $L->p( 'Search Button' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_search" name="header_search">
				<option value="true" <?php echo ( $this->getValue( 'header_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a search icon in the navigation to toggle the header search bar.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_social"><?php $L->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_social" name="header_social">
				<option value="true" <?php echo ( $this->getValue( 'header_social' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_social' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
</fieldset>
