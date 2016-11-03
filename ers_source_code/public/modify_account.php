<?php $title = "Update Details"; require( '../core/config.php' ); ?>
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
                <?php 
                $sess_id = $_SESSION['user_id'];

                $sql_query = "SELECT * FROM `users` WHERE user_id = '$sess_id'";
                $query = mysqli_query( $connection, $sql_query );
                $row = mysqli_fetch_assoc($query);
                $timesteamp = strtotime( $row['date_of_birth']);
                $date = date( 'd/m/Y', $timesteamp );

                if ( isset( $_POST['save_form'] )) 
                {
                    extract( $_POST );
                    // echo $date_of_birth; exit;
                    $date_of_birth = substr($date_of_birth, 6, 4) . "-" . substr($date_of_birth, 3, 2) . "-" . substr($date_of_birth, 0, 2);

                    try {

                        if ( empty( $first_name )) {
                            throw new Exception( "First Name can't be empty", 1);                        
                        }   

                        if ( empty( $last_name )) {
                            throw new Exception( "Last Name can't be empty", 1);                        
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

                        $update_sql     = "UPDATE `users` SET 
                        first_name = '$first_name', 
                        last_name = '$last_name',
                        gender = '$gender',
                        date_of_birth = '$date_of_birth',
                        address_line_1 = '$address_line_1',
                        city = '$city', 
                        address_line_2 = '$address_line_2', 
                        zip = '$zip',
                        phone = '$phone',
                        email = '$email', 
                        alternative_contact_number = '$alternative_contact_number',
                        mobile = '$mobile' 
                        WHERE user_id = '$sess_id'";


                        $query = mysqli_query( $connection, $update_sql ) or die( mysqli_error($connection));

                        if ( $query ) {
                            header( "location: myaccount.php?msg=" . urldecode( 'Your Profile sucessfully updated' ));
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
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <form class="credentials_form register-form" method="POST" id="registrationOrderForm">
                <h2><i class="fa fa-pencil-square-o"></i> <span>Update Details</span></h2>
                
                <hr>
                
                <h2 style="color: #000; font-size: 2em; font-weight: bold;">Update Your Account</h2>
                <ul class="list-unstyled">
                 
                  <legend>Personal Information</legend>
                  <li>
                    <input class="form-control" type="text" name="first_name" value="<?php echo $row['first_name'];?>" required="required">
                </li>
                <li>
                    <input class="form-control" type="text" name="last_name" value="<?php echo $row['last_name'];?>" required="required" id="newAccountUsername">
                </li>
                
                <li>
                    <select class="form-control" name="gender">                  
                      <?php 
                      if ( $row['gender'] == 1 ) { ?>
                      <option selected value="1">MALE</option>
                      <option value="2">FEMALE</option>                          
                      <?php }
                      
                      elseif ( $row['gender'] == 2 ) { ?>
                      <option selected value="2">FEMALE</option>
                      <option value="1">MALE</option>  
                      <?php }
                      
                      else{ ?>
                      <option selected>GENDER</option>
                      <option  value="1">MALE</option>                        
                      <option  value="2">FEMALE</option>
                      
                      <?php }
                      
                      ?>
                  </select>
              </li>
              
              <li>
                  
                <input class="form-control" type="text" name="date_of_birth" value="<?php echo $date; ?>" id="datepicker" placeholder="Birth Date">
            </li>
            
            <h2>Address Information</h2>
            <li>
                <input class="form-control" type="text" name="address_line_1" value="<?php echo $row['address_line_1'];?>" placeholder="ADDRESS LINE 1">
            </li>
            <li>
                <input class="form-control" type="text" name="city" value="<?php echo $row['city'];?>" placeholder="CITY">
            </li>              
            
            <li>
                <input class="form-control" type="text" name="address_line_2" value="<?php echo $row['address_line_2'];?>" placeholder="ADDRESS LINE 2">
            </li>
            
            <li>
                <input class="form-control" type="text" name="zip" value="<?php echo $row['zip'];?>" placeholder="ZIP CODE">
            </li>
            
            
            <h2>Contact Information</h2>
            
            <li>
                <input class="form-control" type="tel" name="phone" value="<?php echo $row['phone'];?>" placeholder="PHONE NUMBER" required="required">
            </li>
            
            <li>
                <input class="form-control" type="email" name="email" value="<?php echo $row['email'];?>" placeholder="EMAIL ADDRESS" required="required">
            </li>
            <li>
                <input class="form-control" type="tel" name="alternative_contact_number" value="<?php echo $row['alternative_contact_number'];?>" placeholder="ALTERNATIVE CONTACT NUMBER">
            </li>
            
            <li>
                <input class="form-control" type="tel" name="mobile" value="<?php echo $row['mobile'];?>" placeholder="MOBILE NUMBER">
            </li>             
            <li>
                <!-- <input type="checkbox" id="terms" name="trcon"> -->
                <!-- <label for="terms"><span>I agree with <a target="_blank" href="#">Terms and Condition</a></span></label> -->
            </li>
            <li class="form_buttons">
                <input type="submit" name="save_form" value="Update Information" class="cpsbtn register btn-primary">
            </li>
        </ul>
    </form>
</div>
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