<?php /* ======================================================================

  THEME SETUP

===============================================================================

  Plugin Name:  Theme Setup

  Description:  Runs various functions to speed up site setup, including setting default settings, also adds the ability import default JavaScript and CSS.

  Version:      0.0.255

  Author:       We Are Empire

  Author URI:   http://www.weareempire.co.uk

===============================================================================

  PLUG IN SLUG

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - Defines the plug in slug, set here to make sure it is set as theme-setup

============================================================================ */

$plugin_slug = basename( dirname( __FILE__ ) );


/* ============================================================================

  CHECK FOR UPDATES

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.205

  - Although the update file should always exist, we will double check first, before trying to check for updates.

============================================================================ */

if ( file_exists( plugin_dir_path( __FILE__ ) . 'update/index.php' ) ) :

  include_once( plugin_dir_path( __FILE__ ) . 'update/index.php' );

endif;


/* ============================================================================

  DEFAULT THEME AND UPLOAD DIRECTORY

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.205

  - Sets default theme ( uses REDIRECT TO DASHBOARD to activate correctly ) and also sets upload location to url /images to keep source code clean.

============================================================================ */

$empireTheme = wp_get_theme( 'empire_base' );

if ( $empireTheme->exists() ) :

  define( 'WP_DEFAULT_THEME', 'empire_base' );

  define( 'UPLOADS', 'images' );

endif;


/* ============================================================================

  REDIRECT TO DASHBOARD

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.205

  - Checks whether the current page is the themes page and redirected from the plugin activation

============================================================================ */

if ( $_SERVER[ 'REQUEST_URI' ] == '/wordpress/wp-admin/themes.php?activation=redirect' && $_SERVER[ 'HTTP_REFERER' ] === 'http://' . $_SERVER[ 'HTTP_HOST' ] . '/wordpress/wp-admin/plugins.php' ) :
  
  header('Location: ' . 'http://' . $_SERVER[ 'HTTP_HOST' ] . '/wordpress/wp-admin/?welcome=0'); 

endif;

register_activation_hook( __FILE__, 'ts_emp_activate' );

add_action( 'admin_init', 'ts_emp_redirect' );

function ts_emp_activate() {

  add_option( 'ts_emp_activate_redirect', true );

}

function ts_emp_redirect() {

  $redirect_url = admin_url( 'themes.php?activation=redirect', 'http' );

  if ( get_option( 'ts_emp_activate_redirect', false ) ) {

    delete_option( 'ts_emp_activate_redirect' );

    wp_redirect( $redirect_url );

  }

/* ============================================================================

  SET FRONT PAGE

===============================================================================

  - Only option to be set outside of general settings, as we have to wait for the home page to be created before setting it as the front page.

============================================================================ */

  $setHome = get_page_by_title( 'Home' );

  $o = array(

    'page_on_front'                 => $setHome->ID,

  );

  foreach ( $o as $k => $v ) :

    update_option($k, $v);

  endforeach;

}


/* ============================================================================

  ASSET URL

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.250

  - Defines the asset url, to use within functions

============================================================================ */

$asset_url = 'http://955eea252b7d72adef32-c2e5ade8760524f99ddc26b0b4956fe2.r18.cf3.rackcdn.com/local/';

define( 'ASSET_URL', $asset_url );


/* ============================================================================

  GENERAL SET UP

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - Removes dummy content, including post, comment and sample page.

  - Sets all general settings, deactivating comments, etc.

  PLEASE NOTE: This only fires on first activation as it checks whether the dummy post exists, to avoid unintentional deletion and rewriting of any adjusted settings.

============================================================================ */

if ( file_exists( plugin_dir_path( __FILE__ ) . 'settings/index.php' ) ) :

  include_once( plugin_dir_path( __FILE__ ) . 'settings/index.php' );

  if ( function_exists( 'ts_emp_reset_setttings' ) ) :

    if ( FALSE === get_post_status( 1 ) ) : else :

      ts_emp_reset_setttings();

    endif;

  endif;

endif;


/* ============================================================================

  GLOBAL FUNCTIONS

===============================================================================

  Since:        0.0.001

  Last Updated: 0.0.001

  - Adds global functionality by adding various functions, which will allow hooking both backend and frontend.

============================================================================ */

if ( file_exists( plugin_dir_path( __FILE__ ) . 'functions/index.php' ) ) :

  include_once( plugin_dir_path( __FILE__ ) . 'functions/index.php' );

endif;


/* ============================================================================

  ADMIN

===============================================================================

  Since:        0.0.232

  Last Updated: 0.0.232

  - Adds global functionality by adding various functions, which will allow hooking both backend and frontend.

============================================================================

if ( file_exists( plugin_dir_path( __FILE__ ) . 'advanced-custom-fields-pro/acf.php' ) ) :

  include_once( 'functions/admin.php' );

endif;


/* ============================================================================

  END THEME SETUP

============================================================================ */

