<?php require( '../core/config.php' ); ?>
<?php require( TEMPLATE_FORNT.DS. 'header.php' ); ?>
    <div class="clear"></div>
    
    <div class="clear"></div>
    
    <!--orderSummary start-->
		<section class="span6 well" id="main">
  <div>
    <div class="clear"></div>
    <section class="container">
      <aside class="login_info">
      
      </aside>
        
      <aside class="user_selection m_top">
        <div class="registration_form order_login_forms">
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

                    // if ( !filter_var( $phone, FILTER_VALIDATE_INT )) {
                    //     throw new Exception( "Please enter valid phone number", 1);                        
                    // }

                    $phone_lent = strlen( $phone );

                    if ( $phone_lent != 11 ) {
                        throw new Exception( "Please provide 11 character number", 1);                        
                    }

                    if ( empty( $password )) {
                        throw new Exception( "Password can't be empty", 1);                        
                    }

                    $password_len = strlen( $password );
                    $confirmpassword_len = strlen( $con_password );
                    
                    if ( $password_len >= 6 ) {
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
            <h1><span>E - METER RECHARGE SYSTEM</span></h1>
            <ul>
              <li>
                <input type="text" name="first_name" placeholder="FIRST NAME" required="required">
                
              </li>
              <li>
                <input type="text" name="last_name" placeholder="LAST NAME" required="required">
              </li>

              <li>
                <input type="text" name="meter_number" placeholder="METER NUMBER *" required="required">
              </li>

              <li>
                <input type="email" name="email" placeholder="E-MAIL ADDRESS *" required="required" >
              </li>

              <li>
                <input type="tel" name="phone" placeholder="PHONE NUMBER *" required="required">
              </li>

              <li>
                <input type="password" name="password" placeholder="ENTER YOUR PASSWORD" required="required">
              </li>
              <li>
                <input type="password" name="con_password" placeholder="REPEAT YOU PASSWORD" required="required">
              </li>             
              <li>
                <!-- <input type="checkbox" id="terms" name="trcon"> -->
                <!-- <label for="terms"><span>I agree with <a target="_blank" href="#">Terms and Condition</a></span></label> -->
              </li>
              <li class="form_buttons">
                <input type="submit" name="reg_form" style="width: 100px" value="REGISTER" class="cpsbtn register">
                <input type="reset" name="reset_form" style="width: 100px" value="RESET" class="cpsbtn register">
              </li>
            </ul>
          </form>

        </div>
        <div class="login_form order_login_forms">
        <?php 
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
                        $_SESSION['status'] = 2; 
                        $_SESSION['username'] = $row_re['first_name'];
                        $_SESSION['user_id'] = $row_re['user_id'];  
                        header('location: ../admin/order_list.php' );
                    }
                    elseif ( $row_re['status'] == 1 ) 
                    {     
                       $_SESSION['status'] = 1;                    
                       $_SESSION['user_id'] = $row_re['user_id']; 
                       header('location: myaccount.php' );
                    }
                    else{
                      echo "OOPS";
                    }
                    }
                    else
                    {
                        echo "Login Fail";
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
        <form action="" method="post" class="credentials_form login-form" enctype="">
            <h1><span>Login here</span></h1>
            <ul>
              <li>
              	  <!-- <a href="#"><img src="images/fb-login.png"> </a> -->
              	  <!-- <a href="#"><img src="images/google-login.png"> </a> -->
              </li>
              <li>
                <div class="login-divider">
                <!-- <img src="images/or-divider.png"> -->
                              
                </div>
              </li>
              <li>
                <input type="text" placeholder="Enter your email" required="required" name="email" id="username">
              </li>
              <li>
                <input type="password" placeholder="Enter your password" required="required" name="password">
                <p>Forgot? Please <a href="resetpassword.php">reset your password</a></p>
              </li>
              <li class="form_buttons">
                <div class="remember">
                  <!-- <input type="checkbox" value="on" name="" id="remember_me"> -->
                  <!-- <label for="remember_me"><span>Remember me</span></label> -->
                </div>
                <div class="login-button">
                  <input type="submit" style="width: 100px" class="cpsbtn" value="Login" name="login_form">
                </div>
              </li>
            </ul>
          </form>
        </div>
      </aside>
      <br>

    </section>
  </div>
</section>

   	<!--orderSummary End--> 
    
	<!--footer-->
    <aside class="bottom"></aside>
  <?php require( TEMPLATE_FORNT.DS."footer.php" ); ?>