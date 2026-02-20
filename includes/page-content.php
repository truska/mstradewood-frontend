<!-- START page-content.php -->

<section class="row body-area">
	<div class="col-lg-10 col-lg-offset-1 body-area-top">
	
	<?php
		$GLOBALS['cms_content_debug'] = [];
		$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage['id'] . "' AND `showonweb` = 'Yes' ORDER BY `sort`  ";
		$querycontent = mysqli_query($conn,$selectcontent);
		$num_rows = mysqli_num_rows($querycontent);
		//echo "rows = " .$num_rows . "<br>";

		while ($rowcontent = mysqli_fetch_assoc($querycontent) )
		{
				//echo $rowcontent["title"] . " | " . $rowcontent["layout"] . "<br>" ;
			$selectcontentlayout = "SELECT `url`, `name` FROM `layout` WHERE `id` = " . $rowcontent['layout'] . " ";
			$querycontentlayout = mysqli_query($conn,$selectcontentlayout);
			$rowcontentlayout = mysqli_fetch_assoc($querycontentlayout) ;
			$layoutUrl = $rowcontentlayout["url"] ?? '';
			$layoutName = $rowcontentlayout["name"] ?? '';
			$GLOBALS['cms_content_debug'][] = [
				'id' => $rowcontent["id"] ?? null,
				'name' => $rowcontent["name"] ?? $rowcontent["title"] ?? $rowcontent["heading"] ?? '',
				'layout' => $rowcontent["layout"] ?? '',
				'layout_url' => $layoutUrl,
				'layout_name' => $layoutName,
				'sort' => $rowcontent["sort"] ?? null,
			];

//	echo $rowpage["title"] . " | " . $pageLayout . "<br>" ;
//	echo $rowcontent["title"] . " | " . $rowcontent["layout"] . " | " . $rowcontentlayout["url"] . "<br>" ;
				include("includes/" . $layoutUrl . "") ; 
		}
	
		?>
	
	</div>
</section>


<!-- END page-content.php -->
