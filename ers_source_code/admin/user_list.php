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
              <header>
                  <?php 
                    if ( isset( $_GET['delmsg'] )) {
                        echo $_GET['delmsg'];
                    }

                   ?>
              </header>
              <table class="table table-bordered">
               
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Meter number</th>
                      <!-- <th>Time Of Request</th> -->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  
                    $sql_qu = "SELECT * FROM `users` WHERE status = 1 ORDER BY user_id desc";
                    $query = mysqli_query( $connection, $sql_qu ) or die( mysqli_error( $connection ));
                    while ( $row = mysqli_fetch_assoc( $query )) { ?>
                        <?php
                            $timestamp = strtotime( $row['time_of_request']);
                            $time = date('h:i:s A', $timestamp );
                        ?>   
                        <tr>
                         <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                          <td><?php echo $row['email'];?></td>
                          <td><?php echo $row['meter_number'];?></td>
                          
                          <td>
                          <?php if ( $row['status'] == 0 ) { ?>                            
                            INACTIVE USER                          
                           <?php  }
                           else
                            { ?>  
                            ACTIVE USER                 
                            
                           <?php } 
                          ;?>
                          </td>
                          <td><a href="user_delete.php?id=<?php echo $row['user_id'];?>">Delete user</a></td>
                   
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
