<?php

function gen_imgtile($inputimage,$inputfile,$inputthumb) {
echo '
<div class="imagetile lightbox_trigger" href="'.$inputimage.'" style="background: url(',$inputthumb,') no-repeat;">
</div>';
};

function chkdir($dir) {
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);};
};
