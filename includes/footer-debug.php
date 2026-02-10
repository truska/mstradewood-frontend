<!-- START footer-debug.php -->
<style>
	.footerdebug {padding-top:50px;}
	.footerdebug ,
	.footerdebug p
		{color:#333333;}
		
</style>
 <?php
// include("includes/dbcon.php");

 // $prefs = loadPrefs($conn);
 //  echo "<pre>";
//  print_r($prefs);
 
            	echo "<div class='row footerdebug' style='padding-top:50px;'>" ;
            		echo "<div class='col-sm-4 col-md-4' style='padding-top:50px; border-top:thin solid #333333;'>" ;
						echo "<p>Page ID  =  " . $slugID . " / " . $rowpage['id'] . "</p>" ;
						echo "<p>Site Search  =  " . $prefs['prefSiteSearchOn'] . "</p>" ;
						echo "<p>Page Search  =  " . $rowpage["pagesearch"] . "</p>" ;
						echo "<p>Def Meta Key  =  " . $prefs['prefDefaultMetaKeywords'] . "</p>" ;
						echo "<p>Server name  =  " . $servername . "</p>" ;
					//	echo "<p>Is Home Page? = " . $homePage . "</p>" ;
					//	echo "<p>Base URL = " . $baseURL . "</p>" ;
					//	echo "<p>Long Address URL = " . getAddressLong($prefs) . "</p>" ;
					//	echo "<p>Long Address URL = " . getAddressLong($prefs) . "</p>" ;
						
					//	echo "<p>&copy; Year Start = " . $prefs['prefCopyrightStartYear'] . "</p>" ;
					//	echo "<p>File store path = " . $prefs['prefFileStorePath'] . "</p>" ;

            		echo "</div>" ;
            		echo "<div class='col-sm-4 col-md-4' style='padding-top:50px; border-top:thin solid #333333;'>" ;
					   
				     /* print_r(loadPrefs($conn));
					  foreach(loadPrefs($conn) as $dataa)
					  {
						 // print_r($dataa);
						  echo $dataa['name']['prefCompanyName'];
					  } */
					  
					  
					// $customarray[0]['value'];
					//	echo "<p>Company Name = " . getCompanyName($prefs) . "</p>" ;
						//echo "<p>Company Name = " . $customarray[0]['value'] . "</p>" ;
					//	echo "<p>Site name Name = " . getSiteName($prefs) . "</p>" ;

					//	echo "<p>&nbsp;</p>";
						echo "<p>segs[0] = " .$segs[0] . "</p>"; 
						echo "<p>segs[1] = " .$segs[1] . "</p>"; 
						echo "<p>segs[2] = " .$segs[2] . "</p>"; 
		//				echo "<p>segs[3] = " .$segs[3] . "</p>"; 
		//				echo "<p>segs[4] = " .$segs[4] . "</p>"; 
		//				echo "<p>segs[5] = " .$segs[5] . "</p>";  
            		echo "</div>" ;


            		echo "<div class='col-sm-4 col-md-4' style='padding-top:50px; border-top:thin solid #333333;'>" ;
					//	echo "<p>Banner layout = " . $bannerLayout . "</p>" ;
						echo "<p>Slug ID (slugID)  = " . $slugID . "</p>" ;
					//	echo "<p>Page Layout = " . $pageLayout . "</p>" ;
						//echo "<p>Select Panel 1 = " . $selectpanel1 . "</p>" ;
						//echo "<p>Select Panel 2 = " . $selectpanel2 . "</p>" ;
						//echo "<p>Select Panel 3 = " . $selectpanel3 . "</p>" ;

						echo "<p>&nbsp;</p>";
						$selectprefs1 = "SELECT `name`, `value` FROM `preferences` ORDER BY `prefCat` ";
							$queryprefs1 = mysqli_query($conn,$selectprefs1);
							//while ($rowprefs = mysqli_fetch_assoc($queryprefs) )
							while ($rowprefs1 = mysqli_fetch_array($queryprefs1) )
								{
								//	echo "<p>" . $rowprefs1["name"] . " = " . $rowprefs1["value"] . "</p>";
								}

            		echo "</div>" ;
            	echo "</div>" ;
?>
<!-- END footer-debug.php -->