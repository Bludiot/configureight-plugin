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
	suite_plugins,
	options_list
};

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

?>

<h1 class="page-title"><span class="page-title-icon fa fa-server"></span><span class="page-title-text"><?php $L->p( 'Options Databases' ); ?></span></h1>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$settings_page}'>website options</a> page." ); ?></p>
</div>

<?php $L->p( 'List of current Configure 8 Suite options and their values. Includes plugins that are bundled in the full suite, if installed and activated.' ); ?></p>

<?php
foreach ( suite_plugins() as $list => $heading ) :
	if ( options_list( $list ) ) {
		printf(
			'<div class="database-list"><h2>%s</h2>%s</div>',
			$heading,
			options_list( $list )
		);
	}
endforeach;
