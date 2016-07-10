<?php
require('./includes/header.php');
require('./includes/resize.php');
print "<div class=\"container\">\n";
print "<div class=\"row\">\n";
$directory = 'images/';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
foreach($scanned_directory as $file) {
  //do your work here
	createthumb("images/$file","thumbs/$file",30000,300);
	print '<a href="images/'.$file.'"><div class="col-md-2"><div class="logo-box" style="background-image:url(thumbs/'.$file.');" ></div></div></a>';
	print "\n";
}
print "</div>\n</div>";
require('./includes/footer.php');
?>
