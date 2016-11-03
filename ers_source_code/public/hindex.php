<?php require( '../core/config.php' ); ?>
<?php require( TEMPLATE_FORNT.DS. 'header.php' ); ?>
    <div class="clear"></div>
    
    <div class="clear"></div>

        <section class="container new-signup">
        <aside class="middle">

            <div id="login-container" class="box-container">

                <?php 
                    if ( isset( $_POST['login_form'] )) {
                        extract( $_POST );
                        try {
                                               
                            if ( empty( $email )) {
                                throw new Exception( "Please enter your E-mail address", 1);                        
                            }
                            if ( empty( $password )) {
                                throw new Exception( "Please enter your E-mail address", 1);                        
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
                                header('location: ../admin/admin.php' );
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
                          <a href="#"><img src="images/fb-login.png"> </a>
                          <a href="#"><img src="images/google-login.png"> </a>
                      </li>
                      <li>
                        <div class="login-divider"><img src="images/or-divider.png"><br>
                          <br>
                        </div>
                      </li>
                      <li>
                        <input type="text" placeholder="Enter your email" required="required" name="email" id="username">
                      </li>
                      <li>
                        <input type="password" placeholder="Enter your password" required="required" name="password" id="password">
                        <p>Forgot? Please <a href="/resetting/request">reset your password</a></p>
                      </li>
                      <li class="form_buttons">
                        <div class="remember">
                          <input type="checkbox" value="on" name="" id="remember_me">
                          <label for="remember_me"><span>Remember me</span></label>
                        </div>
                        <div class="login-button">
                          <input type="submit" style="width: 100px" class="cpsbtn" value="Login" name="login_form" id="submit_login">
                        </div>
                      </li>
                    </ul>
                  </form>
                
            </div>
      
            <img src="images/front-loader.gif" style="display:none;" />
    </aside>

        
    </section>

    <aside class="bottom"></aside>
    
    
    
<?php require( TEMPLATE_FORNT.DS."footer.php" ); ?>
    
    


