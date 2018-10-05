<?php

$q_fileupload = true;

$q = @$_REQUEST['q'];

switch ($q) {
	case 'fileupload':
		
		if ( $q_fileupload = true ) {
			include('api/q/fileupload.php')
		}

		break;
	default:
		# code...
		break;
}

?>