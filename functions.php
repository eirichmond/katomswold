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
 * Mark images inside the gallery widget groups (four image, gallery left, gallery right).
 *
 * These images sit in fixed square tiles (280x280, object-fit: cover). Core gives lazy images
 * sizes="auto", so the browser picks a file as wide as the 280px box, then cover scales that file
 * up to fill the box height and the photo goes soft on 1x screens (#497). The marker lets
 * katomswold_gallery_tile_image_sizes() fix the sizes once core has added srcset.
 *
 * Runs at render time, so it covers every existing house without re-saving content.
 *
 * @param string $block_content Rendered group block.
 * @param array  $block         Parsed block.
 * @return string
 */
function katomswold_mark_gallery_tile_images( $block_content, $block ) {
	$class_name = $block['attrs']['className'] ?? '';

	if ( ! preg_match( '/\bis-style-gallery-(fourimage|left|right)\b/', $class_name ) ) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );
	while ( $processor->next_tag( 'img' ) ) {
		$processor->set_attribute( 'data-kt-gallery-tile', '1' );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/group', 'katomswold_mark_gallery_tile_images', 10, 2 );

/**
 * Give gallery tile images a sizes value that matches what object-fit: cover actually needs.
 *
 * A landscape photo covering a 280px square has to be drawn 280px tall, so it needs a file
 * 280 x aspect ratio wide (420px for a 3:2 photo), not 280px. On mobile the tiles can stretch
 * to the column width, so 100vw is used there, never dropping below the cover width.
 *
 * Hooked to wp_content_img_tag, which runs after core adds srcset, sizes and "auto". Block
 * templates run the content filters twice (post content, then the whole template) and core
 * re-adds "auto" on the second pass, so the marker stays on the img to fix it every time.
 *
 * @param string $image Full img tag.
 * @return string
 */
function katomswold_gallery_tile_image_sizes( $image ) {
	if ( ! str_contains( $image, 'data-kt-gallery-tile' ) ) {
		return $image;
	}

	$processor = new WP_HTML_Tag_Processor( $image );
	if ( ! $processor->next_tag( 'img' ) ) {
		return $image;
	}

	$width  = (int) $processor->get_attribute( 'width' );
	$height = (int) $processor->get_attribute( 'height' );

	if ( $width > 0 && $height > 0 && $processor->get_attribute( 'srcset' ) ) {
		// Tile dimensions come from the block's inline style; the patterns use 280x280.
		$style  = (string) $processor->get_attribute( 'style' );
		$tile_w = preg_match( '/(?:^|;)\s*width:\s*(\d+)px/', $style, $m ) ? (int) $m[1] : 280;
		$tile_h = preg_match( '/(?:^|;)\s*height:\s*(\d+)px/', $style, $m ) ? (int) $m[1] : 280;

		// Width the photo is drawn at to cover the tile.
		$cover_w = (int) ceil( max( $tile_w, $tile_h * $width / $height ) );

		if ( $cover_w >= 782 ) {
			$sizes = sprintf( '%dpx', $cover_w );
		} else {
			$sizes = sprintf( '(max-width: %1$dpx) %1$dpx, (max-width: 782px) 100vw, %1$dpx', $cover_w );
		}

		// No "auto": with auto the browser uses the 280px layout box and ignores the rest.
		$processor->set_attribute( 'sizes', $sizes );
	}

	return $processor->get_updated_html();
}
add_filter( 'wp_content_img_tag', 'katomswold_gallery_tile_image_sizes' );

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
		'block' => 'core/post-title',
		'name'  => 'center-post-title-mobile',
		'label' => 'Center on mobile',
	),
	array(
		'block' => 'core/heading',
		'name'  => 'hidden-all-devices',
		'label' => 'SEO hidden',
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
		'block' => 'core/column',
		'name'  => 'center-column-mobile',
		'label' => 'Center on mobile',
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
		'block' => 'core/group',
		'name'  => 'matrix-cards-five',
		'label' => 'Matrix Cards Five',
	),
	array(
		'block' => 'core/buttons',
		'name'  => 'stack-buttons-mobile',
		'label' => 'Stack on mobile',
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
