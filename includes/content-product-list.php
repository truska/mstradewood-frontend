<!-- START content-peoduct-list.php () --> 
<?php
// GET CONTENT

$selectcontent = "SELECT * FROM `content` WHERE `id` = '" . $contentid  . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectcontent . "<br>";
					$querycontent = mysqli_query($conn,$selectcontent);
				//	$num_rows_content = mysqli_num_rows($querycontent);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_content . "<br>";
				//	$rowcontent = mysqli_fetch_assoc($querycontent) ;

?>

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				
				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
				<?php
				echo "<div class='col-sm-9'>" ;

				while ($rowcontent = mysqli_fetch_assoc($querycontent) ){
					
					if ($rowcontent["showheading"] == 'Yes') {
						echo "<div class='row'>" ;
							echo "<div class='col-sm-8 col-sm-offset-4'>" ;
								echo "<div class='inner-contact'>" ;
									echo "<h1>" . $rowcontent["heading"] . "</h1>" ;
								echo "</div>" ;
							echo "</div>" ;
						echo "</div>" ;
					}

						echo "<div class='row row-wrp'>" ;
							echo "<div class='col-sm-4 text-center'>" ;
								echo "<div class=''>" ;
									echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowcontent["image"] . "'>" ;
								echo "</div>" ;
							echo "</div>" ;
							echo "<div class='col-sm-8'>" ;
								echo "<div class='inner-contact'>" ;
									echo "" . $rowcontent["text"] . "</p>" ;
									//echo "<a href='https://www.pefc.org/'>https://www.pefc.org/</a>" ;
								echo "</div>" ;

							echo "</div>" ;
						echo "</div>" ;
					
					
				}
				echo "</div>" ;

				?>

<!-- END content-peoduct-list.php -->