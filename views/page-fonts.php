<?php
/**
 * Color Scheme Reference page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin
};
use function CFE_Fonts\{
	font_schemes,
	current_font_scheme
};

$schemes = font_schemes();
// $default = default_color_scheme();
$current = current_font_scheme();

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . $this->className();

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

// Add class class to 'js' to `<body>` if JavaScript is enabled.
echo "<script>var bodyClass = document.body;bodyClass.classList ? bodyClass.classList.add('js') : bodyClass.className += ' js';</script>\n";

?>

<style>
.font-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--font-heading--font-size, 1.625rem );
}
.font-list-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--font-list-heading--font-size, 1.25rem );
}
.font-list {
	list-style: var( --cfe-admin--font-list--list-style, none );
	margin: 1rem 0 0 0 !important;
	padding: 0 !important;
}
.font-sublist {
	list-style: var( --cfe-admin--font-list--sublist-style, none );
	margin: 0.5em 0 0 0 !important;
	padding: 0 !important;
}
.font-list li {
	line-height: var( --cfe-admin--font-list--item--line-height, 1.3 );
}
.font-list-label {
	font-weight: var( --cfe-admin--font-list-value--font-weight, 600 );
}
code.select {
	cursor: pointer;
}
</style>

<?php echo Bootstrap :: pageTitle( [ 'title' => $L->g( 'Font Scheme Reference' ), 'element' => 'h1', 'icon' => 'bold' ] ); ?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$guide_page}'>theme guide</a> page. Go to the <a href='{$settings_page}#style'>theme options</a> page." ); ?></p>
</div>

<?php
printf(
	'<h2 class="font-heading">%s %s</h2>',
	$L->get( 'Current Scheme:' ),
	$current['name']
);

echo '<ul class="font-list">';
	printf(
		'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
		$L->get( 'General Text' )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Family:' ),
		$current['text']['family']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Variable Weight:' ),
		( $current['text']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
	);
	if ( $current['text']['var'] ) {
		printf(
			'<li><span class="font-list-label">%s</span> %s-%s</li>',
			$L->get( 'Weight Range:' ),
			$current['text']['min'],
			$current['text']['max']
		);
	}
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Default:' ),
		$current['text']['weight']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Option:' ),
		plugin()->wght_text()
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Default:' ),
		( '0' === $current['text']['space'] ? 'normal' : $current['text']['space'] )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Option:' ),
		( '0' === plugin()->space_text() ? 'normal' : plugin()->space_text() )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Stack:' ),
		$current['text']['stack']
	);
	echo '</ul></li>';

	printf(
		'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
		$L->get( 'Primary Headings' )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Family:' ),
		$current['primary']['family']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Variable Weight:' ),
		( $current['primary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
	);
	if ( $current['primary']['var'] ) {
		printf(
			'<li><span class="font-list-label">%s</span> %s-%s</li>',
			$L->get( 'Weight Range:' ),
			$current['primary']['min'],
			$current['primary']['max']
		);
	}
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Default:' ),
		$current['primary']['weight']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Option:' ),
		plugin()->wght_primary()
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Default:' ),
		( '0' === $current['primary']['space'] ? 'normal' : $current['primary']['space'] )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Option:' ),
		( '0' === plugin()->space_primary() ? 'normal' : plugin()->space_primary() )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Stack:' ),
		$current['primary']['stack']
	);
	echo '</ul></li>';

	printf(
		'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
		$L->get( 'Secondary Headings' )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Family:' ),
		$current['secondary']['family']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Variable Weight:' ),
		( $current['secondary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
	);
	if ( $current['secondary']['var'] ) {
		printf(
			'<li><span class="font-list-label">%s</span> %s-%s</li>',
			$L->get( 'Weight Range:' ),
			$current['secondary']['min'],
			$current['secondary']['max']
		);
	}
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Default:' ),
		$current['secondary']['weight']
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Weight Option:' ),
		plugin()->wght_secondary()
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Default:' ),
		( '0' === $current['secondary']['space'] ? 'normal' : $current['secondary']['space'] )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Spacing Option:' ),
		( '0' === plugin()->space_secondary() ? 'normal' : plugin()->space_secondary() )
	);
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Stack:' ),
		$current['secondary']['stack']
	);
	echo '</ul></li>';
echo '</ul>';

foreach ( $schemes as $scheme => $option ) {

	if ( $this->font_scheme() == $option['slug'] ) {
		continue;
	}

	echo '<hr />';

	printf(
		'<h2 class="font-heading">%s %s</h2>',
		$L->get( 'Scheme:' ),
		$option['name']
	);

	echo '<ul class="font-list">';
		printf(
			'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
			$L->get( 'General Text' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$option['text']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $option['text']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		if ( $option['text']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$option['text']['min'],
				$option['text']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$option['text']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $option['text']['space'] ? 'normal' : $option['text']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Stack:' ),
			$option['text']['stack']
		);
		echo '</ul></li>';

		printf(
			'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
			$L->get( 'Primary Headings' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$option['primary']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $option['primary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		if ( $option['primary']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$option['primary']['min'],
				$option['primary']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$option['primary']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $option['primary']['space'] ? 'normal' : $option['primary']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Stack:' ),
			$option['primary']['stack']
		);
		echo '</ul></li>';

		printf(
			'<li><h3 class="font-list-heading">%s</h3><ul class="font-sublist">',
			$L->get( 'Secondary Headings' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$option['secondary']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $option['secondary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		if ( $option['secondary']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$option['secondary']['min'],
				$option['secondary']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$option['secondary']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $option['secondary']['space'] ? 'normal' : $option['secondary']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Stack:' ),
			$option['secondary']['stack']
		);
		echo '</ul></li>';
	echo '</ul>';
} // End foreach.
