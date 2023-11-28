/**
 * Plugin form fields
 *
 * @package    Configure 8 Options
 * @subpackage Assets
 * @category   Scripts
 * @since      1.0.0
 */

jQuery(document).ready( function($) {

	// Page loader options.
	$( '#page_loader' ).on( 'change', function() {
    	var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#loader_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#loader_options' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#loader_options" ).fadeOut( 250 );
		}
    });

	// Loader background.
	$( '#loader_bg_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		showAlpha       : false,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#loader_bg_color' ).show();

	$( '#loader_bg_color_default' ).click( function() {
		$( '#loader_bg_color' ).spectrum( 'set', $( '#loader_bg_default' ).val() );
	});

	// Loader text.
	$( '#loader_text_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		showAlpha       : false,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#loader_text_color' ).show();

	$( '#loader_text_color_default' ).click( function() {
		$( '#loader_text_color' ).spectrum( 'set', $( '#loader_text_default' ).val() );
	});

	// Modal window background.
	$( '#modal_bg_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "rgb",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#modal_bg_color' ).show();

	$( '#modal_bg_color_default' ).click( function() {
		$( '#modal_bg_color' ).spectrum( 'set', $( '#modal_bg_default' ).val() );
	});

	// Cover image background.
	$( '#cover_overlay' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "rgb",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#cover_overlay' ).show();

	$( '#cover_overlay_default' ).click( function() {
		$( '#cover_overlay' ).spectrum( 'set', $( '#cover_bg_default' ).val() );
	});

	// Cover image text.
	$( '#cover_text_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "rgb",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#cover_text_color' ).show();

	$( '#cover_text_color_default' ).click( function() {
		$( '#cover_text_color' ).spectrum( 'set', $( '#cover_text_default' ).val() );
	});

	// Related posts options.
	$( '#related_posts' ).on( 'change', function() {
    	var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#related_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#related_options' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#related_options" ).fadeOut( 250 );
		}
    });

	// Sidebar options.
	$( '#sidebar_social' ).on( 'change', function() {
		var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#sb_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#sb_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#sb_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	// Sidebar options.
	$( '#footer_social' ).on( 'change', function() {
		var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#ftr_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#ftr_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#ftr_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	// Copyright options.
	$( '#copyright' ).on( 'change', function() {
		var showLoader = $(this).val();
		if ( showLoader == 'true' ) {
			$( "#copyright_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#copy_date' ).offset().top
			}, 1000 );
		} else if ( showLoader == 'false' ) {
			$( "#copyright_options" ).fadeOut( 250 );
		}
	});
});
