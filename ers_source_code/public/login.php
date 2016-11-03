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
          <h1>
            <?php
              if (isset( $_GET['msg'] )){
                    echo $_GET['msg'];              
                 }
             ?>
          </h1>
          <hr>

        </div>
        <div class="login_form order_login_forms">

        <?php if ( isset( $_POST['login_form'] )) {
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

                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="quote-form">
                    <h2>Login Form</h2>
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
                            
                            <div class="form-group">
                              <input name="login_form" class="button btn btn-primary" type="submit" value="Login">
                            </div>
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