<?php require( '../core/config.php' ); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.themewinter.com/html/saifway/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Mar 2016 18:51:17 GMT -->
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
   <title>
   <?php if ( isset( $title )) 
   {
     echo $title;
   } 
   else
   {
    echo "ERS | APPLICATION";
   }
   ?>
   </title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" >
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" >
    
    <!-- CSS
    ================================================== -->
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <!-- Colorbox -->
    <link rel="stylesheet" href="css/colorbox.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div class="body-inner">
    <!-- Header start -->
    <nav class="site-navigation navigation">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="site-nav-inner pull-left">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse navbar-responsive-collapse">
                            <?php 
                                if ( isset( $_SESSION['status'] )  != 1 ) {
                                    ?>
                            <ul class="nav navbar-nav">
                                <li class="dropdown active">
                                    <a href="index.php" class="dropdown-toggl" data-toggle="">Home</a>                            
                                </li>

                                <li class="dropdown">
                                    <a href="contact.php" class="" data-toggle="">Contact Us</a>                            
                                </li>
                           </ul>
                           <?php
                           }
                           else
                           { ?>

                           <ul class="nav navbar-nav">


                           <li class="dropdown dropdown-large">
                             <a class="cpsbtn" href="index.php">Home</a>

                                    
                           </li>

                           <li class="dropdown">
                             <a href="recharge.php" class="cpsbtn">Recharge</a>
                                    
                           </li>

                           <li class="dropdown">
                              <a href="myaccount.php" class="cpsbtn">My account</a>
                                    
                           </li>

                           <li class="dropdown">
                              <a href="logout.php" class="cpsbtn">Logout</a>
                                    
                           </li>
                           
                           <li class="dropdown">
                               <a href="contact.php" class="" data-toggle="">Contact Us</a>                            
                           </li>

                             
                        </ul><!--/ Nav ul end -->
                           <?php }

                        ?>
                        </div><!--/ Collapse end -->

                    </div><!-- Site Navbar inner end -->
                    <?php 
                        if ( isset( $_SESSION['status'] )  != 1 ) {
                            ?>
                    <div class="find-agent pull-right">
                        <a href="register.php">Registration</a>
                    </div>
                  <?php } ?>
                </div><!--/ Col end -->
            </div><!--/ Row end -->
        </div><!--/ Container end -->
    </nav><!--/ Navigation end -->



