<!-- START page-event.php -->
<?php
		$selectcalendar = "SELECT * FROM `events` WHERE `id` = " . $segs[2] . " AND `showonweb` = 'Yes' ";
		$querycalendar = mysqli_query($conn,$selectcalendar);
		$num_rows = mysqli_num_rows($querycalendar);
		$rowcalendar = mysqli_fetch_assoc($querycalendar) ;

?>
<section class="row body-area">
	
	<div class="col-lg-10 col-lg-offset-1 body-area-top">
		
		<div class="col-lg-9 col-md-9">
			<?php echo "<h1>"	. $rowcalendar["name"] . "</h1>" ; ?>
		</div>
		<div class="col-lg-3 col-md-3">
			<?php echo "<p style='float:righ';><a href='" . $baseURL . "/web-events'><<< Back to Calendar</a></p>" ; ?>
		</div>
		
		<div class="clearfix"></div>
		
		<div class="col-lg-8">

		<?php

				$pieces = explode("-", flipdate($rowcalendar["date"],"-","-"));

				// check div after this - set div for left hand column
	//		echo "<div class='col-lg-12  col-md-12 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
					echo "<h4><strong>"	. date('D M j', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "</strong></h4>" ;
					echo "<h4>Location:<br><strong>" . $rowcalendar["location"] . "</strong></h4>";
					echo "<h4>Time: <strong>" . $rowcalendar["time"] . "</strong></h4>";
					echo "<p>ref: " . $rowcalendar["id"] . "</p>";
				echo "</div>" ;
				echo "<div class='col-lg-8 col-md-8 col-sm-6 col-xs-12 body-area-left'>" ; 
					echo "<p>" . $rowcalendar["text"] . "</p>" ;
				echo "</div>" ;

	//		echo "</div>" ;




		?>
		</div>
		<div class="col-lg-4"> 
		<?php

			echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 body-area-right'>" ;
			if ($rowcalendar["image"]) {
				echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowcalendar["image"] . "' class='img-responsive'>";
			}
			?>

		</div>
	
	</div>
</section>


<!-- END page-event.php -->