<?php

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    // Should check if user already exists
    echo $result->command;

    $sql = sprintf( "INSERT INTO Users ( email, password, firstname, lastname, bio, image, events, friends )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", mysql_real_escape_string( $result->email ),
            mysql_real_escape_string( $result->password ), mysql_real_escape_string( $result->firstname ),
            mysql_real_escape_string( $result->lastname ), mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $defaultImage ), mysql_real_escape_string( "" ),
            mysql_real_escape_string( "" )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( );
    }

    // Add tags now?

    // Upload image

    reportBack( );

    function reportBack( )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'id' => $connection->insert_id );
        $status_json = json_encode( $status_array );

        echo "$status_json";
    }

 ?>
