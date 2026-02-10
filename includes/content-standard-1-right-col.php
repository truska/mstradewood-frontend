<!-- START content-standard-1-right-col.php -->
		
<?php
	//  Set Col widths	

		echo "<div class='col-lg-12'>" ; // Heading
			if ($rowcontent["showtitle"] == 'Yes' )
			{
				echo "<h1>"	. $rowcontent["title"] . "</h1>" ;
			}
			if ($rowcontent["subhead1"])
			{
				echo "<h2>"	. $rowcontent["subhead1"] . "</h2>" ;
			}
				echo ""	. $rowcontent["text1"] . "" ;
				echo "<p style='float:right; color:#dddddd;'>Ref:"	. $rowcontent["id"] . "</p>" ;
		echo "</div>" ;
		
	// END OF LEFT COL
?>	
<div class="clearfix"></div>

<!-- END content-standard-1-right-col.php -->
		