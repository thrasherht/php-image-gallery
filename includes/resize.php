<?php
function createthumb($source_image,$destination_image_url, $desired_width, $desired_height){
    if (!file_exists($destination_image_url)){
    ini_set('memory_limit','512M');
    set_time_limit(0);

    //Check if image is taller or wider, and adjust resize to make clean thumbnails for divs
    list($img_width, $img_height) = getimagesize($source_image);
    if($img_height >= $img_width) {
      $get_height = 200000;
      $get_width = $desired_width;
    } else {
      $get_height = $desired_height;
      $get_width = 200000;
    }

    $image_array = explode('/',$source_image);
    $image_name = $image_array[count($image_array)-1];
    $max_width  = $get_width;
    $max_height =$get_height;
    $quality = 50;

    //Set image ratio
    list($width, $height) = getimagesize($source_image);
    $ratio = ($width > $height) ? $max_width/$width : $max_height/$height;
    $ratiow = $width/$max_width ;
    $ratioh = $height/$max_height;
    $ratio = ($ratiow > $ratioh) ? $max_width/$width : $max_height/$height;

    if($width > $max_width || $height > $max_height) {
        $new_width = $width * $ratio;
        $new_height = $height * $ratio;
    } else {
        $new_width = $width;
        $new_height = $height;
    }
    if (preg_match('/.jpg|.jpeg/i',"$source_image")) {
        //JPEG type thumbnail
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($source_image);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($image_p, $destination_image_url, $quality);
        imagedestroy($image_p);

    } elseif (preg_match('/.png/i', "$source_image")){
        //PNG type thumbnail
        $im = imagecreatefrompng($source_image);
        $image_p = imagecreatetruecolor ($new_width, $new_height);
        imagealphablending($image_p, false);
        imagecopyresampled($image_p, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagesavealpha($image_p, true);
        imagepng($image_p, $destination_image_url);

    } elseif (preg_match('/.gif/i', "$source_image")){
        //GIF type thumbnail
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromgif($source_image);
        $bgc = imagecolorallocate ($image_p, 255, 255, 255);
        imagefilledrectangle ($image_p, 0, 0, $new_width, $new_height, $bgc);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagegif($image_p, $destination_image_url, $quality);
        imagedestroy($image_p);

    } else {
	error_log("There are a problem processing the thumbnail for $source_image");
    }
}}
