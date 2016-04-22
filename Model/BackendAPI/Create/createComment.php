<?php
    // Author: Jasper Davey
    $status = 200;

    $today = date( "Y-m-d H:i:s" );

    $sql = sprintf( "INSERT INTO Comments ( owner, event, datePosted, comment )
                     VALUES ( '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->owner ),
                     mysql_real_escape_string( $result->event ), mysql_real_escape_string( $today ),
                     mysql_real_escape_string( $result->comment )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status );
    }

    reportBack( $status );
    function reportBack( $status )
    {
        // Return Results
        $status_array = array( 'status' => $status );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }

 ?>
