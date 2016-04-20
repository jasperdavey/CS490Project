<?php
    $status = 200;
    $eventTags = [ ];

    $sql = sprintf( "SELECT * FROM Events WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    $eventInfo = mysql_query( $sql, $connection );

    if ( !$eventInfo )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    // Query Tags
    $sql = sprintf( "SELECT * FROM Tags WHERE owner = '%s' AND type = '%s'", mysql_real_escape_string( $result->id ),
                     mysql_real_escape_string( 1 )
    );

    $tags = mysql_query( $sql, $connection );

    if ( !$tags )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $tags ) )
    {
        array_push( $eventTags, array( 'id' => $row[ 'id' ], 'owner' => $row[ 'owner' ], 'tag' => $row[ 'tag' ], 'nice' => $row[ 'nice' ],
                                'type' => $row[ 'type' ]
        ) );
    }

    while ( $row = mysql_fetch_assoc( $eventInfo ) )
    {
        $infoArray = array( 'id' => $row[ 'id' ], 'name' => $row[ 'name' ], 'owner' => $row[ 'owner' ],
                            'image' => $row[ 'image' ],
                            'bio' => $row[ 'bio' ], 'startDateTime' => $row[ 'startDateTime' ], 'endDateTime' => $row[ 'endDateTime' ],
                            'location' => $row[ 'location' ], 'attendees' => $row[ 'attendees' ], 'tags' => $eventTags
        );
    }

    reportBack( $status, $infoArray );


    function reportBack( $status, $info )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $info );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }

 ?>
