	<?php
					
				$selectmenutop = "SELECT * FROM `menu` WHERE `menu` > '20' AND `submenu` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
				//echo "<p> Select Menu Top = " . $selectmenutop . "</p>" ;
				$querymenutop = mysqli_query($conn, $selectmenutop );									
				while ( $rowmenutop = mysqli_fetch_assoc( $querymenutop ) ) {
					
					
					echo "<li class='dropdown'>" ; // Start top Level 1st item
					  echo "<a href='#' class='dropdown-toggle'>" . $rowmenutop["title"] . "<span class='caret'></span></a>" ; // Top level Menu

					  echo "<ul class='dropdown-menu'>" ;

						echo "<li><a href='#'>TIMBER AT A GLANCE</a></li>" ; // 2nd level menu - no sub1 menu

						echo "<li class='sub-children'>" ;
							echo "<a href='#'>Hardwood/Plywood <span class='caret'></span></a>" ;

							echo "<ul class='sub-children-menu'>" ;
								echo "<li><a href='#'>BRANDS:</a> </li>" ; // 3rd level menu
								echo "<li><a href='" . $baseURL . "/products/hibernia/1/4'>Hibernia </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/chieftian/2/4'>Chieftian </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/ri/3/4'>Ri</a> </li>" ;
								echo "<li><img src='" . $baseURL . "/images/fadf.png'></li>" ;
							echo "</ul>" ;

						echo "</li>" ;



						echo "<li class='sub-children'>" ;
							echo "<a href='#'>Softwood/Plywood <span class='caret'></span></a>" ; // 2nd level

							echo "<ul class='sub-children-menu'>" ;
								echo "<li><a href='#'>BRANDS:</a> </li>" ; // 3rd level
								echo "<li><a href='" . $baseURL . "/products/chieftian/2/4'>Chieftian </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/hibernia/1/4'>Hibernia </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/ri/3/4'>Ri</a> </li>" ;
								echo "<li><img src='" . $baseURL . "/images/fadf.png'></li>" ;
							echo "</ul>" ;

						echo "</li>" ;

						echo "<li><a href='#'>MDF</a></li>" ;

						echo "<li class='sub-children'>" ;
							echo "<a href='#'>OSB <span class='caret'></span></a>" ;

							echo "<ul class='sub-children-menu'>" ;
								echo "<li><a href='#'>BRANDS:</a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/chieftian/2/4'>Chieftian </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/hibernia/1/4'>Hibernia </a> </li>" ;
								echo "<li><a href='" . $baseURL . "/products/ri/3/4'>Ri</a> </li>" ;
								echo "<li><img src='" . $baseURL . "/images/fadf.png'></li>" ;
							echo "</ul>" ;

						echo "</li>" ;

						echo "<li><a href='#'>Chip Board</a></li>" ;
						echo "<li><a href='#'>Hard Board</a></li>" ;
						echo "<li><a href='#'>Enginering Floors</a></li>" ;
						echo "<li><img src='" . $baseURL . " ;/images/zxcz.png'></li>" ;

					  echo "</ul>" ;

					echo "</li>" ; // End top level 1st item

					echo "<li><a href='" . $baseURL . "/doors/9/10/10'>Doors</a></li>" ;
					echo "<li><a href='" . $baseURL . "/doors-template.html'>Tech Terms</a></li>" ;
					echo "<li><a href='" . $baseURL . "/about-ms-timber/2/2/2'>About MS timber</a></li>" ;
					echo "<li><a href='" . $baseURL . "/acceditation.html'>Environmental</a></li>" ;
					echo "<li><a href='" . $baseURL . "/contact-ms-timber'>Contact Us</a></li>" ; 
				}
?>