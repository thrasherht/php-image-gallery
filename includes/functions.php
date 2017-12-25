<?php

function gen_imgtile($inputimage,$inputfile,$inputthumb) {
print '<a href="'.$inputimage.'" title="'.$inputfile.'" class="lightbox_trigger"><div class="imagetile col" style="background: url('.$inputthumb.') no-repeat;"></div></a>';
        print "\n";
};

function chkdir($dir) {
if (!is_dir("$dir")) {
    mkdir("$dir", 0755, true);};
};
