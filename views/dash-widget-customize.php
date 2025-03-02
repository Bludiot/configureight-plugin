<?php
/**
 * Dashboard widget: customize links
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Dashboard
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	suite_plugins_active,
	plugin_options_url
};

// Admin page links.
$settings = plugin_options_url( $this->className() );
$guide    = DOMAIN_ADMIN . 'plugin/' . $this->className();
$colors   = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';
$fonts    = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=fonts';
$database = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=database';

?>
<style>
.customize-links-list {
	list-style: none;
	margin: 0;
}
.customize-links-list li {
	margin: var( --cfe-element--margin, 0.5rem 0 0 0 );
}
.customize-links-list li a {
	text-decoration: none;
	font-weight: var( --cfe-display--font-weight, 600 );
}
</style>
<div id="dashboard-customize-links">

	<h2><?php $L->p( 'Customize This Website' ); ?></h2>

	<ul class="customize-links-list">
		<li><a href="<?php echo $settings; ?>"><?php $L->p( 'Website Configuration' ); ?></a></li>
		<li><a href="<?php echo $guide; ?>"><?php $L->p( 'Options Guide' ); ?></a></li>
		<li><a href="<?php echo $colors; ?>"><?php $L->p( 'Colors Reference' ); ?></a></li>
		<li><a href="<?php echo $fonts; ?>"><?php $L->p( 'Fonts Reference' ); ?></a></li>

		<?php
		foreach ( suite_plugins_active() as $plugin ) {
			$plugin = getPlugin( $plugin );
			printf(
				'<li><a href="%s">%s</a></li>',
				plugin_options_url( $plugin->className() ),
				$plugin->name()
			);
		}
		?>
		<li><a href="<?php echo $database; ?>"><?php $L->p( 'Options Databases' ); ?></a></li>
	</ul>
</div>
