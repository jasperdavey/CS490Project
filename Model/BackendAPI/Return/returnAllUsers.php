<?php
    // Author: Jasper Davey
    // Input: none
    $status = 200;
    $userIDs = [ ];

    $sql = sprintf( "SELECT id FROM Users" );

    $allUsers = mysql_query( $sql, $connection );

    if ( !$allUsers )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $allUsers ) )
    {
        array_push( $userIDs, explode( ",", $row[ 'id' ] ) );
    }

    reportBack( $status, $userIDs );

    function reportBack( $status, $info )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $info );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }

 ?>
