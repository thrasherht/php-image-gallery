<?php
//configuration
$image_directory = "images";
$thumbnail_directory = "thumbs";
define('use_bootstrap_gallery', true);

//Pull in included files
//Check if bootstrap gallery is enabled
if ( use_bootstrap_gallery ){
	require('./includes/header-bootstrap-gallery.html');
} else {
	require('./includes/header.html');
}

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

if ( use_bootstrap_gallery ) {

foreach($scanned_directory as $file) {
//do your work here
        //check for and create thumbnails
        createthumb("$image_directory/$file","$thumbnail_directory/$file",30000,300);
        //Create HTML code for each image
print '<a href="'.$image_directory.'/'.$file.'" title="'.$file.'" data-gallery>
<img src="'.$thumbnail_directory.'/'.$file.'" alt="'.$file.'">
</a>';
        print "\n"; }
} else { 

foreach($scanned_directory as $file) {
  //do your work here
	//check for and create thumbnails
	createthumb("$image_directory/$file","$thumbnail_directory/$file",30000,300);
	//Create HTML code for each image
	print '<a href="'.$image_directory.'/'.$file.'" data-lightbox="Snips Gallery"><div class="col-sm-12 col-md-3 col-lg-2"><div class="logo-box" style="background-image:url('.$thumbnail_directory.'/'.$file.');" ></div></div></a>';
	print "\n"; }
}
//Footer include
//Check if bootstrap gallery is enabled
if ( use_bootstrap_gallery ){
	require('./includes/footer-bootstrap-gallery.html');
} else {
	require('./includes/footer.html');
}
?>
