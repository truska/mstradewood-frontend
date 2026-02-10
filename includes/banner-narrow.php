 <!-- START banner-narrow.php -->
		<?php
// banner-narrow expects a product id in segs[1]. When absent (e.g. home route),
// fall back to the home/large banner so PHP 8.4 does not fail on false query results.
$productId = isset($segs[1]) ? (int) $segs[1] : 0;
if ($productId <= 0) {
	$homeBannerPath = __DIR__ . '/banner-large.php';
	if (file_exists($homeBannerPath)) {
		include $homeBannerPath;
	}
	return;
}

$rowproductbanner1 = [];
$rowproductbanner = [];
$rowsectionsbanner = [];

// GET PRODUCT banner by product id
$selectproductbanner1 = "SELECT `banner` FROM `products` WHERE `id` = " . $productId . " AND `showonweb` = 'Yes' ";
$queryproductbanner1 = mysqli_query($conn, $selectproductbanner1);
if ($queryproductbanner1 instanceof mysqli_result) {
	$rowproductbanner1 = mysqli_fetch_assoc($queryproductbanner1) ?: [];
}

// GET product section id
$selectproductbanner = "SELECT `section` FROM `products` WHERE `id` = " . $productId . " AND `showonweb` = 'Yes' ";
$queryproductbanner = mysqli_query($conn, $selectproductbanner);
if ($queryproductbanner instanceof mysqli_result) {
	$rowproductbanner = mysqli_fetch_assoc($queryproductbanner) ?: [];
}

// GET section banner
$sectionId = (int) ($rowproductbanner["section"] ?? 0);
if ($sectionId > 0) {
	$selectsectionsbanner = "SELECT * FROM `sections` WHERE `id` = " . $sectionId . " AND `showonweb` = 'Yes' ";
	$querysectionsbanner = mysqli_query($conn, $selectsectionsbanner);
	if ($querysectionsbanner instanceof mysqli_result) {
		$rowsectionsbanner = mysqli_fetch_assoc($querysectionsbanner) ?: [];
	}
}

if (!empty($rowproductbanner1["banner"])) {
	$bannerimage = $rowproductbanner1["banner"];
	echo "<div class='banner inner-nanner'>";
	echo "<img src='" . $baseURL . "/filestore/images/banners/" . $bannerimage . "'>";
	echo "</div>";
} elseif (!empty($rowsectionsbanner["banner"])) {
	$bannerimage = $rowsectionsbanner["banner"];
	echo "<div class='banner inner-nanner'>";
	echo "<img src='" . $baseURL . "/filestore/images/banners/" . $bannerimage . "'>";
	echo "</div>";
} else {
	$pageId = (int) ($rowpage['id'] ?? 0);
	if ($pageId > 0) {
		$selectbanner = "SELECT * FROM `banner` WHERE `page` = '" . $pageId . "' AND `showonweb` = 'Yes'";
		$querybanner = mysqli_query($conn, $selectbanner);
		if ($querybanner instanceof mysqli_result) {
			$rowbanner = mysqli_fetch_assoc($querybanner) ?: [];
			if (!empty($rowbanner["image"])) {
				echo "<div class='banner inner-nanner'>";
				echo "<img src='" . $baseURL . "/filestore/images/banners/" . $rowbanner["image"] . "'>";
				echo "</div>";
			}
		}
	}
}

	?>
 <!-- END banner-narrow.php -->
