<?php require( "../core/config.php" ); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>ERS ADMIN SECTION</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
      <?php                  
         if ( isset( $_POST['login_form'] )) {
            // echo "ok"; exit();
             extract( $_POST );

             try {
                                    
                 if ( empty( $email )) {
                     throw new Exception( "Please enter your E-mail address", 1);                
                 }

                 if ( empty( $password )) {
                     throw new Exception( "Please enter your password address", 1);                    
                 }
                 if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                    /*
                     * Set Cookie from here for one hour
                     * */
                    setcookie("email", $email, time()+(60*60*1));
                    setcookie("password", $password, time()+(60*60*1));  /* expire in 1 hour */
                  } else {
                    /**
                     * Following code will unset the cookie
                     * it set cookie 1 sec back to current Unix time
                     * so that it will invalid
                     * */
                    setcookie("username", $username, time()-1);
                    setcookie("password", $password, time()-1);
                  }

                 $password =  $password ;
                 // DB Query
                 $login_sql = "SELECT * FROM `admins` WHERE username = '$email' AND password = '$password'";
                 $query = mysqli_query( $connection, $login_sql ) or die( mysqli_error( $connection ));
                 $row = mysqli_num_rows( $query );
                  
                 if ( $row == 1 ) {
                     $row_re = mysqli_fetch_assoc( $query ) or die(mysqli_error($connection));
                 
                     $_SESSION['username'] = $row_re['username'];
                     $_SESSION['user_id'] = $row_re['id'];  
                     header('location: ../admin/order_list.php' );
                 }
                 else
                 {
                    throw new Exception( "Invalid username or password", 1);
                     
                 }


             } catch (Exception $e) {
                 $login_message = $e->getMessage();
             }
         }

       ?>
       <div class="container">    
           
      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">sign in now</h2>
         <?php 
           if ( isset( $login_message )) { ?>            
               <div class="error-message text-center">
                   <?php echo $login_message; ?>
               </div>
           <?php
               
           }
        ?>
        <div class="login-wrap">
            <input type="text" class="form-control" name="email" placeholder="E-mail address" autofocus>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <label class="checkbox">
                <!-- <input type="checkbox" value="remember"> Remember me -->
                <span class="pull-right">
                    <!-- <a data-toggle="modal" href="#myModal"> Forgot Password?</a> -->
                </span>
            </label>
            <input type="submit" class="btn btn-lg btn-login btn-block" name="login_form" value="Sign in">
            <!-- <p>or you can sign in via social network</p>
            <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="icon-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="icon-twitter"></i>
                    Twitter
                </a>
            </div> -->
            <div class="registration">
                <!-- Don't have an account yet? -->
                <!-- <a class="" href="registration.html"> -->
                    <!-- Create an account -->
                </a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>
