<?php 

/**
 *Plugin Name: Sea Level Sensors content management
 *
 */

// Defines constant which is useful for register_activation hook
if ( ! defined( 'PLUGIN_FILE_URL' ) ) {
	define( 'PLUGIN_FILE_URL', __FILE__ );
}

// Assets file loads in js and css needed to render blocks in WP editor
include( plugin_dir_path(__FILE__) . 'includes/lowtide-assets.php' );


// Blocks file loads in php files needed for any custom block-based rendering
include( plugin_dir_path(__FILE__) . 'includes/lowtide-block-render.php' );


// Custom posts file connects php files which register individual custom post types
include( plugin_dir_path(__FILE__) . 'includes/lowtide-custom-posts.php' );
