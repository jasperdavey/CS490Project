<?php
    // Author: Jasper Davey
    // Input: none
    $status = 200;
    $events = [ ];

    $sql = sprintf( "SELECT id FROM Events" );

    $allEvents = mysql_query( $sql, $connection );

    if ( !$allEvents )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $allEvents ) )
    {
        array_push( $events, explode( ",", $row[ 'id' ] ) );
    }

    reportBack( $status, $events );

    function reportBack( $status, $info )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $info );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }

 ?>
