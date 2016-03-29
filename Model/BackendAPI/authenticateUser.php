<?php

    $status = 200;

    $sql = sprintf( "SELECT * FROM Users WHERE email = '%s'",
                     mysql_real_escape_string( $result->email )
    );

    $result = mysql_query($sql, $connection);

	// Debug query in case of error
	if ( !result )
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
	while ( $row = mysql_fetch_assoc( $result ) )
    {
		if( $row[ 'password' ] != $result->password ) { $status = 304; }
		else { $status = 200; }
	}

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
