<!-- START page-contact.php -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
    .google-maps {
        position: relative;
        padding-bottom: 75%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }
</style>

		<div class="container inner inner-page">
		<!-- Breadcrumb Trail -->
			<div class="liquid-nav">
				<ul>
					<li>
						<a href="<?php echo $baseURL ;?>/welcome">Home</a>
					</li>
					<li>
						<a href="#"><?php echo $rowpage["name"] ; ?></a>
					</li>
				</ul>
			</div> 
            
            <div class="row">
               <?php 
                
                echo "<div class='col-sm-12  inner-contact'>" ;
                    echo "<h1>" . $rowpage["name"] . "</h1>" ;
                echo "</div>" ;
                ?>
                

				
				<div class="col-sm-6">
					<div class="contact-wrapper">
					<!--	<div id="googleMap3" class="tow-map map-section"></div> --> <!-- NO MAP for HQ -->
						<h2>Headquarters </h2>
						<p>&nbsp;</p>
						<ul>
							
							<?php
							echo "<li>" . $prefs['prefSiteName'] . "</li>" ;
							echo getAddressShortList($prefs) . "" ;
							?>						
							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;<a href="tel:<?php echo getTel1Int($prefs); ?>"><?php echo getTel1Int($prefs); ?></a> (UK)</li>
                           <li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;<a href="tel:<?php echo getTel2Int($prefs); ?>"><?php echo getTel2Int($prefs); ?></a> (RoI)</li> 
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;<a href="mailto:<?php echo getEmail($prefs); ?>"><?php echo getEmail($prefs); ?></a></li>
						</ul>
                        
                        
                        <!-- Debug Captcha -->
                        <?php
                        /*
                            echo "<p>Captch use? " . $prefs['prefCaptcha'] . "<br>" ;
                            echo "Captch Ver? " . $prefs['prefCaptchaVer'] . "<br>" ;
                            echo "Captch Site? " . $prefs['prefCaptchaSiteKey'] . "<br>" ;
                            echo "Captch Secr? " . $prefs['prefCaptchaSecretKey'] . "</p>" ;
                        */
                        ?>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="contact-wrapper">
						
						<h2>Contact Us </h2>
						<p>&nbsp;</p>
                    
                        <!-- Use Contact-form.php -->
                        <!--
                        <form action="contacthandler" id="formData"  method="post">
                    
                        <input type="hidden" class="form-control" name="tRhgY654">
                        <input type="hidden" class="form-control" name="sourcepage" value="<?php echo $rowpage["slug"] ; ?>">
                        
                        
                        
                      <div class="form-group">
                        <label for="exampleInputEmail1">Your Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="realname" placeholder="Your Name">
                      </div>
                    
                    
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email Address">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputEmail1">Contact Number</label>
                        <input type="tel" class="form-control" id="exampleInputEmail1" name="tele" placeholder="Telephone">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Have you a location in mind</label>
                        <input type="tel" class="form-control" id="exampleInputEmail1" name="location" placeholder="Possible Location">
                      </div>
                  
                      <div class="form-group">
                        <label for="exampleInputEmail1">Message or Question</label>
                        <textarea class="form-control" name="message" rows="5"></textarea>
                      </div>
					<?php 					  
					 if( $data['value']=='Yes' )
					 {
					?>

                       <div class="g-recaptcha" data-sitekey="<?php echo $data2["value"] ; ?>"></div>
                        <p  style="color:red;font-weight:bold;" id="error-recaptcha"></p>
                    <?php 
					 }
					?>
						 <button type="submit"  class="btn btn-default">Submit</button>
						 <p class="text-muted">
                            
                  </form>
                        -->
                        
                        <?php
                            include("includes/contact-form.php"); 
                        ?>
                        

					</div>
				</div>
                
                
                <div class="col-sm-6">
					<div class="contact-wrapper">
                        
						<h2><?php echo  $prefs['prefBelfastDepotName'] ;?></h2>

                        <div class="google-maps">
                            
                        <?php echo $prefs['prefBelfastDepotMap']; ?>
						<!--	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4552.344522834317!2d-5.921558858904399!3d54.613619729024556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTTCsDM2JzQ3LjQiTiA1wrA1NScxMS4xIlc!5e0!3m2!1sen!2suk!4v1571658082659!5m2!1sen!2suk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                        
                        </div>
						<p>&nbsp;</p>
						<ul>
							
							<?php
							echo "<li>" . $prefs['prefSiteName'] . "</li>" ;
							if ($prefs['prefBelfastDepotAddress1']) {echo "<li>" . $prefs['prefBelfastDepotAddress1'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotAddress2']) {echo "<li>" . $prefs['prefBelfastDepotAddress2'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotAddress3']) {echo "<li>" . $prefs['prefBelfastDepotAddress3'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotTown']) {echo "<li>" . $prefs['prefBelfastDepotTown'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotCounty']) {echo "<li>" . $prefs['prefBelfastDepotCounty'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotPostcode']) {echo "<li>" . $prefs['prefBelfastDepotPostcode'] . "</li>" ; }	
							if ($prefs['prefBelfastDepotCountry']) {echo "<li>" . $prefs['prefBelfastDepotCountry'] . "</li>" ; }	
							?>						

							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;  <a href="tel:<?php echo getTel1Int($prefs); ?>"><?php echo getTel1Int($prefs); ?></a> </li>
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;  <a href="mailto:<?php echo $prefs['prefBelfastDepotEmail']; ?>"><?php echo  $prefs['prefBelfastDepotEmail']; ?></a></li>
							<?php
					//		if ($prefs['prefBelfastDepotLat']) {echo "<li> " . $prefs['prefBelfastDepotLat'] . "</li>" ; }	
					//		if ($prefs['prefBelfastDepotLong']) {echo "<li> " . $prefs['prefBelfastDepotLong'] . "</li>" ; }					
							?>
							<!--
							<li>Latitude: 54.613060</li>
							<li>Longitude: -5919604</li>-->
						</ul>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="contact-wrapper">
						<h2><?php echo  $prefs['prefDublinDepotName'] ;?> </h2>
                        <div class="google-maps">

							<?php echo $prefs['prefDublinDepotMap']; ?>
						<!--	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d304222.9658777274!2d-6.580223998400102!3d53.437322597094976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48676b6ef59c75f1%3A0x62124df97ffe643b!2sGlascarn%2C%20Co.%20Meath%2C%20A85%20R652%2C%20Ireland!5e0!3m2!1sen!2suk!4v1589801073566!5m2!1sen!2suk" width="600" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
                            

                            
                        </div>
						<p>&nbsp;</p>
						<ul>
							<?php
							echo "<li>" . $prefs['prefSiteName'] . "</li>" ;
							if ($prefs['prefDublinDepotAddress1']) {echo "<li>" . $prefs['prefDublinDepotAddress1'] . "</li>" ; }	
							if ($prefs['prefDublinDepotAddress2']) {echo "<li>" . $prefs['prefDublinDepotAddress2'] . "</li>" ; }	
							if ($prefs['prefDublinDepotAddress3']) {echo "<li>" . $prefs['prefDublinDepotAddress3'] . "</li>" ; }	
							if ($prefs['prefDublinDepotTown']) {echo "<li>" . $prefs['prefDublinDepotTown'] . "</li>" ; }	
							if ($prefs['prefDublinDepotCounty']) {echo "<li>" . $prefs['prefDublinDepotCounty'] . "</li>" ; }	
							if ($prefs['prefDublinDepotPostcode']) {echo "<li>" . $prefs['prefDublinDepotPostcode'] . "</li>" ; }	
							if ($prefs['prefDublinDepotCountry']) {echo "<li>" . $prefs['prefDublinDepotCountry'] . "</li>" ; }	
							?>						
							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;  <a href="tel:<?php echo getTel2Int($prefs); ?>"><?php echo getTel2Int($prefs); ?></a> </li>
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;  <a href="mailto:<?php echo $prefs['prefDublinDepotEmail']; ?>"><?php echo $prefs['prefDublinDepotEmail']; ?></a></li>
							<?php
					//		if ($prefs['prefDublinDepotLat']) {echo "<li> " . $prefs['prefDublinDepotLat'] . "</li>" ; }	
					//		if ($prefs['prefDublinDepotLong']) {echo "<li>" . $prefs['prefDublinDepotLong'] . "</li>" ; }					
							?>

						</ul>
					</div>
				</div>
			</div>
		
		</div>



<!-- END page-contact.php -->