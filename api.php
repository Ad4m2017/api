<?php

/* api-options true and false for add and remove the option */
$fileupload = true;

init_param('q');

/* $output is an array for the json output */
$output = array();

switch ($q) {
	case 'javascript.js':
		header('Content-type: text/javascript');
		include('api/js/respond.min.js');
		include('api/js/jquery-1.12.4.min.js');
		echo '$(document).ready(function() {';
		if ( $fileupload == true ) { $file = 'api/js/fileupload.js'; if ( file_exists( $file ) ) { include( $file ); } }
		echo '});';
		break;
	case 'style.css':
		header('Content-type: text/css');
		include('api/css/normalize.min.css');
		if ( $fileupload == true ) { $filename = 'api/css/fileupload.css'; if ( file_exists( $file ) ) { include( $file ); } }
		break;		
	case 'fileupload':
		header('Content-Type: application/json');
		$output['status'] = 'ok';
		$output['status_text'] = 'test';
		//echo json_encode( $output );
		if ( $fileupload == true ) { include('api/fileupload.php');	}
		break;
	default:
		header('Content-Type: application/json');
		$output['status'] = '';
		$output['status_text'] = '';
		echo json_encode( $output );
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
			$GLOBALS[$key] = trim( @$_REQUEST[ $value ] );
		}
	}
}


?>