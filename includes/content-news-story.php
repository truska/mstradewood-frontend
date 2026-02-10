<!-- START content-news-story.php (layout id= 21 )-->
		
<?php
				

//Get Data
	$selectnews = "SELECT * FROM `news` WHERE `news_id` = '" . $segs[1] . "' AND `news_showonweb` = 'Yes' ";
		$querynews = mysqli_query($conn,$selectnews);
		//echo "select = " . $selectnews . "<br>" ;
	$rownews = mysqli_fetch_assoc($querynews) ;
		
	//  Set Col widths	

		echo "<div class='col-lg-12'>" ; // Heading
				echo "<h1 style='font-size:28px;'>"	. $rownews["news_title"] . "</h1>" ;

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

				echo "<p>"	. $rownews["news_text"] . "<br>" ;
				echo "<span style='float:right;'>" . $rownews["news_date"] . "" ;
				echo "<span style='color:#dddddd;'> - (Ref:"	. $rownews["news_id"] . ")</span><br>" ;
				echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/news'>Back to News Index...</a></span></p>" ;
				//echo "<span style='text-align:right;' color:#333333;>"	. $rownews["news_date"] . "</span></p>" ;
			echo "</div>" ;
		
	// END OF LEFT COL
	






	// START OF RIGHT COL


				echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12 body-area-right'>" ;$addlayout = '2' ;			

			
			echo "<div class='col-lg-12 col-md-12 col-sm-6 hidden-xs body-area-right' style='width:100%; padding-right:0px;'>" ;
//echo "<h3>" . $rowcontent["left_width"] . "</h3>" ;
				if ($rownews["news_image"])	
				{

					echo "<img src='http://" . $_SERVER['SERVER_NAME'] . "/filestore/images/news/lg-"	. $rownews["news_image"] . "' class='img-responsive' alt='"	. $rownews["news_title"] . " " . $rowcontent["subhead1"] . "'>" ;
				}
			echo "</div>" ;
			
		echo "</div>" ;
			
		
?>
<div class="clearfix"></div>

<!-- END content-news-story.php -->
		