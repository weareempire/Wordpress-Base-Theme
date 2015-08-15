<?php /* ======================================================================

  ADMIN

===============================================================================

  INCLUDE ADMIN OPTIONS ( ADVANCED CUSTOM FIELDS )

===============================================================================

  Since:        0.0.232
  Last Updated: 0.0.241

  - Includes custom install of Advanced Custom Fields from within the theme folder.

===============================================================================

  Defines plugin url as the base for the include

============================================================================ */

$folder = str_replace( 'functions', '', plugin_dir_path( __FILE__ ) );

define( 'ACF_URL', $folder );

/* ============================================================================

  Sets the file path for the plugins files

============================================================================ */

add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {

  $path = ACF_URL . '/advanced-custom-fields-pro/';

  return $path;
    
}


/* ============================================================================

  Sets the url for the plugin to include css and js

============================================================================ */

add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {

  $dir = get_site_url() . '/wp-content/plugins/theme-setup/advanced-custom-fields-pro/';

  return $dir;

}

/* ============================================================================

  Hides the Settings page on all live sites

============================================================================ */

if ( !strpos( IS_DEV, 'youareempire' ) !== false ) :

  add_filter( 'acf/settings/show_admin', '__return_false' );

endif;


/* ============================================================================

  Includes the main plugin file

============================================================================ */

include_once( ACF_URL . '/advanced-custom-fields-pro/acf.php' );


/* ============================================================================

  Displays the license key in a help tab for admin users

============================================================================ */

if ( function_exists( 'get_field' ) ) :

  if ( isset( $_GET[ 'post_type' ] ) == 'acf-field-group' ) :

    add_action( 'load-edit.php', 'add_pages_help_tab' , 20 );

    function add_pages_help_tab() {

      get_current_screen()->add_help_tab( array(

        'id'  => 'license_key',
        'title' => 'License Key',
        'content' => '<h3>License Key</h3><p>b3JkZXJfaWQ9NDM3MjJ8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTExLTA2IDExOjM1OjM2</p><p>Copy and paste into the License Key field <a href="' . get_bloginfo( 'url' ) . '/wp-admin/edit.php?post_type=acf-field-group&page=acf-settings-updates">here</a>.</p>',

      ) );

    }


  endif;

endif;


/* ============================================================================

  Imports Advanced Custom Field json for options page

============================================================================ */

add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset( $paths[0] );
    
    
    // append path
    $paths[] = ASSET_URL . '/settings';
    
    
    // return
    return $paths;
    
}