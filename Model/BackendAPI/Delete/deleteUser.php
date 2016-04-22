<?php
    // Author: Jasper Davey
    $status = 200;

    $sql = sprintf( "DELETE From Users WHERE id = '%s'", mysql_real_escape_string( $result->id ) );

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error( ) . "\n";
        $message .= 'Whole query: ' . $sql;
        print( $message );
        $status = 404;
        reportBack( $status );
    }

    // Delete tags associated with user
    $sql = sprintf( "DELETE FROM Tags WHERE owner = '%s' and type = '%s'", mysql_real_escape_string( $result->id ),
                     mysql_real_escape_string( 0 )
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
