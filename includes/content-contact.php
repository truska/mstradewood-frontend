<!-- START content-contact.php  Layout id= 9 -->
<?php
		echo "<div class='col-12'>" ; // Heading
			if ($rowcontent["showheading"] == 'Yes' )
			{
				echo "<h1>"	. $rowcontent["heading"] . "</h1>" ;
			}
		echo "</div>" ;

			
		echo "<div class='col-12 col-lg-6 body-area-left'>" ; // Left Column wit sub head and text 1
			
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

					echo "<img src='filestore/images/content/"	. $rowcontent["image"] . "' class='img-fluid' alt='"	. $rowcontent["title"] . " " . $rowcontent["subhead1"] . "'>" ;
				}
			echo "<p>&nbsp;</p>" ;
		echo "</div>" ;
			
		echo "<div class='col-12 col-lg-6 body-area-right'>" ; // Right Column
			
				if ($rowcontent["subhead2"])
				{
					echo "<h2>"	. $rowcontent["subhead2"] . "</h2>" ;
				}

				if ($rowcontent["text2"])	
				{
					include("includes/contact-form.php");
				echo "<p>&nbsp;</p>" ;

				}
			
		?>
									
		<?php
		echo "</div>" ;

		echo "<div class='col-12'>" ; // Map
				echo "" . getGoogleMap($prefs) . "";
		echo "</div>" ;
	?>
<!-- END content-contact.php -->


		
