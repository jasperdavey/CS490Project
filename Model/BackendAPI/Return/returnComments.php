<?php
    // Author: Jasper Davey
    $status = 200;
    $allComments = [ ];

    $sql = sprintf( "SELECT * FROM Comments WHERE event = '%s'", mysql_real_escape_string( $result->event ) );

    $comments = mysql_query( $sql, $connection );

    if ( !$comments )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status, $info = "NULL" );
    }

    while ( $row = mysql_fetch_assoc( $comments ) )
    {
        array_push( $allComments, array( 'id' => $row[ 'id' ], 'owner' => $row[ 'owner' ], 'event' => $row[ 'event' ], 'datePosted' => $row[ 'datePosted' ],
                                'comment' => $row[ 'comment' ]
        ) );
    }

    reportBack( $status, $allComments );
    function reportBack( $status, $info )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $info );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }


 ?>
