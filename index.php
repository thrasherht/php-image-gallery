<?php
//Pull in included files
// Moved to blade
require('./includes/resize.php');
//configuration
$image_directory = "images";
$thumbnail_directory = "thumbs";
//Check for and create directory for images and thumbnails
if (!is_dir("$image_directory")) {
    mkdir("$image_directory", 0755, true);
};
if (!is_dir("$thumbnail_directory")) {
	mkdir("$thumbnail_directory", 755, true);
};
// Moved to blade

//Setup directory for images
$directory = "$image_directory";
//read through image directory and get rid of .. , . , .htaccess , and .ftpquota
$scanned_directory = array_diff(scandir($directory), array('..', '.', '.htaccess', '.ftpquota'));
//loop through all the files from the directory listing
foreach($scanned_directory as $file) {
  //do your work here
	//check for and create thumbnails
	createthumb("$image_directory/$file","$thumbnail_directory/$file",30000,300);
	//Create HTML code for each image
	print '<a href="images/'.$file.'" data-lightbox="Snips Gallery"><div class="col-sm-12 col-md-3 col-lg-2"><div class="logo-box" style="background-image:url(thumbs/'.$file.');" ></div></div></a>';
	print "\n";
}
// Moved to blade

//Footer include
// Moved to blade
?>
