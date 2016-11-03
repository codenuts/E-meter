<?php $title= "Recharge"; require( '../core/config.php' ); ?>
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
            if ( $_SESSION['status'] != 1 ) 
            {
                header( 'location: index.php' );
            }
            if ( isset( $_POST['recharge_form'] )) {                
                extract( $_POST );

                try {
                    if ( empty( $trnxid )) {
                        throw new Exception( "BKash trx Id can't be empty", 1);                        
                    }   
                    $trnxid_len = strlen( $trnxid );   
                    if ( $trnxid_len != 10 ) {
                         throw new Exception( "Please provide 10 characters of BKash trx Id", 1);
                                             
                      }              
                    if ( empty( $price )) {
                        throw new Exception( "Price can't be empty", 1);                        
                    }
                    if ( empty( $price > 99  )) {
                        throw new Exception( "You have to submit minimum 100 taka", 1);                        
                    }
                    $user_id = $_SESSION['user_id'];
                    
                    $account_sql = "INSERT INTO `unit_order` ( trnxid,units,price,user_id) VALUES ( '$trnxid','$units','$price','$user_id')";
                    $query_order = mysqli_query( $connection, $account_sql ) or die( mysqli_error($connection));

                      header( "location: recharge.php?msg=" .urldecode( 'Thank you. your order is procecing'));
                    
                  
                    

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
          <h1 style="color: green;">
          <?php 
          if (isset( $_GET['msg'] ))
          {
            echo $_GET['msg'];                
          }
          ?>
          </h1>

          <form class="credentials_form register-form" action="" method="POST" id="registrationOrderForm">
            <h2><span><i class="fa fa-calculator"></i> Recharge</span></h2>
            <hr>
            <ul class="list-unstyled">
              <li>
                <input type="text" onkeypress="return onlyNumbers(event);"  class="form-control" name="trnxid" placeholder="bkash transaction ID" required="required">
              </li>
              <li>
              <div class="row">                
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <input type="text" onkeypress="return onlyNumbers(event);" class="form-control"name="units" id="" placeholder="Enter your rechagre unit(optional)">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <input type="text" onkeypress="return onlyNumbers(event);"  class="form-control" name="price" id="" placeholder="Enter your unit price">
                </div>

              </div>
            </li>
              
              <script type="text/javascript">
                 // function recharge_clc()
                        // {
                        //     var qnty = document.getElementById("qnty").selectedIndex;
                        //     var calc = document.getElementsByTagName("option")[qnty].value;
                        //     var myFormElements = calc * 60;    
                        //     var myInput = myFormElements + 'tk';               
                        //     var myInput2 = '<input type="hidden" id="lol" style="width:70px;" name="price" value="'+myFormElements+'">';               
                        //     document.getElementById('recharge').innerHTML = myInput;
                        //     document.getElementById('recharge2').innerHTML = myInput2;
                            
                        // }

                        function onlyNumbers(e){
                            if(e.charCode > 47 && e.charCode < 58 || e.keyCode == 46){
                                return true;
                            }else{
                                return false;
                            }
                        }
                </script>

              <li class="form_buttons">
                <input type="submit" name="recharge_form" value="RECHARGE" class="cpsbtn register btn-primary">
                <input type="reset" name="reset_form" value="RESET" class="cpsbtn register btn-primary" id="submit_register">
              </li>
            </ul>
          </form>

        </div>

        <div class="registration_form order_login_forms">
        <table class="table table-bordered rech-table">
        <thead>
          <tr>
            <th>RECHARGE UNITES</th>
            <th>PRICE</th>
            <th>Bkash transaction ID</th>
            <th>STATUS</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                $id = $_SESSION['user_id'];
                $sql_reg = "SELECT * FROM `unit_order` WHERE user_id = '$id' ORDER BY id desc";
                $re_query = mysqli_query( $connection, $sql_reg );

                while ( $row = mysqli_fetch_assoc( $re_query )) {
                    ?>
                      <tr>
                        <td><?php echo $row['units'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['trnxid'];?></td>
                        <td>
                        <?php if ( $row['status'] == 1 ): ?>
                            Confirm
                        <?php else: ?>
                            Pending
                        <?php endif ?>
                        </td>
                      </tr>

                    <?php 
                    // echo "<pre>";
                    // print_r( $row );
                }


             ?>  
     
            </tbody>
          </table>


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
