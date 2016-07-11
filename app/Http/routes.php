<?php

use ImageGallery\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //config vars
    $image_directory = "images";
    $thumbnail_directory = "thumbs";
    $data = [];
    $data['files'] = [];

    //Check for and create directory for images and thumbnails
    if (!is_dir("$image_directory")) {
        mkdir("$image_directory", 0755, true);
    };
    if (!is_dir("$thumbnail_directory")) {
    	mkdir("$thumbnail_directory", 755, true);
    };

    //Setup directory for images
    $directory = "$image_directory";
    //read through image directory and get rid of .. , . , .htaccess , and .ftpquota
    $scanned_directory = array_diff(scandir($directory), array('..', '.', '.htaccess', '.ftpquota'));
    $data['files'] = $scanned_directory;

    foreach($scanned_directory as $file) {
    	//check for and create thumbnails
    	Controller::createthumb($image_directory."/".$file,$thumbnail_directory."/".$file,30000,300);
    }

    return view('default', $data);
});

Route::get('/welcome', function () {
    return view('welcome');
});
