<?php
//configuration
$img_dir = 'images/';
$tmb_dir = 'thumbs/';

//Pull in included files
	require('./includes/header.html');
	require('./includes/resize.php');
	require('./includes/functions.php');

//Check for and create directory for images and thumbnails
chkdir($img_dir);
chkdir($tmb_dir);

//read through image directory and get rid of .. , . , .htaccess , and .ftpquota
$scanned_directory = array_diff(scandir($img_dir), array('..', '.', '.htaccess', '.ftpquota'));

//loop through all the files from the directory listing
foreach($scanned_directory as $file) {
	//Checking if file extension matches desired type
	//only resize these files.	
	if (preg_match('/.png|.jpg|.jpeg|.gif/i',$file)) {

	//check for and create thumbnails
	createthumb("$img_dir$file","$tmb_dir$file",200,200);
	
        //Sanitize filenames and encode for HTML use
        $tmb = $tmb_dir.rawurlencode($file);
        $img = $img_dir.rawurlencode($file);
	
	//Create HTML code for each image
	gen_imgtile ($img,$file,$tmb);

        } else {
	//Do nothing for files that don't match
}}
//Footer include
//Check if bootstrap gallery is enabled
	require('./includes/footer.html');
?>
