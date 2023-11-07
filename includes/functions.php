<?php
/**
 * Plugin functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Plugin;

/**
 * Change theme
 *
 * Replaces admin theme value in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function change_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = $site->adminTheme();

	// Get database content.
	$content = file_get_contents( $db_file );

	// Change admin theme to Configureight.
	$content = str_replace( $current . "\"", "configureight\"", $content);

	// Write theme into the database file.
	file_put_contents( $db_file, $content );
}


/**
 * Default theme
 *
 * Restore admin theme to default in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function default_theme() {

	// Access global variables.
	global $site;

	// Default admin theme.
	$default = 'booty';

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = $site->adminTheme();

	// Get database content.
	$content = file_get_contents( $db_file );

	// Change admin theme to default.
	$content = str_replace( $current . "\"", $default . "\"", $content );

	// Write theme into the database file.
	file_put_contents ( $db_file, $content );
}

// @todo Remove if unnecessary.
function themes_dir_empty( $themesDir ) {

	if ( ! is_readable( $themesDir ) ) {
		return null;
	}
	return ( count( scandir( $themesDir ) ) == 2 );
}
