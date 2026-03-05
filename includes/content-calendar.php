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
<!-- START content-calendar.php -->
		
<?php
	//  Set Col widths	

		echo "<div class='col-lg-12'>" ; // Heading across full width
			echo "<h2>Forthcoming Events</h2>";
		echo "</div>" ;

			$pieces = explode("-", flipdate($row1["cal_date"],"-","-"));
			

			// check div after this - set div for left hand column
		echo "<div class='col-lg-8  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
			echo "<div class='col-lg-4  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<a href='#'><h4>"	. date('D M j', mktime(0, 0, 0, $pieces[1]  , $pieces[0] , $pieces[2])) . "</h4></a>" ;
			echo "</div>" ;
			echo "<div class='col-lg-8  col-md-4 col-sm-6 col-xs-12 body-area-left'>" ; 
				echo "<a href='#'><h4>"	. $rowcalendar["event"] . "</h4></a>" ;
			echo "</div>" ;

		echo "</div>" ;
	// END OF LEFT COL
	
	// START OF RIGHT COL - set div for right hand column
				echo "<div class='col-lg-4 col-md-6 col-sm-6 col-xs-12 body-area-right'>" ;

					echo "<h2>Right Col</h2>" ;

					if ($rowcalendar["image"])	
					{
						echo "<img src='filestore/images/content/"	. $rowcalendar["image"] . "' class='img-responsive' alt='"	. $rowcalendar["title"] . " " . $rowcalendar["subheading"] . "'>" ;
					}

			echo "</div>" ; 


?>
<div class="clearfix"></div>

<!-- END content-calendar.php -->
		<?php echo '</div>'; ?>
