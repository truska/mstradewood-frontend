<!-- START page-home.php -->

<!-- Specific home Styles -->
<style>
	.inner-footer {background: rgba(255, 255, 255, 0.78);}
</style>

<?php
//Get Content
	
		$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage['id'] . "' AND `showonweb` = 'Yes' ORDER BY `sort`  ";
		$querycontent = mysqli_query($conn,$selectcontent);
		$num_rows = mysqli_num_rows($querycontent);
		//echo "rows = " .$num_rows . "<br>";

		$rowcontent = mysqli_fetch_assoc($querycontent) ;


?>
<style>
    .homepage,
    .homepage p,
    .homepage p a,
    .homepage li,
    .homepage h1,
    .homepage h2,
    .homepage h3,
    .homepage h4 {
        color: #fff;
    }
    .homepage h1,
    .homepage h2,
    .homepage h3 {
        font-size: 32px;
        font-weight: 700;
        font-family: 'Lato', sans-serif;
        margin-bottom: 18px;
    }
    .homepage p {
        font-size: 18px;
        margin-bottom: 18px;
    }
    .homepage ul {
        list-style:none;
        padding-left:30px;
    }
    .homepage ul li {
        display:list-item;
        font-size: 18px;
    }
    .homepage ul li::before {
        content: "\2022";
        color:#fff;
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
				<div class="col-md-12" style="padding-top:100px;">
                    <?php
                    echo "<h1>" . $rowcontent["heading"] . "</h1>";
                    ?>
                </div>
				<div class="col-md-6 home-content-left"> 
                    <?php
                    echo "" . $rowcontent["text"] . "";
                    ?>
                    
				</div>
				<div class="col-md-6 right-section homepara2 home-content-right">
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
						<a href="<?php echo $baseURL ;?>/filestore/files/MSTradewood-full-product-brochure.pdf" target="_blank">
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
