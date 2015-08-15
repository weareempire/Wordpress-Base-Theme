<?php


/* ============================================================================

  CHECK FILE EXISTS

===============================================================================

  Since:        0.0.001
  Last Updated: 0.0.201
  Removed:      0.0.250

  - Checks whether a remote file exists, as to not include if it doesn't exist.

============================================================================

function ts_emp_remote_file( $url ) {

    $curl = curl_init( $url );

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt( $curl, CURLOPT_NOBODY, true );

    //do request
    $result = curl_exec( $curl );

    $ret = false;

    if ( $result !== false ) {

        $statusCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );  

        if ( $statusCode == 200 ) {

            $ret = true;   

        }

    }

    curl_close( $curl );

    return $ret;

}


/* ============================================================================

  GET FILE

===============================================================================

  Since:        0.0.206
  Last Updated: 0.0.214
  Removed:      0.0.250

  - Checks whether a remote file exists, as to not include if it doesn't exist.

============================================================================

function ts_emp_get_file( $file_name, $file_type, $async = false ) {


/* ============================================================================

FILE NAME

===============================================================================

- Defines the file name.

============================================================================

  if ( $file_name != '' ) :

    $file = $file_name;

  else :

    $file = $file_name;

  endif;


/* ============================================================================

FILE TYPE

===============================================================================

- Defines the file type

============================================================================

  if ( $file_type != '' ) :

    $type = $file_type;


/* ============================================================================

ROOT

===============================================================================

- Defines the root folder of the file.

============================================================================

    if ( $type === 'js' ) :

      if ( function_exists( 'ts_emp_remote_file' ) ) : if ( ts_emp_remote_file( ts_emp_asset_url() . '/javascript/' . $file . '.min.js' ) ) :

        $type = 'min.js';

        $root = 'javascript';

      else :

        $type = 'js';

        $root = 'javascript';

      endif; endif;


/* ============================================================================

ASYNC

===============================================================================

- Async is only for javascript files, this checks whether you are trying to use it.

============================================================================

      if ( $async === true ) :

        $sync = 'async ';

      else :

        $sync = '';

      endif;


/* ============================================================================

CSS

===============================================================================

- If the type is css, this sets the root folder.

============================================================================

    elseif ( $type === 'css' ) :

      $root = 'stylesheets';

      $sync = '';

    else :

      $root = '';

      $sync = '';

    endif;

  else :

    $type = $file_type;

  endif;


/* ============================================================================

THE SCRIPTS

===============================================================================

- If the root is either 'stylesheets' or 'javascript' the function will echo the script or stylesheet links.

============================================================================

  if ( function_exists( 'ts_emp_asset_url' ) && function_exists( 'ts_emp_remote_file' ) && $root != '' ) :

    if ( ts_emp_remote_file( ts_emp_asset_url() . '/' . $root . '/' . $file . '.' . $type ) ) :

      if ( $type == 'js' || $type == 'min.js' ) :

        echo '<script ' . $sync . 'src="' . ts_emp_asset_url() . '/' . $root . '/' . $file . '.' . $type . '"></script>' . "\n";

      else :

        echo '<link rel="stylesheet" href="' . ts_emp_asset_url() . '/' . $root . '/' . $file . '.' . $type . '">' . "\n";

      endif;

    endif;

  endif;

}