<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Europe/Berlin" );  // http://www.php.net/manual/en/timezones.php

define( "DB_DSN", "mysql:host=localhost;dbname=public" );
define( "DB_USERNAME", "nino" );
define( "DB_PASSWORD", "*********" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ALBUMS", 5 );
define( "HOMEPAGE_NUM_SONGS", 10 );

require( CLASS_PATH . "/album.php" );
require( CLASS_PATH . "/song.php" );
require( CLASS_PATH . "/account.php" );

function handleException( $exception ) {
    echo "Sorry, a problem occurred. Please try later.";
    error_log( $exception->getMessage() );
}

set_exception_handler( 'handleException' );
?>