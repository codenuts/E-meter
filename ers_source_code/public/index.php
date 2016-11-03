<?php $title = "Welcome to PDB"; require( '../core/templates/fornt/header.php' ); ?>	
  <section id="ts-features" class="ts-features">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="intro">
						<h2 class="intro-title">
							<i class="fa fa-home"></i> Welcome to PDB
							<span class="title-head"> We are Providing Online E-meter Recharge System</span>
						</h2>
						<p class="intro-text">
                        Now you can recharge your e-meter from this website. We will provide you the token number via SMS system. All you have to do is to register yourself for only once from this website. Remember, while you register you have to provide an active e-mail address. After completing registration you will receive an e-mail and you have to confirm your registration by clicking the link sent to your e-mail. 
                        After you finish the registration procedure you are good to go. Log in from the website with your e-mail id and password. BKash the money you want to buy unit to the below BKash number. Then click on the 'Recharge' tab. Provide the information and click recharge. Then wait for the confirmation. A SMS will be sent to your provided mobile number with your token number. *BKash Charge required (You have to pay BDT 10 taka for per BDT 500 taka transaction)
                        </p>
					</div><!-- Intro end -->

				</div><!-- Col end -->
                <?php 
                if ( $_SESSION['status'] == 1 ) {
                        header( 'location: myaccount.php' );
                    }
                    if ( $_SESSION['status'] == 2 ) {
                        header( 'location: ../admin/order_list.php' );
                    }

                       if ( isset( $_POST['login_form'] )) {
                           extract( $_POST );
                           try {
                                                  
                               if ( empty( $email )) {
                                   throw new Exception( "Please enter your E-mail address", 1);                
                               }

                               if ( empty( $password )) {
                                   throw new Exception( "Please enter your password address", 1);                    
                               }

                               $password = md5( $password );
                               // DB Query
                               $login_sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
                               $query = mysqli_query( $connection, $login_sql ) or die( mysqli_error( $connection ));
                               $row = mysqli_num_rows( $query );
                                
                               if ( $row == 1 ) {
                                   $row_re = mysqli_fetch_assoc( $query ) or die(mysqli_error($connection));
                               if( $row_re['status'] == 2 )
                               { 
                                    
                                 throw new Exception( "Please login from admin login section because you are a admin member", 1);
                                   // header('location: ../admin/order_list.php' );
                               }
                               elseif ( $row_re['status'] == 1 ) 
                               {     
                                  $_SESSION['status'] = 1;                    
                                  $_SESSION['user_id'] = $row_re['user_id']; 
                                  header('location: myaccount.php' );
                               }
                               else{
                                 echo "OOPS Invalid email or password";
                               }
                               }
                               else
                               {
                                   echo "Invalid email or password";
                               }


                           } catch (Exception $e) {
                               $login_message = $e->getMessage();
                           }
                       }

                    ?>

                    <?php 
                        if ( isset( $login_message )) { ?>            
                            <div class="error-message">
                                <?php echo $login_message; ?>
                            </div>
                        <?php
                            
                        }
                     ?>

				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="quote-form">
                <?php 
                    if ( isset( $_POST['forgot_pass'] ) ) {            
                        extract( $_POST );
                        try 
                        {
                            if ( empty( $email )) 
                            {
                                throw new Exception( "Please enter your valid email address", 1);                               
                            }
                            if ( !filter_var( $email, FILTER_VALIDATE_EMAIL)) 
                            {
                                throw new Exception( "Please input valid eamil address", 1);                        
                            }    
                            function forgotpassword_key( $forgotpassword_length ){
                              $forgotpassword_Caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                              $QuantidadeCaracteres = strlen($forgotpassword_Caracteres); 
                              $QuantidadeCaracteres--; 


                                $Hash=NULL; 
                                    for( $x=1; $x<=$forgotpassword_length; $x++ ){ 

                                        $Posicao = mt_rand(0,$QuantidadeCaracteres); 
                                        $Hash .= substr($forgotpassword_Caracteres,$Posicao,1); 
                                    } 

                                return $Hash; 
                                } 

                                $forgot_key = forgotpassword_key( 32 );
                                $forgot_password = md5( $forgot_key ); 



                            $forgot_sql = "SELECT * FROM `users` WHERE email = '$email'";
                            $forgot_query = mysqli_query( $connection, $forgot_sql ) or die( mysqli_error( $connection ));

                            $forgot_row = mysqli_num_rows( $forgot_query );

                            if ( $forgot_row == 1 ) 
                            {
                                $for_upsql = "UPDATE `users` SET password = '$forgot_password' WHERE email = '$email'";

                                $upfor_query = mysqli_query( $connection, $for_upsql );
                                if ( $upfor_query )
                                 {
                                    $to = $email;
                                    $subject = "New Password for account login";
                                    $message = "Hi,  this is Your Password is for account login " . $forgot_key;
                                    $from = "info@googletheme.com";
                                    $headers = "From: $from";
                                    mail($to,$subject,$message,$headers);                          

                                    throw new Exception( "A password sent in your email please check your email", 1 ); 
                                 }    
                            }
                            else
                            {
                                throw new Exception( "This email dose not exists", 1);
                                
                            }

                            


                        } 
                        catch (Exception $e) 
                        {
                            $forgot_msg = $e->getMessage();
                        }
                    }


                 ?>

						<h2>Login Form</h2>
                        <?php 
                        if ( isset( $forgot_msg )) {
                            echo $forgot_msg; 
                        }

                         ?>
						<form action="" method="POST">
                            <div class="row">
                                   <div class="col-xs-12 col-md-12">
                                      <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
                                            </div>
                                   </div>
                               </div>
        
                                <div class="row">
                                   <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="email" placeholder="Password" required>
                                        </div>
                                   </div>
                                </div>
                            <a href="" data-toggle="modal" data-target="#myModal" >Forgot password</a>
    					 	<div class="form-group">
    							<input name="login_form" class="button btn btn-primary" type="submit" value="Login">
    						</div>
                        </form>
   
					</div><!-- Quote form end -->
				</div><!-- Col end -->
			
			</div><!--/ Content row end -->
		</div><!--/ Container end -->
	</section><!-- About us end -->


    

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter email for get password</h4>
            
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email address">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="forgot_pass" value="Create password">
                </div>
            </form>
          </div>
         
          </div>
        </div>

      </div>
    </div>


 <?php require( TEMPLATE_FORNT.DS."footer.php" ); ?>