<?php
/**
 * Navigation options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

?>
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

				<option value="before" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'before' ? 'selected' : '' ); ?>><?php $L->p( 'Before Pages' ); ?></option>

				<option value="after" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'after' ? 'selected' : '' ); ?>><?php $L->p( 'After Pages' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Link' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the posts loop, blog or news.' ); ?></small>
		</div>
	</div>

	<div id="main_nav_loop_label_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'main_nav_loop' ) != 'none' ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop_label"><?php $L->p( 'Loop Link Label' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="main_nav_loop_label" name="main_nav_loop_label" value="<?php echo $this->getValue( 'main_nav_loop_label' ); ?>" placeholder="<?php echo $this->dbFields['main_nav_loop_label']; ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The label for the loop link in the main navigation.' ); ?></small>
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
