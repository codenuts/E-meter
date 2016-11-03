<?php $title = "My Account"; require( '../core/config.php' ); ?>
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
            
          <h2 class="myprofile"><i class="fa fa-user"></i> My Account</h2>
            <hr>
           
            <?php
            if ( $_SESSION['status'] != 1 ) {
                header( 'location: index.php' );
            }
              $query = "SELECT * FROM `users` WHERE user_id = '".$_SESSION['user_id']."'";
              $select_query = mysqli_query( $connection, $query );

              $row = mysqli_fetch_array(  $select_query );

              $timesteamp = strtotime( $row['date_of_birth']);
              $date = date( 'd/m/Y', $timesteamp );

             ?>
            <ul class="list-unstyled">
              <li>
               FIRST NAME :<?php echo $row['first_name']; ?>
              </li>
              <li>
               LAST NAME  : <?php echo $row['last_name']; ?>
              </li>
              <li>
              <?php if ( $row['gender'] !='' ) : ?>
              GENDER  : <?php if ( $row['gender'] == 1 ): ?>
                  Male
              <?php else : ?>
                Female
               <?php endif;  ?>
              
              <?php endif ?>
              </li>

              <li>
              <?php if ( $date !='' ) : ?>
              Date of Birth           : <?php echo $date ;?> 
              <?php endif ?> 
              </li>

              <li>
               METER      : <?php echo $row['meter_number']; ?> 
              </li>
              <li>
              <?php if ( $row['address_line_1'] !='' ) : ?>
               ADDRESS LINE 1 : <?php echo $row['address_line_1'];?> 
              <?php endif ?> 
              </li>
              <li>
              <?php if ( $row['city'] !='' ) : ?>
              CITY           : <?php echo $row['city'];?> 
              <?php endif ?> 
              </li>
              <li>
              <?php if ( $row['address_line_2'] !='' ) : ?>
              ADDRESS LINE 2 : <?php echo $row['address_line_2'];?> 
              <?php endif ?>
              </li>
              <li>
              <?php if ( $row['zip'] !='' ) : ?>
              ZIP CODE       : <?php echo $row['zip'];?> 
              <?php endif ?>
              </li>
              <li>
               PHONE         : <?php echo $row['phone']; ?> 
              </li>
              <li>
              EMAIL ADDRESS       : <?php echo $row['email'];?>              
              </li>
              <li>
              <?php if ( $row['alternative_contact_number'] !='' ) : ?>
              AlTERNATIVE CONTACT NUMBER       : <?php echo $row['alternative_contact_number'];?> 
              <?php endif ?>
              </li>
              <li>  
              <?php if ( $row['mobile'] !='' ) : ?>
              MOBILE NUMBER       : <?php echo $row['mobile'];?> 
              <?php endif ?>
              </li>
              <li class="form_buttons">
              <br/>

              <a href="modify_account.php?id=<?php echo $_SESSION['user_id'];?>" class="cpsbtn btn-primary">Edit My Account</a>
              <a href="changepassword.php" class="cpsbtn btn-primary">Change Password</a>
              </li>           
            </ul>
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
