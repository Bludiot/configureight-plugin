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
			'slug'     => 'default',
			'name'     => $L->get( 'Default' ),
			'category' => 'basic',
			'thumbs'   => [
				'#0044aa',
				'#0066cc',
				'#333333',
				'#555555',
				'#888888',
				'#cccccc'
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
			'slug'     => 'dark',
			'name'     => $L->get( 'Dark' ),
			'category' => 'basic',
			'thumbs'   => [
				'#1e1e1e',
				'#333333',
				'#555555',
				'#888888',
				'#cccccc',
				'#eeeeee'
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

		// Design.
		'club' => [
			'slug'     => 'club',
			'name'     => $L->get( '1930s Club' ),
			'category' => 'design',
			'thumbs'   => [
				'#2ea65e',
				'#4dce81',
				'#f37709',
				'#ff9f39',
				'#f83d5c',
				'#fa8072'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#2ea65e',
				'two'   => '#4dce81',
				'three' => '#f37709',
				'four'  => '#ff9f39',
				'five'  => '#f83d5c',
				'six'   => '#fa8072'
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
		'deco' => [
			'slug'     => 'deco',
			'name'     => $L->get( '1940s Hotel' ),
			'category' => 'design',
			'thumbs'   => [
				'#1d683b',
				'#2da45d',
				'#937e28',
				'#c8ab37',
				'#8a2b26',
				'#c32323'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#1d683b',
				'two'   => '#2da45d',
				'three' => '#937e28',
				'four'  => '#c8ab37',
				'five'  => '#8a2b26',
				'six'   => '#c32323'
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
		'diner' => [
			'slug'     => 'diner',
			'name'     => $L->get( '1950s Diner' ),
			'category' => 'design',
			'thumbs'   => [
				'#c90a00',
				'#ff0000',
				'#00a1c9',
				'#4cc8e6',
				'#ff126f',
				'#ff6f94'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#c90a00',
				'two'   => '#ff0000',
				'three' => '#00a1c9',
				'four'  => '#4cc8e6',
				'five'  => '#ff126f',
				'six'   => '#ff6f94'
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
		'dress' => [
			'slug'     => 'dress',
			'name'     => $L->get( '1960s Dress' ),
			'category' => 'design',
			'thumbs'   => [
				'#0f3571',
				'#004fc6',
				'#44aa00',
				'#4eff00',
				'#ff1d76',
				'#ff5599'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#0f3571',
				'two'   => '#004fc6',
				'three' => '#44aa00',
				'four'  => '#4eff00',
				'five'  => '#ff1d76',
				'six'   => '#ff5599'
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
		'kitchen' => [
			'slug'     => 'kitchen',
			'name'     => $L->get( '1970s Kitchen' ),
			'category' => 'design',
			'thumbs'   => [
				'#84200f',
				'#b02b14',
				'#df7b0b',
				'#ffb400',
				'#677d08',
				'#93ad00'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#84200f',
				'two'   => '#b02b14',
				'three' => '#df7b0b',
				'four'  => '#ffb400',
				'five'  => '#677d08',
				'six'   => '#93ad00'
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
		'video' => [
			'slug'     => 'video',
			'name'     => $L->get( '1980s Video' ),
			'category' => 'design',
			'thumbs'   => [
				'#d40055',
				'#ff297d',
				'#750093',
				'#a900d2',
				'#0eab8c',
				'#00e0b4'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#d40055',
				'two'   => '#ff297d',
				'three' => '#750093',
				'four'  => '#a900d2',
				'five'  => '#0eab8c',
				'six'   => '#00e0b4'
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
		'wedding' => [
			'slug'     => 'wedding',
			'name'     => $L->get( '1990s Wedding' ),
			'category' => 'design',
			'thumbs'   => [
				'#502d16',
				'#a05a2c',
				'#0081a1',
				'#50b0c9',
				'#f93c5a',
				'#ff8080'
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#502d16',
				'two'   => '#a05a2c',
				'three' => '#0081a1',
				'four'  => '#50b0c9',
				'five'  => '#f93c5a',
				'six'   => '#ff8080'
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

		// Materials.
		'brick' => [
			'slug'     => 'brick',
			'name'     => $L->get( 'Brick' ),
			'category' => 'materials',
			'thumbs'   => [
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
		'concrete' => [
			'slug'     => 'concrete',
			'name'     => $L->get( 'Concrete' ),
			'category' => 'materials',
			'thumbs'   => [
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
		'wood' => [
			'slug'     => 'wood',
			'name'     => $L->get( 'Wood' ),
			'category' => 'materials',
			'thumbs'   => [
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

		// Metallic.
		'bronze' => [
			'slug'     => 'bronze',
			'name'     => $L->get( 'Bronze' ),
			'category' => 'metallic',
			'thumbs'   => [
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
		'copper' => [
			'slug'     => 'copper',
			'name'     => $L->get( 'Copper' ),
			'category' => 'metallic',
			'thumbs'   => [
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
		'gold' => [
			'slug'     => 'gold',
			'name'     => $L->get( 'Gold' ),
			'category' => 'metallic',
			'thumbs'   => [
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
		'pewter' => [
			'slug'     => 'pewter',
			'name'     => $L->get( 'Pewter' ),
			'category' => 'metallic',
			'thumbs'   => [
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

		// Nature.
		'citrus' => [
			'slug'     => 'citrus',
			'name'     => $L->get( 'Citrus' ),
			'category' => 'nature',
			'thumbs'   => [
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
		'forest' => [
			'slug'     => 'forest',
			'name'     => $L->get( 'Forest' ),
			'category' => 'nature',
			'thumbs'   => [
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
			'slug'     => 'ocean',
			'name'     => $L->get( 'Ocean' ),
			'category' => 'nature',
			'thumbs'   => [
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
		'orchid' => [
			'slug'     => 'orchid',
			'name'     => $L->get( 'Orchid' ),
			'category' => 'nature',
			'thumbs'   => [
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
		],
		'rose' => [
			'slug'     => 'rose',
			'name'     => $L->get( 'Rose' ),
			'category' => 'nature',
			'thumbs'   => [
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
			'slug'     => 'violet',
			'name'     => $L->get( 'Violet' ),
			'category' => 'nature',
			'thumbs'   => [
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
		],
		'sunrise' => [
			'slug'     => 'sunrise',
			'name'     => $L->get( 'Sunrise' ),
			'category' => 'nature',
			'thumbs'   => [
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
		'sunset' => [
			'slug'     => 'sunset',
			'name'     => $L->get( 'Sunset' ),
			'category' => 'nature',
			'thumbs'   => [
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
 * @return mixed Returns a style block or null.
 */
function define_color_scheme() {

	// Get the scheme selected in the option.
	$current = current_color_scheme();

	/**
	 * Exclude default scheme
	 *
	 * Default scheme is defined in the theme,
	 * including dark mode variables.
	 */
	if ( 'default' == $current['slug'] ) {
		return null;
	}

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
