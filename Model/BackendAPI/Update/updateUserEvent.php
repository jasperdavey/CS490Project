<?php
    // Author: Jasper Davey
    // event, id
    $status = 200;
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

    array_push( $userEvents, $result->event );

    $userEvents = implode( ",", $userEvents );
    if ( $userEvents[ 0 ] == "," )
    {
        $userEvents = substr( $userEvents, 1 );
    }

    $sql = sprintf( "UPDATE Users SET events = '%s' WHERE id = '%s'", mysql_real_escape_string( $userEvents ),
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

    array_push( $attendees, $result->id );

    $attendees = implode( ",", $attendees );
    if ( $attendees[ 0 ] == "," )
    {
        $attendees = substr( $attendees, 1 );
    }

    $sql = sprintf( "UPDATE Events SET attendees = '%s' WHERE id = '%s'", mysql_real_escape_string( $attendees ),
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
