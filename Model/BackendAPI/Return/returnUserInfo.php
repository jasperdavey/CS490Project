<?php

    // Author: Jasper Davey
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
        reportBack( $status, $info = "NULL" );
    }

    // Query Tags
    $sql = sprintf( "SELECT * FROM Tags WHERE owner = '%s' AND type = '%s'", mysql_real_escape_string( $result->id ),
                     mysql_real_escape_string( 0 )
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
        array_push( $userTags, array( 'id' => $row[ 'id' ], 'owner' => $row[ 'onwer' ], 'tag' => $row[ 'tag' ], 'nice' => $row[ 'nice' ],
                                'type' => $row[ 'type' ]
        ) );
    }

    while ( $row = mysql_fetch_assoc( $userInfo ) )
    {
        $infoArray = array( 'id' => $row[ 'id' ], 'email' => $row[ 'email' ], 'username' => $row[ 'username' ],
                            'firstname' => $row[ 'firstname' ],
                            'lastname' => $row[ 'lastname' ], 'bio' => $row[ 'bio' ], 'image' => $row[ 'image' ],
                            'events' => $row[ 'events' ], 'friends' => $row[ 'friends' ], 'tags' => $userTags
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
