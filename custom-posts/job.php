<?php

// Register Position post type
function lowtide_register_job() {
  $labels = array(
    'name'                    => 'Job Openings',
    'singular_name'           => 'Position',
    'menu_name'               => 'Job Openings',
    'add_new'                 => 'Add New',
    'add_new_item'            => 'Add New Position',
    'new_item'                => 'New Position',
    'edit_item'               => 'Edit Position',
    'view_item'               => 'View Position',
    'all_items'               => 'All Job Openings',
    'search_items'            => 'Search Positions',
    'not_found'               => 'No positions found.',
    'not_found_in_trash'      => 'No positions found in Trash.',
    'archives'                => 'Job Openings archives',
    'filter_items_list'       => 'Filter job openings list',
    'items_list_navigation'   => 'Job openings list navigation',
    'items_list'              => 'Job openings list',
  );

  $args = array(
    'labels'                  => $labels,
    'public'                  => true,
    'menu_icon'               => 'dashicons-portfolio',
    'show_in_rest'            => true,
    'publicly_queryable'      => true,
    'rewrite'                 => array( 'slug' => 'job' ),
  );

  register_post_type( 'post_job', $args );

  $supports = array(
    'custom-fields',
  );
  add_post_type_support( 'post_job', $supports );
}

add_action( 'init', 'lowtide_register_job' );

// Register custom meta
function lowtide_register_job_meta() {
  $string = array(
    'show_in_rest'            => true,
    'single'                  => true,
    'type'                    => 'string',
  );

  $boolTrue = array(
    'show_in_rest'            => true,
    'single'                  => true,
    'type'                    => 'boolean',
    'default'                 => true,
  );

  $boolFalse = array(
    'show_in_rest'            => true,
    'single'                  => true,
    'type'                    => 'boolean',
    'default'                 => false,
  );
  

  register_post_meta( 'post_job', 'post_job_meta_link', $string );
  register_post_meta( 'post_job', 'post_job_meta_desc', $string );
  register_post_meta( 'post_job', 'post_job_meta_location', $string );
  register_post_meta( 'post_job', 'post_job_meta_start_date', $string );
  register_post_meta( 'post_job', 'post_job_meta_partner', $string );
  register_post_meta( 'post_job', 'post_job_meta_is_avail', $boolTrue );
  register_post_meta( 'post_job', 'post_job_meta_is_hidden', $boolFalse );
}
add_action( 'init', 'lowtide_register_job_meta' );

// Register block template
function lowtide_register_job_data_block_template() {
  $job_object = get_post_type_object( 'post_job' );
  $job_object->template = array(
    array( 'lowtide/job-data' ),
  );
  $job_object->template_lock = 'all';
}
add_action( 'init', 'lowtide_register_job_data_block_template' );

// Change title placeholder for job
function lowtide_job_custom_enter_title( $input ) {
  if ( is_object('post') && 'post_job' === get_post_type() ) {
    return 'Position name';
  }
  return $input;
}
add_filter( 'enter_title_here', 'lowtide_job_custom_enter_title' );

function lowtide_flush_jobs() {
  lowtide_register_speaker();
  flush_rewrite_rules();
}
register_activation_hook( PLUGIN_FILE_URL, 'lowtide_flush_jobs' );

function lowtide_deflush_jobs() {
  flush_rewrite_rules();
}
register_deactivation_hook( PLUGIN_FILE_URL, 'lowtide_deflush_jobs' );