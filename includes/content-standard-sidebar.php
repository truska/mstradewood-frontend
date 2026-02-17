<!-- START content-standard-sidebar.php -->
<?php
$numrowsmanuf = $numrowsmanuf ?? 0;
$querymanuf = $querymanuf ?? null;
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
if (!function_exists('cms_extract_youtube_id')) {
    function cms_extract_youtube_id($value) {
        $value = trim((string) $value);
        if ($value === '') {
            return '';
        }

        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $value)) {
            return $value;
        }

        $parts = @parse_url($value);
        if (!is_array($parts)) {
            return '';
        }

        $host = strtolower($parts['host'] ?? '');
        $path = trim((string) ($parts['path'] ?? ''), '/');

        if ($host === 'youtu.be') {
            $segments = explode('/', $path);
            $candidate = $segments[0] ?? '';
            return preg_match('/^[A-Za-z0-9_-]{11}$/', $candidate) ? $candidate : '';
        }

        if (
            $host === 'youtube.com' ||
            $host === 'www.youtube.com' ||
            $host === 'm.youtube.com' ||
            $host === 'youtube-nocookie.com' ||
            $host === 'www.youtube-nocookie.com'
        ) {
            if (!empty($parts['query'])) {
                parse_str($parts['query'], $query);
                $candidate = trim((string) ($query['v'] ?? ''));
                if (preg_match('/^[A-Za-z0-9_-]{11}$/', $candidate)) {
                    return $candidate;
                }
            }

            $segments = explode('/', $path);
            if (($segments[0] ?? '') === 'embed' || ($segments[0] ?? '') === 'shorts') {
                $candidate = $segments[1] ?? '';
                if (preg_match('/^[A-Za-z0-9_-]{11}$/', $candidate)) {
                    return $candidate;
                }
            }
        }

        return '';
    }
}
// GET SIDEBAR CONTENT Below Alternative Porducts
$selectsidebar = "SELECT * FROM `sidebar` WHERE `page` = '" . $slugID  . "' AND (`product` = '0' OR `product` = '" . $segs[1]  . "') AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo "<p>SelectSidebar = " . $selectsidebar . "</p>";
					$querysidebar = mysqli_query($conn,$selectsidebar);
					$num_rows_sidebar = mysqli_num_rows($querysidebar);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_sidebar . "<br>";
				//	$rowsidebar = mysqli_fetch_assoc($querysidebar) ;


?>
<style>
    .sbimg img {
       /* max-width: none; */
    }
    .sidebar-video-embed {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        overflow: hidden;
    }
    .sidebar-video-embed iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>
<!-- <div class="col-sm-3 col-md-2 sidebar-right"> -->
    <div class="sidebar-wpr" style='padding-top:35px;'>
        
    <!-- --------------------------------------------- -->
         <?php
        // Rest of Side bar below products
			if ($num_rows_sidebar > 0)
			{
			
				while ($rowsidebar = mysqli_fetch_assoc($querysidebar) )
				{
					if ($rowsidebar["item"] == "Include") {
						include("includes/" . $rowsidebar["source"] . "");
					}

					if ($rowsidebar["item"] == "Image") {
                        $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
						echo "<div class='download sbimg'>" ;
							echo "<h3>" . $rowsidebar["heading"] . "</h3>" ;
							echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowsidebar["source"] . "' class='img-responsive' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . " - " . $rowsidebar["id"] . "'></a>" ;
								echo "<p>" . $rowsidebar["caption"] . "</p>" ;
						echo "</div>" ;
					}
					// IF Video Link 
					if ($rowsidebar["item"] == "Video") {
                        $youtubeId = '';
                        $videoIdCandidates = [
                            $rowsidebar["link"] ?? '',
                            $rowsidebar["youtubeid"] ?? '',
                            $rowsidebar["source"] ?? '',
                        ];
                        foreach ($videoIdCandidates as $candidate) {
                            $youtubeId = cms_extract_youtube_id($candidate);
                            if ($youtubeId !== '') {
                                break;
                            }
                        }
						echo "<div class='download sdvideo'>" ;
							echo "<h3>" . $rowsidebar["heading"] . "</h3>" ;
                            if ($youtubeId !== '') {
                                echo "<div class='sidebar-video-embed'>";
                                    echo "<iframe src='https://www.youtube.com/embed/" . $youtubeId . "' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>" ;
                                echo "</div>";
                            } else {
                                $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
                                echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
                                    echo "<img src='" . $baseURL . "/filestore/images/content/youtube-click-to-play.jpg' class='img-responsive' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . " - " . $rowsidebar["id"] . "'>" ;
                                echo "</a>";
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
				//echo "<p style='color:#333333;'>No side bar elements set - use default one</p>" ;
			}

            if ($numrowsmanuf > 0)
			{
                $rowmanuf = mysqli_fetch_assoc($querymanuf) ;
                    echo "<img src='" . $baseURL . "/filestore/images/logos/" . $rowmanuf["image"] . "' class='img-responsive' alt='" . $rowmanuf["name"] . " products available in Ireland from " . getCompanyName($prefs) . " Belfast and Dublin' title='" . $rowmanuf["name"] . " products available in Ireland from " . getCompanyName($prefs) . " Belfast and Dublin'>"  ;
            }
            else
            {
            }
				?>
    <!-- --------------------------------------------- -->

        <div class="inner-contact">
            <?php
            echo "<div class='download sbimg'>" ;
                echo "<h3>Download Brochure</h3>" ;
                echo "<a href='" . $baseURL . "/filestore/files/ms-timber-brochure-timber.pdf' target='_blank'>" ;
                    echo "<img src='" . $baseURL . "/filestore/images/content/timber-brochure.jpg' alt='Download MS Timber Brochure' title='Download MS Timber Brochure'></a>" ;
            echo "</div>" ;
           ?>
        </div>

        <div class="inner-contact">
            <?php
            echo "<div class='download sbimg'>" ;
                echo "<h3>Locations</h3>" ;
                echo "<a href='" . $baseURL . "/contact-ms-timber' target='_blank'>" ;
                    echo "<img src='" . $baseURL . "/filestore/images/content/map.png' alt='Contact MS Timber' title='Contact MS Timber'></a>" ;
            echo "</div>" ;
           ?>
        </div>

        <div class="inner-contact">
            <?php
            echo "<div class='download sbimg'>" ;
         //       echo "<h3>Locations / Contact</h3>" ;        
                    echo "<img src='" . $baseURL . "/filestore/images/logos/ms-timber-logo2.jpg' alt='MS Timber products available in Ireland from MS Timber Belfast and Dublin' title='MS Timber products available in Ireland from MS Timber Belfast and Dublin'>" ;
            echo "</div>" ;
           ?>
        </div>
            
    </div>
<!-- </div> -->
<!-- END content-standard-sidebar.php -->
