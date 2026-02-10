<!-- START functions.php ww-->
<?php

function loadPrefs($conn) {
	$selectprefs = "SELECT `name`, `value` FROM `preferences` ORDER BY `prefCat` ";
	$queryprefs = mysqli_query($conn,$selectprefs);
	while ($rowprefs = mysqli_fetch_assoc($queryprefs) )
		{
			$prefs[$rowprefs["name"]] = $rowprefs["value"];
		}
		return $prefs;
	}
?>
<!-- End loadprefs -->
<?php
function getCompanyName($prefs) {
		return $prefs['prefCompanyName'];
	}
function getSiteName($prefs) {
		return $prefs['prefSiteName'];
	}
	
function  getAddressLong($prefs) {
			$prefsAddressLong = '';
		    
			if ($prefs['prefAddress1']){$prefsAddressLong = $prefsAddressLong  . $prefs['prefAddress1'];}
		if ($prefs['prefAddress2']){$prefsAddressLong = $prefsAddressLong . ", " . $prefs['prefAddress2'];}
		if ($prefs['prefTown']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefTown'];}
		if ($prefs['prefCounty']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefCounty'];}
		if ($prefs['prefCountry']){$prefsAddressLong = $prefsAddressLong  . ", " . $prefs['prefCountry'];}
		if ($prefs['prefPostcode']){$prefsAddressLong = $prefsAddressLong  . ", "   . $prefs['prefPostcode'];}

		return $prefsAddressLong;  
	}
function  getAddressShort($prefs) {
			$prefsAddressShort = '';
		    
			if ($prefs['prefAddress1']){$prefsAddressShort = $prefsAddressShort  . $prefs['prefAddress1'];}
		if ($prefs['prefAddress2']){$prefsAddressShort = $prefsAddressShort . "<br>" . $prefs['prefAddress2'];}
		if ($prefs['prefTown']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefTown'];}
		if ($prefs['prefCounty']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefCounty'];}
		if ($prefs['prefCountry']){$prefsAddressShort = $prefsAddressShort  . "<br>" . $prefs['prefCountry'];}
		if ($prefs['prefPostcode']){$prefsAddressShort = $prefsAddressShort  . "<br>"   . $prefs['prefPostcode'];}

		return $prefsAddressShort;  
	}
function  getAddressList($prefs) {
			$prefsAddressList = '';
		    
			if ($prefs['prefAddress1']){$prefsAddressList = $prefsAddressList  . "<li>" . $prefs['prefAddress1'] . "</li>" ;}
		if ($prefs['prefAddress2']){$prefsAddressList = $prefsAddressList . "<li>" . $prefs['prefAddress2'] . "</li>" ;}
		if ($prefs['prefTown']){$prefsAddressList = $prefsAddressList  . "<li>" . $prefs['prefTown'] . "</li>" ;}
		if ($prefs['prefCounty']){$prefsAddressList = $prefsAddressList  . "<li>" . $prefs['prefCounty'] . "</li>" ;}
		if ($prefs['prefCountry']){$prefsAddressList = $prefsAddressList  . "<li>" . $prefs['prefCountry'] . "</li>" ;}
		if ($prefs['prefPostcode']){$prefsAddressList = $prefsAddressList  . "<li>"   . $prefs['prefPostcode'] . "</li>" ;}

		return $prefsAddressList;  
	}
function  getAddressShortList($prefs) {
			$prefsAddressShortList = '';

			$prefsAddressShortList = $prefsAddressShortList  . "<li><strong>Head Office</strong></li>" ;
		if ($prefs['prefAddress1']){$prefsAddressShortList = $prefsAddressShortList  . "<li>" . $prefs['prefAddress1'] . "</li>" ;}
		if ($prefs['prefAddress2']){$prefsAddressShortList = $prefsAddressShortList . "<li>" . $prefs['prefAddress2'] . "</li>" ;}
		if ($prefs['prefTown']){$prefsAddressShortList = $prefsAddressShortList  . "<li>" . $prefs['prefTown'] . "</li>" ;}
		if ($prefs['prefCounty']){$prefsAddressShortList = $prefsAddressShortList  . "<li>" . $prefs['prefCounty'] . "</li>" ;}
		if ($prefs['prefCountry']){$prefsAddressShortList = $prefsAddressShortList  . "<li>" . $prefs['prefCountry'] . "</li>" ;}
		if ($prefs['prefPostcode']){$prefsAddressShortList = $prefsAddressShortList  . "<li>"   . $prefs['prefPostcode'] . "</li>" ;}

		return $prefsAddressShortList;  
	}
function  getAddressNameShortList($prefs) {
			$prefsAddressNameShortList = '';

			if ($prefs['prefCompanyName']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>" . $prefs['prefCompanyName'] . "</li>" ;}
		if ($prefs['prefAddress1']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>" . $prefs['prefAddress1'] . "</li>" ;}
		if ($prefs['prefAddress2']){$prefsAddressNameShortList = $prefsAddressNameShortList . "<li>" . $prefs['prefAddress2'] . "</li>" ;}
		if ($prefs['prefTown']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>" . $prefs['prefTown'] . "</li>" ;}
		if ($prefs['prefCounty']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>" . $prefs['prefCounty'] . "</li>" ;}
		if ($prefs['prefCountry']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>" . $prefs['prefCountry'] . "</li>" ;}
		if ($prefs['prefPostcode']){$prefsAddressNameShortList = $prefsAddressNameShortList  . "<li>"   . $prefs['prefPostcode'] . "</li>" ;}

		return $prefsAddressNameShortList;  
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
<!-- End loadprefs specifics -->
<?php
// Shop Preferences
function loadShopPrefs($conn) {
	$selectshopprefs = "SELECT `name`, `value` FROM `preferences_shop` ORDER BY `prefCat` ";
	$queryshopprefs = mysqli_query($conn,$selectshopprefs);
	while ($rowshopprefs = mysqli_fetch_assoc($queryshopprefs) )
		{
			$prefshop[$rowshopprefs["name"]] = $rowshopprefs["value"];
		}
		return $prefshop;
	}
// ??? Is this needed
function getPrefix($prefshop) {
		return $prefshop['prefFile'];
	}
//

function loadShopText($conn) {
	$selectshoptext = "SELECT `name`, `text` FROM `shoptext` ORDER BY `id` ";
	$queryshoptext = mysqli_query($conn,$selectshoptext);
	while ($rowshoptext = mysqli_fetch_assoc($queryshoptext) )
		{
			$preftext[$rowshoptext["name"]] = $rowshoptext["text"];
		}
		return $preftext;
	}

?>
<!-- End shop -->
<?php

// Shop Modules
function loadModulePrefs($conn) {
	$selectmoduleprefs = "SELECT `name`, `value` FROM `preferences_modules` ORDER BY `prefCat` ";
	$querymoduleprefs = mysqli_query($conn,$selectmoduleprefs);
	while ($rowmoduleprefs = mysqli_fetch_assoc($querymoduleprefs) )
		{
			$prefmodule[$rowmoduleprefs["name"]] = $rowmoduleprefs["value"];
		}
		return $prefmodule;
	}
?>
<!-- End shop mudules -->
<?php
/* General Functions*/

function valid_email($email) {
  return filter_var((string)$email, FILTER_VALIDATE_EMAIL) !== false;
}

function flipdate($dt, $seperator_in, $seperator_out)
	{
	return implode($seperator_out, array_reverse(explode($seperator_in, $dt)));
	}
?>

<!-- END functions.php -->
