<?php $title = "Change password"; require( '../core/config.php' ); ?>
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
           
          <h2 class="myprofile">Change Your Password....</h2>
            <?php
            if ( $_SESSION['status'] != 1 ) {
                header( 'location: index.php' );
            }


            if ( isset( $_POST['uppfassword'])) 
            {
                
                $cur_passwordpassword =  $_POST['password'];
                $newpassword =  $_POST['newpassword'];
                $conpassword =  $_POST['conpassword'];
                $password_len = strlen( $password );
                $confirmpassword_len = strlen( $con_password ); 
                $user_id = $_SESSION['user_id'];
                
                       
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
                    if ( $password_len >= 6 ) {
                        throw new Exception( "Password will be min 6 digit", 1 );                        
                    }
                    if ( $newpassword <> $conpassword ) {
                        throw new Exception( "Your password Mismatch", 1 );                        
                    }

                    $password = md5($cur_passwordpassword);
                    $new_password = md5($newpassword);
                    

                    $view_sql = "SELECT * FROM `users` WHERE user_id = '$user_id' AND password = '$password'";
                    $v_query = mysqli_query( $connection, $view_sql );

                    if ( mysqli_num_rows( $v_query) != 1 )
                    {       
                        throw new Exception( "Please check your current password", 1 ); 
                    }
                    else
                    {
                      $update_sql = "UPDATE `users` SET password = '$new_password' WHERE user_id = '$user_id'";
                        $up_query = mysqli_query( $connection, $update_sql );
                        if ( $up_query )
                         {
                            throw new Exception( "Your password Update Sucessfully", 1 ); 
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
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <form action="" method="POST">
                    <ul class="list-unstyled">
                      <li>
                        <input class="form-control" type="password" name="password" placeholder="Current Password">
                      </li>
                 
                      <li>
                        <input class="form-control" type="password" name="newpassword" placeholder="New Password">
                      </li>
                 
                      <li>
                        <input class="form-control" type="password" name="conpassword" placeholder="Re-type new">
                      </li>
                 
                      <li class="form_buttons">
                      <br/>
                      <input class="form-control" type="submit" name="uppfassword" value="Update Password" class="cpsbtn register btn-primary">              
                      </li>           
                    </ul>
                             </form>
             </div>
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
