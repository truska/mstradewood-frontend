<!-- START content-thumbnail-images.php -->

			<!-- Thunmbnail Images -->
			<?php
				echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
		/*			
			$tncounter = 1 ;		
			while ($tncounter < 6) {
				 $field = "image" . $tncounter ;
				echo $field . "<br>" ;
			
				//if($rowcontent['".$field."']) {
				if($rowcontent[$field]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/content/lg-" . $rowcontent["image1"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/content/" . $rowcontent["image1"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/content/" . $rowcontent["image1"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
					
				$tncounter ++ ;
				}
			*/

				if($rowcontent["image1"]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image1"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image1"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image1"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
				}
					
				if($rowcontent["image2"]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image2"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image2"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image2"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
				}
				if($rowcontent["image3"]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image3"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image3"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image3"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
				}
				if($rowcontent["image4"]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image4"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image4"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image4"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
				}
				if($rowcontent["image5"]) {
					echo "<div class='col-lg-2 col-md-2 col-sm-3 col-xs-4 thumbnails'>" ;
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/lg-" . $rowcontent["image5"] . "' data-thumb-id='product1' data-image='http://" .  $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image5"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/" . $folder . "/" . $rowcontent["image5"] . "' class='img-responsive' />" ;
					echo "</a>" ;
				echo "</div>" ;
				}
			?>

<!-- END content-thumbnail-images.php -->