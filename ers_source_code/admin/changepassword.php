<?php require( "../core/config.php" ); ?>
<?php require( TEMPLATE_BACK.DS."header.php" ); ?>
<?php require( TEMPLATE_BACK.DS."side-nav.php" ); ?>
<?php 
    if ( isset( $_SESSION['username'] ) ) 
    {
        $sess_username = $_SESSION['username'];
    }
    else
    {
        header( 'location: ../public/index.php' );
    }
    if ( isset( $_POST['adminuppfassword'])) 
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

     

    
     
    ?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height col-lg-6 col-md-6 col-sm-12 col-xs-12">
          
          <?php  
            if ( isset( $error_message )) { ?>
            <h2 style="color: red; padding: .5em; background: #fff;"> <?php echo $error_message; ?>
            </h2>

           <?php } 
           ?>
           
               <form action="" method="POST">
                <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Current Password">                    
                </div>
                <div class="form-group">
                      <input type="password" class="form-control" name="newpassword" placeholder="New Password">           
                </div>
                <div class="form-group">
                      <input type="password" class="form-control" name="conpassword" placeholder="Re-type new">           
                </div>
                  <div class="form-group">
                    <input type="submit" name="adminuppfassword" value="Update Password">              
                      
                  </div>
                    
              </form>
          </section>
      </section>
      <!--main content end-->
    
    <?php require( TEMPLATE_BACK.DS."footer.php" ) ?>
