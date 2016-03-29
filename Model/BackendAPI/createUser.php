<?php

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    $sql = sprintf( "INSERT INTO Users ( email, password, firstname, lastname, bio, image, events, friends, tags )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", mysql_real_escape_string( $result->email ),
            mysql_real_escape_string( $result->password ), mysql_real_escape_string( $result->firstname ),
            mysql_real_escape_string( $result->lastname ), mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $defaultImage ), mysql_real_escape_string( $result->events ),
            mysql_real_escape_string( $result->friends ), mysql_real_escape_string( $result->tags )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
    }

    // Upload image

    // Return Results
    $status_array = array( 'status' => $status );
    $status_json = json_encode( $status_array );

    $reponseURL =
	"https://web.njit.edu/~aml35/login/reportingBackToFrontEnd.php";
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $responseURL );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $status_json );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_exec( $ch );
	curl_close( $ch );

 ?>
