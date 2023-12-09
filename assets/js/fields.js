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
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#loader_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#loader_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
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

	$( '#cover_overlay_default_button' ).click( function() {
		$( '#cover_overlay' ).spectrum( 'set', $( '#cover_overlay_default' ).val() );
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
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#related_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#related_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#related_options" ).fadeOut( 250 );
		}
    });

	// Error template.
	$( '#error_widgets' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show != 'content' ) {
			$( "#error_widget_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_widget_options' ).offset().top
			}, 1000 );
		} else if ( show == 'content' ) {
			$( "#error_widget_options" ).fadeOut( 250 );
		}
    });

	$( '#error_search' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_search_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_search_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_search_options" ).fadeOut( 250 );
		}
    });

	$( '#error_search_btn' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_search_btn_text_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_search_btn_text_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_search_btn_text_wrap" ).fadeOut( 250 );
		}
    });

	$( '#error_static' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_static_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_static_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_static_options" ).fadeOut( 250 );
		}
    });

	$( '#error_cats' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_cats_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_cats_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_cats_options" ).fadeOut( 250 );
		}
    });

	$( '#error_tags' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_tags_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_tags_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_tags_options" ).fadeOut( 250 );
		}
    });

	// Sidebar options.
	$( '#sidebar_social' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#sb_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#sb_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#sb_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	// Sidebar options.
	$( '#footer_social' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#ftr_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#ftr_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#ftr_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	// Copyright options.
	$( '#copyright' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#copyright_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#copy_date' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#copyright_options" ).fadeOut( 250 );
		}
	});

	// Appearance options.
	$( '#body_bg_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#body_bg_color' ).show();

	$( '#body_bg_color_default_button' ).click( function() {
		$( '#body_bg_color' ).spectrum( 'set', $( '#body_bg_color_default' ).val() );
	});

	// Custom colors.
	$( '#color_scheme' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'custom' ) {
			$( "#custom_color_scheme_fields" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#color_scheme' ).offset().top
			}, 1000 );
		} else if ( show != 'custom' ) {
			$( "#custom_color_scheme_fields" ).fadeOut( 250 );
		}
	});

	$( '.custom-color' ).spectrum({
		type            : "component",
		showAlpha       : false,
		showPalette     : true,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '.custom-color' ).show();

	$( '#color_one_default_button' ).click( function() {
		$( '#color_one' ).spectrum( 'set', $( '#color_one_default' ).val() );
	});
	$( '#color_two_default_button' ).click( function() {
		$( '#color_two' ).spectrum( 'set', $( '#color_two_default' ).val() );
	});
	$( '#color_three_default_button' ).click( function() {
		$( '#color_three' ).spectrum( 'set', $( '#color_three_default' ).val() );
	});

	$( '#dark_color_one_default_button' ).click( function() {
		$( '#dark_color_one' ).spectrum( 'set', $( '#dark_color_one_default' ).val() );
	});
	$( '#dark_color_two_default_button' ).click( function() {
		$( '#dark_color_two' ).spectrum( 'set', $( '#dark_color_two_default' ).val() );
	});
	$( '#dark_color_three_default_button' ).click( function() {
		$( '#dark_color_three' ).spectrum( 'set', $( '#dark_color_three_default' ).val() );
	});
});
