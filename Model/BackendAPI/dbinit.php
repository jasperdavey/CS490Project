<?php

    $databaseName = "NJITEventsApp";
    $serverName = 'sql1.njit.edu';
    $userName = 'jmd57';
    $password = 'owypHuH4g';

    // create connection
    $connection = mysql_connect( $serverName, $userName, $password );
    if ( !$connection )
    {
        die(' Could not connect: ' . mysql_error( ) );
    }

    // create database
    $sql = "CREATE DATABASE $databaseName";
    if ( !mysql_query( $sql, $connection ) )
    {
        die( 'Could not create database ' . mysql_error( ) );
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
                                 firstname VARCHAR( 50 ) NOT NULL,
                                 lastname VARCHAR( 50 ) NOT NULL,
                                 bio VARCHAR( 1000 ),
                                 image VARCHAR( 1000 ) NOT NULL,
                                 events VARCHAR( 10000 ),
                                 friends VARCHAR( 10000 ),
                                 tags VARCHAR( 10000 )
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
                                  image VARCHAR( 1000 ) NOT NULL,
                                  bio VARCHAR( 1000 ) NOT NULL,
                                  dateAndTime VARCHAR( 1000 ) NOT NULL,
                                  location VARCHAR( 1000 ) NOT NULL,
                                  tags VARCHAR( 10000 )
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

    $connection->close();
 ?>
