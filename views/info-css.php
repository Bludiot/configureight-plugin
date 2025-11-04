<?php
/**
 * Guide page admin tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	lang,
	plugin_options_url
};

?>
<style>
pre {
	user-select: unset;
	cursor: text;
	max-width: 720px;
	margin: 1rem 0;
	white-space: pre-wrap;
}
pre.select {
	user-select: all;
	cursor: pointer;
}
code.select {
	cursor: pointer;
}
</style>

<h2 class="form-heading"><?php lang()->p( 'SCSS & CSS Variables' ); ?></h2>

<?php printf(
	'<p>%s</p>',
	lang()->get( 'CSS variables are used in the public theme and the admin theme. These variables can be redefined in the <code>head</code> section using the CSS field in the Options/Website Configuration styles tab.' )
); ?>

<h3 class="form-heading"><?php lang()->p( 'SCSS Variables' ); ?></h3>

<p><?php lang()->p( '' ); ?></p>

<pre lang="css">
// Media queries.
$break_tablet : 960px !default;
$break_phone  : 640px !default;
$break_small  : 480px !default;
$break-min-xs: 0;
$break-min-sm: 576px;
$break-min_md: 768px;
$break-min_lg: 992px;
$break-min-xl: 1200px;
$break-max-sm: 575.98px;
$break-max_md: 767.98px;
$break-max_lg: 991.98px;
$break-max-xl: 1199.98px;

// General colors.
$white       : #ffffff !default;
$off_white   : #e8e8e8 !default;
$black       : #000000 !default;
$near_black  : #1e1e1e !default;
$dark_gray   : #333333 !default;
$medium_gray : #555555 !default;
$light_gray  : #888888 !default;
$pale_gray   : #cccccc !default;
$red         : #dd0000 !default;
$orange      : #ee6600 !default;
$yellow      : #ffdd00 !default;
$green       : #00aa00 !default;
$blue        : #0044aa !default;
$violet      : #551188 !default;
$error       : $red !default;
$danger      : $red !default;
$notify      : $orange !default;
$warning     : $yellow !default;
$success     : $green !default;

// Color types.
$body_color: $white !default;
$text_color: $dark_gray !default;

// Font stacks.
$fonts_sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';

$fonts_serif: NonBreakingSpaceOverride, 'Hoefler Text', 'Baskerville Old Face', Garamond, Times, 'Times New Roman', serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';

$fonts_monospace: 'Source Code Pro', 'Roboto Mono', 'Fira Code', 'Liberation Mono', Inconsolata, Menlo, Monaco, Consolas, 'Cascadia Mono', 'Segoe UI Mono', 'Oxygen Mono', 'Ubuntu Monospace', 'Fira Mono', 'Droid Sans Mono', 'Courier New', Courier, ui-monospace, monospace, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
</pre>

<pre lang="css">
// Scheme colors.
$color_body:  $white;
$color_text:  $dark_gray;
$color_one:   #0044aa;
$color_two:   #0066cc;
$color_three: $medium_gray;
$color_four:  $light_gray;
$color_five:  $dark_gray;
$color_six:   $medium_gray;

$color_body_dark:  $near_black;
$color_text_dark:  $off_white;
$color_one_dark:   $white;
$color_two_dark:   $yellow;
$color_three_dark: $dark_gray;
$color_four_dark:  $medium_gray;
$color_five_dark:  $dark_gray;
$color_six_dark:   $medium_gray;
</pre>

<h3 class="form-heading"><?php lang()->p( 'CSS Variables' ); ?></h3>

<p><?php lang()->p( 'The <code>--cfe-</code> prefix refers to the Configure 8 theme.
' ); ?></p>

<p><?php lang()->p( '' ); ?></p>

<pre lang="css">
:root {

	// Color schemes.
	--cfe-scheme-color--body:  #{$color_body};
	--cfe-scheme-color--text:  #{$color_text};
	--cfe-scheme-color--one:   #{$color_one};
	--cfe-scheme-color--two:   #{$color_two};
	--cfe-scheme-color--three: #{$color_three};
	--cfe-scheme-color--four:  #{$color_four};
	--cfe-scheme-color--five:  #{$color_five};
	--cfe-scheme-color--six:   #{$color_six};

	--cfe-scheme-color--body--dark:  #{$color_body_dark};
	--cfe-scheme-color--text--dark:  #{$color_text_dark};
	--cfe-scheme-color--one--dark:   #{$color_one_dark};
	--cfe-scheme-color--two--dark:   #{$color_two_dark};
	--cfe-scheme-color--three--dark: #{$color_three_dark};
	--cfe-scheme-color--four--dark:  #{$color_four_dark};
	--cfe-scheme-color--five--dark:  #{$color_five_dark};
	--cfe-scheme-color--six--dark:   #{$color_six_dark};

	// Font stacks.
	--cfe-fonts--sans-stack: #{$fonts_sans};
	--cfe-fonts--serif-stack: #{$fonts_serif};
	--cfe-fonts--monospace-stack: #{$fonts_monospace};
	--cfe-fonts--display-stack: #{$fonts_sans};

	// Layout general.
	--cfe-spacing--horz: 2rem;
	--cfe-spacing--vert: 2rem;
	--cfe-wrapper--general--max-width: 1280px;
	--cfe-wrapper--general--margin: 0 auto;
	--cfe-wrapper--general--padding: 0;

	// Layout elements.
	--cfe-box--border-style: solid;
	--cfe-box--border-width: 1px;
	--cfe-box--border-color: #{rgba( $color: $color_text, $alpha: 0.5 )};
	--cfe-box--border-color--dark: #{rgba( $color: $color_text_dark, $alpha: 0.5 )};
	--cfe-box--border: var( --cfe-box--border-style ) var( --cfe-box--border-width ) var( --cfe-box--border-color );
	--cfe-box--border--dark: var( --cfe-box--border-style ) var( --cfe-box--border-width ) var( --cfe-box--border-color--dark );

	// Body & general text.
	--cfe-body--font-family: var( --cfe-fonts--sans-stack );
	--cfe-body--font-size: 1rem;
	--cfe-body--line-height: 1.5;
	--cfe-body--bg-color: var( --cfe-scheme-color--body );
	--cfe-body--bg-color--dark: var( --cfe-scheme-color--body--dark );
	--cfe-body--text-color: var( --cfe-scheme-color--text );
	--cfe-body--text-color--dark: var( --cfe-scheme-color--text--dark );
	--cfe-text-shadow: 0.05em 0.05em 0.05em #{rgba( $color: black, $alpha: 0.625 )};

	// Links.
	--cfe-link--text-decoration: underline;
	--cfe-link--text-underline-offset: 0.325em;
	--cfe-link--text-color: var( --cfe-scheme-color--one );
	--cfe-link--text-color--dark: var( --cfe-scheme-color--one--dark );
	--cfe-link--action--text-color: var( --cfe-scheme-color--two );
	--cfe-link--action--text-color--dark: var( --cfe-scheme-color--two--dark );

	// Headings.
	--cfe-heading-primary--font-size: 2rem;
	--cfe-heading-primary--font-weight: 700;
	--cfe-heading-secondary--font-size: 1.375rem;
	--cfe-heading-secondary--font-weight: 700;

	// Forms & buttons.
	--cfe-form--border-style: solid;
	--cfe-form--border-width: 1px;
	--cfe-form--border-color: var( --cfe-box--border-color );
	--cfe-form--border-color--dark: var( --cfe-box--border-color--dark );
	--cfe-form--action--border-color: var( --cfe-scheme-color--three );
	--cfe-form--action--border-color--dark: var( --cfe-scheme-color--three--dark );
	--cfe-fieldset--margin: 1em 0 0;
	--cfe-fieldset--padding: 1em 1.5em;
	--cfe-fieldset--border: var( --cfe-form--border-style ) var( --cfe-form--border-width ) var( --cfe-form--border-color );
	--cfe-legend--padding: 0 0.5em;
	--cfe-legend-font-size: 1em;
	--cfe-legend-font-weight: 700;

	--cfe-form-element--padding-x: 1em;
	--cfe-form-element--padding-y: 0.5em;
	--cfe-form-element--padding: var( --cfe-form-element--padding-y ) var( --cfe-form-element--padding-x );
	--cfe-form-element--border-style: solid;
	--cfe-form-element--border-width: 1px;
	--cfe-form-element--border-color: var( --cfe-box--border-color );
	--cfe-form-element--border-color--dark: var( --cfe-box--border-color--dark );
	--cfe-form-element--action--border-color: var( --cfe-scheme-color--two );
	--cfe-form-element--action--border-color--dark: var( --cfe-scheme-color--two--dark );
	--cfe-form-element--border: var( --cfe-form-element--border-style ) var( --cfe-form-element--border-width ) var( --cfe-form-element--border-color );
	--cfe-form-element--border--dark: var( --cfe-form-element--border-style ) var( --cfe-form-element--border-width ) var( --cfe-form-element--border-color--dark );
	--cfe-form-element--font-size: var( --cfe-body--font-size );
	--cfe-form-element--font-weight: 400;
	--cfe-form--placeholder-color: #{$light_gray};
	--cfe-form--placeholder-color--dark: #{$light_gray};
	--cfe-label-field--margin: 0;

	--cfe-textarea--min-height: 200px;
	--cfe-textarea--margin: 1em 0 0;
	--cfe-textarea--padding: 1em;
	--cfe-select--margin: 1em 0 0;
	--cfe-select--padding: 0.5em 1em;

	--cfe-button--padding: 0.75rem 1rem;
	--cfe-button--bg-color: var( --cfe-scheme-color--three );
	--cfe-button--bg-color--dark: var( --cfe-scheme-color--three--dark );
	--cfe-button--action--bg-color: var( --cfe-scheme-color--four );
	--cfe-button--action--bg-color--dark: var( --cfe-scheme-color--four--dark );
	--cfe-button--border-color: var( --cfe-form-element--border-color );
	--cfe-button--border-color--dark: var( --cfe-form-element--border-color--dark );
	--cfe-button--action--border-color: var( --cfe-form-element--border-color );
	--cfe-button--action--border-color--dark: var( --cfe-form-element--border-color--dark );
	--cfe-button--text-color: #{$white};
	--cfe-button--text-color--dark: #{$white};
	--cfe-button--action--text-color: #{$white};
	--cfe-button--action--text-color--dark: #{$white};
	--cfe-button--svg-icon--width: 1em;
	--cfe-button--svg-icon--height: 1em;

	--cfe-text-muted--text-color: var( --cfe-scheme-color--text );
	--cfe-text-muted--text-color--dark: var( --cfe-scheme-color--text--dark );

	// User toolbar.
	--cfe-toolbar--padding: 0 1rem;
	--cfe-toolbar--height: 2rem;
	--cfe-toolbar--mobile--height: 3rem;
	--cfe-toolbar--font-size: 0.875rem;
	--cfe-toolbar--bg-color: var( --cfe-scheme-color--body--dark );
	--cfe-toolbar--bg-color--dark: var( --cfe-scheme-color--body--dark );
	--cfe-toolbar--text-color: #{$white};
	--cfe-toolbar--text-color--dark: #{$white};
	--cfe-toolbar--link--padding: 0 0.5em;
	--cfe-toolbar--link--mobile--padding: 0 0.75em;
	--cfe-toolbar--link--bg-color: inherit;
	--cfe-toolbar--link--bg-color--dark: inherit;
	--cfe-toolbar--link--text-color: #{$white};
	--cfe-toolbar--link--text-color--dark: #{$white};
	--cfe-toolbar--link--action--bg-color: var( --cfe-scheme-color--five );
	--cfe-toolbar--link--action--bg-color--dark: var( --cfe-scheme-color--five--dark );
	--cfe-toolbar--link--action--text-color: #{$white};
	--cfe-toolbar--link--action--text-color--dark: #{$white};
	--cfe-toolbar--submenu--link--action--bg-color: var( --cfe-scheme-color--six );
	--cfe-toolbar--submenu--link--action--bg-color--dark: var( --cfe-scheme-color--six--dark );
	--cfe-toolbar--submenu--link--text-color: #{$white};
	--cfe-toolbar--submenu--link--text-color--dark: #{$white};

	// Admin menu.
	--cfe-admin-menu--bg-color: var( --cfe-body--bg-color--dark );
	--cfe-admin--menu--link--action--bg-color: var( --cfe-scheme-color--five );
	--cfe-admin--menu--link--action--bg-color--dark: var( --cfe-scheme-color--five--dark );

	// Tabbed content.
	--cfe-tabs--list--gap: 0 0.25rem;
	--cfe-tabs--list--margin: 2rem 0 0 0;
	--cfe-tabs--list--padding: 0 0.5rem;
	--cfe-tabs--list--border-bottom-style: solid;
	--cfe-tabs--list--border-bottom-width: 1px;
	--cfe-tabs--list--border-bottom-color: var( --cfe-box--border-color );
	--cfe-tabs--list--border-bottom-color--dark: var( --cfe-box--border-color--dark );
	--cfe-tabs--list--link--border-style: solid;
	--cfe-tabs--list--link--border-width: 1px;
	--cfe-tabs--list--link--border-color: var( --cfe-box--border-color );
	--cfe-tabs--list--link--border-color--dark: var( --cfe-box--border-color--dark );
	--cfe-tabs--list--link--bg-color: #{rgba( $color: black, $alpha: 8% )};
	--cfe-tabs--list--link--bg-color--dark: #{rgba( $color: white, $alpha: 8% )};

	// User profiles plugin.
	--upro-body--bg-color: var( --cfe-scheme-color--body );
	--upro-body--bg-color--dark: var( --cfe-scheme-color--body--dark );
}
</pre>

<pre lang="css">

</pre>

<pre lang="css">

</pre>
