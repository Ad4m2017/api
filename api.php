<?php

//header('Content-Type: application/json');

$fileupload = true;

$q = @$_REQUEST['q'];
function init_parameters( $string ) {
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
init_parameters('query:q,w:w,s:e,wo,e');
echo $query; 
echo $w;
echo $s;
echo $e;
echo $wo;
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

?>