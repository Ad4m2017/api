<?php

$addons_fileupload = true;

$q = @$_REQUEST['q'];

switch ($q) {
	case 'fileupload':
		
		if ( addon_fileupload = true ) {
			include('addons/fileupload.php')
		}

		break;
	default:
		# code...
		break;
}

?>