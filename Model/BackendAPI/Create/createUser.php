<?php
    // Author: Jasper Davey

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    // Should check if user already exists
    $sql = sprintf( "SELECT * FROM Users WHERE email = '%s'",
                     mysql_real_escape_string( $result->email )
    );

    $query = mysql_query($sql, $connection);

    // Debug query in case of error
    if ( !$query )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status, $id="NULL" );
    }

    // Case if given wrong username
    if ( mysql_num_rows( $query ) != 0 )
    {
        $status = 404;
        reportBack( $status, $id="NULL" );
    }

    $events = implode( ",", $result->events );

    $sql = sprintf( "INSERT INTO Users ( email, password, username, firstname, lastname, bio, image, events, friends, pendingFriendRequests, createdEvents )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->email ),
            mysql_real_escape_string( $result->password ), mysql_real_escape_string( $result->username ),
            mysql_real_escape_string( $result->firstname ), mysql_real_escape_string( $result->lastname ),
            mysql_real_escape_string( $result->bio ), mysql_real_escape_string( $defaultImage ),
            mysql_real_escape_string( $events ), mysql_real_escape_string( {} ), mysql_real_escape_string( {} ),
            mysql_real_escape_string( {} )
     );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $connection = "NULL" );
    }

    $id = mysql_insert_id( );

    // Add tags now?
    if ( !empty( $result->tags ) )
    {

        // Save tags. Assuming nice values given = 0 at this point
        foreach ( $result->tags as $tag )
        {
            $sql = sprintf( "INSERT INTO Tags ( owner, tag, nice, type )
                             VALUES ('%s', '%s', '%s', '%s' )", mysql_real_escape_string( $id ),
                             mysql_real_escape_string( $tag ), mysql_real_escape_string( 0 ),
                             mysql_real_escape_string( 0 )
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
    }

    // Upload image

    reportBack( $status, $id );

    function reportBack( $status, $id )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'id' => $id );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }

 ?>
