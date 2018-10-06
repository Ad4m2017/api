<?php

header('Content-Type: application/json');

/* api-options true and false for add and remove the option */
$fileupload = true;

init_param('query:q,w:w,s:e,wo,e');
echo $query;
echo $w;
echo $s;
echo $e;
echo $wo;

init_param('q');
switch ($q) {
	case 'fileupload':
		
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