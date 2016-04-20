<?php
    $status = 200;
    $userFriends = [ ];
    $userFriendsArray = [ ];

    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        array_push( $userFriends, explode( ",", $row[ 'friends' ] ) );
    }


    foreach ( $userFriends as $singleFriend )
    {
        echo $singleFriend;
        $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $singleFriend ) );
        $friend = mysql_query( $sql, $connection );
        if ( !$friend )
        {
            $message = 'Invalid query: ' . mysql_error( ) . "\n";
    		$message .= 'Whole query: ' . $sql;
    		print( $message );
            $status = 404;
            reportBack( $status, $info = "NULL" );
        }

        while ( $row = mysql_fetch_assoc( $friend ) )
        {
            array_push( $userFriendsArray, explode( ",", $row[ 'events' ] ) );
        }

    }

    reportBack( $status, $userFriendsArray );

    function reportBack( $status, $info )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $info );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }


 ?>
