<?php

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    $sql = sprintf( "INSERT INTO Events ( name, image, bio, dateAndTime, location )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->name ),
            mysql_real_escape_string( $result->image ); mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $result->dateAndTime ), mysql_real_escape_string( $result->location )

    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( );
    }

    // get Event's ID
    $sql = sprintf( "SELECT id FROM Events WHERE name = '%s' AND dateAndTime = '%s'",
                     mysql_real_escape_string( $result->name ), mysql_real_escape_string( $result->dateAndTime) );

    $eventID = mysql_query( $sql, $connection );

    if ( !$eventID )
    {
		$message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( );
	}

    // Save tags. Assuming nice values given = 0 at this point
    foreach ( $result->tags as $tag => $nice )
    {
        $sql = sprintf( "INSERT INTO Tags ( id, tag, nice, type )
                         VALUES ('%s', '%s', '%s', '%s' )", mysql_real_escape_string( $eventID ),
                         mysql_real_escape_string( $tag ), mysql_real_escape_string( $nice ),
                         mysql_real_escape_string( 1 )
        );

        if ( !mysql_query( $sql, $connection ) )
        {
            $message = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $sql;
    		print( $message );
            $status = 404;
            reportBack( );
        }
    }

    // Upload image

    reportBack( )

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
