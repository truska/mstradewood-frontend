<!-- START page-content-1-right-col.php -->
<style>
	.body-area-left iframe {
		width:940px;
		height:600px;
	}
</style>
<section class="row body-area">
	<div class="col-lg-10 col-lg-offset-1 body-area-top">
		<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">

		<?php
			$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage['id'] . "' AND `showonweb` = 'Yes' ORDER BY `sort`  ";
			$querycontent = mysqli_query($conn,$selectcontent);
			$num_rows = mysqli_num_rows($querycontent);
			//echo "rows = " .$num_rows . "<br>";
			$counter = 1;
			while ($rowcontent = mysqli_fetch_assoc($querycontent) )
			{
					//echo $rowcontent["title"] . " | " . $rowcontent["layout"] . "<br>" ;
				$selectcontentlayout = "SELECT `url` FROM `layout` WHERE `id` = " . $rowcontent['layout'] . " ";
				$querycontentlayout = mysqli_query($conn,$selectcontentlayout);
				$rowcontentlayout = mysqli_fetch_assoc($querycontentlayout) ;

				//	echo $rowcontent["title"] . " | " . $rowcontent["layout"] . " | " . $rowcontentlayout["url"] . "<br>" ;
				// echo "select = " . $selectcontent . "<br>" ;

					include("includes/" . $rowcontentlayout["url"] . "") ; 
				if ($counter == 1) {
					// SET UP IMAGES
					$image1 = $rowcontent['image'];
				}
				$counter = $counter + 1 ;
			}

			?>
		</div>

		<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12"> <!-- Right Col --> 
			<!-- Carousel here -->
			<?php
				if ($image1) {
					echo "<p style='font-size: 35px;font-weight: 400;'>&nbsp;</p>" ;
					echo "<img src='filestore/images/content/" . $image1 . "' class='img-responsive'>" ;
					$image1 = '';
				}
			?>
		</div>
	</div>
</section>


<!-- END page-content-1-right-col.php -->
