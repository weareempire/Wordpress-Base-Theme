<?php /* ======================================================================

  FRONT END FUNCTIONS

===============================================================================

  INCLUDE THEME CORE FUNCTIONS

===============================================================================

  Since:        0.0.216
  Last Updated: 0.0.217

  - Seperates front end and theme functions to help make maintenance easier.

============================================================================ */

include_once( 'theme-functions.php' );


/* ============================================================================

 INCLUDE ACF AUTO EXPORTER

===============================================================================

  Since:        0.0.218
  Last Updated: 0.0.231

============================================================================ */

$is_dev = $_SERVER[ 'HTTP_HOST' ];

define( 'IS_DEV', $is_dev );


/* ============================================================================

  Checks if on demo development server

============================================================================ */

if ( strpos( $is_dev, 'youareempire' ) !== false ) :


/* ============================================================================

  First checks whether Advanced Custom Fields is activated ( by checking if the function 'get_field' exists, then checks if debug is set to true, then redefines WP_DEBUG

============================================================================ */



endif;


/* ============================================================================

  GET ADMIN URL

===============================================================================

  Since:        0.0.001
  Last Updated: 0.0.201

  - Echoes the asset url to retreive assets.

============================================================================ */

function ts_emp_asset_url() {

  return ASSET_URL;

}


/* ============================================================================

  CUSTOM EXCERPT

===============================================================================

  Since:        0.0.216
  Last Updated: 0.0.216

  - Adds custom excerpt for all content inputs, with option to output all content

============================================================================ */

function ts_emp_excerpt( $limit, $other = '' ) {


/* ============================================================================

  CONTENT INPUT

============================================================================ */

  if ( $other ) :

    $content = $other;

  else :

    $content = get_the_content();

  endif;


/* ============================================================================

  OUTPUT ALL CONTENT

============================================================================ */

  if ( $limit === '-1' || ( $limit >= strlen( $content ) ) ) :

    $excerpt = $content;


/* ============================================================================

  SET OUTPUT LENGTH

============================================================================ */

  else :

    $position = strpos( $content, ' ', $limit );
  
    if ( $position < $limit ) :

      $excerpt = rtrim( $content, ',' );

    else :

      $excerpt = rtrim( substr( $content, 0, $position ), ',' );

    endif;

  endif;

  return $excerpt;

}


/* ============================================================================

  CUSTOM EXCERPT

===============================================================================

  Since:        0.0.216
  Last Updated: 0.0.216

  - Adds custom excerpt for all content inputs, with option to output all content

============================================================================ */

function pagination( $pages = '', $range = 1 ) {

  $showitems = ( $range * 2 ) +1;
  
  global $paged;


/* ============================================================================

  SINGLE PAGE

============================================================================ */

  if ( empty( $paged ) ) $paged = 1;
  
  if ( $pages == '' ) :

    global $wp_query;

    $pages = $wp_query->max_num_pages;

    if ( !$pages ) :

      $pages = 1;

    endif;

  endif;


/* ============================================================================

  PAGED RESULTS

============================================================================ */

  if ( 1 != $pages ) :

    echo '<div class="pagination"><span>Page ' . $paged . ' of ' . $pages . '</span>';


/* ============================================================================

  LINK TO FIRST PAGE

============================================================================ */

    if ( $paged > 2 && $paged > $range +1 && $showitems < $pages ) echo '<a href="' . get_pagenum_link(1) . '">&laquo; First</a>';


/* ============================================================================

  PREVIOUS PAGE

============================================================================ */

    if ( $paged > 1 && $showitems < $pages ) echo '<a href="' . get_pagenum_link( $paged - 1 ) . '">&lsaquo; Previous</a>';


/* ============================================================================

  NUMBERED PAGES

============================================================================ */

    for ( $i=1; $i <= $pages; $i++ ) :

      if ( 1 != $pages && ( !( $i >= $paged + $range +1 || $i <= $paged - $range -1 ) || $pages <= $showitems ) ) :

        echo ( $paged == $i )? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '" class="inactive">' . $i . '</a>';

      endif;
      
    endfor;


/* ============================================================================

  NEXT PAGE

============================================================================ */

    if ( $paged < $pages && $showitems < $pages ) echo '<a href="' . get_pagenum_link( $paged + 1 ) . '">Next &rsaquo;</a>';


/* ============================================================================

  LAST PAGE

============================================================================ */

    if ( $paged < $pages-1 &&  $paged + $range -1 < $pages && $showitems < $pages) echo '<a href="' . get_pagenum_link( $pages ) . '">Last &raquo;</a>';

    echo '</div>';
  
  endif;

}
