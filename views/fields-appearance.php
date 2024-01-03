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

// Color schemes.
$colors = color_schemes();

// Font schemes.
$base_fonts = [
	'default' => $L->get( 'System Default' ),
	'sans'    => $L->get( 'Sans Serif' ),
	'serif'   => $L->get( 'Serif' )
];
$more_fonts = [
	'code'   => $L->get( 'Code' ),
	'cosmo'  => $L->get( 'Cosmopolitan' ),
	'modern' => $L->get( 'Modern' ),
	'slab'   => $L->get( 'Slab Serif' )
];
ksort( $more_fonts );
$fonts = array_merge( $base_fonts, $more_fonts );

// Labels for admin theme options.
$css_label = $L->get( 'Theme Styles' );
if ( admin_theme() ) {
	$css_label = $L->get( 'Styles Only' );
}

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Layout Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Layout' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="content_width"><?php $L->p( 'Content Width' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value px-range-value"><span id="content_width_value"><?php echo ( $this->getValue( 'content_width' ) ? $this->getValue( 'content_width' ) : $this->dbFields['content_width'] ); ?></span><span id="content_width_units">px</span></span>
				<input type="range" class="form-control-range" onInput="$('#content_width_value').html($(this).val())" id="content_width" name="content_width" value="<?php echo $this->getValue( 'content_width' ); ?>" min="300" max="2050" step="10" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#content_width_value').text('<?php echo $this->dbFields['content_width']; ?>');$('#content_width').val('<?php echo $this->dbFields['content_width']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'General content width limit in pixels.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="horz_spacing"><?php $L->p( 'Horizontal Space' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="horz_spacing_value"><?php echo ( $this->getValue( 'horz_spacing' ) ? $this->getValue( 'horz_spacing' ) : $this->dbFields['horz_spacing'] ); ?></span><span id="horz_spacing_units">rem</span></span>
				<input type="range" class="form-control-range" onInput="$('#horz_spacing_value').html($(this).val())" id="horz_spacing" name="horz_spacing" value="<?php echo $this->getValue( 'horz_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#horz_spacing_value').text('<?php echo $this->dbFields['horz_spacing']; ?>');$('#horz_spacing').val('<?php echo $this->dbFields['horz_spacing']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'General horizontal spacing between elements and areas.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="vert_spacing"><?php $L->p( 'Vertical Spacing' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="vert_spacing_value"><?php echo ( $this->getValue( 'vert_spacing' ) ? $this->getValue( 'vert_spacing' ) : $this->dbFields['vert_spacing'] ); ?></span><span id="vert_spacing_units">rem</span></span>
				<input type="range" class="form-control-range" onInput="$('#vert_spacing_value').html($(this).val())" id="vert_spacing" name="vert_spacing" value="<?php echo $this->getValue( 'vert_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#vert_spacing_value').text('<?php echo $this->dbFields['vert_spacing']; ?>');$('#vert_spacing').val('<?php echo $this->dbFields['vert_spacing']; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'General vertical spacing between elements and areas.' ); ?></small>
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
			<small class="form-text text-muted"><?php $L->p( 'Each color scheme, except for "Dark", has a dark version for devices with a dark user preference.' ); ?></small>

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
		</div>
	</div>

	<div id="custom_color_scheme_fields" style="display: <?php echo ( $this->getValue( 'color_scheme' ) === 'custom' ? 'block' : 'none' ); ?>;">

		<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Custom Colors' ) ] ); ?>

		<p><?php $L->p( 'Custom colors will override colors for basic elements in the default light and dark color schemes. If you wish to use these colors for further customization then a CSS variable is provided for each color. Simply add your CSS rules with these variables to the custom code fields below.' ); ?></p>

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
							<input id="color_body_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_body']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_text"><?php $L->p( 'Text Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_text" name="color_text" value="<?php echo $this->getValue( 'color_text' ); ?>" />
							<input id="color_text_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_text']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_one"><?php $L->p( 'Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_one" name="color_one" value="<?php echo $this->getValue( 'color_one' ); ?>" />
							<input id="color_one_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_one']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--one</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_two"><?php $L->p( 'Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_two" name="color_two" value="<?php echo $this->getValue( 'color_two' ); ?>" />
							<input id="color_two_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_two']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--two</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_three"><?php $L->p( 'Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_three" name="color_three" value="<?php echo $this->getValue( 'color_three' ); ?>" />
							<input id="color_three_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_three']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--three</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_four"><?php $L->p( 'Color Four' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_four" name="color_four" value="<?php echo $this->getValue( 'color_four' ); ?>" />
							<input id="color_four_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_four']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--four</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_five"><?php $L->p( 'Color Five' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_five" name="color_five" value="<?php echo $this->getValue( 'color_five' ); ?>" />
							<input id="color_five_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_five']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--five</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_six"><?php $L->p( 'Color Six' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_six" name="color_six" value="<?php echo $this->getValue( 'color_six' ); ?>" />
							<input id="color_six_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_six']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--six</code>' ); ?></small></p>
					</div>
				</div>
			</div>

			<div id="dark-colors">

				<p><?php $L->p( 'These colors are used when the user/device prefers a dark color scheme.' ); ?></p>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_body_dark"><?php $L->p( 'Body Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_body_dark" name="color_body_dark" value="<?php echo $this->getValue( 'color_body_dark' ); ?>" />
							<input id="color_body_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_body_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_text_dark"><?php $L->p( 'Text Color' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_text_dark" name="color_text_dark" value="<?php echo $this->getValue( 'color_text_dark' ); ?>" />
							<input id="color_text_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_text_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-bg-color--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_one_dark"><?php $L->p( 'Dark Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_one_dark" name="color_one_dark" value="<?php echo $this->getValue( 'color_one_dark' ); ?>" />
							<input id="color_one_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_one_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--one--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_two_dark"><?php $L->p( 'Dark Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_two_dark" name="color_two_dark" value="<?php echo $this->getValue( 'color_two_dark' ); ?>" />
							<input id="color_two_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_two_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--two--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_three_dark"><?php $L->p( 'Dark Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_three_dark" name="color_three_dark" value="<?php echo $this->getValue( 'color_three_dark' ); ?>" />
							<input id="color_three_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_three_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--three--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_four_dark"><?php $L->p( 'Dark Color Four' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_four_dark" name="color_four_dark" value="<?php echo $this->getValue( 'color_four_dark' ); ?>" />
							<input id="color_four_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_four_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--four--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_five_dark"><?php $L->p( 'Dark Color Five' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_five_dark" name="color_five_dark" value="<?php echo $this->getValue( 'color_five_dark' ); ?>" />
							<input id="color_five_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_five_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--five--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_six_dark"><?php $L->p( 'Dark Color Six' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_six_dark" name="color_six_dark" value="<?php echo $this->getValue( 'color_six_dark' ); ?>" />
							<input id="color_six_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $this->dbFields['color_six_dark']; ?>" />
							<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_dark_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-scheme-color--six--dark</code>' ); ?></small></p>
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
				<?php foreach ( $fonts as $option => $name ) {
					printf(
						'<option value="%s" %s>%s</option>',
						$option,
						( $this->getValue( 'font_scheme' ) === $option ? 'selected' : '' ),
						$name
					);
				} ?>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Each font scheme, except for "System Default", uses variable-weight fonts.' ); ?></small>
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
			<small class="form-text text-muted"><span style="color: #d00; font-weight: bold;"><?php $L->p( 'Note:' ); ?></span> <?php $L->p( 'This option edits the site database. In testing this option has always worked as intended but for the odd chance that something goes wrong when saving this form, you may want to first copy the site database before changing this setting. Find the database where your Bludit installation is in <code>bl-content/databases/site.php</code>' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Custom Code' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Custom' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="custom_css"><?php $L->p( 'Frontend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text text-muted"><?php $L->p( 'This will be printed in the public &lt;head&gt; element, after enqueued stylesheets.' ); ?></small></p>
			<textarea id="custom_css" name="custom_css" placeholder="<?php $L->p( 'CSS code only' ); ?>" cols="1" rows="10"><?php echo $this->getValue( 'custom_css' ) ?></textarea>
		</div>
	</div>

	<?php if ( $this->admin_theme() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="admin_css"><?php $L->p( 'Backend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text text-muted"><?php $L->p( 'This will be printed in the admin &lt;head&gt; element, after enqueued stylesheets.' ); ?></small></p>
			<textarea id="admin_css" name="admin_css" placeholder="<?php $L->p( 'CSS code only' ); ?>" cols="1" rows="10"><?php echo $this->getValue( 'admin_css' ) ?></textarea>
		</div>
	</div>
	<?php endif; ?>
</fieldset>

<script>
jQuery(document).ready( function($) {
	$( '#color_scheme' ).on( 'change', function() {
		var show = $(this).val();

		<?php foreach ( $colors as $color => $option ) : ?>
		if ( show == '<?php echo $option['slug']; ?>' ) {
			$( '#light_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'block' );
			$( '#dark_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'block' );
			$( '#light_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'flex' );
			$( '#dark_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'flex' );
		} else {
			$( '#light_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});
});
</script>
