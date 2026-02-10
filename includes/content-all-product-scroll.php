<!-- START all-product-scroll.php -->

	<?php
		echo "<div class='col-lg-12 fullproductrange'>" ;
			echo "<h3>Full Product Range</h3>" ;
		echo "</div>" ;
		$selectproducts = "SELECT * FROM `products` WHERE `showonweb` = 'Yes' ORDER BY `order`  ";
		$queryproducts = mysqli_query($conn,$selectproducts);
		echo "<div class='col-lg-12 fullproductrangescroll'>" ;
			echo "<div class='MagicScroll'>" ;
				while ($rowproducts = mysqli_fetch_assoc($queryproducts) )
				{
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/art-on-a-tin-product/" . $rowproducts["id"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME']  . "/filestore/images/product/" . $rowproducts["image"] . "' class='img-responsive' style='height:150px;' alt='" . $rowproducts["title"] . "' title='" . $rowproducts["title"] . "' />" ;
					echo "</a>" ;
				}

			echo "</div>" ;
		echo "</div>" ;
?>


<!-- END all-product-scroll.php -->