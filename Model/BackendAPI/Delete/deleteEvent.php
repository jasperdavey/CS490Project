<?php
    $status = 200;
    $owner = "";
    $userCreatedEvents = [ ];
    $templist = [ ];

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

    while ( $row = mysql_fetch_assoc( $event ) )
    {
        $owner = $row[ 'owner' ];
    }

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