<!-- START functions.php -->

<?php
function loadPrefs($conn) {
	$selectprefs = "SELECT `name`, `value` FROM `preferences` ORDER BY `prefCat` ";
	$queryprefs = mysqli_query($conn,$selectprefs);
	//while ($rowprefs = mysqli_fetch_assoc($queryprefs) )
	while ($rowprefs = mysqli_fetch_array($queryprefs) )
		{
			$prefs[$rowprefs["name"]] = $rowprefs["value"];
		}
		return $prefs;
	}


	
function getCompanyName($prefs) {
		return $prefs['prefCompanyName'];
	}
function getSiteName($prefs) {
		return $prefs['prefSiteName'];
	}
	
function  getAddressLong($prefs) {
	    
		if ($prefs['prefAddress1']){$prefsAddressLong = $prefsAddressLong  . $prefs['prefAddress1'];}
		if ($prefs['prefAddress12']){$prefsAddressLong = $prefsAddressLong . ", " . $prefs['prefAddress12'];}
		if ($prefs['prefTown']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefTown'];}
		if ($prefs['prefCounty']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefCounty'];}
		if ($prefs['prefCountry']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefCountry'];}
		if ($prefs['prefPostcode']){$prefsAddressLong = $prefsAddressLong  . ", "   . $prefs['prefPostcode'];}

		return $prefsAddressLong;  
	}
function  getAddressShort($prefs) {
	    
		if ($prefs['prefAddress1']){$prefsAddressShort = $prefsAddressShort  . $prefs['prefAddress1'];}
		if ($prefs['prefAddress2']){$prefsAddressShort = $prefsAddressShort . "<br>" . $prefs['prefAddress2'];}
		if ($prefs['prefTown']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefTown'];}
		if ($prefs['prefCounty']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefCounty'];}
		if ($prefs['prefCountry']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefCountry'];}
		if ($prefs['prefPostcode']){$prefsAddressShort = $prefsAddressShort  . "<br>"   . $prefs['prefPostcode'];}

		return $prefsAddressShort;  
	}
function getEmail($prefs) {
		return $prefs['prefEmail'];
	}
function getTel1($prefs) {
		return $prefs['prefTel1'];
	}
function getTel1Int($prefs) {
		return $prefs['prefTel1Int'];
	}
function getTel2($prefs) {
		return $prefs['prefTel2'];
	}
function getTel2Int($prefs) {
		return $prefs['prefTel2Int'];
	}
function getFax($prefs) {
		return $prefs['prefFax'];
	}
function getGoogleMap($prefs) {
		return $prefs['prefGoogleMap'];
	}
function getLogo($prefs) {
		return "filestore/images/logos/" . $prefs['prefLogo'];
	}
function getTagline($prefs) {
		return $prefs['prefTagline'];
	}

?>


<!-- END functions.php -->