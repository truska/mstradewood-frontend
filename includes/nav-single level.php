<!-- START nav.php -->

<?php
$active = 'active' ;

$selectmenu = "SELECT * FROM `menu` WHERE `submenu` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
$querymenu = mysqli_query($conn, $selectmenu );
?>
	<!-- MANUAL NAV -->
	<!--	<nav class="navbar navbar-inverse navbar-fixed-top"> -->
		<nav class="navbar navbar-inverse">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
				<!--
			  <a class="navbar-brand" href="<?php echo $homePageURL ; ?>"><?php echo getSiteName($prefs) ;?></a>
				-->
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				
			  <ul class="nav navbar-nav">
			  	<?php
					while ($rowmenu = mysqli_fetch_assoc( $querymenu) ) {
						//Check if Active
						if ($slugid == $rowmenu["id"]) {
							$active = 'active' ;
							}
							else {
								$active = '' ;
							}
						
						//Look up URL
						$selectmenuurl = "SELECT * FROM `pages` WHERE `id` = " . $rowmenu["page"] . " ";
						$querymenuurl = mysqli_query($conn, $selectmenuurl );
						$rowmenuurl = mysqli_fetch_assoc( $querymenuurl);

						echo "<li class='" . $active . "'><a href='http://" . $_SERVER['SERVER_NAME'] . "/" . $rowmenuurl["slug"] . "'>" . $rowmenu["title"] ."</a></li>" ;
				  	}
				?>

			  </ul>
				
			  <a class="navbar-brand pull-right" href="#">T: <?php echo getTel1($prefs) ;?></a>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>


<!-- END nav.php -->