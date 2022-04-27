<?php

function lowtide_register_job_block() {
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }

  $register_args = array(
    'attributes' => array(
      'link' => array(
        'type' => 'string',
        'source' => 'meta',
        'meta' => 'post_job_meta_link',
      ),
      'desc' => array(
        'type' => 'string',
        'source' => 'meta',
        'meta' => 'post_job_meta_desc',
      ),
      'loc' => array(
        'type' => 'string',
        'source' => 'meta',
        'meta' => 'post_job_meta_location',
      ),
      'start' => array(
        'type' => 'string',
        'source' => 'meta',
        'meta' => 'post_job_meta_start_date',
      ),
      'partner' => array(
        'type' => 'string',
        'source' => 'meta',
        'meta' => 'post_job_meta_partner',
      ),
      'is_avail' => array(
        'type' => 'boolean',
        'source' => 'meta',
        'meta' => 'post_job_meta_is_avail',
      ),
      'is_hidden' => array(
        'type' => 'boolean',
        'source' => 'meta',
        'meta' => 'post_job_meta_is_hidden',
      ),
    ),
    'render_callback' => 'lowtide_job_block_render',
  );

  register_block_type( 'lowtide/job-data', $register_args );
}
add_action( 'init', 'lowtide_register_job_block' );

function lowtide_job_block_render( $attributes) {
  global $post;
  $id = $post->ID;

  $name = get_the_title( $id );
  $loc = get_post_meta( $id, 'post_job_meta_location', true );
  $partner = get_post_meta( $id, 'post_job_meta_partner', true );
  $start = get_post_meta( $id, 'post_job_meta_start_date', true );
  $is_avail = get_post_meta( $id, 'post_job_meta_is_avail', true );
  $url = get_post_meta( $id, 'post_job_meta_link', true );
  $desc = get_post_meta( $id, 'post_job_meta_desc', true );

  $markup = '';

  $markup .= '<div class="job-info">';

  if ( $start != '' || $loc != '' || $partner != '' ) {
    $markup .= '<div class="job-side-info">';
    if ( $start != '' ) {
      $markup .= '<div class="job-start">';
        $markup .= '<p>';
          $markup .= '<span class="side-info-label">Start date: </span>';
          $markup .= '<span class="side-info-value">' . esc_html( $start ) . '</span>';
        $markup .= '</p>';
      $markup .= '</div>';
    }

    if ( $loc != '' ) {
      $markup .= '<div class="job-location">';
        $markup .= '<p>';
          $markup .= '<span class="side-info-label">Location: </span>';
          $markup .= '<span class="side-info-value">' . esc_html( $loc ) . '</span>';
        $markup .= '</p>';
      $markup .= '</div>';
    }

    if ( $partner != '' ) {
      $markup .= '<div class="job-partner">';
        $markup .= '<p>';
          $markup .= '<span class="side-info-label">Partner(s): </span>';
          $markup .= '<span class="side-info-value">' . esc_html( $partner ) . '</span>';
        $markup .= '</p>';
      $markup .= '</div>';
    }
    $markup .= '</div>'; //.job-side-info
  }

  if ( $url != '' ) {
    $markup .= '<div class="apply-now">';
      $markup .= '<a class="btn-cta" href="' . esc_url( $url ) . '" '
      . 'aria-label="Application form for ' . esc_attr( $name ) . '">';
        $markup .= 'Apply Now';
      $markup .= '</a>';
    $markup .= '</div>';
  }

  if ( $desc != '' ) {
    $markup .= '<div class="job-desc">';
      $markup .= $desc;
    $markup .= '</div>';
  }

  $markup .= '</div>'; // .job


  return $markup;
}