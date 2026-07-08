<!-- START page content product -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php
require_once __DIR__ . '/lib/cms_product_images.php';
require_once __DIR__ . '/lib/cms_images.php';
require_once __DIR__ . '/lib/cms_product_models.php';

$cmsHasColumn = static function (mysqli $conn, string $table, string $column): bool {
    $tableEsc = mysqli_real_escape_string($conn, $table);
    $columnEsc = mysqli_real_escape_string($conn, $column);
    $sql = "SHOW COLUMNS FROM `$tableEsc` LIKE '$columnEsc'";
    $result = mysqli_query($conn, $sql);
    return ($result && mysqli_num_rows($result) > 0);
};

// GET PRODUCT
$selectproduct = "SELECT * FROM `products` WHERE `id` = " . $segs[1]  . " AND `showonweb` = 'Yes' " ;
				//	echo "selectproduct = " . $selectproduct . "<br>";
					$queryproduct = mysqli_query($conn,$selectproduct);
				//	$num_rows_product = mysqli_num_rows($queryproduct);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_product . "<br>";
					$rowproduct = mysqli_fetch_assoc($queryproduct) ;

// GET Features (supports legacy and normalized schemas).
$pfNameCol = $cmsHasColumn($conn, 'productfeatures', 'name') ? 'name' : 'feature';
$pfSortCol = $cmsHasColumn($conn, 'productfeatures', 'sort') ? 'sort' : 'order';
$pfHasFeatureId = $cmsHasColumn($conn, 'productfeatures', 'feature_id');
$fcNameCol = $cmsHasColumn($conn, 'product_feature_catalog', 'name') ? 'name' : 'feature';

if ($pfHasFeatureId) {
    $selectfeatures = "SELECT pf.*, COALESCE(fc.`$fcNameCol`, pf.`$pfNameCol`) AS feature_label
                       FROM `productfeatures` pf
                       LEFT JOIN `product_feature_catalog` fc ON fc.id = pf.feature_id
                       WHERE pf.`product` = " . (int) $rowproduct["id"] . " AND pf.`showonweb` = 'Yes'
                       ORDER BY pf.`$pfSortCol`";
} else {
    $selectfeatures = "SELECT pf.*, pf.`$pfNameCol` AS feature_label
                       FROM `productfeatures` pf
                       WHERE pf.`product` = " . (int) $rowproduct["id"] . " AND pf.`showonweb` = 'Yes'
                       ORDER BY pf.`$pfSortCol`";
}
$queryfeatures = mysqli_query($conn, $selectfeatures);
$numrowsfeatures = $queryfeatures ? mysqli_num_rows($queryfeatures) : 0;

// GET Tech Spec (supports legacy and normalized schemas).
$ptsNameCol = $cmsHasColumn($conn, 'producttechspec', 'name') ? 'name' : 'feature';
$ptsSortCol = $cmsHasColumn($conn, 'producttechspec', 'sort') ? 'sort' : 'order';
$ptsHasSpecId = $cmsHasColumn($conn, 'producttechspec', 'spec_id');
$tscNameCol = $cmsHasColumn($conn, 'product_techspec_catalog', 'name') ? 'name' : 'spec';

if ($ptsHasSpecId) {
    $selecttech = "SELECT pts.*, COALESCE(tsc.`$tscNameCol`, pts.`$ptsNameCol`) AS feature_label
                   FROM `producttechspec` pts
                   LEFT JOIN `product_techspec_catalog` tsc ON tsc.id = pts.spec_id
                   WHERE pts.`product` = " . (int) $rowproduct["id"] . " AND pts.`showonweb` = 'Yes'
                   ORDER BY pts.`$ptsSortCol`";
} else {
    $selecttech = "SELECT pts.*, pts.`$ptsNameCol` AS feature_label
                   FROM `producttechspec` pts
                   WHERE pts.`product` = " . (int) $rowproduct["id"] . " AND pts.`showonweb` = 'Yes'
                   ORDER BY pts.`$ptsSortCol`";
}
$querytech = mysqli_query($conn, $selecttech);
$numrowstech = $querytech ? mysqli_num_rows($querytech) : 0;

// GET Maunf
$selectmanuf = "SELECT * FROM `manuf` WHERE `id` = " . $rowproduct["manuf"]  . " AND `showonweb` = 'Yes' " ;
				//	echo "selectmanuf = " . $selectmanuf . "<br>";
					$querymanuf = mysqli_query($conn,$selectmanuf);
				//	$numrowsmanuf = mysqli_num_rows($querymanuf);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsmanuf . "<br>";
					$rowmanuf = mysqli_fetch_assoc($querymanuf) ;

$companyName = trim((string) cms_pref('prefCompanyName', (string) getCompanyName($prefs)));
if ($companyName === '') {
    $companyName = 'MSTradewood';
}

$productGalleryImages = cms_product_gallery_images(
    $conn,
    (int) ($rowproduct['id'] ?? 0),
    (string) $baseURL,
    (string) ($rowproduct['name'] ?? '')
);
$productModel = cms_product_model($rowproduct ?? [], (string) $baseURL);
$productLifestyleImage = cms_product_lifestyle_image($rowproduct ?? [], (string) $baseURL);

$magicToolboxMode = function_exists('cms_magictoolbox_mode') ? cms_magictoolbox_mode() : 'magiczoomplus';
if ($magicToolboxMode === 'none') {
    $magicToolboxMode = 'magiczoomplus';
}
$magicToolboxClass = $magicToolboxMode === 'magiczoomplus' ? 'MagicZoomPlus' : 'MagicZoom';
$magicToolboxOptionsAttr = " data-options='zoomWidth:120%; zoomHeight:100%'";
?>

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
						<a href="#"><?php echo $rowproduct["name"] ; ?></a>
					</li>
				</ul>
			</div> 
            
	            <div class="row hibernia-wrp cms-edit-target">
                    <?php
                    $productEditItem = [
                        'id' => (int) ($rowproduct['id'] ?? 0),
                        'table_name' => 'products',
                    ];
                    echo cms_render_frontend_edit_button($productEditItem);
                    ?>

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-left"> 
					<figure>	
					<!--	<div class="col-xs-4 col-sm-12 col-md-12 sidebar-left" style="padding-left: 0px; padding-right: 0px;">  -->
                    <?php 
                        if ($rowmanuf["id"] == 1 ) {
                            $imagetag = $rowmanuf["name"] . " | " . $rowproduct["name"] ;
                        }
                        else
                        {
                            $imagetag = $rowproduct["name"] . " available from " . $companyName;
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
                                            echo "<li>• " . ($rowfeatures["feature_label"] ?? $rowfeatures[$pfNameCol]) . "</li>" ;
                                        }
                                    echo "</ul>" ;
                                }
                                
                                
                                if ($rowproduct["showdop"] == 'Yes') {
                                    if ($rowproduct["dop"]) {
                                    ?>
                                        <!-- Link straight to download DOP document -->
                                        <!-- there should be no uses if this code -->
                                        <a href="<?php echo $baseURL ;?>/filestore/files/<?php echo $rowproduct["dop"] ; ?>" target='_blank'>
                                            CLICK HERE TO REQUEST <?php echo $rowproduct["doptext"] ; ?>
                                        </a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <!-- All products with $showdop == yes should use this / Direct link above is not being used currently -->
                                    <!-- Code for popup form is in footer-code.php -->
                                    <a href="#" class="banner-btn" data-bs-toggle="modal" data-bs-target="#dopRequestModal">
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
                                ?>
							</figcaption>
                                <?php echo cms_render_product_model($productModel, 'Interactive 3D model of ' . $imagetag); ?>
								<?php
                                if (!empty($productGalleryImages)) {
                                    $firstImage = $productGalleryImages[0];
                                    echo "<div style='padding-bottom:20px; display:block; margin-left:auto; margin-right:auto; width:100%;'>";
                                    echo "<a href='" . $firstImage['zoom'] . "' class='" . $magicToolboxClass . "' id='product-gallery-zoom' title='" . htmlspecialchars($firstImage['alt'], ENT_QUOTES, 'UTF-8') . "'" . $magicToolboxOptionsAttr . ">";
                                    echo "<img src='" . $firstImage['main'] . "' class='img-responsive' alt='" . htmlspecialchars($firstImage['alt'], ENT_QUOTES, 'UTF-8') . "' title='" . htmlspecialchars($firstImage['alt'], ENT_QUOTES, 'UTF-8') . "'>";
                                    echo "</a>";
                                    echo "</div>";

                                    if (count($productGalleryImages) > 1) {
                                        echo "<div class='row thumbnailimages' style='padding-bottom:20px; padding-left:0px; padding-right:0px;'>";
                                        foreach ($productGalleryImages as $image) {
                                            echo "<div class='col-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 thumbnailimages'>";
                                            echo "<a data-zoom-id='product-gallery-zoom' href='" . $image['zoom'] . "' data-image='" . $image['main'] . "'>";
                                            echo "<img src='" . $image['thumb'] . "' class='img-responsive img-fluid' alt='" . htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') . "' title='" . htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') . "'>";
                                            echo "</a>";
                                            echo "</div>";
                                        }
                                        echo "</div>";
                                    }
                                } else {
                                    // Legacy products.image first, with new product folders as missing-file fallbacks.
                                    $imageVariants = cms_product_single_image_variants((string) ($rowproduct["image"] ?? ''), (string) $baseURL);
                                    $imageAlt = htmlspecialchars($imagetag, ENT_QUOTES, 'UTF-8');

                                    if ($imageVariants['main'] !== '') {
                                        if (!empty($imageVariants['has_zoom'])) {
                                            echo "<a href='" . $imageVariants['zoom'] . "' class='" . $magicToolboxClass . "' id='product-gallery-zoom' title='" . $imageAlt . "'" . $magicToolboxOptionsAttr . "><img src='" . $imageVariants['main'] . "' class='img-responsive' alt='" . $imageAlt . "' title='" . $imageAlt . "'></a>" ;
                                        } else {
                                            echo "<img src='" . $imageVariants['main'] . "' class='img-responsive' alt='" . $imageAlt . "' title='" . $imageAlt . "'>" ;
                                        }
                                    }
                                }
								?>

					<!--	</div> -->
					</figure>
                        <p><span style="text-align:right; font-size:12px; color: #333333; margin-top:30px;"><?php echo $imagetag ;?></span><br>
                          <!--  <span style="text-align:right; font-size:11px; color: #aaaaaa; margin-top:30px;">Product Ref ID : <?php echo $rowproduct["id"] ; ?> | 
						Section: <?php echo $rowproduct["section"] ; ?> </span> --></p>

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
                                    echo "<li>" . ($rowtech["feature_label"] ?? $rowtech[$ptsNameCol]) . "</li>" ;
                                }
                                ?>
                            </ul>
                            </div>
                        <?php
                        }
                        ?>
                        <?php echo cms_render_product_lifestyle_image(
                            $productLifestyleImage,
                            $imagetag . ' lifestyle image'
                        ); ?>
					</div>

				</div>
				
				<?php
                $pageslug = 'product';
				include("includes/content-right-side-section.php");
				?>
			</div>
		
		</div>

<?php include __DIR__ . '/dop-request-modal.php'; ?>

<?php if ($productModel !== null): ?>
<script type="module" src="https://unpkg.com/@google/model-viewer@4.3.1/dist/model-viewer.min.js"></script>
<?php endif; ?>

<!-- END page content product -->
