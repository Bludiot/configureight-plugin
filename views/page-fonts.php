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

<h1 class="page-title"><span class="page-title-icon fa fa-bold"></span><span class="page-title-text"><?php $L->p( 'Font Schemes Reference' ); ?></span></h1>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$guide_page}'>options guide</a> page. Go to the <a href='{$settings_page}#style'>website options</a> page." ); ?></p>
</div>

<?php
printf(
	'<h2 class="font-heading">%s %s</h2>',
	$L->get( 'Current Scheme:' ),
	$current['name']
);

echo '<ul class="font-list">';
	printf(
		'<li><h3 class="font-list-heading" style="font-family: %s; font-size: 1.5rem; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
		$current['text']['family'],
		$current['text']['weight'],
		$current['text']['space'],
		$current['text']['variant'],
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
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Size:' ),
		$current['text']['size']
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
		$L->get( 'Font Variant:' ),
		$current['text']['variant']
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
		'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
		$L->get( 'Font Stack:' ),
		$current['text']['stack']
	);
	echo '</ul></li>';

	printf(
		'<li><h3 class="font-list-heading" style="font-family: %s; font-size: %s; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
		$current['primary']['family'],
		$current['primary']['size'],
		$current['primary']['weight'],
		$current['primary']['space'],
		$current['primary']['variant'],
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
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Size:' ),
		$current['primary']['size']
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
		$L->get( 'Font Variant:' ),
		$current['primary']['variant']
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
		'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
		$L->get( 'Font Stack:' ),
		$current['primary']['stack']
	);
	echo '</ul></li>';

	printf(
		'<li><h3 class="font-list-heading" style="font-family: %s; font-size: %s; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
		$current['secondary']['family'],
		$current['secondary']['size'],
		$current['secondary']['weight'],
		$current['secondary']['space'],
		$current['secondary']['variant'],
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
	printf(
		'<li><span class="font-list-label">%s</span> %s</li>',
		$L->get( 'Font Size:' ),
		$current['secondary']['size']
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
		$L->get( 'Font Variant:' ),
		$current['secondary']['variant']
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
		'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
		$L->get( 'Font Stack:' ),
		$current['secondary']['stack']
	);
	echo '</ul></li>';
echo '</ul>';

foreach ( $schemes as $scheme => $font ) {

	if ( $this->font_scheme() == $font['slug'] ) {
		continue;
	}

	echo '<hr />';

	printf(
		'<h2 class="font-heading">%s %s</h2>',
		$L->get( 'Scheme:' ),
		$font['name']
	);

	echo '<ul class="font-list">';
		printf(
			'<li><h3 class="font-list-heading" style="font-family: %s; font-size: 1.5rem; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
			$font['text']['family'],
			$font['text']['weight'],
			$font['text']['space'],
			$font['text']['variant'],
			$L->get( 'General Text' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$font['text']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $font['text']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Size:' ),
			$font['text']['size']
		);
		if ( $font['text']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$font['text']['min'],
				$font['text']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$font['text']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Variant:' ),
			$font['text']['variant']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $font['text']['space'] ? 'normal' : $font['text']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
			$L->get( 'Font Stack:' ),
			$font['text']['stack']
		);
		echo '</ul></li>';

		printf(
			'<li><h3 class="font-list-heading" style="font-family: %s; font-size: %s; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
			$font['primary']['family'],
			$font['primary']['size'],
			$font['primary']['weight'],
			$font['primary']['space'],
			$font['primary']['variant'],
			$L->get( 'Primary Headings' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$font['primary']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $font['primary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Size:' ),
			$font['primary']['size']
		);
		if ( $font['primary']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$font['primary']['min'],
				$font['primary']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$font['primary']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Variant:' ),
			$font['primary']['variant']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $font['primary']['space'] ? 'normal' : $font['primary']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
			$L->get( 'Font Stack:' ),
			$font['primary']['stack']
		);
		echo '</ul></li>';

		printf(
			'<li><h3 class="font-list-heading" style="font-family: %s; font-size: %s; font-weight: %s; letter-spacing: %s; font-variant: %s;">%s</h3><ul class="font-sublist">',
			$font['secondary']['family'],
			$font['secondary']['size'],
			$font['secondary']['weight'],
			$font['secondary']['space'],
			$font['secondary']['variant'],
			$L->get( 'Secondary Headings' )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Family:' ),
			$font['secondary']['family']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Variable Weight:' ),
			( $font['secondary']['var'] ? $L->get( 'Yes' ) : $L->get( 'No' ) )
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Size:' ),
			$font['secondary']['size']
		);
		if ( $font['secondary']['var'] ) {
			printf(
				'<li><span class="font-list-label">%s</span> %s-%s</li>',
				$L->get( 'Weight Range:' ),
				$font['secondary']['min'],
				$font['secondary']['max']
			);
		}
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Weight Default:' ),
			$font['secondary']['weight']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Font Variant:' ),
			$font['secondary']['variant']
		);
		printf(
			'<li><span class="font-list-label">%s</span> %s</li>',
			$L->get( 'Spacing Default:' ),
			( '0' === $font['secondary']['space'] ? 'normal' : $font['secondary']['space'] )
		);
		printf(
			'<li><span class="font-list-label">%s</span> <code class="select">%s</code></li>',
			$L->get( 'Font Stack:' ),
			$font['secondary']['stack']
		);
		echo '</ul></li>';
	echo '</ul>';
} // End foreach.
