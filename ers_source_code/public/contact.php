<?php $title = "Contact Us"; require( '../core/config.php' ); ?>
<?php require( TEMPLATE_FORNT.DS. 'header.php' ); ?>	

	<div id="banner-area" class="banner-area" style="background-image:url(images/contact.jpg)">
		<!-- Subpage title start -->
		<div class="banner-text text-center">
     		<div class="container">
	        	<div class="row">
	        		<div class="col-xs-12">
	        			<div class="banner-heading">
	        				<h1 class="banner-title" style="color: #000; "><i class="fa fa-phone"></i> Contact Us</h1>
	        			</div>
			        	<ul class="breadcrumb">
			            <li>Home</li>
			            <li>Contact</li>
			            <li><a href="#"> Contact One</a></li>
		          	</ul>
	        		</div>
	        	</div>
       	</div>
    	</div><!-- Subpage title end -->
	</div><!-- Banner area end --> 


	<section id="main-container" class="main-container">
		<div class="container">

			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="ts-service-wrapper">
						<div class="ts-service-icon-wrapper">
							<span class="ts-service-icon">
							   <i class="fa fa-map-marker"></i>
							</span>
						</div>
						<div class="ts-service-info">
							<h3>Address</h3>
							<p>Medical College - Sheikhghat Road, Sylhet, Bangladesh.</p>
						</div>
					</div>
				</div><!-- Col 1 end -->

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="ts-service-wrapper">
						<div class="ts-service-icon-wrapper">
							<span class="ts-service-icon">
							   <i class="fa fa-phone"></i>
							</span>
						</div>
						<div class="ts-service-info">
							<h3>Phone</h3>
							<p>(+880) 1234567890</p>
						</div>
					</div>
				</div><!-- Col 2 end -->

						<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="ts-service-wrapper">
						<div class="ts-service-icon-wrapper">
							<span class="ts-service-icon">
							   <i class="fa fa-envelope-o"></i>
							</span>
						</div>
						<div class="ts-service-info">
							<h3>Email</h3>
							<p>info@pdb.com</p>
						</div>
					</div>
				</div><!-- Col 4 end -->
			
			</div><!-- Content row -->
		</div><!-- Conatiner end -->
	</section><!-- Main container end -->

	<section class="maparea">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:500px;width:100%;"><div id="gmap_canvas" style="height:500px;width:100%;"><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.themecircle.net" id="get-map-data">http://www.themecircle.net</a></div></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(24.893535,91.86049950000006),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(24.893535, 91.86049950000006)});infowindow = new google.maps.InfoWindow({content:"<b>Sylhet Bangladesh</b><br/>Sheikhghat Road, Sylhet, Bangladesh.<br/> " });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
	</section>


        <?php 
        	if ( isset( $_POST['contact_form'])) {
        			extract( $_POST );
        			try {
        				if ( !filter_var( $email, FILTER_VALIDATE_EMAIL)) 
        					{
        					    throw new Exception( "Please input valid eamil address", 1);                        
        					} 		

        				if ( empty( $subject )) 
        					{
        						throw new Exception( "Please write your subject", 1 );
        						
        					}
        					$to = "rshozib@gmail.com";
        					$from = "$email";
        					$headers = "From: $subject";
        					mail($to,$subject,$message,$headers);                          

        					throw new Exception( "Thank you for your message we will contact with you very soon.", 1 ); 


        			} catch (Exception $e) {
        				$contact_msg = $e->getMessage();
        			}

        		
        			

        	}
         ?>

	<section id="contact" class="contact">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	            <header>
	            	<?php if ( isset( $contact_msg )): ?>
	            		<?php echo $contact_msg;  ?>
	            	<?php endif ?>
	            </header>
	                <h3 class="title-normal">Contact Form</h3>

	                <form id="contact-form" action="" method="POST">
	                    <div class="row">
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label>Name</label>
	                            <input class="form-control" name="name" id="name" placeholder="" type="text" required>
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label>Email</label>
	                                <input class="form-control" name="email" id="email" 
	                                placeholder="" type="email" required>
	                            </div>
	                        </div>
	                        <div class="col-md-4">
	                            <div class="form-group">
	                                <label>Subject</label>
	                                <input class="form-control" name="subject" id="subject" 
	                                placeholder="" required>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label>Message</label>
	                        <textarea class="form-control" name="message" id="message" placeholder="" rows="10" required></textarea>
	                    </div>
	                    <div class="text-right"><br>
	                        <input class="btn btn-primary solid blank" type="submit" name="contact_form" value="Send Message"> 
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</section><!-- Cotact form end -->


<?php require( TEMPLATE_FORNT.DS."footer.php" ); ?>