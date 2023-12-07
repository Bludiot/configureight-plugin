<?php
/**
 * Header options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Default values.
$logo_width_std_default = $this->logo_width_std_default();
$logo_width_mob_default = $this->logo_width_mob_default();

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

	<?php if ( ! empty( $site->logo() ) ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_std"><?php $L->p( 'Logo Width, Desktop' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value px-range-value"><span id="logo_width_std_value"><?php echo $this->getValue( 'logo_width_std' ); ?></span><span id="logo_width_std_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_std_value').html($(this).val())" id="logo_width_std" name="logo_width_std" value="<?php echo $this->getValue( 'logo_width_std' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#logo_width_std_value').text('<?php echo $logo_width_std_default; ?>');$('#logo_width_std').val('<?php echo $logo_width_std_default; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo_width_mob"><?php $L->p( 'Logo Width, Mobile' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value px-range-value"><span id="logo_width_mob_value"><?php echo $this->getValue( 'logo_width_mob' ); ?></span><span id="logo_width_mob_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#logo_width_mob_value').html($(this).val())" id="logo_width_mob" name="logo_width_mob" value="<?php echo $this->getValue( 'logo_width_mob' ); ?>" min="0" max="320" step="1" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#logo_width_mob_value').text('<?php echo $logo_width_mob_default; ?>');$('#logo_width_mob').val('<?php echo $logo_width_mob_default; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'This is a maximum width in pixels.' ); ?></small>
		</div>
	</div>
	<?php else : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo-message"><?php $L->p( 'Logo Options' ); ?></label>
		<div id="logo-message" class="col-sm-10">
			<?php printf(
				'<p class="form-text">%s<br /><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></p>',
				$L->get( 'No logo uploaded:' ),
				DOMAIN_ADMIN . '/settings#logo',
				DOMAIN_ADMIN . '/settings#logo'
			); ?>
		</div>
	</div>
	<?php endif; ?>
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
		<label class="form-label col-sm-2 col-form-label" for="main_nav_icon"><?php $L->p( 'Menu Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_icon" name="main_nav_icon">

				<option value="bars" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'bars' ? 'selected' : '' ); ?>><?php $L->p( 'Bars' ); ?></option>

				<option value="dots" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'dots' ? 'selected' : '' ); ?>><?php $L->p( 'Dots' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None (Text)' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The icon to toggle the mobile menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="max_nav_items"><?php $L->p( 'Maximum Items' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="max_nav_items" name="max_nav_items" value="<?php echo $this->getValue( 'max_nav_items' ); ?>" placeholder="<?php echo $this->dbFields['max_nav_items']; ?>" />
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
			<?php

			// If the Search plugin is installed and activated.
			if ( getPlugin( 'Search_Forms' ) ) : ?>
			<select class="form-select" id="header_search" name="header_search">
				<option value="true" <?php echo ( $this->getValue( 'header_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a search icon in the navigation to toggle the header search bar.' ); ?></small>
			<?php

			// If the Search plugin is installed and not activated.
			elseif ( class_exists( 'Search_Forms' ) ) : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please activate the Search Forms plugin:' ),
					DOMAIN_ADMIN . 'install-plugin/Search_Forms',
					DOMAIN_ADMIN . 'install-plugin/Search_Forms'
				); ?>
			<?php

			// If the Search plugin is not installed in bl-plugins.
			else : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please download, install, and activate the Search Forms plugin:' ),
					'https://github.com/Bludiot/searchforms',
					$L->get( 'GitHub Repository' )
				); ?>
			<?php endif; ?>
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
