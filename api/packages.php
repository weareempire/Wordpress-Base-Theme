<?php
// Theme with update info
$packages['empire_base'] = array( //Replace theme with theme stylesheet slug that the update is for
    'versions' => array(
        '1.0.003' => array( //Array name should be set to current version of update
            'version' => '1.0.003', //Current version available
            'date' => '2015-09-08', //Date version was released
            //theme.zip is the same as file_name
            'package' => 'http://demo.youareempire.co.uk/theme/api/download.php?key=' . md5('empire_base.zip' . mktime(0,0,0,date("n"),date("j"),date("Y"))),
            //file_name is the name of the file in the update folder.
            'file_name' => 'empire_base.zip',	//File name of theme zip file
            'author' => 'We Are Empire', //Author of theme
            'name' => 'We Are Empire', //Name of theme
            'requires' => '4.3', //Wordpress version required
            'tested' => '4.3', //WordPress version tested up to
        )
    ),
    'info' => array(
        'url' => 'http://weareempire.co.uk'  // Website devoted to theme if available
    )
);
