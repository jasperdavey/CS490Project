<?php
    $status = 200;
    $owner = "null";
    $userCreatedEvents = [ ];
    $templist = [ ];
    $attendees = [ ];
    $events = [ ];

    // Get event details
    $sql = sprintf( "SELECT * FROM Events WHERE id = '%s'", mysql_real_escape_string( $result->id ) );
    $event = mysql_query( $sql, $connection );

    if ( !$event )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Get owner of the event
    while ( $row = mysql_fetch_assoc( $event ) )
    {
        $owner = $row[ 'owner' ];
        $attendees = explode( ",", $row[ 'attendees' ] );
    }

    // Get the owner's createdEvents list
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $owner ) );
    $user = mysql_query( $sql, $connection );

    if ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $userCreatedEvents = explode( ",", $row[ 'createdEvents' ] );
    }

    foreach ( $userCreatedEvents as $singleCreatedEvent )
    {
        if ( $singleCreatedEvent != $result->id )
        {
            array_push( $templist, $singleCreatedEvent );
        }
    }

    $templist = implode( ",", $templist );
    if ( $templist[ 0 ] == "," )
    {
        $templist = substr( $templist, 1 );
    }

    $sql = sprintf( "UPDATE Users SET createdEvents = '%s' WHERE id = '%s'", mysql_real_escape_string( $templist ),
                     mysql_real_escape_string( $owner )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Remove event from ALL attendees
    foreach ( $attendees as $singleAttendee )
    {
        echo "here";
        $newtemplist = [ ];
        $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $singleAttendee ) );
        $user = mysql_query( $sql, $connection );

        if ( !$user )
        {
            $message = 'Invalid query: ' . mysql_error( ) . "\n";
            $message .= 'Whole query: ' . $sql;
            print( $message );
            $status = 404;
            reportBack( $status );
        }

        while ( $row = mysql_fetch_assoc( $user ) )
        {
            $events = explode( ",", $row[ 'events' ] );
        }

        foreach ( $events as $singleEvent )
        {
            if ( $singleEvent != $result->id )
            {
                array_push( $newtemplist, $singleEvent );
            }
        }

        $newtemplist = implode( ",", $newtemplist );
        if ( $newtemplist[ 0 ] == "," )
        {
            $newtemplist = substr( $newtemplist, 1 );
        }

        $sql = sprintf( "UPDATE Users SET events = '%s' WHERE id = '%s'", mysql_real_escape_string( $newtemplist ),
                         mysql_real_escape_string( $singleAttendee )
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


    // Remove the event
    $sql = sprintf( "DELETE From Events WHERE id = '%s'", mysql_real_escape_string( $result->id ) );
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
