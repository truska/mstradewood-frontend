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
echo '<div class="cms-edit-target">';
echo cms_render_frontend_edit_button($contentItem, ['form_id' => $contentSourceFormId ?? null]);
?>
<!-- START all-product-scroll.php -->

	<?php
		echo "<div class='col-lg-12 fullproductrange'>" ;
			echo "<h3>Full Product Range</h3>" ;
		echo "</div>" ;
		$selectproducts = "SELECT * FROM `products` WHERE `showonweb` = 'Yes' ORDER BY `order`  ";
		$queryproducts = mysqli_query($conn,$selectproducts);
		echo "<div class='col-lg-12 fullproductrangescroll'>" ;
			echo "<div class='MagicScroll'>" ;
				while ($rowproducts = mysqli_fetch_assoc($queryproducts) )
				{
					echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/art-on-a-tin-product/" . $rowproducts["id"] . "'>" ;
						echo "<img src='http://" . $_SERVER['SERVER_NAME']  . "/filestore/images/product/" . $rowproducts["image"] . "' class='img-responsive' style='height:150px;' alt='" . $rowproducts["title"] . "' title='" . $rowproducts["title"] . "' />" ;
					echo "</a>" ;
				}

			echo "</div>" ;
		echo "</div>" ;
?>


<!-- END all-product-scroll.php --><?php echo '</div>'; ?>
