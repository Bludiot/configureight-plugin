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
use function CFE_Colors\{
	color_schemes,
	get_color_scheme,
	default_color_scheme,
	current_color_scheme,
	hex_to_rgb
};
use function CFE_Plugin\{
	plugin
};

// Access global variables.
global $site;

$schemes = color_schemes();
$default = default_color_scheme();
$current = current_color_scheme();

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . $this->className();

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

?>

<style>
.color-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-heading--font-size, 1.625rem );
}
.color-list-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-list-heading--font-size, 1.25rem );
}
.color-list {
	list-style: var( --cfe-admin--color-list--list-style, none );
	margin: 1rem 0 0 0 !important;
	padding: 0 !important;
}
.color-list li {
	line-height: var( --cfe-admin--color-list--item--line-height, 1.3 );
}
.color-list-label {
	font-weight: var( --cfe-admin--color-list-value--font-weight, 600 );
}
.color-list-preview {
	display: inline-block;
	vertical-align: middle;
	width: 6rem;
	height: 1em;
	border: var( --cfe-form-element--border );
}
pre {
	user-select: all;
	cursor: pointer;
	max-width: 720px;
	margin: 1rem 0;
	white-space: pre-wrap;
}
code.select {
	cursor: pointer;
}
</style>

<h1 class="page-title"><span class="page-title-icon fa fa-eyedropper"></span><span class="page-title-text"><?php $L->p( 'Color Schemes Reference' ); ?></span></h1>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$guide_page}'>options guide</a> page. Go to the <a href='{$settings_page}#style'>website options</a> page." ); ?></p>
</div>

<p><?php $L->p( 'Click any code value to select for copy.' ); ?></p>

<?php
printf(
	'<h2 class="color-heading">%s <a class="reference-link form-tooltip" href="http://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties" target="_blank" rel="noopener noreferrer" title="%s"><span class="fa fa-external-link-square"></span><span class="screen-reader-text">%s</span></a></h2>',
	$L->get( 'CSS Variables' ),
	$L->get( 'Reference on the Mozilla website' ),
	$L->get( 'Reference on the Mozilla website' )
);

printf(
	'<p>%s</p>',
	$L->get( 'The CSS color variables are used universally in the public theme and the admin theme for each color scheme. These variables are redefined in the <code>head</code> section by the various options. The <code>--cfe-</code> prefix refers to the Configure 8 theme.' )
);
printf(
	'<p>%s</p>',
	$L->get( 'To redefine these variables, simply copy the variable and paste it into the relevant custom CSS field, under the <code>:root</code> selector, with its new color.' )
);
printf(
	'<p><span class="color-list-label">%s</span> <code>:root{ --cfe-scheme-color--one: #ffcc00; }</code></p>',
	$L->get( 'Example:' )
);
echo '<hr />';
printf(
	'<p>%s</p>',
	$L->get( 'To use these variables as a value for an element, ID, or class, simply copy the variable and paste it into the relevant custom CSS field following a selector.' )
);
printf(
	'<p><span class="color-list-label">%s</span> <code>.div-class a { color: var( --cfe-scheme-color--three ); }</code></p>',
	$L->get( 'Example:' )
);

printf(
	'<h3 class="color-list-heading">%s</h3>',
	$L->get( 'Light Mode Variables' )
);

echo '<ul class="color-list color-list-light">';
foreach ( $default['light'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s:</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		$L->get( 'variable:' ),
		"--cfe-scheme-color--{$name}"
	);
}

printf(
	'<h3 class="color-list-heading">%s</h3>',
	$L->get( 'Dark Mode Variables' )
);

echo '<ul class="color-list color-list-dark">';
foreach ( $default['dark'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		$L->get( 'variable:' ),
		"--cfe-scheme-color--{$name}--dark"
	);
}

echo '<hr />';

printf(
	'<h2 class="color-heading">%s</h2>',
	$L->get( 'Scheme Slugs' )
);

printf(
	'<p>%s</p>',
	$L->get( 'Color scheme page/post templates require use of the scheme slug. To apply a color scheme template use the name <code>color-scheme-$slug</code> where <code>$slug</code> is one of the color scheme slugs listed below.' )
);

printf(
	'<p><span class="color-list-label">%s</span> %s</p>',
	$L->get( 'Example:' ),
	$L->get( 'the template <code>color-scheme-forest</code> will apply the Forest color scheme to that page or post.' )
);

printf(
	'<p>%s</p>',
	$L->get( 'Slugs can also be used in the <code>get_color_scheme( $slug )</code> function to get an array of data about the scheme.' )
);

// Sort schemes alphabetically then by category.
asort( $schemes );
usort( $schemes, function( $one_thing, $another ) {
	return strcmp( $one_thing['category'], $another['category'] );
} );

// Category used for option groups.
$category = '';

echo '<ul id="schemes-list" class="color-list">';
foreach ( $schemes as $scheme => $option ) {

	// Skip custom scheme.
	if ( 'custom' == $option['slug'] ) {
		continue;
	}

	if ( $category != $option['category'] ) {
		printf(
			'<li><h3>%s</h3></li>',
			ucwords( $option['category'] )
		);
	}

	printf(
		'<li><span class="color-list-label"><a href="#%s">%s</a>:</span> <code class="select">%s</code></li>',
		$option['slug'],
		ucwords( $option['name'] ),
		$option['slug']
	);

	$category = $option['category'];
}
echo '</ul>';

// Redefine after sorting;
$schemes = color_schemes();

echo '<hr />'; ?>

<?php
printf(
	'<h2 class="color-heading">%s %s</h2>',
	$L->get( 'Current Scheme:' ),
	$current['name']
); ?>

<?php
if ( 'custom' == $current['slug'] ) {
	$scheme_from = plugin()->custom_scheme_from();
	$original    = get_color_scheme( $scheme_from );
	if ( is_array( $original ) ) {
		printf(
			$L->get( '<p>Adapted from the <a href="#%s">%s</a> scheme.</p>' ),
			$scheme_from,
			$original['name']
		);
	}
} ?>

<?php
printf(
	'<h3 class="color-list-heading">%s</h3>',
	$L->get( 'Light Mode Colors' )
);

echo '<ul class="color-list color-list-light">';
foreach ( $current['light'] as $name => $color ) {

	if ( $color ) :
		echo '<li><ul class="color-list color-list-light">';
		printf(
			'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			$color
		);
		printf(
			'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			hex_to_rgb( $color )
		);
		printf(
			'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
			$L->get( 'Preview:' ),
			$color,
			$color
		);
		echo '</ul></li>';
	endif;
}
echo '</ul>';

printf(
	'<h3 class="color-list-heading">%s</h3>',
	$L->get( 'Dark Mode Colors' )
);

echo '<ul class="color-list color-list-dark">';
foreach ( $current['dark'] as $name => $color ) {

	if ( $color ) :
		echo '<li><ul class="color-list color-list-dark">';
		printf(
			'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			$color
		);
		printf(
			'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			hex_to_rgb( $color )
		);
		printf(
			'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
			$L->get( 'Preview:' ),
			$color,
			$color
		);
		echo '</ul></li>';
	endif;
}
echo '</ul>';

// Copy custom colors as text.
if ( 'custom' == plugin()->color_scheme() ) :
printf(
	'<h3 class="form-heading" style="text-transform: none;">%s</h3>',
	$L->get( 'Copy Custom Colors for Records' )
);
echo '<pre>';
echo $L->get( 'Light' ) . '<br />';
foreach ( $current['light'] as $name => $color ) {
	echo ucwords( $name ) . ' &mdash; ' . $color . '<br />';
}
echo '<br />' . $L->get( 'Dark' ) . '<br />';
foreach ( $current['dark'] as $name => $color ) {
	echo ucwords( $name ) . ' &mdash; ' . $color . '<br />';
}
echo '</pre>';
endif;

// List color schemes.
foreach ( $schemes as $scheme => $option ) {

	if ( $this->color_scheme() == $option['slug'] ) {
		continue;
	}

	echo '<hr />';

	printf(
		'<h2 id="%s" class="color-heading">%s %s</h2>',
		$option['slug'],
		$L->get( 'Scheme:' ),
		$option['name']
	);

	printf(
		'<h3 class="color-list-heading">%s</h3>',
		$L->get( 'Light Mode Colors' )
	);

	echo '<ul class="color-list color-list-light">';
	foreach ( $option['light'] as $color => $value ) {

		if ( $value ) :
			echo '<li><ul class="color-list color-list-light">';
			printf(
				'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				$value
			);
			printf(
				'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				hex_to_rgb( $value )
			);
			printf(
				'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
				$L->get( 'Preview:' ),
				$value,
				$value
			);
			echo '</ul></li>';
		endif;
	}
	echo '</ul>';

	printf(
		'<h3 class="color-list-heading">%s</h3>',
		$L->get( 'Dark Mode Colors' )
	);

	echo '<ul class="color-list color-list-dark">';
	foreach ( $option['dark'] as $color => $value ) {

		if ( $value ) :
			echo '<li><ul class="color-list color-list-dark">';
			printf(
				'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				$value
			);
			printf(
				'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				hex_to_rgb( $value )
			);
			printf(
				'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
				$L->get( 'Preview:' ),
				$value,
				$value
			);
			echo '</ul></li>';
		endif;
	}
	echo '</ul>';
} ?>

<script>
jQuery(document).ready( function($) {
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
});
</script>
