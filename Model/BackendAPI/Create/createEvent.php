<?php
    // Author: Jasper Davey

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;
    $eventsList = [ ];

    $sql = sprintf( "INSERT INTO Events ( name, image, bio, startDateTime, endDateTime, location, owner )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->name ),
            mysql_real_escape_string( $defaultImage ), mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $result->startDateTime ), mysql_real_escape_string( $result->endDateTime ),
            mysql_real_escape_string( $result->location ), mysql_real_escape_string( $result->owner )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status );
    }

    $id = mysql_insert_id( );
    // Save tags. Assuming nice values given = 0 at this point
    foreach ( $result->tags as $tag => $nice )
    {
        $sql = sprintf( "INSERT INTO Tags ( owner, tag, nice, type )
                         VALUES ('%s', '%s', '%s', '%s' )", mysql_real_escape_string( $id ),
                         mysql_real_escape_string( $tag ), mysql_real_escape_string( $nice ),
                         mysql_real_escape_string( 1 )
        );

        if ( !mysql_query( $sql, $connection ) )
        {
            $message = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $sql;
    		print( $message );
            $status = 404;
            reportBack( $status );
        }
    }

    // Update event creator
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->owner ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $eventsList = explode( ",", $row[ 'createdEvents' ] );
    }

    array_push( $eventsList, $id );
    $eventsList = implode( ",", $eventsList );
    if ( $eventsList[ 0 ] == "," )
    {
        $eventsList = substr( $eventsList, 1 );
    }

    $sql = sprintf( "UPDATE Users SET createdEvents = '%s' WHERE id = '%s'", mysql_real_escape_string( $eventsList ),
                     mysql_real_escape_string( $result->owner )
    );

    while ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Upload image

    reportBack( $status );
    function reportBack( $status )
    {
        // Return Results
        $status_array = array( 'status' => $status );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }


 ?>
