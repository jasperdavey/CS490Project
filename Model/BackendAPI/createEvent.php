<?php
    // Author: Jasper Davey

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    $sql = sprintf( "INSERT INTO Events ( name, image, bio, dateAndTime, location )
            VALUES ( '%s', '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->name ),
            mysql_real_escape_string( $defaultImage ), mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $result->dateAndTime ), mysql_real_escape_string( $result->location )

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
        $sql = sprintf( "INSERT INTO Tags ( id, tag, nice, type )
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
