<!-- START page-content-products-mobile.php -->

<?php
// GET PRODUCT

	$selectproductlist = "SELECT * FROM `products` WHERE `section` = ' " . $segs[1] . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
		//	echo $selectgallery . "<br>";
			$queryproductlist = mysqli_query($conn,$selectproductlist);
			$num_rows_productlist = mysqli_num_rows($queryproductlist);
		//	$count = 1 ;
		//	echo "Number of records = " . $num_rows_productlist . "<br>";
		//	$rowproductlist = mysqli_fetch_assoc($queryproductlist) ;


?>
 		<div class="container inner inner-page">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
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
				<div class="col-sm-9">
					
					<div class="row">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="inner-contact">
								 
							<?php
								echo "<h1><span style='font-weight:200;'>Product Selection </span>" . $rowpanelfinder["name"] . "</h1>";
								echo "<p>Number of products selected = " . $num_rows_productlist . "</p>" ;
								
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
					$useimage = $rowproduct["image"] ;
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
				
				echo "<div class='col-sm-4 text-center'>" ;
					echo "<div class='' style='valign:top;'>" ;
						echo "<a href='" . $baseURL . "/product/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<img src='" . $baseURL . "/filestore/images/content/" . $brandimage . "' class='img-responsive' style='max-width:250px;'>" ;
						echo "</a>" ;
					echo "</div>" ;
				echo "</div>" ;
				
				echo "<div class='col-sm-8'>" ;
					echo "<div class='inner-contact' style='padding-bottom:50px;'>" ;
						echo "<a href='" . $baseURL . "/product/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>" ;
							echo "<h2>" . $rowproduct["name"] . "</h2>" ;
						echo "</a>" ;
						echo "<p>" . $rowproduct["shorttext"] . "</p>" ;
						echo "<a href='" . $baseURL . "/product/" . $rowproduct["id"] . "/" . strtolower($rowproduct["slug"]) . "'>Click Full Spec</a>" ;
						echo "<p style='font-size:12px; color::#aaaaaa;'>Ref: " . $rowproduct["id"] . "</p>" ;					echo "</div>" ;

				echo "</div>" ;
			echo "</div>" ;
			}
					
		}
					 echo "<h4>Records = " . $num_rows_productlist . "</h4>" ; 
	?>
		</div>

		<?php
			include("includes/content-standard-sidebar.php");
		?>

				 <!-- R I G H T  S I D E B A R   S E C T I O N -->
	</div>
</div>
<!-- END page-content-products-mobile.php -->