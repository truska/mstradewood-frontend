<!-- START functionprefs.php -->
<h3>In FunctionPrefs.php</h3>s

<?php
	
function loadPrefs1() {
  $selectprefs = "SELECT name, value FROM `preferences` ORDER BY `prefCat` ";
	$queryprefs = mysqli_query($conn,$selectprefs);
	
	while ($rowprefs = mysqli_fetch_assoc($queryprefs) )
		{
			$prefs[$rowprefs["name"]] = $rowprefs["value"];
		}
		return $prefs;
		
	}
/* */
function dkc() {
	echo "DCs Function<br>" ;
}
?>
<h3>Functions Loaded</h3>
<!-- END functionprefs.php -->