<?php /* ======================================================================

  GENERAL SETTINGS

===============================================================================

  Since:        0.0.1
  Last Updated: 0.0.201

  Runs through settings, changing default values

============================================================================ */

function ts_emp_reset_setttings() {


/* ============================================================================

  SET UP HOME PAGE

===============================================================================

  Since:        0.0.1
  Last Updated: 0.0.201

  Sets up a new page with title Home

============================================================================ */

  $homePage_title    = 'Home';
  $homePage_content  = '';

  $homePage = array(

    'post_title'     => $homePage_title,
    'post_content'   => $homePage_content,
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'post_author'    => 1,
    'menu_order'     => 1,
    'comment_status' => 'closed'
   
  );

  $setHome    = get_page_by_title( $homePage_title );

  if ( !isset( $setHome->ID ) ) {

    $homePage_id = wp_insert_post( $homePage );

  }


/* ============================================================================

  UPDATE SETTINGS

===============================================================================

  Since:        0.0.1
  Last Updated: 0.0.201

  Update default settings, assigns the front page to the newly created home page.

============================================================================ */

  $o = array(

// GENERAL SETTINGS
    'blogdescription'               => '',
    'timezone_string'               => 'Europe/London',
    'date_format'                   => 'd.m.Y',

// WRITING
    'use_smilies'                   => 0,

// READING
    'show_on_front'                 => 'page',

// DISCUSSION
    'show_avatars'                  => 0,
    'avatar_default'                => 'blank',
    'avatar_rating'                 => 'G',
    'default_ping_status'           => 'closed',
    'default_comment_status'        => 'closed',
    'comment_registration'          => 1,
    'comment_max_links'             => 0,
    'comments_per_page'             => 0,
    'thread_comments'               => 0,
    'close_comments_for_old_posts'  => 1,
    'close_comments_days_old'       => 0,
    'comments_notify'               => 0,
    'moderation_notify'             => 0,
    'comment_moderation'            => 1,


// MEDIA
    'uploads_use_yearmonth_folders' => 0,

// PERMALINKS
    'permalink_structure'           => '/%postname%/',
    'category_base'                 => ''

  );

  foreach ( $o as $k => $v ) :

    update_option($k, $v);

  endforeach;


/* ============================================================================

  REMOVE DUMMY CONTENT

===============================================================================

  Since:        0.0.1
  Last Updated: 0.0.201

  Removes dummy content, including intial post, page and comment.

============================================================================ */

  wp_delete_post( 1, TRUE );
  wp_delete_post( 2, TRUE );
  wp_delete_comment( 1 );

  return;

}



register_activation_hook( __FILE__, 'ts_emp_reset_setttings' );

