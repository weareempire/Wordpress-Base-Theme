<?php

  $version = '1.0.001'; // format 0.0.000

  $date = '2015-09-08'; // format YYYY-MM-DD

  $theme = 'empire_base';

  $file = $theme . '.zip';

  $directory = 'https://github.com/weareempire/Wordpress-Base-Theme/tree/master/api/download.php';


  $packages[ $theme ] = array( //Replace theme with theme stylesheet slug that the update is for

    'versions' => array(

      $version => array( // Array name should be set to current version of update

        'version' => $version, // Current version available
        'date' => $date, // Date version was released
        'package' => $directory . '?key=' . md5( $file . mktime( 0,0,0, date( 'n' ), date( 'j' ), date( 'Y' ) ) ),
        'file_name' => $file,	// File name of theme zip file
        'author' => 'We Are Empire', // Author of theme
        'name' => 'We Are Empire', // Name of theme
        'requires' => '4.3', // Wordpress version required
        'tested' => '4.3', // WordPress version tested up to
      )

    ),

    'info' => array(
        'url' => 'http://weareempire.co.uk'
    )

  );
