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

      $mes_sql = "SELECT COUNT(id) FROM `unit_order` WHERE status = 0";
      $queries_mes = mysqli_query( $connection, $mes_sql );
      while ( $row = mysqli_fetch_assoc( $queries_mes )) 
      {

        if ( $row ['COUNT(id)'] !='' ) 
          {
            $_SESSION['mes_notify'] = ( $row ['COUNT(id)'] );            
          }
       }

    ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <table class="table table-bordered">
               
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Recharge Units</th>
                      <th>Price</th>
                      <th>Trnxid</th>
                      <th>Time Of Request</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  
                    $sql_qu = "SELECT * FROM `unit_order` ORDER BY id desc";
                    $query = mysqli_query( $connection, $sql_qu ) or die( mysqli_error( $connection ));
                    while ( $row = mysqli_fetch_assoc( $query )) { ?>  
                        <tr>
                         <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row['units'];?></td>
                          <td><?php echo $row['price'];?> tk</td>
                          <td><?php echo $row['trnxid'];?></td>
                          <td><?php echo $row['time_of_request'];?></td>
                          <td>
                          <?php if ( $row['status'] == 0 ) { ?>                            
                            PENDING                          
                           <?php  }
                           else
                            { ?>  
                            CONFIRM                 
                            
                           <?php } 
                          ;?>
                          </td>
                          <td>
                            <div class="btn-group">
                               <a id="headerUserButton" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                   <i class="glyphicon glyphicon-user"></i> Confirmation
                                   <span class="caret"></span>
                               </a>
                               <ul class="dropdown-menu">
                                   <!-- dropdown menu links -->
                                   <?php if ( $row['status'] == 0 ) { ?> 
                                    <li>
                                      <form action="confirm.php" method="POST">
                                          <input class="form-control" type="text" name="card" placeholder="Card No....">

                                          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                          <input type="hidden" name="status" value="<?php echo $row['status'];?>">
                                          <input type="hidden" name="userid" value="<?php echo $row['user_id'];?>">

                                          <input class="btn btn-primary" name="cardbutton" type="submit" value="Confirm Order">
                                      </form>                              
                                                            
                                    </li>

                                   <?php } else {  ;?>
                                   <li><a href="confirm.php?id=<?php echo $row['id'];?>&status=<?php echo $row['status'];?>">Cancel Order</a></li>
                                   <?php } ;?>
                               </ul>
                           </div>

                          </td>
                        </tr>
                        
                    <?php }

                  ?>                  
                    
                  </tbody>
                </table>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
    
    <?php require( TEMPLATE_BACK.DS."footer.php" ) ?>