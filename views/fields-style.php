<?php
/**
 * Appearance options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	admin_theme
};
use function CFE_Colors\{
	color_schemes,
	hex_to_rgb
};
use function CFE_Fonts\{
	font_schemes,
	current_font_scheme
};

// Color schemes.
$colors = color_schemes();
$custom_from = $this->custom_scheme_from();

// Font schemes.
$fonts = font_schemes();
$current_fonts = current_font_scheme();

// Labels for admin theme options.
$css_label = $L->get( 'Theme Styles' );
if ( admin_theme() ) {
	$css_label = $L->get( 'Styles Only' );
}

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Layout Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Layout' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="content_width"><?php $L->p( 'Content Width' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value px-range-value"><span id="content_width_value"><?php echo ( $this->getValue( 'content_width' ) ? $this->getValue( 'content_width' ) : $this->dbFields['content_width'] ); ?></span><span id="content_width_units">px</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#content_width_value').html($(this).val())" id="content_width" name="content_width" value="<?php echo $this->getValue( 'content_width' ); ?>" min="300" max="2050" step="10" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#content_width_value').text('<?php echo $this->dbFields['content_width']; ?>');$('#content_width').val('<?php echo $this->dbFields['content_width']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'Sets a maximum width on the wrapper around the page content and the sidebar. Viewport breakpoints apply. ' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="horz_spacing"><?php $L->p( 'Horizontal Space' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="horz_spacing_value"><?php echo ( $this->getValue( 'horz_spacing' ) ? $this->getValue( 'horz_spacing' ) : $this->dbFields['horz_spacing'] ); ?></span><span id="horz_spacing_units">rem</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#horz_spacing_value').html($(this).val())" id="horz_spacing" name="horz_spacing" value="<?php echo $this->getValue( 'horz_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#horz_spacing_value').text('<?php echo $this->dbFields['horz_spacing']; ?>');$('#horz_spacing').val('<?php echo $this->dbFields['horz_spacing']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'General horizontal spacing between elements and areas. A fraction of this setting may be used where the full amount would not be appealing.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="vert_spacing"><?php $L->p( 'Vertical Spacing' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="vert_spacing_value"><?php echo ( $this->getValue( 'vert_spacing' ) ? $this->getValue( 'vert_spacing' ) : $this->dbFields['vert_spacing'] ); ?></span><span id="vert_spacing_units">rem</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#vert_spacing_value').html($(this).val())" id="vert_spacing" name="vert_spacing" value="<?php echo $this->getValue( 'vert_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#vert_spacing_value').text('<?php echo $this->dbFields['vert_spacing']; ?>');$('#vert_spacing').val('<?php echo $this->dbFields['vert_spacing']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php $L->p( 'General vertical spacing between elements and areas. A fraction of this setting may be used where the full amount would not be appealing.' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Appearance Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Appearance' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="color_scheme"><?php $L->p( 'Color Scheme' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="color_scheme" name="color_scheme">
				<?php

				// Sort schemes alphabetically then by category.
				asort( $colors );
				usort( $colors, function( $one_thing, $another ) {
					return strcmp( $one_thing['category'], $another['category'] );
				} );

				// Category used for option groups.
				$category = '';

				// Exclude some schemes from loop.
				$exclude = [ 'default', 'dark', 'custom' ];

				// Basic schemes.
				printf(
					'<optgroup label="%s"><option value="default" %s>%s</option><option value="dark" %s>%s</option></optgroup>',
					$L->get( 'Basic' ),
					( $this->getValue( 'color_scheme' ) === 'default' ? 'selected' : '' ),
					$L->get( 'Default' ),
					( $this->getValue( 'color_scheme' ) === 'dark' ? 'selected' : '' ),
					$L->get( 'Dark' )
				);

				foreach ( $colors as $color => $option ) {

					if ( $category != $option['category'] && 'basic' != $option['category'] ) {
						if ( $category != '' ) {
							echo '</optgroup>';
						}
						printf(
							'<optgroup label="%s">',
							ucwords( $option['category'] )
						);
					}
					if ( ! in_array( $option['slug'], $exclude ) ) {
						printf(
							'<option value="%s" %s>%s</option>',
							$option['slug'],
							( $this->getValue( 'color_scheme' ) === $option['slug'] ? 'selected' : '' ),
							$option['name']
						);
					}
					$category = $option['category'];
				}
				if ( $category != '' ) {
					echo '</optgroup>';
				}

				printf(
					'<optgroup label="%s"><option value="custom" %s>%s</option></optgroup>',
					$L->get( 'Build Your Own' ),
					( $this->getValue( 'color_scheme' ) === 'custom' ? 'selected' : '' ),
					$L->get( 'Custom' )
				); ?>
			</select>
			<input type="hidden" id="custom_scheme_from" name="custom_scheme_from" value="<?php echo $this->custom_scheme_from(); ?>" />
			<small class="form-text"><?php $L->p( 'Each color scheme, except for "Dark", has a dark version for devices with a dark user preference.' ); ?></small>

			<ul id="form-color-thumbs-list">
			<?php foreach ( $colors as $color => $option ) {
				printf(
					'<p id="light_scheme_label_%s" style="display: %s;">%s</p>',
					$option['slug'],
					( $this->getValue( 'color_scheme' ) === $option['slug'] ? 'flex' : 'none' ),
					$L->get( 'Light mode colors:' )
				);
				printf(
					'<ul id="light_scheme_thumbs_%s" style="display: %s;">',
					$option['slug'],
					( $this->getValue( 'color_scheme' ) === $option['slug'] ? 'flex' : 'none' )
				);
				$count = 0;
				foreach ( $option['light'] as $thumb ) {
					$count++;
					if ( ! empty( $thumb ) ) {
						printf(
							'<li id="%s_thumb_%s" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
							$option['slug'],
							$count,
							$thumb,
							$thumb,
							$thumb
						);
					}
				}
				echo '</ul>';

				printf(
					'<p id="dark_scheme_label_%s" style="display: %s;">%s</p>',
					$option['slug'],
					( $this->getValue( 'color_scheme' ) === $option['slug'] ? 'flex' : 'none' ),
					$L->get( 'Dark mode colors:' )
				);
				printf(
					'<ul id="dark_scheme_thumbs_%s" style="display: %s;">',
					$option['slug'],
					( $this->getValue( 'color_scheme' ) === $option['slug'] ? 'flex' : 'none' )
				);
				$count = 0;
				foreach ( $option['dark'] as $thumb ) {
					$count++;
					if ( ! empty( $thumb ) ) {
						printf(
							'<li id="%s_thumb_%s_dark" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
							$option['slug'],
							$count,
							$thumb,
							$thumb,
							$thumb
						);
					}
				}
				echo '</ul>';
			} ?>
			</ul>
			<p class="m-0"><?php $L->p( "Go to the <a href='{$colors_page}'>color scheme reference</a> page." ); ?></p>
		</div>
	</div>

	<?php
	// Redefine `$colors` variable after sorting.
	$colors = color_schemes();

	?>
	<div id="custom_color_scheme_fields" style="display: <?php echo ( $this->getValue( 'color_scheme' ) === 'custom' ? 'block' : 'none' ); ?>;">

		<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Custom Colors' ) ] ); ?>

		<p><?php $L->p( 'Custom colors will override colors for basic elements in the default light and dark color schemes. If you wish to use these colors for further customization then a CSS variable is provided for each color. Simply add your CSS rules with these variables to the custom code fields below.' ); ?></p>

		<p><?php $L->p( "Current custom colors originate from the previously set theme: <strong>{$colors[$custom_from]['name']}</strong>" ); ?></p>

		<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

			<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="light-colors" aria-selected="false" href="#light-colors"><?php $L->p( 'Light' ); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="dark-colors" aria-selected="false" href="#dark-colors"><?php $L->p( 'Dark' ); ?></a>
				</li>
			</ul>

			<div id="light-colors">

				<p><?php $L->p( 'These colors are used with default browser/device settings and when the user/device prefers a light color scheme.' ); ?></p>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_body"><?php $L->p( 'Body Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_body" name="color_body" value="<?php echo $this->getValue( 'color_body' ); ?>" />
							<input id="color_body_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['body']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_text"><?php $L->p( 'Text Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_text" name="color_text" value="<?php echo $this->getValue( 'color_text' ); ?>" />
							<input id="color_text_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['text']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_one"><?php $L->p( 'Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_one" name="color_one" value="<?php echo $this->getValue( 'color_one' ); ?>" />
							<input id="color_one_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['one']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--one</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_two"><?php $L->p( 'Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_two" name="color_two" value="<?php echo $this->getValue( 'color_two' ); ?>" />
							<input id="color_two_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['two']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--two</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_three"><?php $L->p( 'Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_three" name="color_three" value="<?php echo $this->getValue( 'color_three' ); ?>" />
							<input id="color_three_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['three']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--three</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_four"><?php $L->p( 'Color Four' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_four" name="color_four" value="<?php echo $this->getValue( 'color_four' ); ?>" />
							<input id="color_four_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['four']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--four</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_five"><?php $L->p( 'Color Five' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_five" name="color_five" value="<?php echo $this->getValue( 'color_five' ); ?>" />
							<input id="color_five_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['five']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--five</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_six"><?php $L->p( 'Color Six' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_six" name="color_six" value="<?php echo $this->getValue( 'color_six' ); ?>" />
							<input id="color_six_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['six']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--six</code>' ); ?></small></p>
					</div>
				</div>
			</div>

			<div id="dark-colors">

				<p><?php $L->p( 'These colors are used when the user/device prefers a dark color scheme.' ); ?></p>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_body_dark"><?php $L->p( 'Dark Body Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_body_dark" name="color_body_dark" value="<?php echo $this->getValue( 'color_body_dark' ); ?>" />
							<input id="color_body_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['body']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_text_dark"><?php $L->p( 'Dark Text Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_text_dark" name="color_text_dark" value="<?php echo $this->getValue( 'color_text_dark' ); ?>" />
							<input id="color_text_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['text']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_one_dark"><?php $L->p( 'Dark Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_one_dark" name="color_one_dark" value="<?php echo $this->getValue( 'color_one_dark' ); ?>" />
							<input id="color_one_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['one']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--one--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_two_dark"><?php $L->p( 'Dark Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_two_dark" name="color_two_dark" value="<?php echo $this->getValue( 'color_two_dark' ); ?>" />
							<input id="color_two_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['two']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--two--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_three_dark"><?php $L->p( 'Dark Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_three_dark" name="color_three_dark" value="<?php echo $this->getValue( 'color_three_dark' ); ?>" />
							<input id="color_three_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['three']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--three--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_four_dark"><?php $L->p( 'Dark Color Four' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_four_dark" name="color_four_dark" value="<?php echo $this->getValue( 'color_four_dark' ); ?>" />
							<input id="color_four_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['four']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--four--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_five_dark"><?php $L->p( 'Dark Color Five' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_five_dark" name="color_five_dark" value="<?php echo $this->getValue( 'color_five_dark' ); ?>" />
							<input id="color_five_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['five']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--five--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_six_dark"><?php $L->p( 'Dark Color Six' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_six_dark" name="color_six_dark" value="<?php echo $this->getValue( 'color_six_dark' ); ?>" />
							<input id="color_six_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['six']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--six--dark</code>' ); ?></small></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Typography' ) ] ); ?>

	<div class="form-field form-group row">

		<label class="form-label col-sm-2 col-form-label" for="font_scheme"><?php $L->p( 'Font Scheme' ); ?></label>

		<div class="col-sm-10">
			<select class="form-select" id="font_scheme" name="font_scheme">
				<?php foreach ( $fonts as $option => $scheme ) {
					printf(
						'<option value="%s" %s>%s</option>',
						$scheme['slug'],
						( $this->getValue( 'font_scheme' ) === $scheme['slug'] ? 'selected' : '' ),
						ucwords( $scheme['name'] )
					);
				} ?>
			</select>
			<small class="form-text"><?php $L->p( 'Each font scheme, except for "System Default", uses variable-weight fonts.' ); ?></small>

			<ul id="font-preview-list">
			<?php foreach ( $fonts as $option => $scheme ) {

				$preview = $this->phpPath() . "/assets/images/font-preview-{$scheme['slug']}.svg";
				if ( file_exists( $preview ) ) {
					printf(
						'<!-- %s %s --><li id="font-scheme-preview-%s" style="display: %s;">%s</li>' . "\r",
						$L->get( 'Font scheme preview:' ),
						ucwords( $scheme['name'] ),
						$scheme['slug'],
						( $this->getValue( 'font_scheme' ) === $scheme['slug'] ? 'block' : 'none' ),
						file_get_contents( $preview )
					);
				}
			} ?>
			</ul>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_text"><?php $L->p( 'General Text' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php $L->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">

				<span class="form-range-value rem-range-value"><span id="wght_text_value"><?php echo ( $this->getValue( 'wght_text' ) ? $this->getValue( 'wght_text' ) : $this->dbFields['wght_text'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_text_value').html($(this).val())" id="wght_text" name="wght_text" value="<?php echo $this->getValue( 'wght_text' ); ?>" min="<?php echo $current_fonts['text']['min']; ?>" max="<?php echo $current_fonts['text']['max']; ?>" step="<?php echo $current_fonts['text']['step']; ?>" />

				<input type="hidden" id="wght_text_default"  name="wght_text_default" value="<?php echo $current_fonts['text']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_text_value').text($('#wght_text_default').val() );$('#wght_text').val($('#wght_text_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small id="wght_text_desc" class="form-text">
				<?php if ( ! $current_fonts['text']['var'] ) {
					$L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php $L->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_text_value"><?php echo ( $this->getValue( 'space_text' ) ? $this->getValue( 'space_text' ) : $current_fonts['text']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_text_value').html($(this).val())" id="space_text" name="space_text" value="<?php echo $this->getValue( 'space_text' ); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_text_default"  name="space_text_default" value="<?php echo $current_fonts['text']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_text_value').text($('#space_text_default').val() );$('#space_text').val($('#space_text_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_primary"><?php $L->p( 'Primary Headings' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php $L->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="wght_primary_value"><?php echo ( $this->getValue( 'wght_primary' ) ? $this->getValue( 'wght_primary' ) : $this->dbFields['wght_primary'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_primary_value').html($(this).val())" id="wght_primary" name="wght_primary" value="<?php echo $this->getValue( 'wght_primary' ); ?>" min="<?php echo $current_fonts['primary']['min']; ?>" max="<?php echo $current_fonts['primary']['max']; ?>" step="<?php echo $current_fonts['primary']['step']; ?>" />

				<input type="hidden" id="wght_primary_default"  name="wght_primary_default" value="<?php echo $current_fonts['primary']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_primary_value').text($('#wght_primary_default').val() );$('#wght_primary').val($('#wght_primary_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small id="wght_primary_desc" class="form-text">
				<?php if ( ! $current_fonts['primary']['var'] ) {
					$L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php $L->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_primary_value"><?php echo ( $this->getValue( 'space_primary' ) ? $this->getValue( 'space_primary' ) : $current_fonts['primary']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_primary_value').html($(this).val())" id="space_primary" name="space_primary" value="<?php echo $this->getValue( 'space_primary' ); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_primary_default"  name="space_primary_default" value="<?php echo $current_fonts['primary']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_primary_value').text($('#space_primary_default').val() );$('#space_primary').val($('#space_primary_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_secondary"><?php $L->p( 'Secondary Headings' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php $L->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="wght_secondary_value"><?php echo ( $this->getValue( 'wght_secondary' ) ? $this->getValue( 'wght_secondary' ) : $this->dbFields['wght_secondary'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_secondary_value').html($(this).val())" id="wght_secondary" name="wght_secondary" value="<?php echo $this->getValue( 'wght_secondary' ); ?>" min="<?php echo $current_fonts['secondary']['min']; ?>" max="<?php echo $current_fonts['secondary']['max']; ?>" step="<?php echo $current_fonts['secondary']['step']; ?>" />

				<input type="hidden" id="wght_secondary_default"  name="wght_secondary_default" value="<?php echo $current_fonts['secondary']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_secondary_value').text($('#wght_secondary_default').val() );$('#wght_secondary').val($('#wght_secondary_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small id="wght_secondary_desc" class="form-text">
				<?php if ( ! $current_fonts['secondary']['var'] ) {
					$L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php $L->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_secondary_value"><?php echo ( $this->getValue( 'space_secondary' ) ? $this->getValue( 'space_secondary' ) : $current_fonts['secondary']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_secondary_value').html($(this).val())" id="space_secondary" name="space_secondary" value="<?php echo $this->getValue( 'space_secondary' ); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_secondary_default"  name="space_secondary_default" value="<?php echo $current_fonts['secondary']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_secondary_value').text($('#space_secondary_default').val() );$('#space_secondary').val($('#space_secondary_default').val());"><?php $L->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Admin Theme' ) ] ); ?>

	<div class="form-field form-group row">

		<label class="form-label col-sm-2 col-form-label" for="admin_theme"><?php $L->p( 'Admin Theme' ); ?></label>

		<div class="col-sm-10">
			<select class="form-select" id="admin_theme" name="admin_theme">

				<?php if ( admin_theme() ) : ?>
				<option value="theme" <?php echo ( $this->admin_theme() === 'theme' ? 'selected' : '' ); ?>><?php $L->p( 'Full Theme' ); ?></option>
				<?php endif; ?>

				<option value="css" <?php echo ( $this->admin_theme() === 'css' ? 'selected' : '' ); ?>><?php echo $css_label; ?></option>

				<option value="default" <?php echo ( $this->admin_theme() === 'default' ? 'selected' : '' ); ?>><?php $L->p( 'Default Theme' ); ?></option>
			</select>
			<?php if ( ! admin_theme() ) {
				printf(
					'<small class="form-text">%s<br /><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></small>',
					$L->get( 'Download the Configure 8 admin theme for added features:' ),
					'https://github.com/Bludiot/configureight-admin',
					'https://github.com/Bludiot/configureight-admin'
				);
			} ?>
			<small class="form-text"><span style="color: #d00; font-weight: bold;"><?php $L->p( 'Note:' ); ?></span> <?php $L->p( 'This option edits the site database. In testing this option has always worked as intended but for the odd chance that something goes wrong when saving this form, you may want to first copy the site database before changing this setting. Find the database where your Bludit installation is in <code>bl-content/databases/site.php</code>' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Custom Code' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Custom' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="custom_css"><?php $L->p( 'Frontend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text"><?php $L->p( 'This will be printed in the public &lt;head&gt; element, after enqueued stylesheets. CSS code only.' ); ?></small></p>
			<textarea id="custom_css" name="custom_css" placeholder=":root {}" cols="1" rows="10"><?php echo $this->getValue( 'custom_css' ) ?></textarea>
		</div>
	</div>

	<?php if ( $this->admin_theme() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="admin_css"><?php $L->p( 'Backend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text"><?php $L->p( 'This will be printed in the admin &lt;head&gt; element, after enqueued stylesheets. CSS code only.' ); ?></small></p>
			<textarea id="admin_css" name="admin_css" placeholder=":root {}" cols="1" rows="10"><?php echo $this->getValue( 'admin_css' ) ?></textarea>
		</div>
	</div>
	<?php endif; ?>
</fieldset>

<script>
jQuery(document).ready( function($) {
	$( '#color_scheme' ).on( 'change', function() {
		var scheme = $(this).val();

		<?php foreach ( $colors as $color => $option ) :

			$slug = $option['slug'];
		?>
		if ( scheme == '<?php echo $slug; ?>' ) {

			if ( 'custom' != scheme ) {
				$( '#custom_scheme_from' ).val( '<?php echo $slug; ?>' );
			}

			// Custom scheme labels and color thumbnails.
			$( '#light_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
			$( '#dark_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
			$( '#light_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );
			$( '#dark_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );

			// Custom scheme light colors.
			$( '#color_body' ).val( '<?php echo $option['light']['body']; ?>' );
			$( '#color_text' ).val( '<?php echo $option['light']['text']; ?>' );
			$( '#color_one' ).val( '<?php echo $option['light']['one']; ?>' );
			$( '#color_two' ).val( '<?php echo $option['light']['two']; ?>' );
			$( '#color_three' ).val( '<?php echo $option['light']['three']; ?>' );
			$( '#color_four' ).val( '<?php echo $option['light']['four']; ?>' );
			$( '#color_five' ).val( '<?php echo $option['light']['five']; ?>' );
			$( '#color_six' ).val( '<?php echo $option['light']['six']; ?>' );

			$( '#loader_bg_color' ).val( '<?php echo $option['light']['body']; ?>' );
			$( '#loader_text_color' ).val( '<?php echo $option['light']['text']; ?>' );

			// Custom scheme dark colors.
			$( '#color_body_dark' ).val( '<?php echo $option['dark']['body']; ?>' );
			$( '#color_text_dark' ).val( '<?php echo $option['dark']['text']; ?>' );
			$( '#color_one_dark' ).val( '<?php echo $option['dark']['one']; ?>' );
			$( '#color_two_dark' ).val( '<?php echo $option['dark']['two']; ?>' );
			$( '#color_three_dark' ).val( '<?php echo $option['dark']['three']; ?>' );
			$( '#color_four_dark' ).val( '<?php echo $option['dark']['four']; ?>' );
			$( '#color_five_dark' ).val( '<?php echo $option['dark']['five']; ?>' );
			$( '#color_six_dark' ).val( '<?php echo $option['dark']['six']; ?>' );

			$( '#loader_bg_color_dark' ).val( '<?php echo $option['dark']['body']; ?>' );
			$( '#loader_text_color_dark' ).val( '<?php echo $option['dark']['text']; ?>' );

			if ( 'default' != scheme ) {
				$( '#cover_blend' ).val( '<?php echo ( isset( $option['cover'] ) ? $option['cover'] : $option['light']['three'] ); ?>' );
			} else {
				$( '#cover_blend' ).val( '<?php echo $this->dbFields['cover_blend']; ?>' );
			}

		} else {

			// Scheme labels and color thumbnails.
			$( '#light_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});

	$( '#font_scheme' ).on( 'change', function() {
		var scheme = $(this).val();

		<?php foreach ( $fonts as $font => $scheme ) : ?>
		if ( scheme == '<?php echo $scheme['slug']; ?>' ) {

			// General text weight.
			$( '#wght_text' ).val( '<?php echo $scheme['text']['weight']; ?>' );
			$( '#wght_text_default' ).val( '<?php echo $scheme['text']['weight']; ?>' );
			$( '#wght_text_value' ).html( '<?php echo $scheme['text']['weight']; ?>' );
			$( '#wght_text' ).attr( 'min', '<?php echo $scheme['text']['min']; ?>' );
			$( '#wght_text' ).attr( 'max', '<?php echo $scheme['text']['max']; ?>' );
			$( '#wght_text' ).attr( 'step', '<?php echo $scheme['text']['step']; ?>' );
			if ( true == '<?php echo $scheme['text']['var']; ?>' ) {
				$( '#wght_text_desc' ).html( '' );
			} else {
				$( '#wght_text_desc' ).html( '<?php $L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// General text letter spacing.
			$( '#space_text' ).val( '<?php echo $scheme['text']['space']; ?>' );
			$( '#space_text_default' ).val( '<?php echo $scheme['text']['space']; ?>' );
			$( '#space_text_value' ).html( '<?php echo $scheme['text']['space']; ?>' );

			// Primary headings weight.
			$( '#wght_primary' ).val( '<?php echo $scheme['primary']['weight']; ?>' );
			$( '#wght_primary_default' ).val( '<?php echo $scheme['primary']['weight']; ?>' );
			$( '#wght_primary_value' ).html( '<?php echo $scheme['primary']['weight']; ?>' );
			$( '#wght_primary' ).attr( 'min', '<?php echo $scheme['primary']['min']; ?>' );
			$( '#wght_primary' ).attr( 'max', '<?php echo $scheme['primary']['max']; ?>' );
			$( '#wght_primary' ).attr( 'step', '<?php echo $scheme['primary']['step']; ?>' );
			if ( true == '<?php echo $scheme['primary']['var']; ?>' ) {
				$( '#wght_primary_desc' ).html( '' );
			} else {
				$( '#wght_primary_desc' ).html( '<?php $L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// Primary headings letter spacing.
			$( '#space_primary' ).val( '<?php echo $scheme['primary']['space']; ?>' );
			$( '#space_primary_default' ).val( '<?php echo $scheme['primary']['space']; ?>' );
			$( '#space_primary_value' ).html( '<?php echo $scheme['primary']['space']; ?>' );

			// Secondary headings weight.
			$( '#wght_secondary' ).val( '<?php echo $scheme['secondary']['weight']; ?>' );
			$( '#wght_secondary_default' ).val( '<?php echo $scheme['secondary']['weight']; ?>' );
			$( '#wght_secondary_value' ).html( '<?php echo $scheme['secondary']['weight']; ?>' );
			$( '#wght_secondary' ).attr( 'min', '<?php echo $scheme['secondary']['min']; ?>' );
			$( '#wght_secondary' ).attr( 'max', '<?php echo $scheme['secondary']['max']; ?>' );
			$( '#wght_secondary' ).attr( 'step', '<?php echo $scheme['secondary']['step']; ?>' );
			if ( true == '<?php echo $scheme['secondary']['var']; ?>' ) {
				$( '#wght_secondary_desc' ).html( '' );
			} else {
				$( '#wght_secondary_desc' ).html( '<?php $L->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// Secondary headings letter spacing.
			$( '#space_secondary' ).val( '<?php echo $scheme['secondary']['space']; ?>' );
			$( '#space_secondary_default' ).val( '<?php echo $scheme['secondary']['space']; ?>' );
			$( '#space_secondary_value' ).html( '<?php echo $scheme['secondary']['space']; ?>' );
		}

		// Scheme preview.
		if ( scheme == '<?php echo $scheme['slug']; ?>' ) {
			$( '#font-scheme-preview-<?php echo $scheme['slug']; ?>' ).css( 'display', 'block' );
		} else {
			$( '#font-scheme-preview-<?php echo $scheme['slug']; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});
});
</script>
