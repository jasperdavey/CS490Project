<?php

    // Input: initiatorID, targetID
    // Output: 200 if successful, 304 if already added, 404 if error
    $status = 200;
    $friendlist = [ ];
    $pendingFriendRequests = [ ];

    // Get user information
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->targetID ) );
    echo "$sql";
    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
		$message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status );
	}
    /*
    // Explode User's friendlist
    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $friendlist = explode( ",", $row[ 'friends' ] );
        $pendingFriendRequests = explode( ",", $row[ 'pendingFriendRequests' ] );
    }

    // Check if initiatorID already has requested this person
    if ( in_array( $result->initiatorID, $friendlist, true ) || in_array( $result->initiatorID, $pendingFriendRequests, true ) )
    {
        $status = 304;
        reportBack( $status );
    }
    else
    {
        array_push( $pendingFriendRequests, $result->initiatorID );

        $sql = sprintf( "UPDATE Users SET pendingFriendRequests = '%s'
                         WHERE id = '%s'", mysql_real_escape_string( implode( $pendingFriendRequests ) ),
                         mysql_real_escape_string( $result->targetID )
        );

        if ( !mysql_query( $sql, $connection ) )
        {
    		$message = 'Invalid query: ' . mysql_error( ) . "\n";
    		$message .= 'Whole query: ' . $sql;
    		print( $message );
            $status = 404;
            reportBack( $status );
    	}
    }
    */
    reportBack( $status );
    function reportBack( $status )
    {
        // Return Results
        $status_array = array( 'status' => $status );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }
 ?>
