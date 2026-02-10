<!-- START footer.php -->
teststststststststsst
		<footer>
			<?php
			if ($homePage == "Yes"){
				echo "<div class='container inner'> ";
			}
			else
			{
				echo "<div class='container inner inner-footer'>" ;
			}
			?>
			<!--<div class="container inner"> -->
            	<div class="row">
            		<div class="col-sm-4 col-md-3">
            			<ul>
            				<li><a href="#">Hardwood/Plywood</a></li>
							<li><a href="#">Softwood/Plywood</a></li>
							<li><a href="#">MDF</a></li>
							<li><a href="#">OSB</a></li>
							<li><a href="#">Chip Board</a></li>
							<li><a href="#">Hard Board</a></li>
							<li><a href="#">Enginering Floors</a></li>
            			</ul>
            		</div>
            		<div class="col-sm-4 col-md-2">
            			<ul>
            				<li><a href="<?php echo $baseURL ; ?>/products/chieftian/2">Chieftian</a></li>
							<li><a href="<?php echo $baseURL ; ?>/products/hibernia/1">Hibernia </a></li>
							<li><a href="<?php echo $baseURL ; ?>/products/ri/3">Ri</a></li>
							<li><a href="#">Mayalysian</a></li>
							<li><a href="#">Marine</a></li>
							<li><a href="#">Panopy</a></li>
							<li><a href="#">Elliots Pin</a></li>
							<li><a href="#">Greatwalle</a></li>
            			</ul>
            		</div>
            		<div class="col-sm-4 col-md-2">
            			<ul class="addres">
							<?php
							echo "<p>" . getAddressShort($prefs) . "</p>" ;
							?>
            				<li>MS TIMBER</li>
							<li>2nd Floor </li>
							<li>Strand House</li>
							<li>102 Holywood Road</li>
							<li>Belfast BT4 1NU</li>
            			</ul>
            		</div>
            		<div class="col-md-5">
            			<div class="row">
            				<div class="col-sm-6">
            					<ul class="phone">
									<li><span>T:</span> <a href='tel:+4428 9046 0990'>+44 28 9046 0990</a></li> 
									<li><span>e:</span> <a href='mailto:sales@mstimber.com'>sales@mstimber.com</a></li>
            					</ul>
            				</div>
            				<div class="col-sm-6 social">
            					<ul>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/fac.png"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/in.png"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/tw.png"></a></li>
            					</ul>
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-sm-12 social malone-fabics">
            					<ul>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/hd-icon-1.png" class="img-responsive" alt="Malone Fabics"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/hd-icon-2.png" class="img-responsive" alt="Malone Fabics"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/hd-icon-3.png" class="img-responsive" alt="Malone Fabics"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/cvxc.png" class="img-responsive" alt="Malone Fabics"></a></li>
            					</ul>
            				</div>
            			</div>
            		</div>
            	</div>
			<?php
				include("includes/footer-debug.php");
			?>
            </div>
		</footer>

<!-- ================================================================ -->

<?php
$ShowSTDCode = "No" ;
if ($ShowSTDCode == "Yes")
{
?>

<!--<div id="footer" data-animate="fadeInUp"> -->
  	<div class="col-lg-12  col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 footerarea">
      		 

       		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<?php
				echo "<h3>Quick Links</h3>" ;
				$selectnavfootermenu = "SELECT * FROM `menu` WHERE `footercol` = '1' AND `showonweb` = 'Yes' ORDER BY `menu`, `submenu` ";
				$querynavfootermenu = mysqli_query($conn,$selectnavfootermenu);
				while ($rownavfootermenu = mysqli_fetch_assoc($querynavfootermenu) )
				{
					// GET URL
					$selectnavfootermenuurl = "SELECT * FROM `pages` WHERE `id` = '" . $rownavfootermenu["page"] . "' ";
					$querynavfootermenuurl = mysqli_query($conn,$selectnavfootermenuurl);
					$rownavfootermenuurl = mysqli_fetch_assoc($querynavfootermenuurl);

					echo "<li><a href='" . $baseURL . "/" . $rownavfootermenuurl["slug"] . "'>" . $rownavfootermenu["title"] . "</a></li> " ;
				}

			?>
			</div><!-- /.footer -->

			<div class="col-lg-5 col-md-3 col-sm-3 col-xs-3">
			<?php
				echo "<h3>" . getCompanyName($prefs) . "</h3>" ;
				echo "<p>" . getAddressShort($prefs) . "</p>" ;
			?>
			</div>
 
  	
  	  	<div class="col-lg-4 col-md-3 col-sm-3 col-xs-3">
			<h3>We are social:</h3>
			
			<ul class="footer-social-icon">
			<?php
				
				
				if ($prefs["prefFacebookURL"]) 
				{
					if($prefs["prefFacebookALT"]) {$facebooktag = $prefs["prefFacebookALT"] ;} else {$facebooktag = "Follow " . $prefs["prefcompanyName"]. " on FaceBook" ;}
					echo "<li><a href='" . $prefs["prefFacebookURL"] . "' target='_blank'alt='".$facebooktag."' title='".$facebooktag."'><i class='fa fa-facebook' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefGoogleplusURL"]) {
					if($prefs["prefGoogleplusALT"]) {$googeplustag = $prefs["prefGoogleplusALT"] ;} else {$googeplustag = "Follow " . $prefs["prefcompanyName"]. " on GooglePlus" ;}
					echo "<li><a href='" . $prefs["prefGoogleplusURL"] . "' target='_blank'alt='".$googeplustag."' title='".$googeplustag."'><i class='fa fa-google-plus' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefInstagramURL"]) {
					if($prefs["prefInstagramALT"]) {$instagramtag = $prefs["prefInstagramALT"] ;} else {$instagramtag = "Follow " . $prefs["prefcompanyName"]. " on GooglePlus" ;}
					echo "<li><a href='" . $prefs["prefInstagramURL"] . "' target='_blank'alt='".$instagramtag."' title='".$instagramtag."'><i class='fa fa-instagram' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefTwitterURL"]) {
					if($prefs["prefTwitterALT"]) {$twittertag = $prefs["prefTwitterALT"] ;} else {$twittertag = "Follow " . $prefs["prefcompanyName"]. " on Twitter" ;}
					echo "<li><a href='" . $prefs["prefTwitterURL"] . "' target='_blank'alt='".$twittertag."' title='".$twittertag."'><i class='fa fa-twitter' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefLinkedinURL"]) {
					if($prefs["prefLinkedinALT"]) {$linkedintag = $prefs["prefLinkedinALT"] ;} else {$linkedintag = "Follow " . $prefs["prefcompanyName"]. " on LinkedIn" ;}
					echo "<li><a href='" . $prefs["prefLinkedinURL"] . "' target='_blank'alt='".$linkedintag."' title='".$linkedintag."'><i class='fa fa-linkedin' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefYouTubeURL"]) {
					if($prefs["prefYouTubeALT"]) {$youtubetag = $prefs["prefYouTubeALT"] ;} else {$youtubetag = "Follow " . $prefs["prefcompanyName"]. " on YouTube" ;}
					echo "<li><a href='" . $prefs["prefYouTubeURL"] . "' target='_blank' alt='".$youtubetag."' title='".$youtubetag."'><i class='fab fa-youtube-square' aria-hidden='true'></i></a></li>" ;
				}
				if ($prefs["prefMailchimpURL"]) {
					if($prefs["prefMailchimpALT"]) {$mailchimptag = $prefs["prefMailchimpALT"] ;} else {$mailchimptag = "Follow " . $prefs["prefcompanyName"]. " on Mailchimp" ;}
					echo "<li><a href='" . $prefs["prefMailchimpURL"] . "' target='_blank' alt='".$mailchimptag."' title='".$mailchimptag."' ><i class='fa fa-envelope' aria-hidden='true'></i></a></li>" ;
				}
			?>
			</ul>
			<?php
			
			
			//Use images for social -->
				/*
			echo "<p><a href='" . $prefs['prefFacebookURL'] . "' target='_blank'>" ;
				echo "<img src='" . $baseURL . "/filestore/images/logos/" . $prefs['prefFacebookImage'] . "' style='max-width:57px;'>" ;
			echo "</a></p>" ;
			*/
			?>
		</div>
  	
    </div><!-- /.footer -->

  	<div class="col-lg-10  col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 footerarea"  style='padding-top:10px; '>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<?php
			echo "<p>Copyright " . $prefs["prefcompanyName"] . " " . $prefs["prefCopyrightStartYear"] . " - " . date('Y') . " " ;
			?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<?php
			echo "<p class='pull-right'><a href='https://www.truska.com' target='_blank'>Web site, hosting & design by truska.com</a>" ;
			?>
		</div>
    </div><!-- /.footer imprint -->

	<?php 
		if ($prefs["prefDeBug"] == 'Yes') 
		{
	?>
		<div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 footerarea"  style='padding-top:10px;  border-top:thin solid #aaaaaa;'>

			<!-- debug stuff -->
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=''>
				<?php
				echo "<p>Page ID = " . $rowpage['id'] . "<br>" ;
				?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			</div>
    	</div><!-- /.footer debug -->
	<?php
		}
	?>
	<?php
		}
	?>

<!-- END footer.php -->