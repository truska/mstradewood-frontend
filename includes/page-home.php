<!-- START page-home.php -->

<!-- Specific home Styles -->
<style>
	.inner-footer {background: rgba(255, 255, 255, 0.78);}
</style>

<?php
//Get Content
	
		$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage['id'] . "' AND `showonweb` = 'Yes' ORDER BY `order`  ";
		$querycontent = mysqli_query($conn,$selectcontent);
		$num_rows = mysqli_num_rows($querycontent);
		//echo "rows = " .$num_rows . "<br>";

		$rowcontent = mysqli_fetch_assoc($querycontent) ;


?>
<style>
    .homepage ul {
        list-style:none;
        padding-left:30px;
    }
    .homepage ul li {
        display:list-item;
    }
    .homepage ul li::before {
        content: "\2022";
        color:#3ea244;
         font-weight: bold;
          display: inline-block; 
          width: 1em;
          margin-left: -1em;
    }
    .homepage-inner {
        padding-top:0px;
    }
</style>
<div class='container inner homepage-inner'>
            <div class="row homepage">
				<div class="col-md-6" style="padding-top:100px;"> 
                    <?php
                    echo "<h3>" . $rowcontent["heading"] . "</h3>";
                    echo "" . $rowcontent["text"] . ">";
                    ?>
                    
				</div>
				<div class="col-md-6 right-section homepara2">
                    <?php
                    echo "" . $rowcontent["text2"] . "";
                    ?>

				 </div>
                 <div class="clearfix"></div>
               <div class="col-md-6" style="padding-top:20px;"> 
					<div class="img-section" >
						<img src="<?php echo $baseURL ;?>/filestore/images/content/home-image1.jpg">
					</div>
                    
				</div>
				<div class="col-md-6 col-xs-12 right-section" style="padding-top:20px;">
				<!--	<div class="col-md-4 col-xs-5 col-xs-offset-1 img-section" style="padding-left:0px; "> -->
					<div class="col-md-5 col-xs-5 col-xs-offset-0 img-section" style="padding-left:0px; ">
						<a href="<?php echo $baseURL ;?>/filestore/files/ms-timber-brochure-timber.pdf" target="_blank">
							<img src="<?php echo $baseURL ;?>/filestore/images/content/timber-brochure.jpg" class="img-responsive" style="padding-left:20px;">
						</a>
					</div>
					<div class="col-md-4 col-xs-5 img-section" >
					<!--
                        <a href="<?php echo $baseURL ;?>/filestore/files/ms-timber-brochure-doors.pdf" target="_blank">
							<img src="<?php echo $baseURL ;?>/filestore/images/content/doors-brochure.jpg" class="img-responsive">
						</a>
                    -->
					</div>
                    
				 </div>

			</div>
		</div>

<!-- END page-home.php -->
