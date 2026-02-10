<!-- START page-event.php -->
<?php
		$selectnews = "SELECT * FROM `news` WHERE `id` = " . $segs[2] . " AND `showonweb` = 'Yes' ";
		$querynews = mysqli_query($conn,$selectnews);
		$num_rows = mysqli_num_rows($querynews);
		$rownews = mysqli_fetch_assoc($querynews) ;
				$pieces = explode("-", flipdate($rownews["date"],"-","-"));

?>
<section class="row body-area">
	
	<div class="col-lg-10 col-lg-offset-1 body-area-top">
		
		<div class="col-lg-12 col-md-12">
			<?php
			echo "<h1>"	. $rownews["name"] . "</h1>" ; 
			if ($rownews["image"]) {
				echo "<img src='" . $baseURL . "/filestore/images/news/" . $rownews["image"] . "' class='img-responsive'>";
			}
?>
		</div>
		<div class="col-lg-8 col-md-3">
			<?php echo "<h4><strong>"	. date('D M j', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "</strong></h4>" ; ?>
		</div>
		<div class="col-lg-3 col-md-3">
			<?php echo "<p style='float:righ';><a href='" . $baseURL . "/news-index'><<< Back to News Home</a></p>" ; ?>
		</div>
		
		<div class="clearfix"></div>
		
		<div class="col-lg-8">

		<?php

				echo "<div class='col-lg-8 col-md-8 col-sm-6 col-xs-12 body-area-left'>" ; 
					echo "<p>" . $rownews["text"] . "</p>" ;
				echo "</div>" ;


				echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
					echo "<p>ref: " . $rownews["id"] . "</p>";
				echo "</div>" ;

	//		echo "</div>" ;




		?>
		</div>
		<div class="col-lg-4"> 
		<?php

			echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 body-area-right'>" ;
			if ($rownews["image1"]) {
				echo "<img src='" . $baseURL . "/filestore/images/news/" . $rownews["image1"] . "' class='img-responsive'>";
			}
			?>

		</div>
	
	</div>
</section>


<!-- END page-event.php -->