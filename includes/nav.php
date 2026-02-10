<!-- START nav.php  -->

<?php
$debugcheck = 'No';
if ( $debugcheck == 'Yes' ) {
	//echo "<h1>Hello - Debug is ON</h1>";
}
?>


<?php
// GET CONTENT
$selectpanel1 = "SELECT * FROM `panelfinder` WHERE `level1` > '0' AND `level2` = '0' AND `level3` = '0' AND `showonweb` = 'Yes' ORDER BY `level1` " ;
	//	echo $selectpanel1 . "<br>";
		$querypanel1 = mysqli_query($conn,$selectpanel1);
		$num_rows_panel1 = mysqli_num_rows($querypanel1);
	//	$count = 1 ;
	//	echo "Number of records = " . $num_rows_panel1 . "<br>";
		$rowpanel1 = mysqli_fetch_assoc($querypanel1) ;

		$counter1 = 1 ;
		$counter2 = 0 ;
		$counter3 = 1 ;

?>
	<!-- B O T T O M   H E A D E R  -->
	<div class="bottom-header">
		<div class="container inner">
            <div class="row">
				
				<!-- P A N E L   F I N D E R -->
            	<div class="col-md-3 col-xs-6">
	            	<div class="dropdown-1  children sd1top" style="">
	            		<a href="JavaScript:void(0);"> <span>panel </span> finder <span> <i class="fa fa-sort-desc" aria-hidden="true"></i></span></a>
	            		<ul class="palen-link" style="background:transparent;"> <!-- menu bar -->
							
							<?php
							while ($rowpanel1 = mysqli_fetch_assoc($querypanel1) )
							{
								
							// CHECK 2nd level QTY needed
								$selectpanel2q = "SELECT `id` FROM `panelfinder` WHERE `level1` = '" . $rowpanel1["level1"] . "' AND level2 > '0' AND level3 = '0' AND `showonweb` = 'Yes' ORDER BY `level2` " ;
							//	echo $selectpanel2 . "<br>";
								$querypanel2q = mysqli_query($conn,$selectpanel2q);
								$num_rows_panel2q = mysqli_num_rows($querypanel2q);
							//	$count = 1 ;
							//	echo "Number of records 2 = " . $num_rows_panel2 . "<br>";
								
								if ($num_rows_panel2q > 0 ) {  // 2nd level dropdown needed
									
									// DisplayTop level with dropdown
									echo "<li style='background: #919090;'>" ;
									echo "<span>" . $rowpanel1["name"] . " <i class='fa fa-sort-desc' aria-hidden='true'></i></span>" ;
								//	echo "<span>" . $rowpanel1["name"] . " (" . $counter1 . " of " . $num_rows_panel1 . " | XX)<i class='fa fa-sort-desc' aria-hidden='true'></i></span>" ;
									//echo $selectpanel1 . "<br>" ;
									
									// Dropdown Top Level UL START
									echo "<ul class='palen-link-1 sd1dropdowm'>" ;
									
									// Get 2nd level Data
										$selectpanel2 = "SELECT * FROM `panelfinder` WHERE `level1` = '" . $rowpanel1["level1"] . "' AND level2 > '0' AND level3 = '0' AND `showonweb` = 'Yes' ORDER BY `level2` " ;
									//	echo $selectpanel2 . "<br>";
										$querypanel2 = mysqli_query($conn,$selectpanel2);
										$num_rows_panel2 = mysqli_num_rows($querypanel2);
									

										while ($rowpanel2 = mysqli_fetch_assoc($querypanel2) ) //
										{

										// CHECK 3nd level QTY - Is DD needed?
										$selectpanel3q = "SELECT `id` FROM `panelfinder` WHERE `level1` = '" . $rowpanel2["level1"] . "' AND `level2` = '" . $rowpanel2["level2"] . "' AND `level3` > '0' AND `showonweb` = 'Yes' ORDER BY `level2` " ;
										$querypanel3q = mysqli_query($conn,$selectpanel3q);
								//	echo "<span style='color:red;'>selectpanel3q = " . $selectpanel3q . "<span>";
										$num_rows_panel3q = mysqli_num_rows($querypanel3q);

											
										// GET 3rd level data 
											$selectpanel3 = "SELECT * FROM `panelfinder` WHERE `level1` = '" . $rowpanel1["level1"] . "' AND `level2` = '" . $rowpanel2["level2"] . "' AND `level3` > '0' AND `showonweb` = 'Yes' ORDER BY `level3` " ;
										//	echo "<span style='font-size:10px; color:red;'>" . $selectpanel3 . "</span><br>";
											$querypanel3 = mysqli_query($conn,$selectpanel3);
											$num_rows_panel3 = mysqli_num_rows($querypanel3);
										//	$count = 1 ;
										//	echo "Number of records 3 = " . $num_rows_panel3 . "<br>";
										$counter2 ++ ;
											
										if ($num_rows_panel3q > 0 ) { // If 3rd Level DD needed
											// Display 2nd Level Data
											echo "<li style='padding: 0px 0px; margin-bottom:0px;'>" ; // DK Brown #69654e
                                            //2nd level with link (h<a ref removed )
												echo "<a href='#' style='line-height:16px; margin-bottom:-5px;'>" . $rowpanel2["name"] . " <i class='fa fa-sort-desc' aria-hidden='true'></i></a>" ;
												
												// Start 3rd Level dropdown 
												echo "<ul class='palen-link-2'>" ;
													while ($rowpanel3 = mysqli_fetch_assoc($querypanel3) ) //
													{											
														echo "<li style='padding: 0px 0px; margin-bottom:0px;'>" ; // Light brown
															echo "<a href='" . $baseURL . "/product-range/" . $rowpanel3["id"] . "' style='line-height:16px; margin-bottom:-5px;'>" . $rowpanel3["name"] . " </a></li>";
													}
													echo "<li style='background:transparent; margin-top:-10px;'><img src='" . $baseURL . "/filestore/images/logos/menu-slice-brown.png'></li>" ; // Shape at bottom of list
												echo "</ul>" ; // end ul palen-link-2
											echo "</li>" ;
											// 2nd level dropdown
										}
										else
										{
												//2nd level no dropdown - means a list
											//Get/Set URL
											
												echo "<li>" ;
													echo "<a href='" . $baseURL . "/product-range/" . $rowpanel2["id"] . "'>" . $rowpanel2["name"] . "   </a>" ;
												echo "</li>" ;
										}
									}
										$counter2 ++ ;
										echo "<li style='background:transparent; margin-top:-9px;'>" ; 
                                            echo "<img src='" . $baseURL . "/filestore/images/logos/menu-slice-lightbrown.png'>" ;
                                        echo "</li>" ; // Shape at bottom of list
									echo "</ul>" ;
										echo "</li>" ;
										
									}
									else
									{
										echo "<li style='background:transparent; margin-top:-9px;'>" ;
										// Top level no dropdown
											echo "<a href='" . $baseURL . "/product-range/" . $rowpanel1["id"] . "'><span>" . $rowpanel1["name"] . "</span></a>" ;
										echo "</li>" ;
									}
										$counter1 ++ ;
								}
							echo "<li style='padding-left:0px; padding-right:0px; margin-top:-6px;'>" ;
								echo "<img src='" . $baseURL . "/filestore/images/logos/menu-slice-grey.png' style='width:254px; float:right;' >" ;
							echo "</li>" ; // Shape at bottom of list
							?>
							
						
					</ul> <!-- end ul palen-link-1 -->

				</li>
			</ul>
		</div>
	</div>
	            
				<!-- M E N U  S Y S T E M -->
				<div class="col-md-9 col-xs-6">
		            <div class="desktop">		
		            	<nav class="navbar navbar-default">
				    		<!-- Brand and toggle get grouped for better mobile display -->
						    <div class="navbar-header">
						      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						      </button>
						    </div>
							
						    <!-- Collect the nav links, forms, and other content for toggling -->
							
						    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1" >
						    <!--<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1" style="margin-top:9px; margin-bottom:9px;"> -->
				            <ul class="nav navbar-nav">
							<?php
									
				$selectmenutop = "SELECT * FROM `menu` WHERE `menu` > '20' AND `submenu` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
				//echo "<p> Select Menu Top = " . $selectmenutop . "</p>" ;
				$querymenutop = mysqli_query($conn, $selectmenutop );									
				while ( $rowmenutop = mysqli_fetch_assoc( $querymenutop ) ) 
				{
				
				//Top Level No Dropdown
				// Look up Top Level URL / SLUG	
				// Custom Rop Level For Panel Porducts  menu 30
				if ($rowmenutop["menu"] == '30' AND $rowmenutop["product"] > 0)
				{
					$topurl = 'product' ;
				}
				else
				{
				$selectmenutopURL = "SELECT `slug` FROM `pages` WHERE `id` = '" .  $rowmenutop["page"]. "' AND `showonweb` = 'Yes' ";
				//echo "<p> Select Menu Top = " . $selectmenutopURL . "</p>" ;
				$querymenutopURL = mysqli_query($conn, $selectmenutopURL );									
				$rowmenutopURL = mysqli_fetch_assoc( $querymenutopURL ) ;
						$topurl = $rowmenutopURL["slug"] ;
				}
					
				// Check if Drop down 1 needed
				$selectmenu1check = "SELECT `id` FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` > '0' AND `submenu1` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
				//echo "<p> Select Menu 1 Check = " . $selectmenu1check . "</p>" ;
				$querymenu1check = mysqli_query($conn, $selectmenu1check );
				$numrowsmenu1check = mysqli_num_rows($querymenu1check);

				if ($numrowsmenu1check > 0 ) // There is a dropdown
				{					
					echo "<li class='dropdown toplevel' style=''>" ; // Start top Level 1st item
				//	echo "<li class='dropdown toplevel' style='border-right:thin solid #aaaaaa'>" ; // Start top Level 1st item
					  echo "<a href='#' class='dropdown-toggle'>" . $rowmenutop["title"] . "&nbsp;<span class='caret' style='color:#3ea244;'></span></a>" ; // Top level Menu

					  echo "<ul class='dropdown-menu'>" ;
					
					// Get 2nd level data
						$selectmenu1 = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` > '0' AND `submenu1` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` , `submenu`, `submenu1` ";
						//echo "<p> Select Menu 1 Check = " . $selectmenu1 . "</p>" ;

						$querymenu1 = mysqli_query($conn, $selectmenu1 );
						$numrowsmenu1 = mysqli_num_rows($querymenu1);

						while ( $rowmenu1 = mysqli_fetch_assoc( $querymenu1 ) ) { // There is a dropdown		

						//2nd  Level No Dropdown
						// Look up 2nd Level URL / SLUG							
						$selectmenutop2URL = "SELECT `slug` FROM `pages` WHERE `id` = '" .  $rowmenu1["page"]. "' AND `showonweb` = 'Yes' ";
						//echo "<p> Select Menu Top = " . $selectmenutop2URL . "</p>" ;
						$querymenutop2URL = mysqli_query($conn, $selectmenutop2URL );									
						$rowmenutop2URL = mysqli_fetch_assoc( $querymenutop2URL ) ;

							// Check if Drop down 2 needed
							$selectmenu2check = "SELECT `id` FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` = '" . $rowmenu1["submenu"] . "' AND `submenu1` > '0' AND `showonweb` = 'Yes' ORDER BY `menu` , `submenu`, `submenu1` ";
							//echo "<p> Select Menu 1 Check = " . $selectmenu2check . "</p>" ;
							$querymenu2check = mysqli_query($conn, $selectmenu2check );
							$numrowsmenu2check = mysqli_num_rows($querymenu2check);

							if ($numrowsmenu2check > 0 ) // There is a dropdown to 2nd level
							{
						
						
							// Look up 3rd Level URL / SLUG							
							$selectmenutop3URL = "SELECT `slug` FROM `pages` WHERE `id` = '" .  $rowmenu1["page"]. "' AND `showonweb` = 'Yes' ";
							//echo "<p> Select Menu Top = " . $selectmenutop3URL . "</p>" ;
							$querymenutop3URL = mysqli_query($conn, $selectmenutop3URL );									
							$rowmenutop3URL = mysqli_fetch_assoc( $querymenutop3URL ) ;
	
							echo "<li class='sub-children'>" ;
								//echo "<a href='" . $baseURL . "/" . $topurl . "/'>" . $rowmenu1["title"] . " <span class='caret'></span></a>" ;
								echo "<a href='#'>" . $rowmenu1["title"] . " <span class='caret'></span></a>" ;

								echo "<ul class='sub-children-menu'>" ;
	
					// Get 3rd level data
							$selectmenu2 = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` = '" . $rowmenu1["submenu"] . "' AND `submenu1` > '0' AND `showonweb` = 'Yes' ORDER BY `submenu1` ";
						//echo "<p> Select Menu 1 Check = " . $selectmenu1 . "</p>" ;

						$querymenu2 = mysqli_query($conn, $selectmenu2 );
						$numrowsmenu2 = mysqli_num_rows($querymenu2);

								
								
						while ( $rowmenu2 = mysqli_fetch_assoc( $querymenu2 ) ) { // There is a dropdownto 3rd level	
											// Look up Top Level URL / SLUG	

								
							$selectmenu2page = "SELECT * FROM `pages` WHERE `id` = '" . $rowmenu2["page"] . "' ";
							$querymenu2page = mysqli_query($conn, $selectmenu2page );
							$rowmenu2page = mysqli_fetch_assoc( $querymenu2page ) 	;
							 $pageslug = $rowmenu2page["slug"] ;	
								
								
								if ($rowmenu2["page"]) {
									$page_product = $rowmenu2["product"] ;
								}
								else
								{
									$page_product = $rowmenu2["page"] ;
								}
							// Get 3rd level PRODUCR data
							$selectproduct = "SELECT `slug` FROM `products` WHERE `id` = '" . $page_product . "' AND `showonweb` = 'Yes'  ";
							//echo "<p> Select Menu 1 Check = " . $selectmenu1 . "</p>" ;

							$queryproduct = mysqli_query($conn, $selectproduct );
							//$numrowsproduct = mysqli_num_rows($queryproduct);
							$rowproduct = mysqli_fetch_assoc( $queryproduct ) ;
							

									echo "<li><a href='" . $baseURL . "/" .  strtolower($pageslug) . "/" .  $page_product  . "/" . strtolower($rowproduct["slug"]) . "'>" . $rowmenu2["title"] . "</a> </li>" ; // 2nd drop down 
							
								//	echo "<li><a href='" . $baseURL . "/" . $topurl . "/" .  $page_product  . "/" . $rowproduct["slug"] . "'>" . $rowmenu2["title"] . "</a> </li>" ; // 2nd drop down 
								}
								echo "<li><img src='" . $baseURL . "/filestore/images/logos/menu-slice-lightbrown.png'></li>" ;
								echo "</ul>" ;

							echo "</li>" ;
								
							}
							else
							{
								// No drop down for 2nd level
								if ($rowmenu1["page"]) {
									$page_product = $rowmenu1["page"] ;
								}
								else
								{
									$page_product = $rowmenu1["product"] ;
								}
							// Get 2nd level PRODUCT data
							$selectproduct = "SELECT `slug` FROM `products` WHERE `id` = '" . $page_product . "' AND `showonweb` = 'Yes'  ";
							//echo "<p> Select Menu 1 Check = " . $selectmenu1 . "</p>" ;
                                
                                

							$queryproduct = mysqli_query($conn, $selectproduct );
							//$numrowsproduct = mysqli_num_rows($queryproduct);
							$rowproduct = mysqli_fetch_assoc( $queryproduct ) ;
								
								echo "<li><a href='" . $baseURL . "/" . strtolower($rowmenutopURL["slug"]) . "/" . $page_product . "/" . strtolower($rowproduct["slug"]) . "'>" . $rowmenu1["title"] . "</a></li>" ; // 2nd level menu - no sub1 menu
								
							}

						}

					
					//---------------------------------------------
					echo "<li><img src='" . $baseURL . "/filestore/images/logos/menu-slice-brown.png'></li>" ;
					  echo "</ul>" ;

					echo "</li>" ; // End top level 1st item
				
					}
					else
					{						
					echo "<li class='toplevel' style=''><a href='" . $baseURL . "/" . strtolower($rowmenutopURL["slug"]) . "'>" . $rowmenutop["title"] . "</a></li>" ;
				//	echo "<li style='border-left:thin solid #aaaaaa'><a href='" . $baseURL . "/" . strtolower($rowmenutopURL["slug"]) . "'>" . $rowmenutop["title"] . "</a></li>" ;
				//	echo "<li><a href='" . $baseURL . "/doors-template.html'>Tech Terms</a></li>" ;
				//	echo "<li><a href='" . $baseURL . "/about-ms-timber/2/2/2'>About MS timber</a></li>" ;
				//	echo "<li><a href='" . $baseURL . "/acceditation.html'>Environmental</a></li>" ;
				//	echo "<li><a href='" . $baseURL . "/contact-ms-timber'>Contact Us</a></li>" ;
					}
				}
									
	/*								
								$selectmenutop = "SELECT * FROM `menu` WHERE `menu` > '20' AND `submenu` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
								//echo "<p> Selcst Manu Top = " . $selectmenutop . "</p>" ;
								$querymenutop = mysqli_query($conn, $selectmenutop );									
								while ( $rowmenutop = mysqli_fetch_assoc( $querymenutop ) ) {
									// Check if Drop down 1 needed
										$selectmenu1check = "SELECT `id` FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` > '0' AND `submenu1` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
										//echo "<p> Select Menu 1 Check = " . $selectmenu1check . "</p>" ;
									
										$querymenu1check = mysqli_query($conn, $selectmenu1check );
										$numrowsmenu1check = mysqli_num_rows($querymenu1check);
									
										if ($numrowsmenu1check > 0 ) // There is a dropdown
										{
										echo "<li class='dropdown'>" ; // TOP LEVEL
											$selectmenu1 = "SELECT * FROM `menu` WHERE `menu` = '" . $rowmenutop["menu"] . "' AND `submenu` > '0' AND `submenu1` = '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";											
											//echo "<p> Select Menu 1 = " . $selectmenu1 . "</p>" ;											
											$querymenu1 = mysqli_query($conn, $selectmenu1 );
												// TOP LEVEL MENU DISPLAY
												echo "<a href='#' class='dropdown-toggle'>" . $rowmenutop["title"] . " Top - " . $counter1 ."<span class='caret'></span></a>" ; 
														$counter1 ++ ;
	
													// Check if Drop down 2 needed
													$selectmenu2check = "SELECT `id` FROM `menu` WHERE `menu` = '" . $rowmenu1["menu"] . "' AND `submenu` > '0' AND `submenu1` > '0' AND `showonweb` = 'Yes' ORDER BY `menu` ";
													//echo "<p> Select Menu 1 Check = " . $selectmenu1check . "</p>" ;
													$querymenu2check = mysqli_query($conn, $selectmenu2check );
													$numrowsmenu2check = mysqli_num_rows($querymenu2check);
											echo "<ul class='dropdown-menu'>" ;
													echo "a" ;
													if ($numrowsmenu2check > 0 ) // There is a dropdown
													{
														
														echo "<li class='sub-children'>DROP Down " . $counter2 . "</li>" ;
														$counter2 ++ ;
														echo "<li class='sub-children'>DROP Down " . $counter2 . "</li>" ;
														
														echo "b" ;
														
													}
													else
													{
														echo "<li class='sub-children'><a href='#'>" . $rowmenu1["title"] . "</a></li>" ;
														
														

													}
											echo "</ul>" ;
										echo "</li>" ;
											}
										else
										{
												echo "<li><a href='" . $baseURL . "/doors-template.html'>" . $rowmenutop["title"] . " No DD</a></li>" ;
											}
									
									echo "<li><a href='" . $baseURL . "/doors/9/10/10'>Doors</a></li>" ;
									echo "<li><a href='" . $baseURL . "/doors-template.html'>Tech Terms</a></li>" ;
									echo "<li><a href='" . $baseURL . "/about-ms-timber/2/2/2'>About MS Timber</a></li>" ;
									echo "<li><a href='" . $baseURL . "/acceditation.html'>Environmental</a></li>" ;
									echo "<li><a href='" . $baseURL . "/contact-ms-timber'>Contact MS Timber</a></li>" ;
								}
						*/			
							?>
						      <!--
						        <li class="dropdown">
						          <a href="#" class="dropdown-toggle">Panel Products<span class="caret"></span></a>
						          <ul class="dropdown-menu">
						            <li><a href="#">TIMBER AT A GLANCE</a></li>
						            <li class="sub-children">
						            	<a href="#">Hardwood/Plywood <span class="caret"></span></a>
						            	<ul class="sub-children-menu">
						            		<li><a href="#">BRANDS:</a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/hibernia/1/4">Hibernia </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/chieftian/2/4">Chieftian </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/ri/3/4">Ri</a> </li>
											<li><img src="<?php echo $baseURL ;?>/images/fadf.png"></li>
						            	</ul>
						            </li>
						            <li class="sub-children">
						            	<a href="#">Softwood/Plywood <span class="caret"></span></a>
						            	<ul class="sub-children-menu">
						            		<li><a href="#">BRANDS:</a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/chieftian/2/4">Chieftian </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/hibernia/1/4">Hibernia </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/ri/3/4">Ri</a> </li>
											<li><img src="<?php echo $baseURL ;?>/images/fadf.png"></li>
						            	</ul>
						            </li>
						            <li><a href="#">MDF</a></li>
						            <li class="sub-children">
						            	<a href="#">OSB <span class="caret"></span></a>
						            	<ul class="sub-children-menu">
						            		<li><a href="#">BRANDS:</a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/chieftian/2/4">Chieftian </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/hibernia/1/4">Hibernia </a> </li>
											<li><a href="<?php echo $baseURL ; ?>/products/ri/3/4">Ri</a> </li>
											<li><img src="<?php echo $baseURL ;?>/images/fadf.png"></li>
						            	</ul>
						            </li>
						            <li><a href="#">Chip Board</a></li>
						            <li><a href="#">Hard Board</a></li>
						            <li><a href="#">Enginering Floors</a></li>
						            <li><img src="<?php echo $baseURL ;?>/images/zxcz.png"></li>
						          </ul>
						        </li>
						        <li><a href="<?php echo $baseURL ;?>/doors/9/10/10">Doors</a></li>
						        <li><a href="<?php echo $baseURL ;?>/doors-template.html">Tech Terms</a></li>
						        <li><a href="<?php echo $baseURL ;?>/about-ms-timber/2/2/2">About MS timber</a></li>
						        <li><a href="<?php echo $baseURL ;?>/acceditation.html">Environmental</a></li>
						        <li><a href="<?php echo $baseURL ;?>/contact-ms-timber">Contact Us</a></li> -->
									
									
						      </ul>
								
								
								
						    </div><!-- /.navbar-collapse -->
							
							
							
						</nav>
						
					</div>	<!-- END DESKTOP MENU -->
					
				 <!--	<div class="collapse navbar-collapse mobile text-right">-->
				
                        
                     <div class="mobile text-right">  
                        
                        
						<ul class="nav navbar-nav"> 
							<li id="" class="dropdown mobile-menu-root" data-bs-auto-close="outside"> 
								<a href="#" class="dropdown-toggle" id="drop1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars mobile" aria-hidden="true"></i>
                                </a> 
								<ul class="dropdown-menu" aria-labelledby="drop1"> 
                                    
								<?php
                                    $selectnavfootermenu = "SELECT * FROM `menu` WHERE `showonhomemobile` = 'Yes' ORDER BY `menu`, `submenu`, `submenu1`";
                                    $querynavfootermenu = mysqli_query($conn, $selectnavfootermenu);

                                    $mobileMenuRows = [];
                                    while ($row = mysqli_fetch_assoc($querynavfootermenu)) {
                                        $mobileMenuRows[] = $row;
                                    }

                                    // Some mobile datasets only include child rows; hydrate missing top
                                    // nodes from the main nav table so grouped parent titles still render.
                                    $mobileTopRows = [];
                                    $selectMobileTop = "SELECT * FROM `menu` WHERE `submenu` = '0' AND `submenu1` = '0' AND `showonweb` = 'Yes' ORDER BY `menu`";
                                    $queryMobileTop = mysqli_query($conn, $selectMobileTop);
                                    if ($queryMobileTop) {
                                        while ($topRow = mysqli_fetch_assoc($queryMobileTop)) {
                                            $mobileTopRows[(string) ($topRow["menu"] ?? "")] = $topRow;
                                        }
                                    }

                                    $mobileMenuTree = [];
                                    foreach ($mobileMenuRows as $menuRow) {
                                        $topKey = (string) ($menuRow["menu"] ?? "0");
                                        $subKey = (string) ($menuRow["submenu"] ?? "0");
                                        $sub1Key = (string) ($menuRow["submenu1"] ?? "0");

                                        if (!isset($mobileMenuTree[$topKey])) {
                                            $mobileMenuTree[$topKey] = [
                                                "item" => null,
                                                "children" => []
                                            ];
                                        }

                                        if ($subKey === "0") {
                                            $mobileMenuTree[$topKey]["item"] = $menuRow;
                                            continue;
                                        }

                                        if (!isset($mobileMenuTree[$topKey]["children"][$subKey])) {
                                            $mobileMenuTree[$topKey]["children"][$subKey] = [
                                                "item" => null,
                                                "children" => []
                                            ];
                                        }

                                        if ($sub1Key === "0") {
                                            $mobileMenuTree[$topKey]["children"][$subKey]["item"] = $menuRow;
                                            continue;
                                        }

                                        $mobileMenuTree[$topKey]["children"][$subKey]["children"][$sub1Key] = [
                                            "item" => $menuRow
                                        ];
                                    }

                                    foreach ($mobileMenuTree as $topKey => $topNode) {
                                        if (empty($topNode["item"]) && !empty($mobileTopRows[$topKey])) {
                                            $mobileMenuTree[$topKey]["item"] = $mobileTopRows[$topKey];
                                        }
                                    }

                                    $mobileMenuUrl = function ($item) use ($baseURL, $conn) {
                                        if (!empty($item["section"])) {
                                            return $baseURL . "/product-list-section/" . $item["section"];
                                        }
                                        if (!empty($item["page"])) {
                                            $pageId = (int) $item["page"];
                                            if ($pageId > 0) {
                                                $selectPageSlug = "SELECT `slug` FROM `pages` WHERE `id` = '" . $pageId . "' LIMIT 1";
                                                $queryPageSlug = mysqli_query($conn, $selectPageSlug);
                                                if ($queryPageSlug) {
                                                    $rowPageSlug = mysqli_fetch_assoc($queryPageSlug);
                                                    if (!empty($rowPageSlug["slug"])) {
                                                        return $baseURL . "/" . strtolower($rowPageSlug["slug"]);
                                                    }
                                                }
                                            }
                                        }
                                        return "#";
                                    };

                                    $renderMobileMenuNode = function ($node, $level, $keyPrefix) use (&$renderMobileMenuNode, $mobileMenuUrl) {
                                        if (!is_array($node)) {
                                            return;
                                        }

                                        $children = $node["children"] ?? [];
                                        $item = $node["item"] ?? null;

                                        // If parent row is missing, render children at this level instead
                                        // of dropping the branch entirely.
                                        if (empty($item)) {
                                            foreach ($children as $childKey => $childNode) {
                                                $renderMobileMenuNode($childNode, $level, $keyPrefix . "-" . preg_replace("/[^a-zA-Z0-9_-]/", "", (string) $childKey));
                                            }
                                            return;
                                        }

                                        $title = htmlspecialchars((string) ($item["title"] ?? ""), ENT_QUOTES, "UTF-8");
                                        $url = $mobileMenuUrl($item);

                                        if (!empty($children)) {
                                            $submenuId = "mobile-submenu-" . $keyPrefix;
                                            echo "<li class='mobile-menu-item mobile-level-" . (int) $level . " has-submenu'>";
                                            echo "<button type='button' class='mobile-submenu-toggle' data-submenu-target='" . $submenuId . "' aria-expanded='false'>";
                                            echo "<span>" . $title . "</span>";
                                            echo "<span class='caret'></span>";
                                            echo "</button>";
                                            echo "<ul class='mobile-submenu' id='" . $submenuId . "' hidden>";

                                            foreach ($children as $childKey => $childNode) {
                                                $renderMobileMenuNode($childNode, $level + 1, $keyPrefix . "-" . preg_replace("/[^a-zA-Z0-9_-]/", "", (string) $childKey));
                                            }

                                            echo "</ul>";
                                            echo "</li>";
                                            return;
                                        }

                                        echo "<li class='mobile-menu-item mobile-level-" . (int) $level . "'>";
                                        echo "<a href='" . htmlspecialchars((string) $url, ENT_QUOTES, "UTF-8") . "'>" . $title . "</a>";
                                        echo "</li>";
                                    };

                                    foreach ($mobileMenuTree as $topKey => $topNode) {
                                        $safeTopKey = preg_replace("/[^a-zA-Z0-9_-]/", "", (string) $topKey);
                                        $renderMobileMenuNode($topNode, 1, $safeTopKey);
                                    }
                               ?>     
                                    
                                    <li><a href="<?php echo $baseURL ; ?>/tech-terms">Tech Terms</a></li>
                                    <li><a href="<?php echo $baseURL ; ?>/about-ms-timber">About MS Timber</a></li>
                                    <li><a href="<?php echo $baseURL ; ?>/ms-timber-environmental">Environmental</a></li>
                                    <li><a href="<?php echo $baseURL ; ?>/contact-ms-timber">Contact Us</a></li>
                                    <li><a href="<?php echo $baseURL ; ?>/welcome">&nbsp;</a></li>

                                    
                                    

								</ul> 
							</li> 
						</ul>
					</div>
	            </div>
            </div>
        </div>
	</div>



<!-- END nav.php
