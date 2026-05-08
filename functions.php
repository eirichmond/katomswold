<?php

function extend_register_enqueue_assets() {

    /***
     * The class simply takes two path parameters as string values,
     * 
     * First one for the Theme's CSS styles directory
     * Second one for the Theme's JS directory
     * There is no need to provide the Theme's absolute directory path,
     * only the individual paths within the Theme's directory are needed
     * for example, '/assets/css/blocks/' or '/assets/css/core-blocks/' or '/assets/css/' etc
     * 
     * As long as there is a file in the theme's directory the CLASS will look after everything else
     * 
     * NOTE: the name of the file should reflect the name of the block and not preceed with the key 'core'
     * for example, for a core heading CSS of JS file, the file name should be 'heading.css' or 'heading.js'
     * do not use 'core-heading.css' or 'core-heading.js'
     * 
     * If you only want to include JS file's simply pass an empty string for the first parameter, and vice versa
     * its a assumed that you'll likely only need to include styles but it's possible to pass empty parameters
     * 
     * example usage
     * new Extend_Block_Assets('/assets/css/blocks/'); // for only style files
     * new Extend_Block_Assets('', '/assets/js/blocks/'); // for only javascript files
     * 
     */
    require_once get_template_directory() . '/extend-block-assets/class-extent-block-assets.php';

    // Instantiate the class with the block assets array
    new Extend_Block_Assets('/assets/css/blocks', '/assets/js/blocks', );

}
add_action( 'init', 'extend_register_enqueue_assets' );

/**
 * Enqueue custom block styles for kate-and-toms namespace blocks
 */
function katomswold_enqueue_custom_block_styles() {
	// Register additional styles for icon-button block (loaded after plugin styles)
	wp_register_style(
		'kate-and-toms-icon-button-theme-style',
		get_template_directory_uri() . '/assets/css/blocks/icon-button.css',
		array('kate-and-toms-icon-button-style'), // Dependency on plugin's base styles
		filemtime( get_template_directory() . '/assets/css/blocks/icon-button.css' )
	);

	wp_enqueue_block_style(
		'kate-and-toms/icon-button',
		array(
			'handle' => 'kate-and-toms-icon-button-theme-style'
		)
	);
}
add_action( 'init', 'katomswold_enqueue_custom_block_styles' );

add_image_size( 'square', 280, 280, true );

/**
 * Add theme support for block templates and template parts
 */
function katomswold_theme_support() {
    add_theme_support( 'block-templates' );
    add_theme_support( 'block-template-parts' );
}
add_action( 'after_setup_theme', 'katomswold_theme_support' );


function katomswold_global_scripts() {
    // Register the script
    wp_enqueue_script(
        'global',                                   // Handle
        get_stylesheet_directory_uri() . '/js/global.js', // Path to your JS file
        array(),                                           // Dependencies
        '1.0',                                             // Version
        true                                               // Load in footer
    );

    wp_enqueue_script(
        'burger-menu',
        get_stylesheet_directory_uri() . '/js/burger-menu.js',
        [],
        null,
        true  // load in footer
    );


    // Enqueue the theme's style.css for global control and mobile overrides use sparingly
    wp_enqueue_style(
        'katomswold-style',
        get_parent_theme_file_uri( 'style.css' ),
        array(),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'katomswold_global_scripts' );

/**
 * Register custom block styles
 * Uses the Custom_Block_Styles class for simplified registration
 */
require_once get_template_directory() . '/custom-block-styles/class-custom-block-styles.php';

$custom_block_styles = array(
	array(
		'block' => 'core/paragraph',
		'name'  => 'hide-paragraph-mobile',
		'label' => 'Hide on mobile',
	),
	array(
		'block' => 'core/paragraph',
		'name'  => 'center-paragraph-mobile',
		'label' => 'Center on mobile',
	),
	array(
		'block' => 'core/heading',
		'name'  => 'center-heading-mobile',
		'label' => 'Center on mobile',
	),
    array(
        'block' => 'core/navigation',
        'name'  => 'hide-navigation-desktop',
        'label' => 'Hide on desktop',
    ),
	array(
		'block' => 'core/navigation',
		'name'  => 'hide-navigation-mobile',
		'label' => 'Hide on mobile',
	),
	array(
		'block' => 'core/column',
		'name'  => 'hide-column-mobile',
		'label' => 'Hide on mobile',
	),
	array(
		'block' => 'core/group',
		'name'  => 'house-title-banner',
		'label' => 'House Title Banner',
	),
	array(
		'block' => 'core/group',
		'name'  => 'house-title-banner-sub-page',
		'label' => 'House Title Banner Sub Page',
	),
	array(
		'block' => 'core/group',
		'name'  => 'gallery-fourimage',
		'label' => 'Gallery Four Image',
	),
	array(
		'block' => 'core/group',
		'name'  => 'gallery-left',
		'label' => 'Gallery Left',
	),
	array(
		'block' => 'core/group',
		'name'  => 'gallery-right',
		'label' => 'Gallery right',
	),
	array(
		'block' => 'core/group',
		'name'  => 'center-group-mobile',
		'label' => 'Center on mobile',
	),
	array(
		'block' => 'core/group',
		'name'  => 'hide-group-mobile',
		'label' => 'Hide on mobile',
	),
	array(
		'block' => 'core/image',
		'name'  => 'center-mobile',
		'label' => 'Center on mobile',
	),
	array(
		'block' => 'core/image',
		'name'  => 'hide-mobile',
		'label' => 'Hide on mobile',
	),
);

// Initialize custom block styles - CSS files loaded from /assets/css/styles/
new Custom_Block_Styles( $custom_block_styles, '/assets/css/styles/' );
