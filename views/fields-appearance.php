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

// Default layout values.
$horz_spacing_default = $this->horz_spacing_default();
$vert_spacing_default = $this->vert_spacing_default();

// Body color value.
$body_bg_color_default = $this->body_bg_color_default();
$body_bg_color   = $body_bg_color_default;
if ( ! empty( $this->getValue( 'body_bg_color' ) ) ) {
	$body_bg_color = $this->getValue( 'body_bg_color' );
}

// Color schemes.
$base_colors = [
	'default' => $L->get( 'Default' ),
	'dark'    => $L->get( 'Dark' )
];
$more_colors = [
	'apricot' => $L->get( 'Apricot' ),
	'bronze'  => $L->get( 'Bronze' ),
	'flat'    => $L->get( 'Flat UI' ),
	'ocean'   => $L->get( 'Ocean' ),
	'rose'    => $L->get( 'Rose' )
];
ksort( $more_colors );
$scheme_colors = array_merge( $base_colors, $more_colors );

$custom_colors = [
	'custom' => $L->get( 'Custom' )
];
$colors = array_merge( $scheme_colors, $custom_colors );

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
		<label class="form-label col-sm-2 col-form-label" for="horz_spacing"><?php $L->p( 'Horizontal Space' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="horz_spacing_value"><?php echo ( $this->getValue( 'horz_spacing' ) ? $this->getValue( 'horz_spacing' ) : $horz_spacing_default ); ?></span><span id="horz_spacing_units">rem</span></span>
				<input type="range" class="form-control-range" onInput="$('#horz_spacing_value').html($(this).val())" id="horz_spacing" name="horz_spacing" value="<?php echo $this->getValue( 'horz_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#horz_spacing_value').text('<?php echo $horz_spacing_default; ?>');$('#horz_spacing').val('<?php echo $horz_spacing_default; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'General horizontal spacing between elements and areas.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="vert_spacing"><?php $L->p( 'Vertical Spacing' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="vert_spacing_value"><?php echo ( $this->getValue( 'vert_spacing' ) ? $this->getValue( 'vert_spacing' ) : $vert_spacing_default ); ?></span><span id="vert_spacing_units">rem</span></span>
				<input type="range" class="form-control-range" onInput="$('#vert_spacing_value').html($(this).val())" id="vert_spacing" name="vert_spacing" value="<?php echo $this->getValue( 'vert_spacing' ); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-sm form-range-button" onClick="$('#vert_spacing_value').text('<?php echo $vert_spacing_default; ?>');$('#vert_spacing').val('<?php echo $vert_spacing_default; ?>');"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted form-range-small"><?php $L->p( 'General vertical spacing between elements and areas.' ); ?></small>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Appearance Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Appearance' ); ?></legend>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_bg_color"><?php $L->p( 'Body Color' ); ?></label>
			<div class="col-sm-10">
				<div class="row color-picker-wrap">
					<input class="color-picker" id="body_bg_color" name="body_bg_color" value="<?php echo $body_bg_color; ?>" />
					<input id="body_bg_color_default" class="screen-reader-text" type="hidden" value="<?php echo $body_bg_color_default; ?>" />
					<span class="btn btn-secondary btn-sm" id="body_bg_color_default_button"><?php $L->p( 'Default' ); ?></span>
				</div>
				<p><small class="form-text text-muted"><?php $L->p( 'This will override color scheme body colors and will not affect dark modes.' ); ?></small></p>
			</div>
		</div>

	<div class="form-field form-group row">

		<label class="form-label col-sm-2 col-form-label" for="color_scheme"><?php $L->p( 'Color Scheme' ); ?></label>

		<div class="col-sm-10">
			<select class="form-select" id="color_scheme" name="color_scheme">
				<?php foreach ( $colors as $option => $name ) {
					printf(
						'<option value="%s" %s>%s</option>',
						$option,
						( $this->getValue( 'color_scheme' ) === $option ? 'selected' : '' ),
						$name
					);
				} ?>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Each color scheme, except for "Dark", has a dark version for devices with a dark user preference.' ); ?></small>
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
					<label class="form-label col-sm-2 col-form-label" for="color_one"><?php $L->p( 'Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_one" name="color_one" value="<?php echo ( $this->getValue( 'color_one' ) ? $this->getValue( 'color_one' ) : '#333333' ); ?>" />
							<input id="color_one_default" class="screen-reader-text" type="hidden" value="#333333" />
							<span class="btn btn-secondary btn-sm" id="color_one_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--one</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_two"><?php $L->p( 'Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_two" name="color_two" value="<?php echo ( $this->getValue( 'color_two' ) ? $this->getValue( 'color_two' ) : '#0044aa' ); ?>" />
							<input id="color_two_default" class="screen-reader-text" type="hidden" value="#0044aa" />
							<span class="btn btn-secondary btn-sm" id="color_two_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--two</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="color_three"><?php $L->p( 'Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="color_three" name="color_three" value="<?php echo ( $this->getValue( 'color_three' ) ? $this->getValue( 'color_three' ) : '#005ce7' ); ?>" />
							<input id="color_three_default" class="screen-reader-text" type="hidden" value="#005ce7" />
							<span class="btn btn-secondary btn-sm" id="color_three_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--three</code>' ); ?></small></p>
					</div>
				</div>
			</div>

			<div id="dark-colors">

				<p><?php $L->p( 'These colors are used when the user/device prefers a dark color scheme.' ); ?></p>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="dark_color_one"><?php $L->p( 'Dark Color One' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="dark_color_one" name="dark_color_one" value="<?php echo ( $this->getValue( 'dark_color_one' ) ? $this->getValue( 'dark_color_one' ) : '#eeeeee' ); ?>" />
							<input id="dark_color_one_default" class="screen-reader-text" type="hidden" value="#eeeeee" />
							<span class="btn btn-secondary btn-sm" id="dark_color_one_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--one--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="dark_color_two"><?php $L->p( 'Dark Color Two' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="dark_color_two" name="dark_color_two" value="<?php echo ( $this->getValue( 'dark_color_two' ) ? $this->getValue( 'dark_color_two' ) : '#555555' ); ?>" />
							<input id="dark_color_two_default" class="screen-reader-text" type="hidden" value="#555555" />
							<span class="btn btn-secondary btn-sm" id="dark_color_two_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--two--dark</code>' ); ?></small></p>
					</div>
				</div>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="dark_color_three"><?php $L->p( 'Dark Color Three' ); ?></label>
					<div class="col-sm-10">
						<div class="row color-picker-wrap">
							<input class="color-picker custom-color" id="dark_color_three" name="dark_color_three" value="<?php echo ( $this->getValue( 'dark_color_three' ) ? $this->getValue( 'dark_color_three' ) : '#888888' ); ?>" />
							<input id="dark_color_three_default" class="screen-reader-text" type="hidden" value="#888888" />
							<span class="btn btn-secondary btn-sm" id="dark_color_three_default_button"><?php $L->p( 'Reset' ); ?></span>
						</div>
						<p><small class="form-text text-muted"><?php $L->p( 'CSS variable: <code class="select">--cfe-color--three--dark</code>' ); ?></small></p>
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
