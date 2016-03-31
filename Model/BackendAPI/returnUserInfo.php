<?php

    // Input: id
    // Output: status, info

    $status = 200;
    $infoArray = [ ];
    $userTags = [ ];

    // Query Users
    $sql = sprintf( "SELECT * FROM Users WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    $userInfo = mysql_query( $sql, $connection );

    if ( !$userInfo )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack();
    }

    // Query Tags
    $sql = sprintf( "SELECT * FROM Tags WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    $tags = mysql_query( $sql, $connection );

    if ( !$tags )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack();
    }

    while ( $row = mysql_fetch_assoc( $tags ) )
    {
        $userTags = array_push( 'id' => $row[ 'id' ], 'tag' => $row[ 'tag' ], 'nice' => $row[ 'nice' ],
                                'type' => $row[ 'type' ]
        );
    }

    while ( $row = mysql_fetch_assoc( $userInfo ) )
    {
        $infoArray = array( 'id' => $row[ 'id' ], 'email' => $row[ 'email' ], 'firstname' => $row[ 'firstname' ],
                            'lastname' => $row[ 'lastname' ], 'bio' => $row[ 'bio' ], 'image' => $row[ 'image' ],
                            'events' => $row[ 'events' ], 'friends' => $row[ 'friends' ], 'tags' => $userTags
        );
    }


    function reportBack( )
    {
        // Return Results
        $status_array = array( 'status' => $status, 'info' => $infoArray );
        $status_json = json_encode( $status_array );

        die( "$status_json" );
    }
 ?>
