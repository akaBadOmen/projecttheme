<?php

/**
 * Enqueue the theme's directly editable CSS and JavaScript files.
 */
function projecttheme_enqueue_assets() {
	$theme_path = get_template_directory();
	$theme_uri  = get_template_directory_uri();

	$bootstrap_css = $theme_path . '/assets/css/bootstrap.min.css';
	$bootstrap_js  = $theme_path . '/assets/js/bootstrap.bundle.min.js';
	$theme_css     = $theme_path . '/assets/css/theme.css';
	$theme_js      = $theme_path . '/assets/js/main.js';
	$theme_styles  = glob( $theme_path . '/assets/css/*.css' );
	$theme_version = $theme_css && file_exists( $theme_css ) ? filemtime( $theme_css ) : null;

	if ( $theme_styles ) {
		$theme_version = max( array_map( 'filemtime', $theme_styles ) );
	}

	wp_enqueue_style(
		'projecttheme-bootstrap-style',
		$theme_uri . '/assets/css/bootstrap.min.css',
		array(),
		file_exists( $bootstrap_css ) ? filemtime( $bootstrap_css ) : null
	);

	/*
	 * Performance: Statt theme.css (die alle Dateien per @import nacheinander lädt)
	 * werden die Teil-Dateien direkt eingebunden. So lädt der Browser sie parallel
	 * statt in einer Kette – Reihenfolge bleibt gleich wie in theme.css.
	 */
	$theme_parts = array( 'constants', 'base', 'typography', 'header', 'menu', 'footer', 'forms', 'components', 'pages' );
	$previous    = 'projecttheme-bootstrap-style';
	foreach ( $theme_parts as $part ) {
		$file = $theme_path . '/assets/css/' . $part . '.css';
		if ( ! file_exists( $file ) ) {
			continue;
		}
		wp_enqueue_style(
			'projecttheme-' . $part,
			$theme_uri . '/assets/css/' . $part . '.css',
			array( $previous ),
			filemtime( $file )
		);
		$previous = 'projecttheme-' . $part;
	}

	wp_enqueue_script(
		'projecttheme-bootstrap-script',
		$theme_uri . '/assets/js/bootstrap.bundle.min.js',
		array(),
		file_exists( $bootstrap_js ) ? filemtime( $bootstrap_js ) : null,
		true
	);

	wp_register_script(
		'projecttheme-main',
		$theme_uri . '/assets/js/main.js',
		array( 'projecttheme-bootstrap-script' ),
		file_exists( $theme_js ) ? filemtime( $theme_js ) : null,
		true
	);

	wp_localize_script(
		'projecttheme-main',
		'siteVars',
		array(
			// 'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);

	wp_enqueue_script( 'projecttheme-main' );
}
add_action( 'wp_enqueue_scripts', 'projecttheme_enqueue_assets', 10 );

function projecttheme_main_script_as_module( $tag, $handle, $src ) {
	if ( 'projecttheme-main' !== $handle ) {
		return $tag;
	}

	return '<script type="module" src="' . esc_url( $src ) . '"></script>';
}
add_filter( 'script_loader_tag', 'projecttheme_main_script_as_module', 10, 3 );

function cleaning_wordpress() {
	// removing all WP css files enqueued by default
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'cleaning_wordpress', 100 );


/**
 * Performance: die zwei wichtigsten Schriften früh vorladen (Überschrift + Fließtext),
 * damit der Text nicht erst nach dem CSS geladen wird.
 */
function projecttheme_preload_fonts() {
	$fonts = array( 'cormorant-garamond-v21-latin-700.woff2', 'inter-v20-latin-regular.woff2' );
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_template_directory_uri() . '/assets/css/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'projecttheme_preload_fonts', 1 );
