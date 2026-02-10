<!-- START nav.php -->

<?php
$nav = 'ZZ' ;
	if ($nav == "No") ;
{
?>
	<!-- MANUAL NAV -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">Art on a Tin</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="about">About</a></li>
				<li><a href="products">Products</a></li>
				<li><a href="corporate">Corporate</a></li>
				<li><a href="wedding">Wedding</a></li>
				<li><a href="retail">Retail</a></li>
				<li><a href="contact">Contact</a></li>
			  </ul>
			  <a class="navbar-brand pull-right" href="#">T: 028 #### ####</a>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>
<?php
}
else {
// DATA BASE NAV
	if ($nav == 'Yes') {
?>
<?php
$debugcheck = 'Yes';
if ( $debugcheck == 'Yes' ) {
	//echo "<h1>Hello - Debug is ON</h1>";
}

//SET ACTIVE STATE

$selectactive = "SELECT * FROM `menu` WHERE `page` = '" . $slugID . "' ";
$queryactive = mysqli_query($conn, $selectactive );
$rowactive = mysqli_fetch_assoc( $queryactive);
$activeCheck1 = $rowactive["menu"];




$selectmenu = "SELECT * FROM `menu` WHERE `submenu` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";

if ( $debugcheck == 'Yes' ) {
	//echo "Menu Select = " . $selectmenu . "<br>";
}

$querymenu = mysqli_query($conn, $selectmenu );
?>

<div class="row">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="defaultNavbar1">
				<ul class="nav navbar-nav">

					<?php
					while ( $rowmenu = mysqli_fetch_assoc( $querymenu) ) {
						$active = 'No';
						$selectmenutop = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenu[ "menu" ] . "' AND `submenu` > '0' AND `showonweb` = 'Yes' ORDER BY `submenu` ";
						if ( $debugcheck == 'Yes' ) {
							//echo "MenuTop Select = " . $selectmenu . "<br>";
						}
						$querymenutop = mysqli_query($conn, $selectmenutop );
						$rowmenutop = mysqli_fetch_assoc( $querymenutop);

						$selectmenuurl = "SELECT * FROM `pages` WHERE `id` = " . $rowmenu[ "page" ] . " ";
						$querymenuurl = mysqli_query($conn, $selectmenuurl );
						$rowmenuurl = mysqli_fetch_assoc( $querymenuurl);

						$selectmenutopCheck = "SELECT * FROM `pages` WHERE `id` = '" . $rowmenu[ "menu" ] . "' AND `submenu` = '0' ";
						$querymenutopCheck = mysqli_query($conn, $selectmenutopCheck );
						$rowmenutopCheck = mysqli_fetch_assoc( $querymenutopCheck);

						//$selectactive = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenu["menu"] . "' ";
						//$queryactive = mysqli_query($conn, $selectactive );
						//$rowactive = mysqli_fetch_assoc( $queryactive);
						$activeCheck2 = $rowmenu["menu"];

						if ( $activeCheck1 == $activeCheck2 ) {
							$active = 'active';
						}

						$num_rows = mysqli_num_rows( $querymenutop );
						if ( $num_rows < 1 ) // No dropdown required
						{
							echo "<li class='" . $active . "'><a href='http://" . $_SERVER['SERVER_NAME'] . "/" . $rowmenuurl[ "slug" ] . "'>" . $rowmenu[ "name" ] . "<span class='sr-only'>(current)</span></a></li>";
						} else // Drop down Yes
						{

							$selectsubmenu = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenu[ "menu" ] . "' AND `submenu` > '0' AND `showonweb` = 'Yes' ORDER BY `submenu` ";
							// GET TOP MENU URL

							if ( $debugcheck == 'Yes' ) {
								//echo "SubMenu Select = " . $selectsubmenu . "<br>";
							}
							$querysubmenu = mysqli_query($conn, $selectsubmenu );

							echo "<li class='dropdown " . $active . "'>";
							echo "<a href='http://" . $_SERVER['SERVER_NAME'] . "/" . $rowmenuurl[ "slug" ] . "' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>";
							echo "" . $rowmenu[ "name" ] . "<span class='caret'></span>";
							echo "</a>";
							echo "<ul class='dropdown-menu'>";
							while ( $rowsubmenu = mysqli_fetch_assoc( $querysubmenu) ) {
								// GET SubMenu URL
								$selectsubmenuurl = "SELECT * FROM `pages` WHERE `id` = " . $rowsubmenu[ "page" ] . " ";
								$querysubmenuurl = mysqli_query($conn, $selectsubmenuurl );
								$rowsubmenuurl = mysqli_fetch_assoc( $querysubmenuurl);
								echo "<li><a href='http://" . $_SERVER['SERVER_NAME'] . "/" . $rowsubmenuurl[ "slug" ] . "'>" . $rowsubmenu[ "name" ] . " (" . $rowsubmenuurl[ "id" ] . ")</a></li>";
							}
							echo "</ul>";
							echo "</li>";
						}
					}
					?>

				</ul>
			</div>

			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</div>


<?php
	}
	else {
		echo "<h1> Hello </h1>" ;
		}
	}
?>
<!--
<?php
echo "<h2 id='reverseout'>";
echo $activeCheck1 . "<br>";
echo $activeCheck2 . "<br>";
echo "</h2>";
?>
-->


<!-- END nav.php -->