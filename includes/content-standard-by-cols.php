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
<!-- START content-standard-by-cols.php (ABOUT US) -->
<?php
// Use the row from the page loop when available.
$contentItem = null;
if (isset($rowcontent) && is_array($rowcontent)) {
    $contentItem = $rowcontent;
} elseif (isset($rowcontent1) && is_array($rowcontent1)) {
    $contentItem = $rowcontent1;
}

// Fallback for direct/legacy use where this layout is included standalone.
if (!$contentItem && isset($slugID)) {
    $selectcontent = "SELECT * FROM `content` WHERE `page` = " . (int) $slugID . " AND `showonweb` = 'Yes' ORDER BY `sort` LIMIT 1";
    $querycontent = mysqli_query($conn, $selectcontent);
    $contentItem = mysqli_fetch_assoc($querycontent) ?: [];
}

if (!$contentItem) {
    $contentItem = [];
}

// GET PEOPLE
$selectpeople = "SELECT * FROM `people` WHERE `showonweb` = 'Yes' ORDER BY `order` ";
$querypeople = mysqli_query($conn, $selectpeople);
?>

<style>
    .aboutusimg figure {
        padding-right: 50px;
    }
</style>

<div class="row g-4">
    <div class="col-12 col-lg-4 sidebar-left">
        <div class="sidebar-wpr aboutusimg">
            <h2>Our people</h2>

            <?php
            while ($rowpeople = mysqli_fetch_assoc($querypeople)) {
                if ($rowpeople["image"]) {
                    $image = $rowpeople["image"];
                } else {
                    $image = 'default-person.jpg';
                }

                echo "<figure>";
                echo "<img src='" . $baseURL . "/filestore/images/content/" . $image . "'>";
                echo "<figcaption>";
                echo "<p>" . $rowpeople["name"] . " <span>" . $rowpeople["position"] . "</span></p>";
                echo "</figcaption>";
                echo "</figure>";
            }
            ?>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="inner-contact">
            <h1><?php echo $contentItem["heading"] ?? ''; ?></h1>
            <?php if (!empty($contentItem["subheading"])): ?>
                <h3><?php echo $contentItem["subheading"]; ?></h3>
            <?php endif; ?>
            <?php echo $contentItem["text"] ?? ''; ?>
        </div>
    </div>
</div>


			<!--	<div class="col-sm-3 col-md3">
					<div class="inner-contact">
						<?php
						echo "<div class='download sbimg'>" ;
							echo "<h3>Download Brochure</h3>" ;
							echo "<a href='" . $baseURL . "/filestore/files/ms-timber-brochure.pdf' target='_blank'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/content/timber-brochure.jpg' alt='Download MS Timber Brochure' title='Download MS Timber Brochure'></a>" ;
				        echo "</div>" ;
					   ?>
					</div>
				</div>
-->

<!-- END content-standard-by-cols.php -->
<?php echo '</div>'; ?>
