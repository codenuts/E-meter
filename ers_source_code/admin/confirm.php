<?php
 require( "../core/config.php" );
 require( TEMPLATE_BACK.DS."header.php" ); 
 require( TEMPLATE_BACK.DS."side-nav.php" ); 

$id = $_POST['id'];
$status = $_POST['status'];
$card = $_POST['card'];
$userid = $_POST['userid'];

$get_id = $_GET['id'];
$get_status = $_GET['status'];


if ( $get_status == 0 ) 
{
	
	$update_sql = "UPDATE `unit_order` SET status = 1 WHERE id = '$id'";
	$query = mysqli_query( $connection, $update_sql ) or die( mysqli_error( $connection ));
	if ( $query ) {		

		$user_sql = "SELECT * FROM `users` WHERE user_id = '$userid'";
		$user_query = mysqli_query( $connection, $user_sql ) or die( mysqli_error( $connection ));

		$user_row = mysqli_fetch_assoc( $user_query );
		$codemail = $user_row['email'];
		$phone = $user_row['phone'];

		$to = "$codemail";
		$subject = "Recharge number";
		$message = "This is your recharge number = " .$card;

		$from = "info@googletheme.com";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		// make this part dynamic

		$userMobile = "88".$phone;
		$message = "This is your recharge number = " .$card;

		if ( isset( $_POST['cardbutton'])) {
			
		
		?>
		 <script type="text/javascript">
		 function sendSMS() {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {		    
		    if (xhttp.readyState == 4 && xhttp.status == 200) {
		      alert("Message Sent");
		    }
		  };
		  
		  xhttp.open("GET", "http://66.45.237.70/api.php?username=rubelbd&password=RQA8NPSM&number=<?php echo $userMobile; ?>&sender=ERS&type=0&message=<?php echo $message; ?>", true);
		  xhttp.send();
		}

		sendSMS();
		 </script>

		<section id="main-content">
		    <section class="wrapper site-min-height text-center">
		 	<h2 class="text-center">Process Completed</h2>
		 	<p>
		 		<a href="order_list.php" class="btn btn-primary">Back Order List</a>
		 	</p>		    	
		    </section>
		</section>

		 <?php 
	}
		// header( "location: order_list.php" );
		}
}
		else
		{
		$update_sql = "UPDATE `unit_order` SET status = 0 WHERE id = '$get_id'";
		$query = mysqli_query( $connection, $update_sql ) or die( mysqli_error( $connection ));
		if ( $query ) {		
			header( "location: order_list.php" );
		}
		}





  ?>
<?php require( TEMPLATE_BACK.DS."footer.php" ) ?>
