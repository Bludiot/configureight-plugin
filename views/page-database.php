<?php
/**
 * Options Database page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	options_list
};

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

?>

<?php echo Bootstrap :: pageTitle( [ 'title' => $L->g( 'Theme Options Database' ), 'icon' => 'cog' ] ); ?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$settings_page}'>theme options</a> page." ); ?></p>
</div>

<?php $L->p( 'List of current theme options and their values.' ); ?></p>

<div id="database-list">
	<?php echo options_list( true ); ?>
</div>
