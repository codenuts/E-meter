<?php 
require( "../core/config.php" );
$user_id = $_GET['id'];

$user_delete = "DELETE FROM `users` WHERE user_id = '$user_id'";
$de_query = mysqli_query( $connection, $user_delete ) or die( mysqli_error( $connection ));

if ( $de_query ) {
	
	header( "Location: user_list.php?delmsg=User delete sucessfully" );
}
else{
	header( "Location: user_list.php?delmsg=Please try again" );
}

 ?>