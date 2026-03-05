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
<!-- START content-peoduct-list.php () --> 
<?php
// GET CONTENT

$selectcontent = "SELECT * FROM `content` WHERE `id` = '" . $contentid  . "' AND `showonweb` = 'Yes' ORDER BY `sort` " ;
				//	echo $selectcontent . "<br>";
					$querycontent = mysqli_query($conn,$selectcontent);
				//	$num_rows_content = mysqli_num_rows($querycontent);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_content . "<br>";
				//	$rowcontent = mysqli_fetch_assoc($querycontent) ;

?>

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				
				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
				<?php
				echo "<div class='col-sm-9'>" ;

				while ($rowcontent = mysqli_fetch_assoc($querycontent) ){
					
					if ($rowcontent["showheading"] == 'Yes') {
						echo "<div class='row'>" ;
							echo "<div class='col-sm-8 col-sm-offset-4'>" ;
								echo "<div class='inner-contact'>" ;
									echo "<h1>" . $rowcontent["heading"] . "</h1>" ;
								echo "</div>" ;
							echo "</div>" ;
						echo "</div>" ;
					}

						echo "<div class='row row-wrp'>" ;
							echo "<div class='col-sm-4 text-center'>" ;
								echo "<div class=''>" ;
									echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowcontent["image"] . "'>" ;
								echo "</div>" ;
							echo "</div>" ;
							echo "<div class='col-sm-8'>" ;
								echo "<div class='inner-contact'>" ;
									echo "" . $rowcontent["text"] . "</p>" ;
									//echo "<a href='https://www.pefc.org/'>https://www.pefc.org/</a>" ;
								echo "</div>" ;

							echo "</div>" ;
						echo "</div>" ;
					
					
				}
				echo "</div>" ;

				?>

<!-- END content-peoduct-list.php -->
<?php echo '</div>'; ?>
