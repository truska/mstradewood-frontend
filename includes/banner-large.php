<!-- START banner-large.php -->


		<div class="banner">
			<div class="desktop">
				<?php
				$homeBannerImages = [];
				$homeBannerRecordId = 0;
				$homeBannerStrategy = 'content_home_layout_5';
				$homePageId = (int) ($prefs['prefHomePage'] ?? 0);

				// 1) Primary: resolve the banner record from home-page content.id (layout 5).
				if ($homePageId > 0) {
					$selectHomeBannerContent = "SELECT `id` FROM `content`
						WHERE `page` = " . $homePageId . "
						AND `layout` = 5
						AND `showonweb` = 'Yes'
						AND `archived` = 0
						ORDER BY `sort` ASC, `id` DESC
						LIMIT 1";
					$queryHomeBannerContent = mysqli_query($conn, $selectHomeBannerContent);
					if ($queryHomeBannerContent instanceof mysqli_result) {
						$rowHomeBannerContent = mysqli_fetch_assoc($queryHomeBannerContent) ?: [];
						$homeBannerRecordId = (int) ($rowHomeBannerContent['id'] ?? 0);
					}
				}

				// 2) Fallback: latest gallery record_id for form 8.
				if ($homeBannerRecordId <= 0) {
					$homeBannerStrategy = 'gallery_latest_record';
					$selectLatestGalleryRecord = "SELECT `record_id` FROM `gallery`
						WHERE `form_id` = 8
						AND `showonweb` = 'Yes'
						AND `archived` = 0
						AND `record_id` > 0
						ORDER BY `id` DESC
						LIMIT 1";
					$queryLatestGalleryRecord = mysqli_query($conn, $selectLatestGalleryRecord);
					if ($queryLatestGalleryRecord instanceof mysqli_result) {
						$rowLatestGalleryRecord = mysqli_fetch_assoc($queryLatestGalleryRecord) ?: [];
						$homeBannerRecordId = (int) ($rowLatestGalleryRecord['record_id'] ?? 0);
					}
				}

				// 3) Final fallback: old page/content context to avoid blanking.
				if ($homeBannerRecordId <= 0) {
					$homeBannerStrategy = 'legacy_page_context';
					$homeBannerRecordId = (int) (($rowcontent['id'] ?? 0));
					if ($homeBannerRecordId <= 0) {
						$homeBannerRecordId = (int) ($rowpage['id'] ?? 0);
					}
				}

				$selectHomeBanners = "SELECT `image`, `alttag`, `caption`, `folder_name` FROM `gallery`
					WHERE `form_id` = 8
					AND `record_id` = " . $homeBannerRecordId . "
					AND `showonweb` = 'Yes'
					AND `archived` = 0
					ORDER BY `sort`, `id`";
				$queryHomeBanners = mysqli_query($conn, $selectHomeBanners);
				if ($queryHomeBanners instanceof mysqli_result) {
					while ($rowHomeBanner = mysqli_fetch_assoc($queryHomeBanners)) {
						$imageFile = trim((string) ($rowHomeBanner['image'] ?? ''));
						if ($imageFile === '') {
							continue;
						}
						$folderName = trim((string) ($rowHomeBanner['folder_name'] ?? ''), '/');
						if ($folderName === '') {
							$folderName = 'content';
						}
						$folderName = preg_replace('#^images/#', '', $folderName);
						$desktopImagePath = 'images/' . rtrim($folderName, '/') . '/lg/' . $imageFile;
						$altText = trim((string) ($rowHomeBanner['alttag'] ?? ''));
						if ($altText === '') {
							$altText = trim((string) ($rowHomeBanner['caption'] ?? ''));
						}
						if ($altText === '') {
							$altText = 'Home banner';
						}
						$homeBannerImages[] = [
							'src' => $baseURL . '/filestore/' . $desktopImagePath,
							'alt' => $altText,
						];
					}
				}
				$homeBannerCount = count($homeBannerImages);
				?>
				<!-- home-banner-debug strategy=<?php echo $homeBannerStrategy; ?> record_id=<?php echo $homeBannerRecordId; ?> banner_rows=<?php echo $homeBannerCount; ?> -->

				<?php if ($homeBannerCount === 1): ?>
					<img src="<?php echo htmlspecialchars($homeBannerImages[0]['src'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($homeBannerImages[0]['alt'], ENT_QUOTES, 'UTF-8'); ?>">
				<?php elseif ($homeBannerCount > 1): ?>
					<div id="home-banner-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
						<div class="carousel-inner" role="listbox">
							<?php foreach ($homeBannerImages as $index => $homeBanner): ?>
								<div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
									<img src="<?php echo htmlspecialchars($homeBanner['src'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($homeBanner['alt'], ENT_QUOTES, 'UTF-8'); ?>">
									<div class="carousel-caption container inner"></div>
								</div>
							<?php endforeach; ?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#home-banner-carousel" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#home-banner-carousel" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				<?php endif; ?>
			</div>
        
        
        
        
		<div class="mobile">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                
  <?php
        // GET Sections for mobile home page 
	   $selectsection = "SELECT * FROM `menu` WHERE `submenu1` = '0' AND `showonhomemobile` = 'Yes' ORDER BY `menu`, `submenu` " ;
		$querysection = mysqli_query($conn,$selectsection);
		if (!($querysection instanceof mysqli_result)) {
			$querysection = null;
		}

        $counter = 1 ;        
		while ($querysection && ($rowsection = mysqli_fetch_assoc($querysection)) ) {

               
            echo "<div class='panel panel-default'>" ;
                echo "<div class='panel-heading' role='tab' id='heading". $counter . "'>" ;
                echo "<a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse". $counter . "' aria-expanded='true' aria-controls='collapse". $counter . "'>
                         " . $rowsection["title"] . "<span class='caret'></span></a>" ;
                echo "</div>" ;
                echo "<div id='collapse". $counter . "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading". $counter . "'>" ;
                    echo "<div class='panel-body'>" ;
                        echo "<ul>" ;

                        // GET Sections for mobile home page 
                       $selectproduct = "SELECT * FROM `menu` WHERE `menu` = " . $rowsection["menu"] . " AND `submenu` = " . $rowsection["submenu"] . " AND `submenu1` > '0' AND `showonweb` = 'Yes' ORDER BY `submenu1` " ;
                            $queryproduct = mysqli_query($conn,$selectproduct);
                            if (!($queryproduct instanceof mysqli_result)) {
                                $queryproduct = null;
                            }

                        while ($queryproduct && ($rowproduct = mysqli_fetch_assoc($queryproduct)) ) {
                            
                            // GET Page Slug 
                           $selectpageslug = "SELECT `slug` FROM `pages` WHERE `id` = " . $rowproduct["page"] . " " ;
                                $querypageslug = mysqli_query($conn,$selectpageslug);
                            	$rowpageslug = ($querypageslug instanceof mysqli_result)
                                    ? (mysqli_fetch_assoc($querypageslug) ?: [])
                                    : [];
                            
                            // GET Product Slug 
                           $selectproductslug = "SELECT `slug` FROM `products` WHERE `id` = " . $rowproduct["product"] . " " ;
                                $queryproductslug = mysqli_query($conn,$selectproductslug);
                            	$rowproductslug = ($queryproductslug instanceof mysqli_result)
                                    ? (mysqli_fetch_assoc($queryproductslug) ?: [])
                                    : [];
            
                            $pageSlug = $rowpageslug["slug"] ?? '';
                            $productSlug = $rowproductslug["slug"] ?? '';
                            echo "<li><a href='" . $baseURL . "/" . $pageSlug . "/" . $rowproduct["product"] . "/" . $productSlug . "'>" . $rowproduct["title"] . "</a></li>" ;
                        }
            
                        echo "</ul>" ;
                    echo "</div>" ;
                echo "</div>" ;
            echo "</div>" ;
            $counter ++ ;
        }
  ?>              
                
                
                
                
                
 <!-- ---------------------------------- -->               

                
 <!-- ---------------------------------- -->               
                
                
			</div>
		</div>
	</div> 


<!-- END banner-large.php -->
