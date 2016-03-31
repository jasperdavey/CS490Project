<?php

    $status = 200;

    $sql = sprintf( "SELECT * FROM Users WHERE email = '%s'",
                     mysql_real_escape_string( $result->email )
    );

    $result = mysql_query($sql, $connection);

	// Debug query in case of error
	if ( !$result )
    {
		$message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack();
	}

    // Case if given wrong username
	if ( mysql_num_rows( $result ) == 0 )
    {
		$status = 404;
	}

    // If username found, check if password given is password on database
    $id = 0;
    while ( $row = mysql_fetch_assoc( $result ) )
    {
		if( $row[ 'password' ] != $result->password ) { $status = 304; }
		else { $status = 200; }
        $id = $row[ 'id' ];
	}

    reportBack( $status, $id );

    function reportBack( $status, $id )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'id' => $id );
        $status_json = json_encode( $status_array );

        echo "$status_json";
    }

 ?>
