<?php

$scripts = array(
  'guten-helpers',
  'rich-field',
  'backlink',
  'card',
  'contained-width',
  'event-data',
  'file-upload',
  'group',
  'link',
  'quote',
  'two-col-main',
  'two-col-related-docs',
  'news-link',
  'job-data',
);

// Add type="module" to scripts
function lowtide_scripts_to_modules( $tag, $handle, $src ) {
  global $scripts;
  foreach( $scripts as $module ) {
    $the_handle = 'lowtide-' . $module;
    if ( $the_handle == $handle ) {
      return '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'lowtide_scripts_to_modules', 10, 3 );

/* Loading GCP block assets (js file and administrative css) ----------------------- */

function lowtide_load_blocks() {
  global $scripts;
  
  $deps = array(
    'wp-blocks',
    'wp-i18n',
    'wp-editor',
    'wp-date',
  );
  
  foreach ( $scripts as $tag ) {
    $script_name = 'lowtide-' . $tag;
    $url = plugin_dir_url( __FILE__ ) . '../assets/js/' . $tag . '.js';
    wp_enqueue_script( $script_name, $url, $deps );
  }
  
  wp_enqueue_style( 
    'lowtide-block-editor-style', 
    plugin_dir_url( __FILE__ ) . '../assets/css/block-editor.css'
  );
  wp_localize_script( 
    'lowtide-news-link', 
    'scriptData', 
    array(
      'pluginUrl' => plugin_dir_url( __FILE__ ) . '../',
    ) 
  );
}

add_action( 'enqueue_block_editor_assets', 'lowtide_load_blocks' );


function lowtide_editor_assets() {
  wp_enqueue_style( 
    'lowtide-dashboard-style', 
    plugin_dir_url( __FILE__ ) . '../assets/css/wp-admin.css'
  );
}


add_action( 'enqueue_admin_assets', 'lowtide_editor_assets' );