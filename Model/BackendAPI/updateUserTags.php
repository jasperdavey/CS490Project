<?php
    // Input: id, tag
    // Output: status

    $status = 200;

    // get User's tags
    $sql = sprintf( "SELECT * FROM Tags WHERE id = '%s'" AND tag = '%s', mysql_real_escape_string ( $result->id ),
                     mysql_real_escape_string( $result->tag )
    );

    $userTags = mysql_query( $sql, $connection );

    if ( !$userTags )
    {
		$message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack();
	}

    $tagNiceValue = 0;
    $id = 0;
    while ( ( $row = mysql_fetch_assoc( $userTags ) ) )
    {
        $tagNiceValue = $row[ 'nice' ] + 1;
        $id = $row[ 'id' ];
    }

    $sql = sprintf( "UPDATE Users SET nice = '%s' WHERE id = '%s'",  mysql_real_escape_string( $tagNiceValue )
                     mysql_real_escape_string( $id )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack();
    }

    /*
    $userTagsArray = array( );

    while ( ( $row = mysql_fetch_assoc( $userTags ) ) ){
        if ( $row[ 'tag' ] == $result->tag )
        {
            $tags = array( $row[ 'tag' ] => ( $row[ 'nice' ] + 1 ) );
        }
        $tags = array( $row[ 'tag' ] => $row[ 'nice' ] );
        array_push( $userTagsArray, $tags );
    }

    $json_tags = json_encode( $userTagsArray );

    $status_array = array( 'status' => $status, 'tags' => $userTagsArray );

    */

    reportBack( );

    function reportBack( )
    {
        // Return Results
        $status_array = array( 'status' => $status );
        $status_json = json_encode( $status_array );

        $reponseURL =
    	"https://web.njit.edu/~aml35/login/reportingBackToFrontEnd.php";
    	$ch = curl_init();
    	curl_setopt( $ch, CURLOPT_URL, $responseURL );
    	curl_setopt( $ch, CURLOPT_POST, 1 );
    	curl_setopt( $ch, CURLOPT_POSTFIELDS, $status_json );
    	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    	curl_exec( $ch );
    	curl_close( $ch );
    }


 ?>