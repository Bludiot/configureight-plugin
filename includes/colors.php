<?php
/**
 * Color functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Colors;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin
};

/**
 * Hex to RGB
 *
 * Convert a 3- or 6-digit hexadecimal color to
 * an associative RGB array.
 *
 * @param  string $color The color in hex format.
 * @param  boolean $opacity Whether to return the RGB color as opaque.
 * @return string Returns the rgb(a) value.
 */
function hex_to_rgb( $color, $opacity = false ) {

	if ( empty( $color ) ) {
		return false;
	}

	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	if ( 6 === strlen( $color ) ) {
		$hex = [ $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] ];
	} elseif ( 3 === strlen( $color ) ) {
		$hex = [ $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] ];
	} else {
		return null;
	}
	$rgb = array_map( 'hexdec', $hex );

	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ',', $rgb ) . ')';
	}
	return $output;
}

/**
 * Custom color value
 *
 * @since  1.0.0
 * @param  string $color
 * @return string
 */
function color( $color ) {
	$value = 'color_' . $color;
	return plugin()->getValue( $value );
}

/**
 * Custom color scheme
 *
 * Array to be passed into the primary
 * array of color schemes.
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array
 */
function custom_scheme() {

	// Access global variables.
	global $L;

	$scheme = [
		'custom' => [
			'slug'   => 'custom',
			'name'   => $L->get( 'Custom' ),
			'thumbs' => [
				color( 'one' ),
				color( 'two' ),
				color( 'three' ),
				color( 'four' )
			],
			'light'  => [
				'body'  => color( 'body' ),
				'text'  => color( 'text' ),
				'one'   => color( 'one' ),
				'two'   => color( 'two' ),
				'three' => color( 'three' ),
				'four'  => color( 'four' ),
				'five'  => color( 'five' ),
				'six'   => color( 'six' )
			],
			'dark' => [
				'body'  => color( 'body_dark' ),
				'text'  => color( 'text_dark' ),
				'one'   => color( 'one_dark' ),
				'two'   => color( 'two_dark' ),
				'three' => color( 'three_dark' ),
				'four'  => color( 'four_dark' ),
				'five'  => color( 'five_dark' ),
				'six'   => color( 'six_dark' )
			]
		]
	];
	return $scheme;
}

/**
 * Color schemes
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array Returns array of color schemes data.
 */
function color_schemes() {

	// Access global variables.
	global $L;

	// Built-in color schemes.
	$schemes = [
			'default' => [
				'slug'   => 'default',
				'name'   => $L->get( 'Default' ),
				'thumbs' => [
					'#0044aa',
					'#0066cc',
					'#555555',
					'#888888'
				],
				'light'  => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#0044aa',
					'two'   => '#0066cc',
					'three' => '#333333',
					'four'  => '#555555',
					'five'  => '#888888',
					'six'   => '#cccccc'
				],
				'dark' => [
					'body'  => '#1e1e1e',
					'text'  => '#eeeeee',
					'one'   => '#ffffff',
					'two'   => '#eeeeee',
					'three' => '#333333',
					'four'  => '#555555',
					'five'  => '#888888',
					'six'   => '#cccccc'
				]
			],
			'dark' => [
				'slug'   => 'dark',
				'name'   => $L->get( 'Dark' ),
				'thumbs' => [
					'#1e1e1e',
					'#333333',
					'#555555',
					'#888888'
				],
				'light' => [
					'body'  => '#1e1e1e',
					'text'  => '#eeeeee',
					'one'   => '#ffffff',
					'two'   => '#eeeeee',
					'three' => '#333333',
					'four'  => '#555555',
					'five'  => '#888888',
					'six'   => '#cccccc'
				],
				'dark' => [
					'body'  => '#1e1e1e',
					'text'  => '#eeeeee',
					'one'   => '#ffffff',
					'two'   => '#eeeeee',
					'three' => '#333333',
					'four'  => '#555555',
					'five'  => '#888888',
					'six'   => '#cccccc'
				]
			],
			'apricot' => [
				'slug'   => 'apricot',
				'name'   => $L->get( 'Apricot' ),
				'thumbs' => [
					'#c76919',
					'#f37e1a',
					'#e6211c',
					'#122538'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#c76919',
					'two'   => '#f37e1a',
					'three' => '#122538',
					'four'  => '#cfd2d4',
					'five'  => '#e6211c',
					'six'   => '#f64117'
				],
				'dark' => [
					'body'  => '#051b21',
					'text'  => '#eeeeee',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'brick' => [
				'slug'   => 'brick',
				'name'   => $L->get( 'Brick' ),
				'thumbs' => [
					'#87200e',
					'#ca2205',
					'#f9f2ef',
					'#242611'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#87200e',
					'two'   => '#ca2205',
					'three' => '#f9f2ef',
					'four'  => '#242611',
					'five'  => '',
					'six'   => ''
				],
				'dark' => [
					'body'  => '',
					'text'  => '',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'bronze' => [
				'slug'   => 'bronze',
				'name'   => $L->get( 'Bronze' ),
				'thumbs' => [
					'#a88548',
					'#c19b57',
					'#cfd2d4',
					'#122538'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#a88548',
					'two'   => '#c19b57',
					'three' => '#122538',
					'four'  => '#cfd2d4',
					'five'  => '#e6211c',
					'six'   => '#f64117'
				],
				'dark' => [
					'body'  => '#051b21',
					'text'  => '#eeeeee',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'forest' => [
				'slug'   => 'forest',
				'name'   => $L->get( 'Forest' ),
				'thumbs' => [
					'#165144',
					'#01332e',
					'',
					''
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#165144',
					'two'   => '#01332e',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				],
				'dark' => [
					'body'  => '',
					'text'  => '',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'ocean' => [
				'slug'   => 'ocean',
				'name'   => $L->get( 'Ocean' ),
				'thumbs' => [
					'#254d88',
					'#467ac7',
					'#122544',
					'#08101d'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#254d88',
					'two'   => '#467ac7',
					'three' => '#122544',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				],
				'dark' => [
					'body'  => '#08101d',
					'text'  => '#f8fafd',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'pewter' => [
				'slug'   => 'pewter',
				'name'   => $L->get( 'Pewter' ),
				'thumbs' => [
					'#9d9fa3',
					'#cacbce',
					'#e6211c',
					'#122538'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#9d9fa3',
					'two'   => '#cacbce',
					'three' => '#122538',
					'four'  => '#cfd2d4',
					'five'  => '#e6211c',
					'six'   => '#f64117'
				],
				'dark' => [
					'body'  => '#051b21',
					'text'  => '#eeeeee',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'rose' => [
				'slug'   => 'rose',
				'name'   => $L->get( 'Rose' ),
				'thumbs' => [
					'#f5487f',
					'#f879a1',
					'#401225',
					'#1b0209'
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#f5487f',
					'two'   => '#f879a1',
					'three' => '#401225',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				],
				'dark' => [
					'body'  => '#1b0209',
					'text'  => '#f3f3f3',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			],
			'violet' => [
				'slug'   => 'violet',
				'name'   => $L->get( 'Violet' ),
				'thumbs' => [
					'#4d0859',
					'#890e9f',
					'',
					''
				],
				'light' => [
					'body'  => '#ffffff',
					'text'  => '#333333',
					'one'   => '#4d0859',
					'two'   => '#890e9f',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				],
				'dark' => [
					'body'  => '',
					'text'  => '',
					'one'   => '',
					'two'   => '',
					'three' => '',
					'four'  => '',
					'five'  => '',
					'six'   => ''
				]
			]
	];

	// Merge custom scheme if selected.
	$custom  = custom_scheme();
	$schemes = array_merge( $schemes, $custom );
	return $schemes;
}

/**
 * Default color scheme
 *
 * The array of data for the default color scheme.
 *
 * @since  1.0.0
 * @return array Returns the color scheme data array.
 */
function default_color_scheme() {
	$colors = color_schemes();
	return $colors['default'];
}

/**
 * Current color scheme
 *
 * Gets the data for the selected
 * color scheme option value.
 *
 * Used to define color scheme variables.
 *
 * @since  1.0.0
 * @return array Returns the color scheme data array.
 */
function current_color_scheme() {

	// Option from database.
	$data = plugin()->color_scheme();

	// Get color schemes.
	$schemes = color_schemes();

	// Fallback variable.
	$name = null;

	// Get all schemes.
	foreach ( $schemes as $scheme => $option ) {

		// Filter out all but the selected option.
		if ( $data == $option['slug'] ) {
			$name = $option;
		}
	}
	return $name;
}

/**
 * Define color scheme variables
 *
 * Used in the `<head>` section to assign current
 * color scheme values to color variables.
 *
 * @since  1.0.0
 * @return string Returns a style block.
 */
function define_color_scheme() {

	// Get the scheme selected in the option.
	$current = current_color_scheme();

	// Begin style block.
	$style = "\n" . '<style>:root{';

		// Set up array of colors.
	$colors = [];

	// Variables for each light mode color.
	foreach ( $current['light'] as $key => $value ) {
		if ( ! empty( $value ) ) {
			$colors[] = sprintf(
				'--cfe-scheme-color--%s: %s',
				$key,
				$value
			);
		}
	}

	// Variables for each dark mode color.
	foreach ( $current['dark'] as $key => $value ) {
		if ( ! empty( $value ) ) {
			$colors[] = sprintf(
				'--cfe-scheme-color--%s--dark: %s',
				$key,
				$value
			);
		}
	}

	// Convert array to semicolon-separated CSS content.
	$style .= implode( '; ', $colors );

	// Close the style block.
	$style .= '}</style>' . "\n";

	return $style;
}
