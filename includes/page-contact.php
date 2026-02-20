<!-- START page-contact.php -->
<style>
    .google-maps {
        position: relative;
        padding-bottom: 75%; /* This is the aspect ratio */
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
<?php
$cmsPrefs = $prefs;
$contactPrefKeys = [
    'prefSiteName',
    'prefAddress1',
    'prefAddress2',
    'prefTown',
    'prefCounty',
    'prefCountry',
    'prefPostcode',
    'prefTel1',
    'prefTel2',
    'prefTelIntCode',
    'prefEmail',
    'prefBelfastDepotName',
    'prefBelfastDepotMap',
    'prefBelfastDepotAddress1',
    'prefBelfastDepotAddress2',
    'prefBelfastDepotAddress3',
    'prefBelfastDepotTown',
    'prefBelfastDepotCounty',
    'prefBelfastDepotPostcode',
    'prefBelfastDepotCountry',
    'prefBelfastDepotEmail',
    'prefDublinDepotName',
    'prefDublinDepotMap',
    'prefDublinDepotAddress1',
    'prefDublinDepotAddress2',
    'prefDublinDepotAddress3',
    'prefDublinDepotTown',
    'prefDublinDepotCounty',
    'prefDublinDepotPostcode',
    'prefDublinDepotCountry',
    'prefDublinDepotEmail'
];
foreach ($contactPrefKeys as $key) {
    $cmsPrefs[$key] = cms_pref($key, $cmsPrefs[$key] ?? '');
}
?>

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
            
            <div class="row g-4">
               <?php 
                
                echo "<div class='col-12 inner-contact'>" ;
                    echo "<h1>" . $rowpage["name"] . "</h1>" ;
                echo "</div>" ;
                ?>
                

				
				<div class="col-12 col-lg-6">
					<div class="contact-wrapper">
					<!--	<div id="googleMap3" class="tow-map map-section"></div> --> <!-- NO MAP for HQ -->
						<h2>Headquarters </h2>
						<p>&nbsp;</p>
						<ul>
							
							<?php
							echo "<li>" . $cmsPrefs['prefSiteName'] . "</li>" ;
							echo getAddressShortList($cmsPrefs) . "" ;
							?>						
							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;<a href="tel:<?php echo getTel1Int($cmsPrefs); ?>"><?php echo getTel1Int($cmsPrefs); ?></a> (UK)</li>
                           <li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;<a href="tel:<?php echo getTel2Int($cmsPrefs); ?>"><?php echo getTel2Int($cmsPrefs); ?></a> (RoI)</li> 
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;<a href="mailto:<?php echo getEmail($cmsPrefs); ?>"><?php echo getEmail($cmsPrefs); ?></a></li>
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
				
				<div class="col-12 col-lg-6">
					<div class="contact-wrapper">
						
						<h2>Contact Us </h2>
						<p>&nbsp;</p>
                    
                        <?php
                            include("includes/contact-form.php"); 
                        ?>
                        

					</div>
				</div>
                
                
                <div class="col-12 col-lg-6">
					<div class="contact-wrapper">
                        
						<h2><?php echo  $cmsPrefs['prefBelfastDepotName'] ;?></h2>

                        <div class="google-maps">
                            
                        <?php echo $cmsPrefs['prefBelfastDepotMap']; ?>
						<!--	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4552.344522834317!2d-5.921558858904399!3d54.613619729024556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTTCsDM2JzQ3LjQiTiA1wrA1NScxMS4xIlc!5e0!3m2!1sen!2suk!4v1571658082659!5m2!1sen!2suk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                        
                        </div>
						<p>&nbsp;</p>
						<ul>
							
							<?php
							echo "<li>" . $cmsPrefs['prefSiteName'] . "</li>" ;
							if ($cmsPrefs['prefBelfastDepotAddress1']) {echo "<li>" . $cmsPrefs['prefBelfastDepotAddress1'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotAddress2']) {echo "<li>" . $cmsPrefs['prefBelfastDepotAddress2'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotAddress3']) {echo "<li>" . $cmsPrefs['prefBelfastDepotAddress3'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotTown']) {echo "<li>" . $cmsPrefs['prefBelfastDepotTown'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotCounty']) {echo "<li>" . $cmsPrefs['prefBelfastDepotCounty'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotPostcode']) {echo "<li>" . $cmsPrefs['prefBelfastDepotPostcode'] . "</li>" ; }	
							if ($cmsPrefs['prefBelfastDepotCountry']) {echo "<li>" . $cmsPrefs['prefBelfastDepotCountry'] . "</li>" ; }	
							?>						

							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;  <a href="tel:<?php echo getTel1Int($cmsPrefs); ?>"><?php echo getTel1Int($cmsPrefs); ?></a> </li>
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;  <a href="mailto:<?php echo $cmsPrefs['prefBelfastDepotEmail']; ?>"><?php echo  $cmsPrefs['prefBelfastDepotEmail']; ?></a></li>
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
				
				<div class="col-12 col-lg-6">
					<div class="contact-wrapper">
						<h2><?php echo  $cmsPrefs['prefDublinDepotName'] ;?> </h2>
                        <div class="google-maps">

							<?php echo $cmsPrefs['prefDublinDepotMap']; ?>
						<!--	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d304222.9658777274!2d-6.580223998400102!3d53.437322597094976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48676b6ef59c75f1%3A0x62124df97ffe643b!2sGlascarn%2C%20Co.%20Meath%2C%20A85%20R652%2C%20Ireland!5e0!3m2!1sen!2suk!4v1589801073566!5m2!1sen!2suk" width="600" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
                            

                            
                        </div>
						<p>&nbsp;</p>
						<ul>
							<?php
							echo "<li>" . $cmsPrefs['prefSiteName'] . "</li>" ;
							if ($cmsPrefs['prefDublinDepotAddress1']) {echo "<li>" . $cmsPrefs['prefDublinDepotAddress1'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotAddress2']) {echo "<li>" . $cmsPrefs['prefDublinDepotAddress2'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotAddress3']) {echo "<li>" . $cmsPrefs['prefDublinDepotAddress3'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotTown']) {echo "<li>" . $cmsPrefs['prefDublinDepotTown'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotCounty']) {echo "<li>" . $cmsPrefs['prefDublinDepotCounty'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotPostcode']) {echo "<li>" . $cmsPrefs['prefDublinDepotPostcode'] . "</li>" ; }	
							if ($cmsPrefs['prefDublinDepotCountry']) {echo "<li>" . $cmsPrefs['prefDublinDepotCountry'] . "</li>" ; }	
							?>						
							<li class="mt-10"><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp;  <a href="tel:<?php echo getTel2Int($cmsPrefs); ?>"><?php echo getTel2Int($cmsPrefs); ?></a> </li>
							<li class="mt-10"><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp;  <a href="mailto:<?php echo $cmsPrefs['prefDublinDepotEmail']; ?>"><?php echo $cmsPrefs['prefDublinDepotEmail']; ?></a></li>
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
