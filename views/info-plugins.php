<?php
/**
 * Guide page plugins tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	suite_plugins_active,
	suite_plugins_inactive,
	plugin_options_url
};

?>
<h2 class="form-heading"><?php $L->p( 'Companion Plugins' ); ?></h2>

<p><?php $L->p( 'The following are plugins that have been designed to enhance the Configure 8 theme, not including the theme options plugin. They should work with most other themes and custom themes, although in some cases code development is necessary.' ); ?></p>

<div class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="active" aria-selected="false" href="#active"><?php $L->p( 'Active' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="inactive" aria-selected="false" href="#inactive"><?php $L->p( 'Inactive' ); ?></a>
		</li>
	</ul>
	<div id="active" class="tab-pane" role="tabpanel" aria-labelledby="active">

		<h2 class="form-heading"><?php $L->p( 'Active Companion Plugins' ); ?></h2>

		<p><?php $L->p( 'The following Configure 8 companion plugins are installed and activated.' ); ?></p>

		<?php
		/**
		 * List active companion plugins
		 *
		 * Includes plugin name, custom description
		 * from plugin metadata file, and options link.
		 */
		$count = 0;
		foreach ( suite_plugins_active() as $plugin ) {

			$count++;
			$plugin = getPlugin( $plugin );

			printf(
				'<h3 class="form-heading">%s</h3>',
				$plugin->name()
			);
			if ( isset( $plugin->metadata['theme_desc'] ) ) {
				printf(
				'<p>%s</p>',
				$plugin->metadata['theme_desc']
				);
			}

			printf(
				'<p><a href="%s" class="button btn btn-primary">%s</a></p>',
				plugin_options_url( $plugin->className() ),
				$L->get( 'Options' )
			);

			if ( $count < count( suite_plugins_active() ) ) {
				echo '<hr />';
			}
		}
		?>
	</div>
	<div id="inactive" class="tab-pane" role="tabpanel" aria-labelledby="inactive">

		<h2 class="form-heading"><?php $L->p( 'Inactive Companion Plugins' ); ?></h2>

		<?php
		if ( count( suite_plugins_inactive() ) > 0 ) {
			printf(
				'<p>%s</p>',
				$L->get( 'The following Configure 8 companion plugins are installed but not activated.' )
			);
		} else {
			printf(
				'<p>%s</p>',
				$L->get( 'There are no Configure 8 companion plugins installed but not activated.' )
			);
		}
		?>

		<?php
		/**
		 * List inactive companion plugins
		 *
		 * Includes plugin name, custom description
		 * from plugin metadata file, and activation link.
		 */

		// Access global variables.
		global $plugins, $pluginsInstalled;

		$inactive = array_diff_key( $plugins['all'], $pluginsInstalled );
		$count    = 0;

		foreach ( $inactive as $plugin ) {

			if (
				'configureight' === $plugin->className() ||
				! isset( $plugin->metadata['theme_compat'] ) ||
				( isset( $plugin->metadata['theme_compat'] ) &&
				! in_array( 'configureight', $plugin->metadata['theme_compat'] ) )
			) {
				continue;
			}
			$count++;

			printf(
				'<h3 class="form-heading">%s</h3>',
				$plugin->name()
			);
			if ( isset( $plugin->metadata['theme_desc'] ) ) {
				printf(
				'<p>%s</p>',
				$plugin->metadata['theme_desc']
				);
			}

			printf(
				'<p><a href="%sinstall-plugin/%s" class="button btn btn-primary">%s</a></p>',
				HTML_PATH_ADMIN_ROOT,
				$plugin->className(),
				$L->get( 'Activate' )
			);

			if ( $count < count( suite_plugins_inactive() ) ) {
				echo '<hr />';
			}
		}
		?>
	</div>
</div>
