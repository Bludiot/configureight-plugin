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

// Suite plugins to list, plugin class name => list heading.
$suite_plugins = [
	$this->className() => $L->g( 'Configure 8 Theme' ),
	'Search_Forms'     => $L->g( 'Search Forms Plugin' ),
	'Pages_Lists'      => $L->g( 'Pages Lists Plugin' ),
	'Posts_Lists'      => $L->g( 'Posts Lists Plugin' ),
	'Categories_Lists' => $L->g( 'Categories Lists Plugin' ),
	'Tags_Lists'       => $L->g( 'Tags Lists Plugin' ),
	'User_Profiles'    => $L->g( 'User Profiles Plugin' )
];

?>

<?php echo Bootstrap :: pageTitle( [ 'element' => 'h1', 'title' => $L->g( 'Options Databases' ), 'icon' => 'server' ] ); ?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$settings_page}'>theme options</a> page." ); ?></p>
</div>

<?php $L->p( 'List of current Configure 8 Suite options and their values. Includes plugins that are bundled in the full suite, if installed and activated.' ); ?></p>

<?php
foreach ( $suite_plugins as $list => $heading ) :
	if ( options_list( $list ) ) {
		printf(
			'<div class="database-list"><h2>%s</h2>%s</div>',
			$heading,
			options_list( $list )
		);
	}
endforeach;
