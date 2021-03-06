<?php
    // Author: Jasper Davey
    // Input initiatorID, targetID
    // This scripts assumes user in pendingFriendRequests
    $status = 200;

    $friendlist = [ ];
    $pendingFriendRequests = [ ];
    $templist = [ ];
    $initiatorIDFriendList = [ ];

    // get targetID information
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->targetID ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Explode User's friendlist
    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $friendlist = explode( ",", $row[ 'friends' ] );
        $pendingFriendRequests = explode( ",", $row[ 'pendingFriendRequests' ] );
    }

    // Add initiatorID to targetID's friendlist
    array_push( $friendlist, $result->initiatorID );

    // Remove initiatorID from pendingFriendRequests
    foreach ( $pendingFriendRequests as $singleFriend )
    {
        if ( $singleFriend != $result->initiatorID )
        {
            array_push( $templist, $singleFriend );
        }
    }

    // Update targetID
    $friendlist = implode( ",", $friendlist );
    if ( $friendlist[ 0 ] == "," )
    {
        $friendlist = substr( $friendlist, 1 );
    }
    $templist = implode( ",", $templist );
    if ( $templist[ 0 ] == "," )
    {
        $templist = substr( $templist, 1 );
    }

    $sql = sprintf( "UPDATE Users SET friends = '%s', pendingFriendRequests = '%s' WHERE id = '%s'",
                     mysql_real_escape_string( $friendlist ), mysql_real_escape_string( $templist ),
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


    // initiatorID
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->initiatorID ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Explode User's friendlist
    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $initiatorIDFriendList = explode( ",", $row[ 'friends' ] );
    }

    array_push( $initiatorIDFriendList, $result->targetID );

    // Update initiatorID
    $initiatorIDFriendList = implode( ",", $initiatorIDFriendList );
    if ( $initiatorIDFriendList[ 0 ] == "," )
    {
        $initiatorIDFriendList = substr( $initiatorIDFriendList, 1 );
    }

    $sql = sprintf( "UPDATE Users SET friends = '%s' WHERE id = '%s'",
                     mysql_real_escape_string( $initiatorIDFriendList ),
                     mysql_real_escape_string( $result->initiatorID )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
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
