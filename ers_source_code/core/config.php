<?php 
 ob_start();
 session_start();
 // session_destroy();

 defined( "DS" ) ? null : define( "DS", DIRECTORY_SEPARATOR );
 defined( "TEMPLATE_FORNT" ) ? null : define( "TEMPLATE_FORNT", __DIR__. DS . "templates/fornt" );
 defined( "TEMPLATE_BACK" ) ? null : define( "TEMPLATE_BACK", __DIR__. DS . "templates/back" );

 defined( "HOST" ) ? null : define( "HOST", "localhost" );
 defined( "USER" ) ? null : define( "USER", "googleth_rk" );
 defined( "PASSWORD" ) ? null : define( "PASSWORD", "RonyKader@0" );
 defined( "DATABASE" ) ? null : define( "DATABASE", "googleth_ers" );

 $connection = mysqli_connect( HOST,USER,PASSWORD,DATABASE ) or die(mysqli_error( $connection ) );
 require( "process/functions.php" );

 ?>