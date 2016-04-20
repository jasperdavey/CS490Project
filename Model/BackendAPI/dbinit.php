<?php
    // Author: Jasper Davey

    $databaseName = "jmd57";
    $serverName = 'sql1.njit.edu';
    $userName = 'jmd57';
    $password = 'owypHuH4g';

    // create connection
    $connection = mysql_connect( $serverName, $userName, $password );
    if ( !$connection )
    {
        die(' Could not connect: ' . mysql_error( ) );
    }

    // select database
    if ( !mysql_select_db( $databaseName, $connection) )
    {
        die( 'Could not select database' );
    }

    // create Users table
    $sql = "CREATE TABLE Users ( id INT( 6 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                 email VARCHAR( 50 ) NOT NULL,
                                 password VARCHAR( 50 ) NOT NULL,
                                 username VARCHAR( 50 ) NOT NULL,
                                 firstname VARCHAR( 50 ),
                                 lastname VARCHAR( 50 ),
                                 bio VARCHAR( 1000 ),
                                 image VARCHAR( 1000 ) NOT NULL,
                                 events VARCHAR( 10000 ),
                                 friends VARCHAR( 10000 ),
                                 pendingFriendRequests VARCHAR( 10000 ),
                                 createdEvents VARCHAR( 10000 )
    )";

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		die( $message );
    }

    // create Events table
    $sql = "CREATE TABLE Events ( id INT( 6 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  name VARCHAR( 50 ) NOT NULL,
                                  owner VARCHAR( 1000 ) NOT NULL,
                                  image VARCHAR( 1000 ) NOT NULL,
                                  bio VARCHAR( 1000 ) NOT NULL,
                                  startDateTime DATETIME NOT NULL,
                                  endDateTime DATETIME NOT NULL,
                                  location VARCHAR( 1000 ) NOT NULL,
                                  attendees VARCHAR( 10000 )
    )";

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		die( $message );
    }

    // create Comments table
    $sql = "CREATE TABLE Comments ( id INT( 6 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    user VARCHAR( 50 ) NOT NULL,
                                    event INT ( 6 ) NOT NULL,
                                    datePosted DATE NOT NULL,
                                    comment VARCHAR( 10000 ) NOT NULL
    )";

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		die( $message );
    }

    $sql = "CREATE TABLE Tags( id INT( 6 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                               owner INT( 6 ) NOT NULL,
                               tag VARCHAR( 50 ) NOT NULL,
                               nice INT( 6 ) NOT NULL,
                               type INT( 1 ) NOT NULL,
                               CONSTRAINT
    )";

    if ( !mysql_query( $sql, $connection ) )
    {
        $message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		die( $message );
    }

    $connection->close();
 ?>
