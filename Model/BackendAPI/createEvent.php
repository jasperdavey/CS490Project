<?php

    $defaultImage = 'http://web.njit.edu/~jmd57/default.jpg';
    $status = 200;

    $sql = sprintf( "INSERT INTO Events ( name, image, bio, dateAndTime, location, tags )
            VALUES ( '%s', '%s', '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->name ),
            mysql_real_escape_string( $result->image ); mysql_real_escape_string( $result->bio ),
            mysql_real_escape_string( $result->dateAndTime ), mysql_real_escape_string( $result->location ),
            mysql_real_escape_string( $result->tags )

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
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $status_json );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_exec( $ch );
	curl_close( $ch );

 ?>
