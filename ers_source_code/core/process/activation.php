<?php 
require('../config.php');

$active_key = $_GET['confirmation_key'];

$check_sql = "SELECT * FROM `users` WHERE confirmation_key = '$active_key'";

$query = mysqli_query( $connection, $check_sql ) or die( mysqli_error( $connection ));

$row = mysqli_num_rows( $query );

if ( $row == 1 ) 
{	
	$active_row = mysqli_fetch_assoc( $query ) or die( mysqli_error( $connection ));
	if ( $active_row['stuts'] == 0 ) 
	{
		$update = "UPDATE users SET status = 1 WHERE confirmation_key = '$active_key'";
		$up_query = mysqli_query( $connection, $update );

		if ( $up_query ) 
		{
			$update_em = "UPDATE users SET confirmation_key = NULL WHERE confirmation_key = '$active_key'";
		    $up_query_em = mysqli_query( $connection, $update_em );
			echo "Now you are Registred Member";
		}
		else
		{
			echo "Please Try with valid Activation Key for details check your mail";
		}

	}
}
else
{
	echo "Please Try with valid Activation Key for details check your mail";
}

?>