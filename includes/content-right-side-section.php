<!-- START content-right-side-section.php -->
<?php
if (!function_exists('cms_localize_internal_link')) {
    function cms_localize_internal_link($link, $baseURL) {
        $link = trim((string) $link);
        if ($link === '') {
            return $link;
        }

        $parts = @parse_url($link);
        if (!is_array($parts) || empty($parts['host'])) {
            return $link;
        }

        $host = strtolower($parts['host']);
        if ($host !== 'mstimber.com' && $host !== 'www.mstimber.com') {
            return $link;
        }

        $path = $parts['path'] ?? '';
        $query = isset($parts['query']) ? ('?' . $parts['query']) : '';
        $fragment = isset($parts['fragment']) ? ('#' . $parts['fragment']) : '';

        return rtrim($baseURL, '/') . $path . $query . $fragment;
    }
}
// Get Section Data
$selectsection = "SELECT * FROM `sections` WHERE `id` = '" . $rowproduct["section"]  . "' AND `showonweb` = 'Yes' " ;
				//	echo "<p>Selectsection = " . $selectsection . "</p>";
					$querysection = mysqli_query($conn,$selectsection);
					$numrowssection = mysqli_num_rows($querysection);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowssection . "<br>";
					$rowsection = mysqli_fetch_assoc($querysection) ;

// GET ALTERNATIVE PRODUCTS
$selectaltproducts = "SELECT * FROM `products` WHERE `section` = '" . $rowproduct["section"]  . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo "<p>SelectAlt Products = " . $selectaltproducts . "</p>";
					$queryaltproducts = mysqli_query($conn,$selectaltproducts);
					$numrowsaltproducts = mysqli_num_rows($queryaltproducts);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsaltproducts . "<br>";
				//	$rowaltproducts = mysqli_fetch_assoc($queryaltproducts) ;

// GET SIDEBAR CONTENT Below Alternative Porducts
$selectsidebar = "SELECT * FROM `sidebar` WHERE `page` = '" . $slugID  . "' AND (`product` = '0' OR `product` = '" . $segs[1]  . "') AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo "<p>SelectSidebar = " . $selectsidebar . "</p>";
					$querysidebar = mysqli_query($conn,$selectsidebar);
					$num_rows_sidebar = mysqli_num_rows($querysidebar);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_sidebar . "<br>";
				//	$rowsidebar = mysqli_fetch_assoc($querysidebar) ;

// GET SIDEBAR Manuf Image - always bottom
$selectmanuf = "SELECT * FROM `manuf` WHERE `id` = '" . $rowproduct["manuf"]  . "' AND `id` > '0' AND `showonweb` = 'Yes' " ;
				//	echo "<p>Selectmanuf = " . $selectmanuf . "</p>";
					$querymanuf = mysqli_query($conn,$selectmanuf);
					$numrowsmanuf = mysqli_num_rows($querymanuf);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsmanuf . " - " . $rowproduct["manuf"] . ")<br>";
				//	$rowmanuf = mysqli_fetch_assoc($querymanuf) ;


?>

	 <!-- R I G H T  S I D E B A R   S E C T I O N -->
	<div class="col-sm-3 col-lg-2 col-md-2 sidebar-right">
		<div class="sidebar-wpr">
			
			<?php
            
			if ($numrowsaltproducts > 0)
			{
				if ($rowsection["title"]) { echo "<h3>" . $rowsection["title"] . "</h3>" ; } else { echo "<h3>Alternative Products</h3>" ; }
                echo "<ul>" ;
                    while ($rowaltproducts = mysqli_fetch_assoc($queryaltproducts) )
                    {
                        echo "<a href='" . $baseURL . "/" . $pageslug . "/" . $rowaltproducts["id"] . "/" . strtolower($rowaltproducts["slug"]) . "' class=''>"  ;
                        echo "<li class='li-h'>" . $rowaltproducts["name"] . "</li>" ;
                        echo "</a>" ;
                    }
                echo "</ul>";
            }
            
            // Rest of Side bar below products
			if ($num_rows_sidebar > 0)
			{
			    $sidebarSeen = [];
				while ($rowsidebar = mysqli_fetch_assoc($querysidebar) )
				{
                    $sidebarSig = strtolower(trim(
                        ($rowsidebar["item"] ?? '') . '|' .
                        ($rowsidebar["heading"] ?? '') . '|' .
                        ($rowsidebar["source"] ?? '') . '|' .
                        ($rowsidebar["link"] ?? '') . '|' .
                        ($rowsidebar["caption"] ?? '') . '|' .
                        ($rowsidebar["youtubeid"] ?? '')
                    ));
                    if ($sidebarSig !== '' && isset($sidebarSeen[$sidebarSig])) {
                        continue;
                    }
                    $sidebarSeen[$sidebarSig] = true;

					if ($rowsidebar["item"] == "Include") {
						include("includes/" . $rowsidebar["source"] . "");
					}

					if ($rowsidebar["item"] == "Image") {
                        $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
						echo "<div class='download sbimg'>" ;
							echo "<h3>" . $rowsidebar["heading"] . "</h3>" ;
							echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowsidebar["source"] . "' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . " - " . $rowsidebar["id"] . "'></a>" ;
								echo "<p>" . $rowsidebar["caption"] . "</p>" ;
						echo "</div>" ;
					}
					// IF Video Link 
					if ($rowsidebar["item"] == "Video") {
						echo "<div class='download sdvideo'>" ;
							echo "<h3>" . $rowsidebar["heading"] . "</h3>" ;
							if($rowsidebar["youtubeid"]) {
							echo "<div style='position:relative;padding-top:56.25%;height:0;overflow:hidden;'>" ;
								echo "<iframe src='https://www.youtube.com/embed/" . $rowsidebar["youtubeid"] . "' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen style='position:absolute;top:0;left:0;width:100%;height:100%;'></iframe>" ;
							echo "</div>" ;
							}
						else
						{
                            $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
							echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/youtube-click-to-play.jpg' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . " - " . $rowsidebar["id"] . "'></a>" ;
						}
						echo "</div>" ;
					}
					// IF URL Web Link
					if ($rowsidebar["item"] == "Link") {
                        $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
						echo "<div class='download sblink'>" ;
							echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
								echo "<h3><i class='fas fa-globe'></i> " . $rowsidebar["heading"] . "</h3>" ;
								echo "<p>" . $rowsidebar["caption"] . "</p>" ;
							echo "</a>" ;

						echo "</div>" ;
					}
					// IF PDF Link (Internal in files folder)
					if ($rowsidebar["item"] == "pdf") {
						echo "<div class='download sbpdf'>" ;
							echo "<a href='" . $baseURL . "/filestore/files/" . $rowsidebar["link"] . "' target='_blank'>" ;
								echo "<h3><span  style='color:red;'><i class='fas fa-file-pdf'></i></span> " . $rowsidebar["heading"] . "</h3>" ;
								echo "<p style='color:#aaaaaa;'>" . $rowsidebar["caption"] . "</p>" ;
							echo "</a>" ;

						echo "</div>" ;
					}
				}
			}
			else
			{
				echo "<p style='color:#333333;'>No side bar elements set - use default one</p>" ;
			}

            if ($numrowsmanuf > 0)
			{
                $rowmanuf = mysqli_fetch_assoc($querymanuf) ;
                    echo "<img src='" . $baseURL . "/filestore/images/logos/" . $rowmanuf["image"] . "' class='img-responsive' alt='" . $rowmanuf["name"] . " products available in Ireland from " . getCompanyName($prefs) . " Belfast and Dublin' title='" . $rowmanuf["name"] . " products available in Ireland from " . getCompanyName($prefs) . " Belfast and Dublin'>"  ;
            }
            else
            {
            echo "<div class='download sbimg'>" ;
         //       echo "<h3>Locations / Contact</h3>" ;        
                    echo "<img src='" . $baseURL . "/filestore/images/logos/ms-timber-logo2.jpg' alt='MS Timber products available in Ireland from MS Timber Belfast and Dublin' title='MS Timber products available in Ireland from MS Timber Belfast and Dublin'>" ;
            echo "</div>" ;
            }
				?>

			
		</div>
	</div>
<!-- END content-right-side-section.php -->
