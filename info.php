<?php

// outputs e.g.  somefile.txt: 1024 bytes
if($_GET["file"]&&trim($_GET["file"])!="")
{
	
$filename = trim($_GET["file"]);
echo filesize($filename);
}

?>