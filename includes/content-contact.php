<!-- START content-contact.php  Layout id= 9 -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript" src="js/custom.js"></script>
<?php

			$selectData = "SELECT id,name,value FROM `preferences` WHERE `name` =  'prefCaptcha' ";
			$queryValue = mysqli_query($conn,$selectData);

			$data = mysqli_fetch_assoc($queryValue);
			
			
            $selectData = "SELECT id,name,value FROM `preferences` WHERE `name` =  'prefCaptchaSeretKey' ";
			$queryValue = mysqli_query($conn,$selectData);

			$data1 = mysqli_fetch_assoc($queryValue);
			
            $selectData = "SELECT id,name,value FROM `preferences` WHERE `name` =  'prefCaptchaSiteKey' ";
			$queryValue = mysqli_query($conn,$selectData);

			$data2 = mysqli_fetch_assoc($queryValue);
			


		echo "<div class='col-lg-12'>" ; // Heading
			if ($rowcontent["showheading"] == 'Yes' )
			{
				echo "<h1>"	. $rowcontent["heading"] . "</h1>" ;
			}
		echo "</div>" ;

			
		echo "<div class='col-lg-6 col-sm-6 col-xs-12 body-area-left'>" ; // Left Column wit sub head and text 1
			
				if ($rowcontent["subhead1"])
				{
					echo "<h2>"	. $rowcontent["subhead1"] . "</h2>" ;
				}
			


			  echo "<p><strong>" . getCompanyName($prefs) . "</strong></p>" ;
			  echo "<p>" . getAddressShort($prefs) . "</p>" ;

			  echo "<p>tel. " . getTel1($prefs) . "</p>" ;
			  echo "<p><a href='mailto:" . getEmail($prefs) . "'>e-mail: " . getEmail($prefs) . "</a></p>" ;
				if ($rowcontent["image"])	
				{

					echo "<img src='filestore/images/content/"	. $rowcontent["image"] . "' class='img-responsive' alt='"	. $rowcontent["title"] . " " . $rowcontent["subhead1"] . "'>" ;
				}
			echo "<p>&nbsp;</p>" ;
		echo "</div>" ;
			
		echo "<div class='col-lg-6 col-sm-6 col-xs-12 body-area-right'>" ; // Right Column
			
				if ($rowcontent["subhead2"])
				{
					echo "<h2>"	. $rowcontent["subhead2"] . "</h2>" ;
				}

				if ($rowcontent["text2"])	
				{
					?>
					    <form action="contacthandler" id="formData"  method="post">
                    
                        <input type="hidden" class="form-control" name="tRhgY654">
                        <input type="hidden" class="form-control" name="sourcepage" value="<?php echo $rowpage["slug"] ; ?>">
                        
                        
                        
                      <div class="form-group">
                        <label for="exampleInputEmail1">Your Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="realname" placeholder="Your Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputEmail1">Company</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="Company" placeholder="Company/Business Name if applicable">
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
                        <label for="exampleInputEmail1">Postcode or County</label>
                        <input type="tel" class="form-control" id="exampleInputEmail1" name="county" placeholder="Postcode or County">
                      </div>
                  
                      <div class="form-group">
                        <label for="exampleInputEmail1">Message or Question</label>
                        <textarea class="form-control" name="message" rows="5"></textarea>
                      </div>
					<?php 					  
					 if( $data['value']=='Yes' )
					 {
					?>

                       <div class="g-recaptcha" data-sitekey="6LeQkmIUAAAAAP2yebhVmijR8J_jwjkWa5XlNo_o"></div>
                        <p  style="color:red;font-weight:bold;" id="error-recaptcha"></p>
                    <?php 
					 }
					?>
						 <button type="submit"  class="btn btn-default">Submit</button>
						 <p class="text-muted">
                            
                  </form>
					<?php
				echo "<p>&nbsp;</p>" ;

				}
			
		?>
									
		<?php
		echo "</div>" ;

		echo "<div class='col-lg-12'>" ; // Map
				echo "" . getGoogleMap($prefs) . "";
		echo "</div>" ;
	?>
<!-- END content-contact.php -->


		