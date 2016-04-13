<?php
    // Author: Jasper Davey
    // Input: id, tag
    // Output: status

    $status = 200;

    // get User's tags
    $sql = sprintf( "SELECT * FROM Tags WHERE id = '%s' AND tag = '%s' and type = '%s'", mysql_real_escape_string ( $result->id ),
                     mysql_real_escape_string( $result->tag ), mysql_real_escape_string( 0 )
    );

    $userTags = mysql_query( $sql, $connection );

    if ( !$userTags )
    {
		$message = 'Invalid query: ' . mysql_error( ) . "\n";
		$message .= 'Whole query: ' . $sql;
		print( $message );
        $status = 404;
        reportBack( $status );
	}


    $tagNiceValue = 0;
    $id = 0;

    // Case tags doesnt exist
	if ( mysql_num_rows( $userTags ) == 0 )
    {
        $tagNiceValue = 1;
        $sql = sprintf( "INSERT INTO Tags ( id, tag, nice, type )
                         VALUES ( '%s', '%s', '%s', '%s' )", mysql_real_escape_string( $result->id ),
                         mysql_real_escape_string( $result->tag ), mysql_real_escape_string( $tagNiceValue ),
                         mysql_real_escape_string( 0 )
        );
	}
    else
    {
        while ( ( $row = mysql_fetch_assoc( $userTags ) ) )
        {
            $tagNiceValue = $row[ 'nice' ] + 1;
            $id = $row[ 'id' ];
        }

        $sql = sprintf( "UPDATE Tags SET nice = '%s' WHERE id = '%s'", mysql_real_escape_string( $tagNiceValue ),
                         mysql_real_escape_string( $id )
        );
    }

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
