<?php
/* 
	//.htaccess
		php_value upload_max_filesize 256M
		php_value post_max_size 256M
	//OR
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
	//check settings with:
		phpinfo();
*/

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

if ( count($_FILES) !== 1 ) { $output['status'] = 'error'; $output['status_text'] = ''; echo json_encode( $output ); }

function save_file( $filesize_limit = 20*KB , $only_images = true , $save_to = 'mysql:db_api,tbl_files,name' , $save_as = 'base64' ) {
	
	if ( 0 < @$_FILES['file']['error'] ) {
	    $output['status'] 		= 'error';
	    $output['status_text'] 	= $_FILES['file']['error'];
		return json_encode( $output );
	}
	
	if ( $_FILES['file']['size'] > $filesize_limit ) {
	    $output['status'] 		= 'error';
	    if ($filesize_limit > TB ) {
		    $output['status_text'] 	= 'File is to big. Maximum filesize is ' . number_format( $filesize_limit / TB , 2 , '.' , '' ) . ' TB.';
	    }
	    else if ($filesize_limit > GB ) {
		    $output['status_text'] 	= 'File is to big. Maximum filesize is ' . number_format( $filesize_limit / GB , 2 , '.' , '' ) . ' GB.';
	    }
	    else if ($filesize_limit > MB ) {
		    $output['status_text'] 	= 'File is to big. Maximum filesize is ' . number_format( $filesize_limit / MB , 2 , '.' , '' ) . ' MB.';
	    }
	    else {
		    $output['status_text'] 	= 'File is to big. Maximum filesize is ' . number_format( $filesize_limit / KB , 2 , '.' , '' ) . ' KB.';
	    }
		return json_encode( $output );
	}

	if ( $only_images == true ) {
		$img_array = @getimagesize( $_FILES['file']['tmp_name'] );
		//var_dump($img_array);
		/*
			Array (	[0] => 800 	[1] => 450 	[2] => 2 	[3] => width="800" height="450" 	[bits] => 8
			[channels] => 3
			[mime] => image/jpeg)
		*/
		if ( $img_array['mime'] !== 'image/gif' AND $img_array['mime'] !== 'image/jpeg' AND $img_array['mime'] !== 'image/png' ) {
		    $output['status'] 		= 'error';
		    $output['status_text'] 	= 'File is not an image. Allowed images: *.gif, *.jpg and *.png.';
			return json_encode( $output );
		}
	}

    //var_dump($_FILES['file']);
    $output_json['status'] 		= 'ok';
    $output_json['status_text'] = '';
   	$output_json['filesize'] 	= $_FILES['file']['size'];
	echo json_encode( $output );
    
}

?>