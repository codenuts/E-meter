<?php $title = "Register"; require( '../core/config.php' ); ?>
<?php require( TEMPLATE_FORNT.DS. 'header.php' ); ?>	
<section id="ts-features" class="ts-features">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="intro">
						<h2 class="intro-title">
							<i class="fa fa-home"></i> Welcome to PDB
							<span class="title-head">We are Providing Online E-meter Recharge System</span>
						</h2>
						<p class="intro-text"> Now you can recharge your e-meter from this website. We will provide you the token number via SMS system. All you have to do is to register yourself for only once from this website. Remember, while you register you have to provide an active e-mail address. After completing registration you will receive an e-mail and you have to confirm your registration by clicking the link sent to your e-mail. 
                        After you finish the registration procedure you are good to go. Log in from the website with your e-mail id and password. BKash the money you want to buy unit to the below BKash number. Then click on the 'Recharge' tab. Provide the information and click recharge. Then wait for the confirmation. A SMS will be sent to your provided mobile number with your token number. *BKash Charge required (You have to pay BDT 10 taka for per BDT 500 taka transaction)</p>
					</div><!-- Intro end -->

					
				</div><!-- Col end -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                <?php 
                if ( $_SESSION['status'] == 1 ) {
                        header( 'location: myaccount.php' );
                    }
                    if ( $_SESSION['status'] == 2 ) {
                        header( 'location: ../admin/order_list.php' );
                    }


                       if ( isset( $_POST['reg_form'] )) {
                                       extract( $_POST );
                                       try {

                                           if ( empty( $meter_number )) {
                                               throw new Exception( "Meter Number can't be empty", 1);                        
                                           } 

                                          if ( empty( $email )) {
                                               throw new Exception( "Email can't be empty", 1);                        
                                           }
                                           if ( !filter_var( $email, FILTER_VALIDATE_EMAIL)) {
                                               throw new Exception( "Please input valid eamil address", 1);                        
                                           }
                                           if ( empty( $phone )) {
                                               throw new Exception( "Phone can't be empty", 1);                        
                                           }


                                           $phone_lent = strlen( $phone );

                                           if ( $phone_lent != 11 ) {
                                               throw new Exception( "Please provide 11 character number", 1);                        
                                           }

                                           if ( empty( $password )) {
                                               throw new Exception( "Password can't be empty", 1);                        
                                           }

                                           $password_len = strlen( $password );
                                           $confirmpassword_len = strlen( $con_password );
                                           
                                           if ( $password_len < 6 ) {
                                               throw new Exception( "Password will be min 6 digit", 1 );                        
                                           }
                                           if ( $password <> $con_password ) {
                                               throw new Exception( "Your password Mismatch", 1 );                        
                                           }
                                           
                                           // DB Query
                                           $meter_number_sql = "SELECT * FROM `users` WHERE meter_number = '$meter_number'";
                                           $meter_numberquery = mysqli_query( $connection, $meter_number_sql );
                                           $meter_numberrow = mysqli_num_rows( $meter_numberquery );

                                           if ( $meter_numberrow == 1 ) {
                                           throw new Exception( "This Meter Number  is already used Please try with another number", 1);                    
                                           }

                                           // DB Query
                                           $accview_sql = "SELECT * FROM `users` WHERE email = '$email'";
                                           $query = mysqli_query( $connection, $accview_sql );
                                           $row = mysqli_num_rows( $query );

                                           if ( $row == 1 ) {
                                           throw new Exception( "This Email address is already used Please try with another email", 1);                    
                                           }



                                           function confirmation_key( $promocode_length ){
                                             $Promocode_Caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                                             $QuantidadeCaracteres = strlen($Promocode_Caracteres); 
                                             $QuantidadeCaracteres--; 


                                               $Hash=NULL; 
                                                   for( $x=1; $x<=$promocode_length; $x++ ){ 

                                                       $Posicao = mt_rand(0,$QuantidadeCaracteres); 
                                                       $Hash .= substr($Promocode_Caracteres,$Posicao,1); 
                                                   } 

                                               return $Hash; 
                                               } 

                                           $confir_key = confirmation_key( 32 );
                                           $passwordcon = md5( $password ); 

                                           // $first_name   = stringClean( $_POST['first_name'] );  
                                           // $last_name    = stringClean( $_POST['last_name'] );  
                                           // $meter_number = stringClean( $_POST['meter_number'] );  
                                           // $email        = stringClean( $_POST['email'] );  
                                           // $phone        = stringClean( $_POST['phone'] );  
                                           // $password     = stringClean( $_POST['password'] );  

                                           $account_sql = "INSERT INTO `users` ( first_name,confirmation_key,last_name,meter_number,email,phone,password) VALUES ( '$first_name','$confir_key','$last_name','$meter_number','$email','$phone','$passwordcon')";
                                           $query = mysqli_query( $connection, $account_sql ) or die( mysqli_error($connection));

                                           if ( $query ) {
                                               $to = "$email";
                                               $subject = "Please Active your Link";
                                               $message = "Hi, in order to activate your account please visit http://googletheme.com/ers/core/process/activation.php?confirmation_key=".$confir_key." and Your Password is " . md5($password);
                                               $from = "info@googletheme.com";
                                               $headers = "From: $from";
                                               mail($to,$subject,$message,$headers);
                                               header("location: login.php?msg="."Please Check your Email address For active your account" );

                                               }                    
                                           } catch (Exception $e) {
                                               $error_message = $e->getMessage();
                                           }
                                       }

                                ?>

                                <?php 
                                    if ( isset( $error_message )) { ?>            
                                        <div class="error-message">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php
                                        
                                    }
                        
                                 ?>
                                 <form class="credentials_form register-form" method="POST" id="registrationOrderForm">
                                   <h1><span><i class="fa fa-user-plus"></i> Register</span></h1>
                                   <ul class="list-unstyled">
                                     <li>
                                       <input class="form-control" type="text" name="first_name" placeholder="FIRST NAME" required="required">
                                       
                                     </li>
                                     <li>
                                       <input class="form-control" type="text" name="last_name" placeholder="LAST NAME" required="required">
                                     </li>

                                     <li>
                                       <input class="form-control" type="text" name="meter_number" placeholder="METER NUMBER *" required="required">
                                     </li>

                                     <li>
                                       <input class="form-control" type="email" name="email" placeholder="E-MAIL ADDRESS *" required="required" >
                                     </li>

                                     <li>
                                       <input class="form-control" type="tel" name="phone" placeholder="PHONE NUMBER *" required="required">
                                     </li>

                                     <li>
                                       <input class="form-control" type="password" name="password" placeholder="ENTER YOUR PASSWORD" required="required">
                                     </li>
                                     <li>
                                       <input class="form-control" type="password" name="con_password" placeholder="RETYPE YOUR PASSWORD" required="required">
                                     </li>             
                                     <li>
                                       <!-- <input type="checkbox" id="terms" name="trcon"> -->
                                       <!-- <label for="terms"><span>I agree with <a target="_blank" href="#">Terms and Condition</a></span></label> -->
                                     </li>
                                     <br>
                                     <li class="form_buttons">
                                       <input type="submit" name="reg_form" value="REGISTER" class="cpsbtn register btn-primary">
                                       <input type="reset" name="reset_form" value="RESET" class="cpsbtn register btn-primary">
                                     </li>
                                   </ul>
                                 </form>
   </div>
					</div><!-- Quote form end -->
				</div><!-- Col end -->
			
			</div><!--/ Content row end -->
		</div><!--/ Container end -->
	</section><!-- About us end -->



 <?php require( TEMPLATE_FORNT.DS."footer.php" ); ?>