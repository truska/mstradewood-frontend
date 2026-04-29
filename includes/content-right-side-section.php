<!-- START content right side section -->
<!-- sidebar-template-check-20260429-17:00-content-right-side-section -->
<style>
  .sidebar-right .sidebar-wpr .download.cms-edit-target {
    position: relative;
  }

  .sidebar-right .sidebar-wpr .download.cms-edit-target > a.cms-frontend-edit-button.cms-sidebar-edit-button {
    top: 0.1rem !important;
    right: auto !important;
    left: -48px !important;
    width: 34px;
    height: 34px;
    z-index: 30;
  }

  .sidebar-right .sidebar-wpr .download.cms-edit-target > a.cms-frontend-edit-button.cms-sidebar-edit-button i {
    font-size: 1rem;
  }

  .sidebar-right .sidebar-video-poster {
    appearance: none;
    background: #111;
    border: 0;
    cursor: pointer;
    display: block;
    overflow: hidden;
    padding: 0;
    position: relative;
    aspect-ratio: 16 / 9;
    width: 100%;
    z-index: 3;
  }

  .sidebar-right .sidebar-video-poster img {
    display: block;
    height: 100%;
    object-fit: cover;
    transition: transform 0.2s ease, opacity 0.2s ease;
    width: 100%;
  }

  .sidebar-right .sidebar-video-poster:hover img,
  .sidebar-right .sidebar-video-poster:focus img {
    opacity: 0.84;
    transform: scale(1.03);
  }

  .sidebar-right .sidebar-video-play-icon {
    align-items: center;
    background: rgba(191, 30, 46, 0.92);
    border-radius: 999px;
    color: #fff;
    display: flex;
    font-size: 1.6rem;
    height: 56px;
    justify-content: center;
    left: 50%;
    line-height: 1;
    padding-left: 0.2rem;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 56px;
    z-index: 4;
  }

  .sidebar-video-modal-embed {
    background: #000;
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
  }

  .sidebar-video-modal-embed iframe {
    border: 0;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
  }

  .sidebar-video-modal .modal-header,
  .sidebar-video-modal .modal-footer {
    position: relative;
    z-index: 3;
  }

  .sidebar-video-modal .modal-footer {
    align-items: center;
    background: #111;
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
    padding: 0.75rem 1rem;
  }

  .sidebar-video-modal .modal-footer .btn,
  .sidebar-video-modal .modal-footer button {
    border-radius: 0.25rem;
    font-size: 1rem;
    line-height: 1.5;
    margin: 0;
    padding: 0.375rem 0.75rem;
  }

  .sidebar-video-modal .modal-footer button {
    background: #6c757d;
    border: 1px solid #6c757d;
    color: #fff;
  }

  .sidebar-video-modal .modal-footer a.btn {
    background: transparent;
    border: 1px solid #f8f9fa;
    color: #f8f9fa;
    text-decoration: none;
  }

  .sidebar-right .sdvideo {
    position: relative;
    z-index: 2;
  }
</style>
<script>
  (function () {
    if (window.cmsSidebarVideoModalReady) {
      return;
    }
    window.cmsSidebarVideoModalReady = true;

    document.addEventListener('show.bs.modal', function (event) {
      var modal = event.target;
      if (!modal || !modal.classList.contains('sidebar-video-modal')) {
        return;
      }

      var iframe = modal.querySelector('iframe[data-src]');
      if (iframe && !iframe.getAttribute('src')) {
        iframe.setAttribute('src', iframe.getAttribute('data-src'));
      }
    });

    document.addEventListener('hidden.bs.modal', function (event) {
      var modal = event.target;
      if (!modal || !modal.classList.contains('sidebar-video-modal')) {
        return;
      }

      var iframe = modal.querySelector('iframe[data-src]');
      if (iframe) {
        iframe.setAttribute('src', '');
      }
    });

    document.addEventListener('click', function (event) {
      var closeButton = event.target.closest('[data-sidebar-video-dismiss]');
      if (closeButton) {
        var modal = closeButton.closest('.sidebar-video-modal');
        if (modal && window.bootstrap && window.bootstrap.Modal) {
          event.preventDefault();
          window.bootstrap.Modal.getOrCreateInstance(modal).hide();
        } else if (modal && window.jQuery && window.jQuery.fn && window.jQuery.fn.modal) {
          event.preventDefault();
          window.jQuery(modal).modal('hide');
        }
        return;
      }

      var watchLink = event.target.closest('[data-sidebar-video-watch]');
      if (watchLink) {
        event.preventDefault();
        window.open(watchLink.href, '_blank', 'noopener');
      }
    });
  }());
</script>
 <?php
if (!isset($contentItem) || !is_array($contentItem)) {
  if (isset($rowcontent) && is_array($rowcontent)) {
    $contentItem = $rowcontent;
  } elseif (isset($rowcontent1) && is_array($rowcontent1)) {
    $contentItem = $rowcontent1;
  } else {
    $contentItem = [];
  }
}
if (!isset($contentSourceFormId) || $contentSourceFormId === null || $contentSourceFormId === '') {
  $contentSourceFormId = (isset($contentItem['source_form_id']) && is_numeric((string) $contentItem['source_form_id']))
    ? (int) $contentItem['source_form_id']
    : null;
}
echo '<div class="col-sm-3 col-lg-2 col-md-2 sidebar-right cms-edit-target">';
echo cms_render_frontend_edit_button($contentItem, ['form_id' => $contentSourceFormId ?? null]);
?>
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
if (!function_exists('cms_normalize_filestore_file_link')) {
    function cms_normalize_filestore_file_link($link, $baseURL) {
        $link = trim((string) $link);
        if ($link === '') {
            return '';
        }

        $baseURLTrimmed = rtrim((string) $baseURL, '/');
        $normalized = strtolower($link);
        if ($baseURLTrimmed !== '' && stripos($normalized, strtolower($baseURLTrimmed . '/')) === 0) {
            $normalized = substr($normalized, strlen($baseURLTrimmed . '/'));
        }
        $normalized = ltrim($normalized, '/');
        if (stripos($normalized, 'filestore/files/') === 0) {
            $normalized = substr($normalized, strlen('filestore/files/'));
        }

        return $normalized;
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
if (!function_exists('cms_youtube_embed_url')) {
    function cms_youtube_embed_url($youtubeId) {
        $youtubeId = cms_extract_youtube_id($youtubeId);
        if ($youtubeId === '') {
            return '';
        }

        return 'https://www.youtube.com/embed/' . rawurlencode($youtubeId) . '?feature=oembed&autoplay=1&rel=0';
    }
}
if (!function_exists('cms_youtube_watch_url')) {
    function cms_youtube_watch_url($youtubeId) {
        $youtubeId = cms_extract_youtube_id($youtubeId);
        if ($youtubeId === '') {
            return '';
        }

        return 'https://www.youtube.com/watch?v=' . rawurlencode($youtubeId);
    }
}
if (!function_exists('cms_youtube_thumbnail_url')) {
    function cms_youtube_thumbnail_url($youtubeId) {
        $youtubeId = cms_extract_youtube_id($youtubeId);
        if ($youtubeId === '') {
            return '';
        }

        return 'https://i.ytimg.com/vi/' . rawurlencode($youtubeId) . '/hqdefault.jpg';
    }
}
// Get Section Data
$selectsection = "SELECT * FROM `sections` WHERE `id` = '" . $rowproduct["section"]  . "' AND `showonweb` = 'Yes' AND `archived` = 0  ORDER BY `order` ";
				//	echo "<p>Selectsection = " . $selectsection . "</p>";
					$querysection = mysqli_query($conn,$selectsection);
					$numrowssection = mysqli_num_rows($querysection);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowssection . "<br>";
					$rowsection = mysqli_fetch_assoc($querysection) ;

// GET ALTERNATIVE PRODUCTS
$selectaltproducts = "SELECT * FROM `products` WHERE `section` = '" . $rowproduct["section"]  . "' AND `showonweb` = 'Yes'  AND `archived` = 0 ORDER BY `order` " ;
				//	echo "<p>SelectAlt Products = " . $selectaltproducts . "</p>";
					$queryaltproducts = mysqli_query($conn,$selectaltproducts);
					$numrowsaltproducts = mysqli_num_rows($queryaltproducts);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsaltproducts . "<br>";
				//	$rowaltproducts = mysqli_fetch_assoc($queryaltproducts) ;

// GET SIDEBAR CONTENT Below Alternative Products
$selectsidebar = "SELECT * FROM `sidebar` WHERE `page` = '" . $slugID  . "' AND (`product` = '0' OR `product` = '" . $segs[1]  . "') AND `showonweb` = 'Yes' AND `archived` = 0 ORDER BY `order` " ;
				//	echo "<p>SelectSidebar = " . $selectsidebar . "</p>";
					$querysidebar = mysqli_query($conn,$selectsidebar);
					$num_rows_sidebar = mysqli_num_rows($querysidebar);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_sidebar . "<br>";
				//	$rowsidebar = mysqli_fetch_assoc($querysidebar) ;

// GET SIDEBAR Manuf Image - always bottom
$selectmanuf = "SELECT * FROM `manuf` WHERE `id` = '" . $rowproduct["manuf"]  . "' AND `id` > '0' AND `showonweb` = 'Yes' AND `archived` = 0" ;
				//	echo "<p>Selectmanuf = " . $selectmanuf . "</p>";
					$querymanuf = mysqli_query($conn,$selectmanuf);
					$numrowsmanuf = mysqli_num_rows($querymanuf);
				//	$count = 1 ;
				//	echo "Number of records = " . $numrowsmanuf . " - " . $rowproduct["manuf"] . ")<br>";
				//	$rowmanuf = mysqli_fetch_assoc($querymanuf) ;


?>

	 <!-- R I G H T  S I D E B A R   S E C T I O N -->
		<div class="sidebar-wpr">
			
			<?php
            // Alternative Products
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

			
            // Product Brochure below alt product list
            $productPdf = trim((string) ($rowproduct["pdf"] ?? ''));
            $productPdfNormalized = '';
            $baseURLTrimmed = rtrim((string) $baseURL, '/');
            if ($productPdf !== '') {
                $pdfHeading = trim((string) ($rowproduct["pdfheading"] ?? 'Product Brochure'));
                if ($pdfHeading === '') {
                    $pdfHeading = 'Product Brochure';
                }

                $pdfCaption = trim((string) ($rowproduct["pdfcaption"] ?? ($rowproduct["pdftext"] ?? '')));
                if ($pdfCaption === '' && !empty($rowproduct["name"])) {
                    $pdfCaption = $rowproduct["name"];
                }

                $baseURLTrimmed = rtrim((string) $baseURL, '/');
                $productPdfNormalized = cms_normalize_filestore_file_link($productPdf, $baseURL);

                $productPdfSidebarEditItem = null;
                if ((int) ($rowproduct["id"] ?? 0) > 0 && (int) ($slugID ?? 0) > 0) {
                    $productPdfSidebarSql = "SELECT * FROM `sidebar`
                        WHERE `page` = '" . (int) $slugID . "'
                        AND `product` = '" . (int) $rowproduct["id"] . "'
                        AND `item` = 'pdf'
                        AND `showonweb` = 'Yes'
                        AND `archived` = 0
                        ORDER BY `order`, `id`";
                    $productPdfSidebarQuery = mysqli_query($conn, $productPdfSidebarSql);
                    if ($productPdfSidebarQuery instanceof mysqli_result) {
                        $productPdfSidebarEditItem = mysqli_fetch_assoc($productPdfSidebarQuery) ?: null;
                    }
                }

                $isHttpLink = (stripos($productPdf, 'http://') === 0 || stripos($productPdf, 'https://') === 0);
                if ($isHttpLink) {
                    $pdfLink = cms_localize_internal_link($productPdf, $baseURL);
                } elseif (strpos($productPdf, '/') === 0) {
                    $pdfLink = rtrim($baseURL, '/') . $productPdf;
                } else {
                    $pdfLink = $baseURL . "/filestore/files/" . $productPdf;
                }

                $productPdfEditClass = is_array($productPdfSidebarEditItem) ? " cms-edit-target" : "";
                echo "<div class='download sbpdf" . $productPdfEditClass . "'>" ;
                    if (is_array($productPdfSidebarEditItem)) {
                        echo cms_render_frontend_edit_button([
                            'id' => (int) ($productPdfSidebarEditItem["id"] ?? 0),
                            'table_name' => 'sidebar',
                        ], [
                            'form_id' => 24,
                            'class' => 'cms-sidebar-edit-button',
                            'title' => 'Edit this sidebar item in WCCMS',
                        ]);
                    }
                    echo "<a href='" . $pdfLink . "' target='_blank'>" ;
                        echo "<h3><span  style='color:red;'><i class='fas fa-file-pdf'></i></span> " . $pdfHeading . "</h3>" ;
                        if ($pdfCaption !== '') {
                            echo "<p style='color:#aaaaaa;'>" . $pdfCaption . "</p>" ;
                        }
                    echo "</a>" ;

                echo "</div>" ;
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
								echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowsidebar["source"] . "' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . "'>";
                            echo "</a>" ;
								echo "<p>" . $rowsidebar["caption"] . "</p>" ;
						echo "</div>" ;
					}
					// IF Video Link 
					if ($rowsidebar["item"] == "Video") {
                        $youtubeId = '';
                        $videoIdCandidates = [
                            $rowsidebar["youtubeid"] ?? '',
                            $rowsidebar["link"] ?? '',
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
                                $youtubeEmbedUrl = cms_youtube_embed_url($youtubeId);
                                $youtubeWatchUrl = cms_youtube_watch_url($youtubeId);
                                $youtubeThumbnailUrl = cms_youtube_thumbnail_url($youtubeId);
                                $youtubeEmbedAttr = htmlspecialchars($youtubeEmbedUrl, ENT_QUOTES);
                                $youtubeWatchAttr = htmlspecialchars($youtubeWatchUrl, ENT_QUOTES);
                                $youtubeThumbnailAttr = htmlspecialchars($youtubeThumbnailUrl, ENT_QUOTES);
                                $videoTitle = htmlspecialchars((string) ($rowsidebar["heading"] ?? 'YouTube video'), ENT_QUOTES);
                                $videoModalId = 'sidebarVideoModal' . (int) ($rowsidebar["id"] ?? 0);

                                echo "<button type='button' class='sidebar-video-poster' data-bs-toggle='modal' data-bs-target='#" . $videoModalId . "' aria-label='Play " . $videoTitle . "'>" ;
                                    echo "<img src='" . $youtubeThumbnailAttr . "' alt='" . $videoTitle . "' loading='lazy'>" ;
                                    echo "<span class='sidebar-video-play-icon' aria-hidden='true'><i class='fa-solid fa-play'></i></span>" ;
                                echo "</button>" ;

                                echo "<div class='modal fade sidebar-video-modal' id='" . $videoModalId . "' tabindex='-1' aria-labelledby='" . $videoModalId . "Label' aria-hidden='true'>" ;
                                    echo "<div class='modal-dialog modal-xl modal-dialog-centered'>" ;
                                        echo "<div class='modal-content'>" ;
                                            echo "<div class='modal-header'>" ;
                                                echo "<h5 class='modal-title' id='" . $videoModalId . "Label'>" . $videoTitle . "</h5>" ;
                                                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' data-sidebar-video-dismiss aria-label='Close'></button>" ;
                                            echo "</div>" ;
                                            echo "<div class='modal-body'>" ;
                                                echo "<div class='sidebar-video-modal-embed'>" ;
                                                    echo "<iframe data-src='" . $youtubeEmbedAttr . "' title='" . $videoTitle . "' referrerpolicy='strict-origin-when-cross-origin' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>" ;
                                                echo "</div>" ;
                                            echo "</div>" ;
                                            echo "<div class='modal-footer'>" ;
                                                echo "<a class='btn btn-outline-secondary' href='" . $youtubeWatchAttr . "' target='_blank' rel='noopener' data-sidebar-video-watch>Watch on YouTube</a>" ;
                                                echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal' data-sidebar-video-dismiss>Close</button>" ;
                                            echo "</div>" ;
                                        echo "</div>" ;
                                    echo "</div>" ;
                                echo "</div>" ;
							}
						else
						{
                            $sidebarLink = cms_localize_internal_link($rowsidebar["link"] ?? '', $baseURL);
							echo "<a href='" . $sidebarLink . "' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/youtube-click-to-play.jpg' style='width:85%;' alt='" . $rowsidebar["alttag"] . "' title='" . $rowsidebar["alttag"] . "'>";
                            echo "</a>" ;
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
                        $sidebarProductId = (int) ($rowsidebar["product"] ?? 0);
                        $sidebarPdfLink = trim((string) ($rowsidebar["link"] ?? ''));
                        $sidebarPdfNorm = cms_normalize_filestore_file_link($sidebarPdfLink, $baseURL);

                        if ($productPdfNormalized !== '' && $sidebarPdfNorm !== '' && $sidebarPdfNorm === $productPdfNormalized) {
                            continue; // already rendered in product brochure block
                        }

                        $sidebarPdfEditClass = $sidebarProductId > 0 ? " cms-edit-target" : "";

						echo "<div class='download sbpdf" . $sidebarPdfEditClass . "'>" ;
                            if ($sidebarProductId > 0) {
                                echo cms_render_frontend_edit_button([
                                    'id' => (int) ($rowsidebar["id"] ?? 0),
                                    'table_name' => 'sidebar',
                                ], [
                                    'form_id' => 24,
                                    'class' => 'cms-sidebar-edit-button',
                                    'title' => 'Edit this sidebar item in WCCMS',
                                ]);
                            }
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
                        echo "<img src='" . $baseURL . "/filestore/images/logos/ms-tradewood-logo2.jpg' alt='MS Tradewood products available in Ireland from MS Tradewood Belfast and Dublin' title='MS Tradewood products available in Ireland from MS Tradewood Belfast and Dublin'>" ;
                echo "</div>" ;
                }
			?>

			
		</div>

<?php echo '</div>'; ?>
<!-- END content right side section -->
