<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
include ("dbcon.php");
include ("functions.php");
?>
</head>

<body>
<h1>Preferences</h1>
<hr>
<?php


$prefs=loadPrefs($conn);

 echo getCompanyName($prefs) . "<br>";

 echo getAddressLong($prefs) . "<br>";

 echo getAddressShort($prefs) . "<br>";
 
 echo "<hr>" ;
 

print_r($prefs);

echo "<hr>" ;
echo "Home Page id = " .  $prefs['prefHomePage'] . "<br>" ;

echo $prefs['prefCompanyName'] . "<br>" ;
echo "<hr>" ;
echo "<h1>Preference Variables for " . $prefSiteName . " site</h1>" ;
echo "<h3>" . $prefs['prefURL'] . "</h3>" ;

  $selectprefs = "SELECT name, value FROM `preferences` ORDER BY `prefCat` ";


	$queryprefs = mysqli_query($conn,$selectprefs);
	while ($rowprefs = mysqli_fetch_assoc($queryprefs) )
		{
			echo "result: " . $rowprefs["name"] . " = " . $rowprefs["value"] . "<br> " ;
		}
	?>
</body>
</html>