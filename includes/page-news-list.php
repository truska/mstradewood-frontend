<!-- START page-news.php -->

<section class="row body-area">
	<div class="col-lg-10 col-lg-offset-1 calendar-area">

	<div class="col-lg-12">
	
	<?php
		echo "<div class='col-lg-12'>" ; // Heading across full width
			echo "<h2>News</h2>";
		echo "</div>" ;
		
		$selectnews = "SELECT * FROM `news` WHERE `showonweb` = 'Yes' ORDER BY `date` ASC  ";
		$querynews = mysqli_query($conn,$selectnews);
		$num_rows = mysqli_num_rows($querynews);

	//	echo "Select = " .$selectnews . "<br>";
	//	echo "rows = " . $num_rows . "<br>";

		while ($rownews = mysqli_fetch_assoc($querynews) )
		{

			$pieces = explode("-", flipdate($rownews["date"],"-","-"));

			// check div after this - set div for left hand column
	//	echo "<div class='col-lg-8  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
			echo "<div class='col-lg-8  col-md-8 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<a href='news/" . $rownews["slug"] . "/" . $rownews["id"] . "'><h4>"	. $rownews["name"] . "</h4></a>" ;
			echo "<p>" . $rownews["shorttext"] . "</p>" ;
			echo "<p><a href='news/" . $rownews["slug"] . "/" . $rownews["id"] . "'>"	. date('D j M Y', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "</a></p>" ;

			echo "</div>" ;


		echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 body-area-right'>" ;
			if ($rownews["image"]) {
				echo "<a href='news/" . $rownews["slug"] . "/" . $rownews["id"] . "'><img src='" . $baseURL . "/filestore/images/news/" . $rownews["image"] . "' class='img-responsive'></a>";
			}
		echo "</div>" ; 
		}
		?>
	
	</div>
		
	</div>

</section>


<!-- END page-calendar.php -->