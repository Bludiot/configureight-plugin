<?php
/**
 * Sidebar options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	admin_theme
};

// User toolbar option.
$show_toolbar = true;
if (
	'frontend' == $this->show_user_toolbar() ||
	'disabled' == $this->show_user_toolbar()
) {
	$show_toolbar = false;
}

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Sidebar Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Sidebar' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_display"><?php $L->p( 'Sidebar Display' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_display" name="sidebar_display">
				<option value="default" <?php echo ( $this->getValue( 'sidebar_display' ) === 'default' ? 'selected' : '' ); ?>><?php $L->p( 'Use Templates' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'sidebar_display' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Never Display' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The Never Display setting will override default display, sidebar page templates, and the Sidebar Position setting.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_position"><?php $L->p( 'Sidebar Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_position" name="sidebar_position">
				<option value="default" <?php echo ( $this->getValue( 'sidebar_position' ) === 'default' ? 'selected' : '' ); ?>><?php $L->p( 'Default' ); ?></option>
				<option value="bottom" <?php echo ( $this->getValue( 'sidebar_position' ) === 'bottom' ? 'selected' : '' ); ?>><?php $L->p( 'Bottom' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'This setting will override sidebar page templates but not the Sidebar in Loop setting.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_sticky"><?php $L->p( 'Sticky Sidebar' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_sticky" name="sidebar_sticky">
				<option value="true" <?php echo ( $this->getValue( 'sidebar_sticky' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'sidebar_sticky' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Makes the sidebar stick to the top of the page until pushed up by content/footer below. Does not affect the sidebar in the bottom position.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_search"><?php $L->p( 'Search Form' ); ?></label>
		<div class="col-sm-10">
			<?php if ( getPlugin( 'pluginSearch' ) ) : ?>
			<select class="form-select" id="sidebar_search" name="sidebar_search">
				<option value="show" <?php echo ( $this->getValue( 'sidebar_search' ) === 'show' ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="hide" <?php echo ( $this->getValue( 'sidebar_search' ) === 'hide' ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
				<option value="footer" <?php echo ( $this->getValue( 'sidebar_search' ) === 'footer' ? 'selected' : '' ); ?>><?php $L->p( 'In Footer' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The Search plugin must be activated for the header search bar to work. If search in the header is enabled you may wish to hide search in the sidebar.' ); ?></small>
			<?php else : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></p>',
					$L->get( 'Please activate the Search plugin:' ),
					DOMAIN_ADMIN . '/install-plugin/pluginSearch',
					DOMAIN_ADMIN . '/install-plugin/pluginSearch'
				); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( Theme :: socialNetworks() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_social"><?php $L->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_social" name="sidebar_social">
				<option value="true" <?php echo ( $this->getValue( 'sidebar_social' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'sidebar_social' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display the navigation menu for links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<div id="sb_social_heading_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'sidebar_social' ) === true ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="sb_social_heading"><?php $L->p( 'Social Heading Text' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="sb_social_heading" name="sb_social_heading" value="<?php echo $this->getValue( 'sb_social_heading' ) ?>" placeholder="<?php $L->p( 'Social Links' ); ?>" />
		</div>
	</div>
</fieldset>

<?php if ( admin_theme() && 'theme' == $this->admin_theme() ) : ?>
	<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Admin Sidebar' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Admin Sidebar' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="admin_menu"><?php $L->p( ' Menu Display' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="admin_menu" name="admin_menu">
				<option value="true" <?php echo ( $this->admin_menu() === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->admin_menu() === false ? 'selected' : '' ); ?> <?php echo ( $show_toolbar ? '' : 'disabled' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Menu can only be disabled if the user toolbar is enabled on the back end.' ); ?></small>
		</div>
	</div>
</fieldset>
<?php endif; ?>
