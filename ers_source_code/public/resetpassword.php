<?php require( '../core/config.php' ); ?>
<?php require( TEMPLATE_FORNT.DS. 'header.php' ); ?>
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

          <div class="credentials_form register-form" id="registrationOrderForm">
            <h1><span>E - METER RECHARGE SYSTEM</span></h1>
            <hr>
           
          <h2 class="myprofile">Reset Your Password....</h2>
            <?php
            
            if ( isset( $_POST['resetpas'])) 
            {
                $email = $_POST['email'];               
                       
                try {
                    if( empty( $email )){
                    
                    throw new Exception( "Please Enter your login email", 1 ); 
                    }


                    $view_sql = "SELECT * FROM `users` WHERE email = '$email'";
                    $v_query = mysqli_query( $connection, $view_sql );

                    if ( mysqli_num_rows( $v_query) != 1 )
                    {       
                        throw new Exception( "Please enter your login email", 1 ); 
                    }
                    else
                    {
                        function passwordGenerator( $password_lenth ){
                          $Promocode_Caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ@#*'; 
                          $QuantidadeCaracteres = strlen($Promocode_Caracteres); 
                          $QuantidadeCaracteres--; 


                            $Hash=NULL; 
                                for( $x=1; $x<=$password_lenth; $x++ ){ 

                                    $Posicao = mt_rand(0,$QuantidadeCaracteres); 
                                    $Hash .= substr($Promocode_Caracteres,$Posicao,1); 
                                } 

                            return $Hash; 
                            } 

                          $newPassword = passwordGenerator( 32 );
                          $haspassword = md5( $newPassword );



                      $update_sql = "UPDATE `users` SET password = '$haspassword' WHERE email = '$email'";
                        $up_query = mysqli_query( $connection, $update_sql );
                        if ( $up_query )
                         {
                            $to = $email;
                            $subject = "New Password for account login";
                            $message = "Hi,  this is Your Password is for account login " . $newPassword;
                            $from = "info@googletheme.com";
                            $headers = "From: $from";
                            mail($to,$subject,$message,$headers);                          

                            throw new Exception( "A password sent in your email please check your email", 1 ); 
                         }
                    }
                    

                } catch (Exception $e) {                    
                    $error_message = $e->getMessage();                   
                }
            }

              if ( isset( $error_message )) {
                  echo $error_message;
              }

             ?>
             <form action="" method="POST">
                <ul>
                  <li>
                    <input type="email" name="email" placeholder="Enter your email address">
                  </li>
                  <li class="form_buttons">
                  <br/>
                  <input type="submit" name="resetpas" value="Update Password" class="cpsbtn" style="font-size:14px; color: #fff; padding: 5px 15px;">              
                  </li>           
                </ul>
            </form>
          </div>

        </div>
        <div class="login_form order_login_forms">
        
    
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
