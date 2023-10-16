<?php
/**
 * Appearance options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Appearance Options' ) ] );

// Color schemes.
$base_colors = [
	'default' => 'Default',
	'dark'    => 'Dark'
];
$more_colors = [
	'apricot' => 'Apricot',
	'bronze'  => 'Bronze',
	'flat'    => 'Flat UI',
	'ocean'   => 'Ocean',
	'rose'    => 'Rose'
];
ksort( $more_colors );
$colors = array_merge( $base_colors, $more_colors );

// Font schemes.
$base_fonts = [
	'default' => 'System Default',
	'sans'    => 'Sans Serif',
	'serif'   => 'Serif'
];
$more_fonts = [
	'code'   => 'Code',
	'cosmo'  => 'Cosmopolitan',
	'modern' => 'Modern',
	'slab'   => 'Slab Serif'
];
ksort( $more_fonts );
$fonts = array_merge( $base_fonts, $more_fonts );

?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Appearance' ); ?></legend>

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
</fieldset>
