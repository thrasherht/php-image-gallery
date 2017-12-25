<?php

function gen_imgtile($inputimage,$inputfile,$inputthumb) {
echo '
<a href="',$inputimage,'" title="',$inputfile,'" class="lightbox_trigger">
	<div class="imagetile col" style="background: url(',$inputthumb,') no-repeat;">
	</div>
</a>';
};

function chkdir($dir) {
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);};
};
