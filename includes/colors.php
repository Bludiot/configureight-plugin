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
			'fonts'    => [
				$L->get( 'Default' ),
				$L->get( 'Sans-Serif' ),
				$L->get( 'Serif' )
			],
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#0044aa',
				'two'   => '#0066cc',
				'three' => '#555555',
				'four'  => '#888888',
				'five'  => '#333333',
				'six'   => '#555555'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			]
		],
		'dark' => [
			'slug'     => 'dark',
			'name'     => $L->get( 'Dark' ),
			'category' => 'basic',
			'fonts'    => [
				$L->get( 'Default' )
			],
			'light' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			]
		],

		// Design.
		'club' => [
			'slug'     => 'club',
			'name'     => $L->get( '1930s Club' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2a180c',
				'one'   => '#f83d5c',
				'two'   => '#f9657d',
				'three' => '#2ea65e',
				'four'  => '#4dce81',
				'five'  => '#ed7409',
				'six'   => '#ff8a0d'
			],
			'dark' => [
				'body'  => '#180e07',
				'text'  => '#eeeeee',
				'one'   => '#f9657d',
				'two'   => '#f83d5c',
				'three' => '#2ea65e',
				'four'  => '#4dce81',
				'five'  => '#ed7409',
				'six'   => '#ff8a0d'
			]
		],
		'deco' => [
			'slug'     => 'deco',
			'name'     => $L->get( '1940s Hotel' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#3b291d',
				'one'   => '#8a2b26',
				'two'   => '#c32323',
				'three' => '#1d683b',
				'four'  => '#2da45d',
				'five'  => '#937e28',
				'six'   => '#c8ab37'
			],
			'dark' => [
				'body'  => '#1c140f',
				'text'  => '#eeeeee',
				'one'   => '#c8ab37',
				'two'   => '#937e28',
				'three' => '#1d683b',
				'four'  => '#2da45d',
				'five'  => '#8a2b26',
				'six'   => '#c32323'
			]
		],
		'diner' => [
			'slug'     => 'diner',
			'name'     => $L->get( '1950s Diner' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#000000',
				'one'   => '#008aad',
				'two'   => '#1fb4d8',
				'three' => '#cc0000',
				'four'  => '#ff0000',
				'five'  => '#ff126f',
				'six'   => '#ff4c93'
			],
			'dark' => [
				'body'  => '#000000',
				'text'  => '#ffffff',
				'one'   => '#1fb4d8',
				'two'   => '#008aad',
				'three' => '#ff126f',
				'four'  => '#ff4c93',
				'five'  => '#cc0000',
				'six'   => '#ff0000'
			]
		],
		'dress' => [
			'slug'     => 'dress',
			'name'     => $L->get( '1960s Dress' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b1b21',
				'one'   => '#093d90',
				'two'   => '#004fc6',
				'three' => '#44aa00',
				'four'  => '#46e400',
				'five'  => '#ff1d76',
				'six'   => '#ff5599'
			],
			'dark' => [
				'body'  => '#1b1b21',
				'text'  => '#eeeeee',
				'one'   => '#46e400',
				'two'   => '#44aa00',
				'three' => '#004fc6',
				'four'  => '#093d90',
				'five'  => '#ff1d76',
				'six'   => '#ff5599'
			]
		],
		'kitchen' => [
			'slug'     => 'kitchen',
			'name'     => $L->get( '1970s Kitchen' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#381f0f',
				'one'   => '#b02b14',
				'two'   => '#e03214',
				'three' => '#df7b0b',
				'four'  => '#ffb400',
				'five'  => '#677d08',
				'six'   => '#93ad00'
			],
			'dark' => [
				'body'  => '#1e1108',
				'text'  => '#eeeeee',
				'one'   => '#ffb400',
				'two'   => '#df7b0b',
				'three' => '#677d08',
				'four'  => '#93ad00',
				'five'  => '#b02b14',
				'six'   => '#e03214'
			]
		],
		'video' => [
			'slug'     => 'video',
			'name'     => $L->get( '1980s Video' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b2025',
				'one'   => '#d40055',
				'two'   => '#ff297d',
				'three' => '#750093',
				'four'  => '#a900d2',
				'five'  => '#0eab8c',
				'six'   => '#00e0b4'
			],
			'dark' => [
				'body'  => '#1b2025',
				'text'  => '#ffffff',
				'one'   => '#ff297d',
				'two'   => '#d40055',
				'three' => '#a900d2',
				'four'  => '#750093',
				'five'  => '#0eab8c',
				'six'   => '#00e0b4'
			]
		],
		'wedding' => [
			'slug'     => 'wedding',
			'name'     => $L->get( '1990s Wedding' ),
			'category' => 'design',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#28170b',
				'one'   => '#65391c',
				'two'   => '#a05a2c',
				'three' => '#0081a1',
				'four'  => '#21aed3',
				'five'  => '#f93c5a',
				'six'   => '#ff7575'
			],
			'dark' => [
				'body'  => '#28170b',
				'text'  => '#eeeeee',
				'one'   => '#c59653',
				'two'   => '#ab602f',
				'three' => '#0081a1',
				'four'  => '#21aed3',
				'five'  => '#f93c5a',
				'six'   => '#ff7575'
			]
		],

		// Materials.
		'brick' => [
			'slug'     => 'brick',
			'name'     => $L->get( 'Brick' ),
			'category' => 'materials',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#242611',
				'one'   => '#ba2d15',
				'two'   => '#e33619',
				'three' => '#84200f',
				'four'  => '#ab2913',
				'five'  => '#bca443',
				'six'   => '#cbb86d'
			],
			'dark' => [
				'body'  => '#241514',
				'text'  => '#eeeeee',
				'one'   => '#cbb86d',
				'two'   => '#bca443',
				'three' => '#ba2d15',
				'four'  => '#e33619',
				'five'  => '#84200f',
				'six'   => '#ab2913'
			]
		],
		'concrete' => [
			'slug'     => 'concrete',
			'name'     => $L->get( 'Concrete' ),
			'category' => 'materials',
			'fonts'    => '',
			'light' => [
				'body'  => '#f3f3f3',
				'text'  => '#333333',
				'one'   => '#666666',
				'two'   => '#888888',
				'three' => '#9299a2',
				'four'  => '#a3a9b1',
				'five'  => '#9299a2',
				'six'   => '#a3a9b1'
			],
			'dark' => [
				'body'  => '#222222',
				'text'  => '#eeeeee',
				'one'   => '#eeeeee',
				'two'   => '#ffffff',
				'three' => '#9299a2',
				'four'  => '#a3a9b1',
				'five'  => '#9299a2',
				'six'   => '#a3a9b1'
			]
		],
		'wood' => [
			'slug'     => 'wood',
			'name'     => $L->get( 'Wood' ),
			'category' => 'materials',
			'fonts'    => '',
			'light' => [
				'body'  => '#fcfcf6',
				'text'  => '#261e18',
				'one'   => '#743020',
				'two'   => '#894229',
				'three' => '#c8ab37',
				'four'  => '#d3bc5f',
				'five'  => '#502d16',
				'six'   => '#784421'
			],
			'dark' => [
				'body'  => '#261e18',
				'text'  => '#fcfcf6',
				'one'   => '#d3bc5f',
				'two'   => '#c8ab37',
				'three' => '#784421',
				'four'  => '#502d16',
				'five'  => '#894229',
				'six'   => '#743020'
			]
		],

		// Metallic.
		'bronze' => [
			'slug'     => 'bronze',
			'name'     => $L->get( 'Bronze' ),
			'category' => 'metallic',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2e2c31',
				'one'   => '#a88548',
				'two'   => '#c19b57',
				'three' => '#a88548',
				'four'  => '#c19b57',
				'five'  => '#2e2c31',
				'six'   => '#a88548'
			],
			'dark' => [
				'body'  => '#20190d',
				'text'  => '#eeeeee',
				'one'   => '#a88548',
				'two'   => '#c19b57',
				'three' => '#a88548',
				'four'  => '#c19b57',
				'five'  => '#503f21',
				'six'   => '#a88548'
			]
		],
		'copper' => [
			'slug'     => 'copper',
			'name'     => $L->get( 'Copper' ),
			'category' => 'metallic',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#381a0c',
				'one'   => '#cb6c07',
				'two'   => '#e88a0f',
				'three' => '#cb6c07',
				'four'  => '#e88a0f',
				'five'  => '#237944',
				'six'   => '#2ca05a'
			],
			'dark' => [
				'body'  => '#211813',
				'text'  => '#eeeeee',
				'one'   => '#e87e0f',
				'two'   => '#bc6407',
				'three' => '#e87e0f',
				'four'  => '#bc6407',
				'five'  => '#237944',
				'six'   => '#2ca05a'
			]
		],
		'gold' => [
			'slug'     => 'gold',
			'name'     => $L->get( 'Gold' ),
			'category' => 'metallic',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2b2200',
				'one'   => '#b88014',
				'two'   => '#e7a21e',
				'three' => '#b88014',
				'four'  => '#e7a21e',
				'five'  => '#402c07',
				'six'   => '#b88014'
			],
			'dark' => [
				'body'  => '#051b21',
				'text'  => '#eeeeee',
				'one'   => '#b88014',
				'two'   => '#e7a21e',
				'three' => '#b88014',
				'four'  => '#e7a21e',
				'five'  => '#402c07',
				'six'   => '#b88014'
			]
		],
		'pewter' => [
			'slug'     => 'pewter',
			'name'     => $L->get( 'Pewter' ),
			'category' => 'metallic',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1c2224',
				'one'   => '#433d3d',
				'two'   => '#625a5a',
				'three' => '#625a5a',
				'four'  => '#7b7f85',
				'five'  => '#625a5a',
				'six'   => '#7b7f85'
			],
			'dark' => [
				'body'  => '#1c2224',
				'text'  => '#eeeeee',
				'one'   => '#c3c6ca',
				'two'   => '#eeeeee',
				'three' => '#625a5a',
				'four'  => '#7b7f85',
				'five'  => '#625a5a',
				'six'   => '#7b7f85'
			]
		],

		// Nature.
		'beach' => [
			'slug'     => 'beach',
			'name'     => $L->get( 'Beach' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#101e36',
				'one'   => '#254d88',
				'two'   => '#467ac7',
				'three' => '#254d88',
				'four'  => '#d3b857',
				'five'  => '#204170',
				'six'   => '#d3b857'
			],
			'dark' => [
				'body'  => '#050b14',
				'text'  => '#f8fafd',
				'one'   => '#467ac7',
				'two'   => '#d3b857',
				'three' => '#254d88',
				'four'  => '#d3b857',
				'five'  => '#204170',
				'six'   => '#d3b857'
			]
		],
		'citrus' => [
			'slug'     => 'citrus',
			'name'     => $L->get( 'Citrus' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#fffffe',
				'text'  => '#111a0b',
				'one'   => '#ff7700',
				'two'   => '#ff5500',
				'three' => '#ffbb00',
				'four'  => '#ffdd11',
				'five'  => '#ff7700',
				'six'   => '#ffcc00'
			],
			'dark' => [
				'body'  => '#111a0b',
				'text'  => '#fffffe',
				'one'   => '#ffdd11',
				'two'   => '#ffbb00',
				'three' => '#ff7700',
				'four'  => '#ff5500',
				'five'  => '#ff7700',
				'six'   => '#ffcc00'
			]
		],
		'forest' => [
			'slug'     => 'forest',
			'name'     => $L->get( 'Forest' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1e110a',
				'one'   => '#6d3d1d',
				'two'   => '#ff6600',
				'three' => '#3e721a',
				'four'  => '#46a109',
				'five'  => '#3e721a',
				'six'   => '#f5a313'
			],
			'dark' => [
				'body'  => '#1e110a',
				'text'  => '#eeeeee',
				'one'   => '#55d400',
				'two'   => '#46a109',
				'three' => '#6d3d1d',
				'four'  => '#ff6600',
				'five'  => '#46a109',
				'six'   => '#f5a313'
			]
		],
		'orchid' => [
			'slug'     => 'orchid',
			'name'     => $L->get( 'Orchid' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#28081c',
				'one'   => '#b800b1',
				'two'   => '#ff00f6',
				'three' => '#e20093',
				'four'  => '#ff2db8',
				'five'  => '#e20093',
				'six'   => '#ff2db8'
			],
			'dark' => [
				'body'  => '#28081c',
				'text'  => '#fbf3f6',
				'one'   => '#ff00f6',
				'two'   => '#b800b1',
				'three' => '#e20093',
				'four'  => '#ff2db8',
				'five'  => '#e20093',
				'six'   => '#ff2db8'
			]
		],
		'rose' => [
			'slug'     => 'rose',
			'name'     => $L->get( 'Rose' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b0209',
				'one'   => '#ff1a40',
				'two'   => '#e00020',
				'three' => '#f7417c',
				'four'  => '#ff6797',
				'five'  => '#f7417c',
				'six'   => '#ff6797'
			],
			'dark' => [
				'body'  => '#1b0209',
				'text'  => '#f3f3f3',
				'one'   => '#ff6797',
				'two'   => '#f7417c',
				'three' => '#e00020',
				'four'  => '#ff1a40',
				'five'  => '#f7417c',
				'six'   => '#ff6797'
			]
		],
		'violet' => [
			'slug'     => 'violet',
			'name'     => $L->get( 'Violet' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#220b28',
				'one'   => '#a400aa',
				'two'   => '#dd00e5',
				'three' => '#672178',
				'four'  => '#8f2ea7',
				'five'  => '#672178',
				'six'   => '#8f2ea7'
			],
			'dark' => [
				'body'  => '#220b28',
				'text'  => '#eeeeee',
				'one'   => '#dd00e5',
				'two'   => '#a400aa',
				'three' => '#672178',
				'four'  => '#8f2ea7',
				'five'  => '#672178',
				'six'   => '#8f2ea7'
			]
		],
		'sunrise' => [
			'slug'     => 'sunrise',
			'name'     => $L->get( 'Sunrise' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#3b3c3c',
				'one'   => '#ffcc00',
				'two'   => '#ffff00',
				'three' => '#2c89a0',
				'four'  => '#00aad4',
				'five'  => '#ff1d76',
				'six'   => '#ff4f94'
			],
			'dark' => [
				'body'  => '#1b0209',
				'text'  => '#f3f3f3',
				'one'   => '#ffcc00',
				'two'   => '#ffff00',
				'three' => '#2c89a0',
				'four'  => '#00aad4',
				'five'  => '#ff1d76',
				'six'   => '#ff4f94'
			]
		],
		'sunset' => [
			'slug'     => 'sunset',
			'name'     => $L->get( 'Sunset' ),
			'category' => 'nature',
			'fonts'    => '',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#3b3c3c',
				'one'   => '#2c89a0',
				'two'   => '#00aad4',
				'three' => '#ff271f',
				'four'  => '#ff5a2d',
				'five'  => '#d3300a',
				'six'   => '#ff6600'
			],
			'dark' => [
				'body'  => '#1b0209',
				'text'  => '#f3f3f3',
				'one'   => '#2c89a0',
				'two'   => '#00aad4',
				'three' => '#ff271f',
				'four'  => '#ff5a2d',
				'five'  => '#d3300a',
				'six'   => '#ff6600'
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
