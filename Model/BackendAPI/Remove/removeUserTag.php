<?php
    $status = 200;

    $sql = sprintf( "DELETE FROM Tags WHERE owner = '%s' AND type = '%s' AND tag = '%s'", mysql_real_escape_string( $result->id ),
                     mysql_real_escape_string( 0 ), mysql_real_escape_string( $result->tag )
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
