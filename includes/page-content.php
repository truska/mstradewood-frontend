<!-- START page-content.php -->

<section class="row body-area">
	<div class="col-lg-10 col-lg-offset-1 body-area-top">
	
	<?php
		$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage['id'] . "' AND `showonweb` = 'Yes' ORDER BY `order`  ";
		$querycontent = mysqli_query($conn,$selectcontent);
		$num_rows = mysqli_num_rows($querycontent);
		//echo "rows = " .$num_rows . "<br>";

		while ($rowcontent = mysqli_fetch_assoc($querycontent) )
		{
				//echo $rowcontent["title"] . " | " . $rowcontent["layout"] . "<br>" ;
			$selectcontentlayout = "SELECT `url` FROM `layout` WHERE `id` = " . $rowcontent['layout'] . " ";
			$querycontentlayout = mysqli_query($conn,$selectcontentlayout);
			$rowcontentlayout = mysqli_fetch_assoc($querycontentlayout) ;

//	echo $rowpage["title"] . " | " . $pageLayout . "<br>" ;
//	echo $rowcontent["title"] . " | " . $rowcontent["layout"] . " | " . $rowcontentlayout["url"] . "<br>" ;
				include("includes/" . $rowcontentlayout["url"] . "") ; 
		}
	
		?>
	
	</div>
</section>


<!-- END page-content.php -->