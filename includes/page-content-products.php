<!-- START page-content-products.php -->

<?php
// GET PRODUCT
//	$selectproduct = "SELECT * FROM `products` WHERE `id` = " . $segs[2]  . " AND `showonweb` = 'Yes' " ;
	$selectpanelfinder = "SELECT * FROM `panelfinder` WHERE `id` = ' " . $segs[1] . "' AND `showonweb` = 'Yes' " ;
		//	echo $selectgallery . "<br>";
			$querypanelfinder = mysqli_query($conn,$selectpanelfinder);
			$rowpanelfinder = mysqli_fetch_assoc($querypanelfinder) ;

	$selectproductlist = "SELECT * FROM `panelfinderbyproduct` WHERE `panelfinder` = ' " . $segs[1] . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
		//	echo $selectgallery . "<br>";
			$queryproductlist = mysqli_query($conn,$selectproductlist);
			$num_rows_productlist = mysqli_num_rows($queryproductlist);
		//	$count = 1 ;
		//	echo "Number of records = " . $num_rows_productlist . "<br>";
		//	$rowproductlist = mysqli_fetch_assoc($queryproductlist) ;


?>
 		<div class="container inner inner-page">
			<div class="row">

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				
				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
				<div class="col-md-10 col-sm-12">
					
					<div class="row">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="inner-contact">
								 
							<?php
								echo "<h1><span style='font-weight:200;'>Product Selection </span>" . $rowpanelfinder["name"] . "</h1>";
                                echo "<p>&nbsp;</p>" ;
								// echo "<p>Please find below  = " . $num_rows_productlist . "</p>" ;
								
							?>
								
							</div>
						</div>
					</div>
	<?php
					
		while ($rowproductlist = mysqli_fetch_assoc($queryproductlist) )
		{
		$selectproduct = "SELECT * FROM `products` WHERE `id` = ' " . $rowproductlist["product"] . "' AND `showonweb` = 'Yes' " ;
			//	echo $selectgallery . "<br>";
				$queryproduct = mysqli_query($conn,$selectproduct);
				$queryproduct = mysqli_query($conn,$selectproduct);
				$num_rows_product = mysqli_num_rows($queryproduct);
			//	$count = 1 ;
			//	echo "Number of records = " . $num_rows_product . "<br>";
			//	$rowproduct = mysqli_fetch_assoc($queryproduct) ;
			$position = "left" ;
			while ($rowproduct = mysqli_fetch_assoc($queryproduct) )
			{
				// Check for image
				if ($rowproduct["image"]) 
				{
					$useimage = "sm-" . $rowproduct["image"] ;
                    $imagefilename = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/" . $useimage ;
                    if (file_exists($imagefilename)) 
                    { 
                        $brandimage = $useimage ;
                    } 
                    else
                    {
                    $useimage = $rowproduct["image"] ;
                    $imagefilename = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/" . $useimage ;
                        if (file_exists($imagefilename)) 
                        { 
                            $brandimage = $useimage ;
                        } 
                    }
                    
				}
				else
				{
					$useimage = $rowproduct["brandimage"] ;
				}
			$imagefilename = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/" . $useimage ;
			if (file_exists($imagefilename)) 
			{ 
				$brandimage = $useimage ;
			}
			else
			{
				$brandimage = 'brand-default.jpg' ;
			}
			
			echo "<div class='row row-wrp'>" ;
                $productslug = 'product';
                if ($rowproduct["section"] == 15 OR $rowproduct["section"] == 16) {$productslug = 'doors';} // DOORS
				
				echo "<div class='col-lg-4 col-md-5 col-sm-6 text-center'>" ;
					echo "<div class='' style='padding-top:10px;'>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<img src='" . $baseURL . "/filestore/images/content/" . $brandimage . "' class='img-responsive' style='max-width:250px;'>" ;
						echo "</a>" ;
            //    echo "image to use = " . $useimage . "" ;
					echo "</div>" ;
				echo "</div>" ;
				
				echo "<div class='col-lg-8 col-md-7 col-sm-6'>" ;
					echo "<div class='inner-contact' style='padding-bottom:30px;'>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<h2>" . $rowproduct["name"] . "</h2>" ;
						echo "</a>" ;
						echo "<p>" . $rowproduct["shorttext"] . "</p>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>Click Full Spec</a>" ;
					//	echo "<p style='font-size:12px; color::#aaaaaa;'>Ref: " . $rowproduct["id"] . " - Section Ref: " . $rowproduct["section"] . "</p>" ;
                echo "</div>" ;

				echo "</div>" ;
			echo "</div>" ;
			}
					
		}
			//		 echo "<h4>Records = " . $num_rows_productlist . "</h4>" ; 
	?>
		</div>

		<?php
                
                echo "<div class='col-lg-2 col-md-2 hidden-sm hidden-xs' style=''>" ;
                    include("includes/content-standard-sidebar.php");
                echo "</div>" ;

		?>

				 <!-- R I G H T  S I D E B A R   S E C T I O N -->
	</div>
</div>
<!-- END page-content-products.php -->