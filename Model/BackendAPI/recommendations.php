<?php

    // Query

    $status = 200;
    $tagsArray = [ ];
    $events = [ ];
    $eventsArray = [ ];

    // Query User Tags
    $sql = sprintf( "SELECT * FROM Tags WHERE id = '%s' AND type = '%s'", mysql_real_escape_string( $result->id ),
                     mysql_real_escape_string( 0 )
    );

    $tags = mysql_query( $sql, $connection );

    if ( !$tags )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $blank = "NULL", $blank = "NULL", $blank = "NULL", $blank = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $tags ) )
    {
        $tagsArray = array( 'tag' => $row[ 'tag' ], 'nice' => $row[ 'nice' ] );
    }

    // Query User Events
    $sql = sprintf( "SELECT * FROM Users where id = '%s'", mysql_real_escape_string( $result->id ) );

    $userEvents = mysql_query( $sql, $connection );

    if ( !$userEvents )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status, $blank = "NULL", $blank = "NULL", $blank = "NULL", $blank = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $userEvents ) )
    {
        $events = explode( ",", $row[ 'events' ] );
    }

    // Query Events
    foreach ( $events as $singleEvent )
    {
        $sql = sprintf( "SELECT * FROM Events INNER JOIN Tags ON Events.id = Tags.id AND Tags.tag = '%s' AND Tags.type = '%s'",
                         mysql_real_escape_string( $singleEvent ), mysql_real_escape_string( 1 )
        );



        $allEvents = mysql_query( $sql, $connection );


        if ( !$allEvents )
        {
            $message = 'Invalid query: ' . mysql_error( ) . "\n";
    		$message .= 'Whole query: ' . $sql;
    		print( $message );
            $status = 404;
            reportBack( $status, $blank = "NULL", $blank = "NULL", $blank = "NULL", $blank = "NULL" );
        }

        while ( $row = mysql_fetch_assoc( $allEvents ) )
        {
            $eventsArray = array( $row[ 'events' ] );
        }
    }


    //$tags = json_encode( $tagsArray );
    //$events = json_encode( $events );
    //$eventsArray = json_encode( $eventsArray );

    reportBack( $status, $id="NULL", $tagsArray="NULL", $events="NULL", $eventsArray="NULL" );


    function reportBack( $status, $id, $tags, $events, $userEvents )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'id' => $id, 'tags' => $tags, 'events' => $events, 'userEvents' => $userEvents );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }


 ?>
