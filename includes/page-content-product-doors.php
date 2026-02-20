<!-- START page-content-product-doors.php -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php
// GET PRODUCT
$selectproduct = "SELECT * FROM `products` WHERE `id` = " . $segs[1]  . " AND `showonweb` = 'Yes' " ;
				//	echo "selectproduct = " . $selectproduct . "<br>";
					$queryproduct = mysqli_query($conn,$selectproduct);
				//	$num_rows_product = mysqli_num_rows($queryproduct);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_product . "<br>";
					$rowproduct = mysqli_fetch_assoc($queryproduct) ;

// GET Features
$selectfeatures = "SELECT * FROM `productfeatures` WHERE `product` = " . $rowproduct["id"]  . " AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectfeatures . "<br>";
					$queryfeatures = mysqli_query($conn,$selectfeatures);
					$numrowsfeatures = mysqli_num_rows($queryfeatures);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_features . "<br>";

// GET Tech Spec
$selecttech = "SELECT * FROM `producttechspec` WHERE `product` = " . $rowproduct["id"]  . " AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selecttech . "<br>";
					$querytech = mysqli_query($conn,$selecttech);
					$numrowstech = mysqli_num_rows($querytech);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_tech . "<br>";

// GET Maunf
$selectmanuf = "SELECT * FROM `manuf` WHERE `id` = " . $rowproduct["manuf"]  . " AND `showonweb` = 'Yes' " ;
				//	echo "selectmanuf = " . $selectmanuf . "<br>";
					$querymanuf = mysqli_query($conn,$selectmanuf);
				//	$numrowsmanuf = mysqli_num_rows($querymanuf);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsmanuf . "<br>";
					$rowmanuf = mysqli_fetch_assoc($querymanuf) ;

// GET Gallery Images
$selectgallery = "SELECT * FROM `gallery` WHERE `product` = " . $rowproduct["id"]  . " AND `showonweb` = 'Yes' " ;
				//	echo "selectgallery = " . $selectgallery . "<br>";
					$querygallery = mysqli_query($conn,$selectgallery);
				//	$numrowsgallery = mysqli_num_rows($querygallery);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsgallery . "<br>";
				//	$rowgallery = mysqli_fetch_assoc($querygallery) ;

?>
<style>
    .thumbnailimages {
      /*  padding-left:0px; padding-right:0px; */
        padding:5px;
    }
</style>
		<div class="container inner inner-page">

		<!-- Breadcrumb Trail -->
			<div class="liquid-nav">
				<ul>
					<li>
						<a href="<?php echo $baseURL ;?>/welcome">Home</a>
					</li>
					<li>
						<a href="#"> Products </a>
					</li>
					<li>
						<a href="#"> Doors </a>
					</li>
					<li>
						<a href="#"><?php echo $rowproduct["name"] ; ?></a>
					</li>
				</ul>
			</div> 
            
            <div class="row hibernia-wrp">

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-left"> 
					<figure>	
					<!--	<div class="col-xs-4 col-sm-12 col-md-12 sidebar-left" style="padding-left: 0px; padding-right: 0px;">  -->
                    <?php 
                        if ($rowmanuf["id"] == 1 ) {
                            $imagetag = $rowmanuf["name"] . " " . $rowproduct["name"] ;
                        }
                        else
                        {
                            $imagetag = $rowproduct["name"] . " available from MS Timber " ;
                        }
                    ?>
							<div class="sidebar-wpr" style="padding-bottom:25px;">	
								<img src="<?php echo $baseURL ;?>/filestore/images/content/<?php echo $rowproduct["brandimage"] ; ?>" class="img-responsive" alt="<?php echo $imagetag ; ?>" title="<?php echo $imagetag ; ?>">
							</div>
					<!--	</div>
						<div class="col-xs-8 col-sm-12 col-md-12 sidebar-wrp" style="padding-left: 0px; padding-right: 0px;">  -->
							<figcaption>
                                <?php
                                if ($numrowsfeatures > 0) { 
                                    echo "<ul>" ;									
                                        while ($rowfeatures = mysqli_fetch_assoc($queryfeatures) )
                                        {
                                            echo "<li>• " . $rowfeatures["feature"] . "</li>" ;
                                        }
                                    echo "</ul>" ;
                                }
                                
                                if ($rowproduct["showdop"] == 'Yes') {
                                    if ($rowproduct["dop"]) {
                                    ?>
                                        <a href="<?php echo $baseURL ;?>/filestore/files/<?php echo $rowproduct["dop"] ; ?>" target='_blank'>CLICK HERE TO REQUEST <?php echo $rowproduct["doptext"] ; ?> <img src="<?php echo $baseURL ;?>/images/xcggdf.png" class="pull-right" alt='<?php echo $imagetag ; ?>' title='Download <?php echo $imagetag ; ?> DOP'></a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="javascript:void(0)" class="banner-btn" data-toggle="modal" data-target="#chat-Modal">
                                        CLICK HERE TO REQUEST <?php echo $rowproduct["doptext"] ; ?>
                                    </a>

                                    <?php
                                    }
                                }
                                else
                                {
                                      ?>
                                        <a href="" target=''>&nbsp;</a>
                                    <?php
                                }
                                ?>							</figcaption>
								<?php 
                        
                        //Doors image section
                        $gallerycounter = 1 ;
                        while ($rowgallery = mysqli_fetch_assoc($querygallery) )
                        {
                            $gallerytag = $rowgallery["name"] . " available from MS Timber " ;
                            if ($rowgallery["image"])
                            {
                                $imagefilenamelg1 = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/lg-" . stripslashes($rowgallery["image"]) ;
                                if (file_exists($imagefilenamelg1)) { $imagefilenamelg = "lg-" . stripslashes($rowgallery["image"]) ; }


                                $imagefilenamesm1 = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/sm-" . stripslashes($rowgallery["image"]) ;
                                if (file_exists($imagefilenamesm1)) { 
                                    $imagefilenamesm = "sm-" . stripslashes($rowgallery["image"]) ; } else  { $imagefilenamesm = stripslashes($rowgallery["image"]) ; }
                                
                                $imagefilenametn1 = $_SERVER['DOCUMENT_ROOT'] . "/filestore/images/content/tn-" . stripslashes($rowgallery["image"]) ;
                                if (file_exists($imagefilenametn1)) { $imagefilenametn = "tn-" . stripslashes($rowgallery["image"]) ; }
                                
                                if ($gallerycounter == 1 ) {
                                echo "<div style='padding-bottom:20px; display:block;  margin-left:auto; margin-right:auto; width:100%;'>" ;

                                        if (file_exists($imagefilenamelg1)) 
                                        { 
                                            echo "<a href='" . $baseURL . "/filestore/images/content/" . $imagefilenamelg . "' class='MagicZoom' title='" . $gallerytag. "' id='doors' data-options='zoomWidth:120%; zoomHeight:100%'>" ;
                                                echo "<img src='" . $baseURL . "/filestore/images/content/" . $imagefilenamesm . "' class='img-responsive' alt='" . $gallerytag . "' title='" . $gallerytag. "'>" ;
                                            echo "</a>" ;
                                        }
                                        else
                                        {
                                            echo "<img src='" . $baseURL . "/filestore/images/content/" . $imagefilenamesm . "' class='img-responsive' alt='" . $gallerytag . "' title='" . $gallerytag. "'>" ;
                                        }
                                echo "</div>" ;
                                
                                echo "<div class='thumbnailimages' style='padding-bottom:20px; padding-left:0px; padding-right:0px;'>" ;
                                    }
                                
                            }
                                //Thumbnails

                                if (file_exists($imagefilenamelg1)) {
                                    echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 thumbnailimages' >" ;
                                        echo "<a data-zoom-id='doors' href='" . $baseURL . "/filestore/images/content/" . $imagefilenamelg . "' data-image='" .   $baseURL . "/filestore/images/content/" . $imagefilenamesm . "'>" ;
                                            echo "<img src='" . $baseURL . "/filestore/images/content/" . $imagefilenametn . "'>" ;
                                        echo "</a>" ;
                                    echo "</div>" ;

                                    $gallerycounter ++ ;
                              }
                                  
                        }
                            echo "</div>" ;
								?>

                                <!--	</div> -->
                                </figure>
                                    <div class="clearfix"></div>
                                    <p><span style="text-align:right; font-size:12px; color: #333333; margin-top:30px;"><?php echo $imagetag ;?></span><br>
                                        <span style="text-align:right; font-size:11px; color: #aaaaaa; margin-top:30px;">Product Ref ID : <?php echo $rowproduct["id"] ; ?> | 
                                        Section: <?php echo $rowproduct["section"] ; ?> </span></p>
				</div>
				

				<!-- C E N T E R  P R O D U C T  S E C T I O N -->
				<div class="col-sm-6 col-md-7 col-lg-7">
					<div class="inner-contact productpage">
						<h1><?php echo $rowproduct["name"] ; ?></h1>
				<!--		<p class="sub-p"><?php echo $rowproduct["shorttext"] ; ?> </p> -->
                        <div class="productdetail">
                            <?php echo $rowproduct["text"] ; ?>
                        </div>
						
                        
                        <?php
                        if ($numrowstech > '0') {
                        ?>
                        <div class="techspecarea" style="padding-right:30px;">
                            <h4>Technical <span>specifications</span></h4>
                            <ul class="hibernia-list">

                                <?php
                                while ($rowtech = mysqli_fetch_assoc($querytech) )
                                {
                                    echo "<li>" . $rowtech["feature"] . "</li>" ;
                                }
                                ?>
                            </ul>
                        
					   </div>
                        <?php
                        }
                        ?>
					</div>

				</div>
				
				<?php
                $pageslug = 'doors';
				include("includes/content-right-side-section.php");
				?>
			</div>
		
		</div>


<!-- END page-content-product-doors.php -->
