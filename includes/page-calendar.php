<!-- START page-calendar.php -->

<section class="row body-area">
	<div class="col-lg-10 col-lg-offset-1 calendar-area">

	<div class="col-lg-8">
	
	<?php
		echo "<div class='col-lg-12'>" ; // Heading across full width
			echo "<h2>Forthcoming Events</h2>";
		echo "</div>" ;
		
		$selectcalendar = "SELECT * FROM `events` WHERE `showonweb` = 'Yes' ORDER BY `date` ASC  ";
		$querycalendar = mysqli_query($conn,$selectcalendar);
		$num_rows = mysqli_num_rows($querycalendar);

	//	echo "Select = " .$selectcalendar . "<br>";
	//	echo "rows = " . $num_rows . "<br>";

		while ($rowcalendar = mysqli_fetch_assoc($querycalendar) )
		{

			$pieces = explode("-", flipdate($rowcalendar["date"],"-","-"));

			// check div after this - set div for left hand column
	//	echo "<div class='col-lg-8  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
			echo "<div class='col-lg-4  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<a href='events/" . $rowcalendar["name"] . "/" . $rowcalendar["id"] . "'><h4>"	. date('D j M Y', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "</h4></a>" ;
			echo "</div>" ;
			echo "<div class='col-lg-8  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<a href='events/" . $rowcalendar["name"] . "/" . $rowcalendar["id"] . "'><h4>"	. $rowcalendar["name"] . "</h4></a>" ;
			echo "</div>" ;

//		echo "</div>" ;
			
		}

		
	?>
	</div>
	<div class="col-lg-4"> 
	<?php

		echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 body-area-right'>" ;
			echo "<h2>Right Col</h2>" ;
		echo "</div>" ; 
		?>
	
	</div>
</section>


<!-- END page-calendar.php -->