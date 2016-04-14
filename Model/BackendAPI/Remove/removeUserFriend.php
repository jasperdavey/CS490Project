<?php
    $status = 200;
    $userFriends = [ ];
    $templist = [ ];

    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->initiatorID ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $userFriends = explode( ",", $row[ 'friends' ] );
    }

    foreach ( $userFriends as $singleFriend )
    {
        if ( $singleFriend != $result->targetID )
        {
            array_push( $templist, $singleFriend );
        }
    }

    $sql = sprintf( "UPDATE Users SET friends = '%s' WHERE id = '%s'", mysql_real_escape_string( implode( $templist ) ),
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

    $newtemplist = [ ];
    $newUserFriends = [ ];

    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->targetID ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $newUserFriends = explode( ",", $row[ 'friends' ] );
    }

    foreach ( $newUserFriends as $singleFriend )
    {
        if ( $singleFriend != $result->initiatorID )
        {
            array_push( $newtemplist, $singleFriend );
        }
    }

    $sql = sprintf( "UPDATE Users SET friends = '%s' WHERE id = '%s'", mysql_real_escape_string( implode( $newtemplist ) ),
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

    reportBack( $status );
    function reportBack( $status )
    {
        // Return Results
        $status_array = array( 'status' => $status );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }


 ?>
