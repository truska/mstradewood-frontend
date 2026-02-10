<!-- START stylesheetcmscss.php -->
	

<style>
<?php
	if ($prefscss["pref2ndCol"]) {
		echo "#secondcol {color:" . $prefscss["pref2ndCol"] . ";}" ;
	}
	if ($prefscss["pref2ndCol"]) {
		echo "h1 {color:" . $prefscss["pref2ndCol"] . ";}" ;
	}
	if ($prefscss["prefH2Col"]) {
		echo "h2 {color:" . $prefscss["prefH2Col"] . ";}" ;
	}
	if ($prefscss["prefH3Col"]) {
		echo "h3 {color:" . $prefscss["prefH3Col"] . ";}" ;
	}
	
	echo "h4 {color:inherit;}" ;
	echo "h5 {color:inherit;}" ;
	echo "h6 {color:inherit;}" ;

	
	echo "p {color:" . $prefscss["prefTextCol"] . ";}" ; /* $prefscss["prefTextCol"] */
	echo "p a:link, p a:visited {color:" . $prefscss["prefTextLinkCol"] . ";}" ; /* $prefscss["prefTextLinkCol"] */
	
	echo "p a:hover, p a:focus, p a:active {color:" . $prefscss["prefTextHoverCol"] . ";}" ; /* prefTextHoverCol */

	/* NAV BAR */
	if ($prefscss["prefMenuBGCol"]) {
		echo ".navbar {" ;
			echo "background-color:" . $prefscss["prefMenuBGCol"] . ";" ;
			echo "border-color:" . $prefscss["prefMenuBGCol"] . ";" ;
		echo "}" ;
	}
	
	if ($prefscss["prefMenuTextCol"]) {
		echo ".navbar-default .navbar-nav>li>a {color:" . $prefscss["prefMenuTextCol"] . ";} " ;
	}
	
	echo ".navbar-default .navbar-nav>.active>a, " ;
	echo ".navbar-default .navbar-nav>.active>a:focus, " ;
	echo ".navbar-default .navbar-nav>.active>a:hover { " ;
		echo "color:" . $prefscss["prefMenuActiveTextCol"] . "; " ;
		echo "background-color: " . $prefscss["prefMenuActiveBGCol"] . "; " ;
	echo "} " ;
	
	echo ".navbar-default .navbar-nav>.open>a, " ;
	echo ".navbar-default .navbar-nav>.open>a:focus, " ;
	echo ".navbar-default .navbar-nav>.open>a:hover, " ;
	echo ".navbar-default .navbar-nav>li>a:focus, " ;
	echo ".navbar-default .navbar-nav>li>a:hover{ " ;
		echo "color:#" . $prefscss["prefMenuHoverTextCol"] . "; " ; /* prefMenuHoverTextCol */
		echo "background-color: " . $prefscss["prefMenuHoverBGCol"] . "; " ; /* prefMenuHoverBGCol */
	echo "} " ;
	
	
	echo ".dropdown-menu { " ;
		echo "color:" . $prefscss["prefMenuDDTextCol"] . "; " ;
		echo "background-color: " . $prefscss["prefMenuDDBGCol"] . "; " ;
	echo "} " ;
	
	echo ".dropdown-menu>li>a: { " ;
		echo "color:" . $prefscss["prefMenuDDTextCol"] . "; " ;
		echo "background-color: " . $prefscss["prefMenuDDBGCol"] . "; " ;
	echo "} " ;
	
	echo ".dropdown-menu>li>a:focus, " ;
	echo ".dropdown-menu>li>a:hover { " ;
		echo "color:" . $prefscss["prefMenuDDTextCol"] . "; " ;
		echo "background-color: " . $prefscss["prefMenuDDHoverBGCol"] . "; " ;
	echo "} " ;
	
	
	
	
	
	echo ".navbar-inverse { " ;
		echo "background-color:#777777; " ;
		echo "border-color:#BF1E2E; " ;
	echo "} " ;
	echo ".navbar-inverse .navbar-nav>li>a { " ;
		echo "color:#ffffff; " ;
	echo "} " ;
	echo ".navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover { " ;
		echo "color:#dddddd; " ;
	echo "} " ;
	echo ".navbar-inverse .navbar-brand { " ;
		echo "color:#ffffff; " ;
	echo "} " ;
	echo ".navbar-inverse .navbar-brand:focus, .navbar-inverse .navbar-brand:hover { " ;
		echo "color:#dddddd; " ;
	echo "} " ;

/* Footer */
	echo ".footer { " ;
		echo "background-color: " . $prefscss["prefFooterBGCol"] . " ; " ;
		echo "color: #ffffff ; " ;
	echo "} " ;
	
	echo ".footerarea h3 { " ;
		echo "color: " . $prefscss["prefFooterH3TextCol"] . " ; " ;
	echo "} " ;
	
	echo ".footer p { " ;
		echo "color: " . $prefscss["prefTextCol"] . " ; " ;
	echo "} " ;
	
	echo ".footer a:link, " ;
	echo ".footer a:visited 	{ " ;
		echo "color: " . $prefscss["prefTextCol"] . " ; " ;
	echo "} " ;
	
	echo ".footer a:hover, " ;
	echo ".footer a:active 	{ " ;
		echo "color: #222222 ; " ;
	echo "} " ;
	
	echo ".footer-link li { " ;
		echo "color: #808080; " ;
	echo "} " ;
	
	echo ".footer-link li a, .footer-social-icon " ;
	echo " li a{ " ;
		echo "color: #808080; " ;
	echo "} " ;
	
/* Icon Colour */
	echo ".footer-link li a:link, .footer-social-icon li a:link , " ;
	echo ".footer-link li a:visited, .footer-social-icon li a:visited { " ;
	echo "color: " . $prefscss["prefscssocialIconTextCol"] . " ; " ; /* Icon Colour  	
prefscssocialIconTextCol */ 
	echo "} " ;
	
	echo ".footer-link li a:hover, .footer-social-icon li a:hover { " ;
		echo "color: " . $prefscss["prefscssocialIconHoverTextCol"] . " ; " ; /* Mouse Over Colour */ 
	echo "} " ;
	
?>
</style>
<!-- END stylesheetcmscss.php -->