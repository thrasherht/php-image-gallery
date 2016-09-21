<?php
//configuration
$image_directory = "images";
$thumbnail_directory = "thumbs";

//Pull in included files
	require('./includes/header.html');
	require('./includes/resize.php');

//Check for and create directory for images and thumbnails
if (!is_dir("$image_directory")) {
    mkdir("$image_directory", 0755, true);
};
if (!is_dir("$thumbnail_directory")) {
    mkdir("$thumbnail_directory", 0755, true);
};

//Setup directory for images
$directory = "$image_directory";
//read through image directory and get rid of .. , . , .htaccess , and .ftpquota
$scanned_directory = array_diff(scandir($directory), array('..', '.', '.htaccess', '.ftpquota'));
//loop through all the files from the directory listing

foreach($scanned_directory as $file) {
  //do your work here
	
	if (preg_match("/.mp4/i", "$file")) {

	//Does nothing here when matched to video files
	//Other Extensions could be added as well

	} else {

	//check for and create thumbnails
	createthumb("$image_directory/$file","$thumbnail_directory/$file",200,200);

	//Create HTML code for each image
	print '<a href="'.$image_directory.'/'.$file.'" title="'.$file.'" class="lightbox_trigger"><div class="imagetile" style="background: url('.$thumbnail_directory.'/'.$file.') no-repeat;"></div></a>';
	print "\n";
}}
//Footer include
//Check if bootstrap gallery is enabled
	require('./includes/footer.html');
?>
