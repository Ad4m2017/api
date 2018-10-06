$( '#btn_fileupload_send' ).on( 'click', function() {

    var file = $('#fileupload').get(0).files[0], formData = new FormData();

    formData.append( 'file', file );
    console.log( file );
    $.ajax( {
        url        : 'api.php?q=fileupload',
        type       : 'POST',
        contentType: false,
        cache      : false,
        processData: false,
        data       : formData,
        xhr        : function ()
        {
            var jqXHR = null;
            if ( window.ActiveXObject ) {
                jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
            }
            else {
                jqXHR = new window.XMLHttpRequest();
            }

            //Upload progress
            jqXHR.upload.addEventListener( "progress", function ( evt ) {
                if ( evt.lengthComputable ) {
                    var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                    //Do something with upload progress
                    $( '#progressBar' ).val( percentComplete );
                    $( '#progressText' ).text( percentComplete + '%' );
                    //console.log( 'Uploaded percent', percentComplete );
                }
            }, false );

            //Download progress
            jqXHR.addEventListener( "progress", function ( evt ) {
                if ( evt.lengthComputable ) {
                    var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                    //Do something with download progress
                    $( '#progressBar' ).val( percentComplete );
                    $( '#progressText' ).text( percentComplete + '%' );
                    //console.log( 'Downloaded percent', percentComplete );
                }
            }, false );

            return jqXHR;
        },
        success    : function ( data )
        {
            console.log( 'Completed.' );
            alert(data);
            alert(JSON.stringify(data));
        },
        error       : function ( data )
        {
            console.log( 'error.' );
            alert('Error, are you Offline ?');
            alert(JSON.stringify(data));
        }
    } );
});