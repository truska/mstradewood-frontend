<!-- START page-content-standard.php -->
		<div class="container inner inner-page">
		<!-- Breadcrumb Trail -->
			<div class="liquid-nav">
				<ul>
					<li>
						<a href="<?php echo $baseURL ;?>/welcome">Home</a>
					</li>
					<li>
						<a href="#"><?php echo $rowpage["name"] ; ?></a>
					</li>
				</ul>
			</div> 
            
            <div class="row">

<?php
// GET CONTENT
		$GLOBALS['cms_content_debug'] = [];
			
		$selectcontent1 = "SELECT * FROM `content` WHERE `page` = '" . $slugID . "' AND `showonweb` = 'Yes'  ";
		//echo "selectcontent = " . $selectcontent . "<br>" ;
		$querycontent1 = mysqli_query($conn,$selectcontent1);
		$nurows1 = mysqli_num_rows($querycontent1);
		//echo "rows = " .$numrows1 . "<br>";

                
            echo "<div class='col-lg-10 col-md-10 col-sm-12 col-xs-12' style=''>" ;

                
		while ($rowcontent1 = mysqli_fetch_assoc($querycontent1) )
		{
			//	echo $rowcontent["title"] . " | " . $rowcontent["layout"] . "<br>" ;
			$selectcontentlayout = "SELECT `url`, `name` FROM `layout` WHERE `id` = '" . $rowcontent1['layout'] . "' ";
			$querycontentlayout = mysqli_query($conn,$selectcontentlayout);
			$rowcontentlayout = mysqli_fetch_assoc($querycontentlayout) ;
			$layoutUrl = $rowcontentlayout["url"] ?? '';
			$layoutName = $rowcontentlayout["name"] ?? '';
			$GLOBALS['cms_content_debug'][] = [
				'id' => $rowcontent1["id"] ?? null,
				'name' => $rowcontent1["name"] ?? $rowcontent1["title"] ?? $rowcontent1["heading"] ?? '',
				'layout' => $rowcontent1["layout"] ?? '',
				'layout_url' => $layoutUrl,
				'layout_name' => $layoutName,
				'sort' => $rowcontent1["sort"] ?? null,
			];
			
			$contentid = $rowcontent1['id'] ;
		//	echo "<p>ContentID = " . $contentid . "</p>" ;
		//	echo "<p>Layout = " . $rowcontentlayout["url"] . "</p>" ;
                ?>


            	 <!-- L E F T  S I D E B A R   S E C T I O N -->
				<!-- C E N T E R  C O N T A C  T  S E C T I O N -->
				<?php
					include("includes/" . $layoutUrl . "");
				//	include("includes/content-right-side-section.php");
				?>

				
                <?php
		}

        
                echo "</div>" ;
                
                echo "<div class='col-lg-2 col-md-2 hidden-sm hidden-xs' style=''>" ;
                    include("includes/content-standard-sidebar.php");
                echo "</div>" ;

        ?>
			</div>		
		</div>

<!-- END page-content-standard.php -->
