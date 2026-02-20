<!-- START page-content-products-section.php -->

<?php
require_once __DIR__ . '/lib/cms_product_images.php';
// GET PRODUCT

	$selectproductlist = "SELECT * FROM `products` WHERE `section` = ' " . $segs[1] . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
		//	echo $selectgallery . "<br>";
			$queryproductlist = mysqli_query($conn,$selectproductlist);
			$num_rows_productlist = mysqli_num_rows($queryproductlist);
		//	$count = 1 ;
		//	echo "Number of records = " . $num_rows_productlist . "<br>";
		//	$rowproductlist = mysqli_fetch_assoc($queryproductlist) ;

	$selectsection = "SELECT * FROM `sections` WHERE `id` = ' " . $segs[1] . "'  " ;
		//	echo $selectsection . "<br>";
			$querysection = mysqli_query($conn,$selectsection);
			$numrowssection = mysqli_num_rows($querysection);
		//	$count = 1 ;
		//	echo "Number of records = " . $numrowssection . "<br>";
			$rowsection = mysqli_fetch_assoc($querysection) ;
?>
 		<div class="container inner inner-page">
			
<!--
			<div class="liquid-nav">
				<ul>
					<li>
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="#">Softwood</a>
					</li>
					<li>
						<a href="#">Chieftian</a>
					</li>
					<li>
						<a href="contact.html">Contact Us</a>
					</li>
				</ul>
					<?php echo "<h3>Records = " . $num_rows_productlist . "</h3>" ; ?>
				
			</div>
-->
			<div class="row">

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				
				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
				<div class="col-sm-10">
					
					<div class="row">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="inner-contact">
								 
							<?php
								echo "<h1><span style='font-weight:200;'>Product Selection </span> " . $rowsection["name"] . " </h1>";
                                echo "<p>&nbsp;</p>" ;
							//	echo "<p>Number of products selected = " . $num_rows_productlist . "</p>" ;
								
							?>
								
							</div>
						</div>
					</div>
	<?php
					
		while ($rowproductlist = mysqli_fetch_assoc($queryproductlist) )
		{
		$selectproduct = "SELECT * FROM `products` WHERE `id` = ' " . $rowproductlist["id"] . "' AND `showonweb` = 'Yes' " ;
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
				$cardImageUrl = cms_product_card_image_url($conn, $rowproduct, $baseURL);
			
			echo "<div class='row row-wrp'>" ;
                $productslug = 'product';
                if ($rowproduct["section"] == 15 OR $rowproduct["section"] == 16) {$productslug = 'doors';} // DOORS
				
				echo "<div class='col-lg-4 col-md-5 col-sm-6 text-center'>" ;
					echo "<div class='' style='padding-top:10px;'>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<img src='" . $cardImageUrl . "' class='img-responsive' style='max-width:250px;' alt='" . htmlspecialchars((string) $rowproduct["name"], ENT_QUOTES, 'UTF-8') . "'>" ;
						echo "</a>" ;
					echo "</div>" ;
				echo "</div>" ;
				
				echo "<div class='col-lg-8 col-md-7 col-sm-6'>" ;
					echo "<div class='inner-contact' style='padding-bottom:30px;'>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<h2>" . $rowproduct["name"] . "</h2>" ;
						echo "</a>" ;
						echo "<p>" . $rowproduct["shorttext"] . "</p>" ;
						echo "<a href='" . $baseURL . "/" . $productslug ."/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>Click Full Spec</a>" ;
					//	echo "<p style='font-size:12px; color::#aaaaaa;'>Ref: " . $rowproduct["id"] . " - Section Ref: " . $rowproduct["section"] . "</p></p>" ;
                echo "</div>" ;

				echo "</div>" ;
			echo "</div>" ;
			}
					
		}
				//	 echo "<h4>Records = " . $num_rows_productlist . "</h4>" ; 
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
<!-- END page-content-products-section.php -->
