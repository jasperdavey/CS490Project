<?php
    // Author: Jasper Davey
    // event, id
    $status = 200;
    $templist = [ ];
    $userEvents = [ ];

    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    $user = mysql_query( $sql, $connection );

    while ( !$user )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $user ) )
    {
        $userEvents = explode( ",", $row[ 'events' ] );
    }

    foreach ( $userEvents as $singleEvent )
    {
        if ( $singleEvent != $result->event )
        {
            array_push( $templist, $singleEvent );
        }
    }

    $templist = implode( ",", $templist );
    if ( $templist[ 0 ] == "," )
    {
        $templist = substr( $templist, 1 );
    }

    $sql = sprintf( "UPDATE Users SET events = '%s' WHERE id = '%s'", mysql_real_escape_string( $templist ),
                     mysql_real_escape_string( $result->id )
    );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    $attendees = [ ];
    $newtemplist = [ ];

    $sql = sprintf( "SELECT * FROM Events WHERE id = '%s'", mysql_real_escape_string( $result->event ) );

    $event = mysql_query( $sql, $connection );

    while ( !$event )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    while ( $row = mysql_fetch_assoc( $event ) )
    {
        $attendees = explode( ",", $row[ 'attendees' ] );
    }

    foreach ( $attendees as $singleAttendee )
    {
        if ( $singleAttendee != $result->id )
        {
            array_push( $newtemplist, $singleAttendee );
        }
    }

    $newtemplist = implode( ",", $newtemplist );
    if ( $newtemplist[ 0 ] == "," )
    {
        $newtemplist = substr( $newtemplist, 1 );
    }

    $sql = sprintf( "UPDATE Events SET attendees = '%s' WHERE id = '%s'", mysql_real_escape_string( $newtemplist ),
                     mysql_real_escape_string( $result->event )
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
