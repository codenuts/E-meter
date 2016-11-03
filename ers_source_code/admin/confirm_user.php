<?php
 require( "../core/config.php" );

$id = $_GET['id'];
$status = $_GET['status'];
if ( $status == 0 ) {
	
	$update_sql = "UPDATE `users` SET status = 1 WHERE user_id = '$id'";
	$query = mysqli_query( $connection, $update_sql ) or die( mysqli_error( $connection ));
	if ( $query ) {		
		header( "location: user_list.php" );
	}
}
else
	{
		$update_sql = "UPDATE `users` SET status = 0 WHERE user_id = '$id'";
		$query = mysqli_query( $connection, $update_sql ) or die( mysqli_error( $connection ));
		if ( $query ) {		
			header( "location: user_list.php" );
		}
	}


 ?>