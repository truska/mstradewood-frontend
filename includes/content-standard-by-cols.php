<!-- START content-standard-by-cols.php (ABOUT US) --> 
<?php
// GET CONTENT
$selectcontent = "SELECT * FROM `content` WHERE `page` = " . $slugID  . " AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectgallery . "<br>";
					$querycontent = mysqli_query($conn,$selectcontent);
				//	$num_rows_content = mysqli_num_rows($querycontent);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_content . "<br>";
					$rowcontent = mysqli_fetch_assoc($querycontent) ;

// GET PEOPLE
$selectpeople = "SELECT * FROM `people` WHERE  `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectpeople . "<br>";
					$querypeople = mysqli_query($conn,$selectpeople);
				//	$numrowspeople = mysqli_num_rows($querypeople);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowspeople . "<br>";
				//	$rowpeople = mysqli_fetch_assoc($querypeople) ;

?>

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->
<style>
    .aboutusimg figure  {
        padding-right:50px;
    }
</style>
				<div class="col-sm-4 col-md-4 sidebar-left"> 
					<div class="sidebar-wpr aboutusimg">
						<h2>Our people</h2>
						
						<?php
						while ($rowpeople = mysqli_fetch_assoc($querypeople) ) {
							if ($rowpeople["image"]) {
								$image = $rowpeople["image"] ;
							}
							else 
							{
								$image = 'default-person.jpg' ;
							}
							
						echo "<figure>" ;
							echo "<img src='" . $baseURL . "/filestore/images/content/" . $image . "'>" ;
							echo "<figcaption>" ;
								echo "<p>" . $rowpeople["name"] . " <span>" . $rowpeople["position"] . "</span></p>" ;
							echo "</figcaption>" ;
						echo "</figure>" ;
						}
						?>
						<!--	
						<figure>
							<img src="<?php echo $baseURL ;?>/filestore/images/content/niall-herbert.jpg">
							<figcaption>
								<p>Niall Herbert <span>Commercial Operations Manager</span></p>
							</figcaption>
						</figure>
						<figure>
							<img src="<?php echo $baseURL ;?>/filestore/images/content/jayne-grattan.jpg">
							<figcaption>
								<p>Jayne Grattan FCA<span>Company Secretary & Accountant</span></p>
							</figcaption>
						</figure>
						<figure>
							<img src="<?php echo $baseURL ;?>/filestore/images/content/richard-kettyle.jpg">
							<figcaption>
								<p>Richard Kettyle <span>Sales Executive</span></p>
							</figcaption>
						</figure>
						<figure>
							<img src="<?php echo $baseURL ;?>/filestore/images/content/karen-anderson.jpg">
							<figcaption>
								<p>Karen Anderson <span>Office Manager (Logistics & Inventory Control)</span></p>
							</figcaption>
						</figure>
						<figure>
							<img src="<?php echo $baseURL ;?>/filestore/images/content/emma-mccreary.jpg">
							<figcaption>
								<p>Emma McCreery<span>Accounts Assistant</span></p>
							</figcaption>
						</figure>
-->
					</div>
				</div>

				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
<?php
                // GET CONTENT
                $selectcontent = "SELECT * FROM `content` WHERE `page` = " . $slugID  . " AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectcontent . "<br>";
					$querycontent = mysqli_query($conn,$selectcontent);
				//	$num_rows_content = mysqli_num_rows($querycontent);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_content . "<br>";
					$rowcontent = mysqli_fetch_assoc($querycontent) ;

?>

				<div class="col-sm-8 col-md-8">
					<div class="inner-contact">
						<h1><?php echo $rowcontent["heading"] ; ?></h1>
						<?php echo $rowcontent["text"] ; ?>
					</div>

				</div>


			<!--	<div class="col-sm-3 col-md3">
					<div class="inner-contact">
						<?php
						echo "<div class='download sbimg'>" ;
							echo "<h3>Download Brochure</h3>" ;
							echo "<a href='" . $baseURL . "/filestore/files/ms-timber-brochure.pdf' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/timber-brochure.jpg' alt='Download MS Timber Brochure' title='Download MS Timber Brochure'></a>" ;
				        echo "</div>" ;
					   ?>
					</div>
				</div>
-->

<!-- END content-standard-by-cols.php -->