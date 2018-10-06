<?php

//header('Content-Type: application/json');

/* api-options true and false for add and remove the option */
$fileupload = true;

/* $output is an array for the json output */
$output = array();

init_param('q');
switch ($q) {
	case 'javascript.js':
		include('api/js/respond.min.js');
		include('api/js/jquery-1.12.4.min.js');
		echo '$(document).ready(function() {';
		if ( $fileupload = true ) { $filename = 'fileupload.js'; if (file_exists($filename)) { include('api/js/' . $filename ); } }
		echo '});';
		break;
	case 'style.css':
		include('api/css/normalize.min.css');
		if ( $fileupload = true ) { $filename = 'fileupload.css'; if (file_exists($filename)) { include('api/css/' . $filename ); } }
		break;		
	case 'fileupload':
		
		var_dump($_FILES);

		if ( $fileupload = true ) {
			include('api/fileupload.php');
		}

		break;
	default:
		# code...
		break;
}













/* 
	function to get easy and quick parameter(s) with one line code
	samples:
	init_param('q'); // put the $_GET['q'] OR $_POST['q'] value to variable $q
	init_param('query:q'); // put the $_GET['q'] OR $_POST['q'] value to variable $query
	init_param('q,query:q'); // put the $_GET['q'] OR $_POST['q'] value to variable $q and $query
	
	init_param('query:q,w:w,s:e');
	echo $query; // ok
	echo $w; // ok
	echo $s; // ok
	echo $e; // error
*/
function init_param( $string ) {
	$array = explode( ',' , $string );
	foreach ( $array as $key_value ) {
		$pos 	= strpos( $key_value , ':' );
		if ( $pos === false ) {
			$GLOBALS[$key_value] = @$_REQUEST[$key_value];
		} else {
			$key 	= substr( $key_value , 0 , $pos );
			$value 	= substr( $key_value , $pos + 1 );
			$GLOBALS[$key] = @$_REQUEST[$value];			
		}
	}
}


?>