<!-- START content-news.php (Layout id = 20)-->
		
<?php
$counter = 1 ;
//Get Data
	$selectnews = "SELECT * FROM `news` WHERE `news_showonweb` = 'Yes' ORDER BY `news_date` DESC";
		$querynews = mysqli_query($conn,$selectnews);
	//	echo "select = " . $selectnews . "<br>" ;
while ($rownews = mysqli_fetch_assoc($querynews) )
		{
	//  Set Col widths	
			//set up date
			$pieces = explode("-", flipdate($rownews["news_date"],"-","-"));

			//date('D M j', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) ;

			
			
if ($counter < 4 ) {
	
		echo "<div class='col-lg-12'>" ; // Heading
		if ($counter > 1){
			echo "<hr>";
		}
				echo "<h1 style='font-size:28px;'><a href='http://" . $_SERVER['SERVER_NAME'] . "/news-story/"	. $rownews["news_id"] . "'>"	. $rownews["news_title"] . "</a></h1>" ;

			echo "<span class='hidden-lg hidden-md hidden-sm' style='width:100%; padding-right:0px;'>" ;
			if ($rownews["news_subtitle"])
			{
				echo "<h2>"	. $rownews["news_subtitle"] . "</h2>" ;
			}
			echo "</span>" ;
		echo "</div>" ;
			// check div after this

				echo "<div class='col-lg-8  col-md-8 col-sm-6 col-xs-12 body-area-left'>" ; 

				if ($rownews["news_subtitle"])
				{
					echo "<h2>"	. $rownews["news_subtitle"] . "</h2>" ;
				}

				echo "<p>"	. $rownews["news_summary"] . "<br>" ;

				echo "<span style='float:right;'>" . date('M Y', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "" ;
				//echo "<span style='float:right;'>" . $rownews["news_date"] . "" ;
				echo "<span style='color:#dddddd;'> - (Ref:"	. $rownews["news_id"] . ")</span><br>" ;
				echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/news-story/"	. $rownews["news_id"] . "'>Read more...</a></span></p>" ;
				//echo "<span style='text-align:right;' color:#333333;>"	. $rownews["news_date"] . "</span></p>" ;
			echo "</div>" ;
		
	// END OF LEFT COL
	


	// START OF RIGHT COL

	
		echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 body-area-right'>" ;			

			
			echo "<div class='col-lg-12 col-md-12 col-sm-6 hidden-xs body-area-right' style='width:100%; padding-right:0px;'>" ;
//echo "<h3>" . $rowcontent["left_width"] . "</h3>" ;
				if ($rownews["news_image"])	
				{

					echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/news/sm-"	. $rownews["news_image"] . "' class='img-responsive' alt='"	. $rownews["news_title"] . " " . $rowcontent["subhead1"] . "'>" ;
				}
			echo "</div>" ;
			

		echo "</div>" ;

	
	
	
}
			else{
		echo "<div class='col-lg-12'>" ; // Heading

				echo "<h1 style='font-size:18px; padding-bottom:10px;'><a href='http://" . $_SERVER['SERVER_NAME'] . "/news-story/"	. $rownews["news_id"] . "'>"	. $rownews["news_title"] . "</a>&nbsp;&nbsp;&nbsp;" ;
				echo "<span style='font-size:12px;'>" . date('M Y', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . " - (Ref:" . $rownews["news_id"] . ")</h1>" ;

		echo "</div>" ;
			// check div after this

			//	echo "<div class='col-lg-12  col-md-12 col-sm-12 col-xs-12 body-area-left'>" ; 


			//	echo "<span style='float:right;'>" . $rownews["news_date"] . "" ;
			//	echo "<span style='color:#dddddd;'> - (Ref:"	. $rownews["news_id"] . ")</span><br>" ;
			//	echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/news-story/"	. $rownews["news_id"] . "'>Read more...</a></span></p>" ;
				//echo "<span style='text-align:right;' color:#333333;>"	. $rownews["news_date"] . "</span></p>" ;
		//	echo "</div>" ;
		
	// END OF LEFT COL
	


			}
			$counter ++ ;
	}
?>
<div class="clearfix"></div>

<!-- END content-news.php -->
		