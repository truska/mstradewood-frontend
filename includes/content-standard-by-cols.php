<!-- START content-standard-by-cols.php (ABOUT US) -->
<?php
// GET CONTENT
$selectcontent = "SELECT * FROM `content` WHERE `page` = " . $slugID . " AND `showonweb` = 'Yes' ORDER BY `sort` ";
$querycontent = mysqli_query($conn, $selectcontent);
$rowcontent = mysqli_fetch_assoc($querycontent);

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
            <h1><?php echo $rowcontent["heading"]; ?></h1>
            <?php echo $rowcontent["text"]; ?>
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
