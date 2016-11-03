<?php 
require('../config.php');
if ( isset( $_POST['uppfassword'])) 
{
	
	$cur_passwordpassword =  $_POST['password'];
	$newpassword =  $_POST['newpassword'];
	$conpassword =  $_POST['conpassword'];
	$password_len = strlen( $password );
    $confirmpassword_len = strlen( $con_password );   
    
           
	try {
		if( empty( $cur_passwordpassword )){
		
		throw new Exception( "Please Enter your current password", 1 ); 
		}
		if( empty( $newpassword )){
			throw new Exception( "Please enter your new password", 1 );
		}
		if( empty( $conpassword )){
			throw new Exception( "Please enter your confirm password", 1 );
		}
		if ( $password_len < 6 ) {
		    throw new Exception( "Password will be min 6 digit", 1 );                        
		}
		if ( $newpassword <> $conpassword ) {
		    throw new Exception( "Your password Mismatch", 1 );                        
		}
		

	} catch (Exception $e) {
		header("Location: ../../public/changepassword.php");
		$error_message = $e->getMessage();
		$_SESSION['e'] = $error_message; 
	}
}
?>