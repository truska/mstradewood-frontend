<!-- START page-content-artist.php -->

<section class="row body-area" style="background-color:#ffffff;" >
	<div class="col-lg-12 body-area-top">
	<!--<div class="col-lg-10 col-lg-offset-1 body-area-top"> -->
		
			<?php
				$selectcontent = "SELECT * FROM `artists` WHERE `id` = '" . $segs[1] . "' ";
				$querycontent = mysqli_query($conn,$selectcontent);
				$num_rows = mysqli_num_rows($querycontent);
				//echo "rows = " .$num_rows . "<br>";

				while ($rowcontent = mysqli_fetch_assoc($querycontent) )
				{
						//echo $rowcontent["title"] . " | " . $rowcontent["layout"] . "<br>" ;
					$selectcontentlayout = "SELECT `url` FROM `layout` WHERE `id` = " . $rowcontent['layout'] . " ";
					$querycontentlayout = mysqli_query($conn,$selectcontentlayout);
					$rowcontentlayout = mysqli_fetch_assoc($querycontentlayout) ;

			?>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainbody">
		
			<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 ">
				<h1><?php echo $rowcontent["name"] ; ?></h1>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 pull-right">
				<a href="http://<?php echo $_SERVER['SERVER_NAME'] ;?>/<?php echo $homePageURL ;?>">
					<img src="http://<?php echo $_SERVER['SERVER_NAME'] ;?>/filestore/images/logos/ArtonaTin-portrait-sq.jpg" class="img-responsive pull-right" style="max-width:75px; ">
				</a>
			</div>
		</div>
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 notop"> <!-- Left and center -->
			<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 mainleftcenter"> <!-- Left and center -->
				<!-- Main Image -->
				<a href="http://<?php echo $_SERVER['SERVER_NAME'] ;?>/filestore/images/content/lg-<?php echo $rowcontent["image"] ; ?>" class="MagicThumb" id="product1" />
					<img src="http://<?php echo $_SERVER['SERVER_NAME'] ;?>/filestore/images/content/<?php echo $rowcontent["image"] ; ?>" class="img-responsive" />
				</a>

			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 notop quote"> <!-- Left and center -->
				<h3>Heading ???:-</h3>
				<?php
					echo $rowcontent["text1"] ;
				?>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 notop fullproductrangescroll"> <!-- Left and center -->
				
			<!-- Thunmbnail Images -->
				<?php 
					$folder = 'content' ;
					include("includes/content-thumbnail-images.php"); 
				?>	
								
			</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 notop"> <!-- Left and center -->
			<h2><?php echo $rowcontent["subhead1"] ; ?></h2>
			<?php echo $rowcontent["text"] ; ?>
		</div>
		
		<?php
			}
		?>
	</div>
	
		<?php include("includes/content-all-product-scroll.php"); ?>	

		</div>
	</div>


</section>
<!-- END page-content-artist.php -->