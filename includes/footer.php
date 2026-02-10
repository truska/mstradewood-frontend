<!-- START footer.php -->
<style>
    .accreditationfooter img {
        max-height:80px;
        margin-top:40px;
    }
</style>
			<?php
			if ($homePage == "Yes"){
			//	echo "<div class='container inner'> ";
            ?>
            <style>
                footer  {
                    padding-top:80px !important;
                }
            </style>
            <?php
			}
			else
			{
			//	echo "<div class='container inner inner-footer'>" ;
			}
?>
  		<footer class="footer">          
<?php
            echo "<div class='container inner inner-footer'>" ;
			?>
			<!--<div class="container inner"> -->
            	<div class="row">
            		<div class="col-sm-4 col-md-3">
            			<ul>
							<?php
							$selectnavfootermenu = "SELECT * FROM `menu` WHERE  `showonhomemobile` = 'Yes' ORDER BY `menu`, `submenu` " ;
							$querynavfootermenu = mysqli_query($conn,$selectnavfootermenu);
							while ($rownavfootermenu = mysqli_fetch_assoc($querynavfootermenu) )
							{
								echo "<li><a href='" . $baseURL . "/product-list-section/" . $rownavfootermenu["section"] . "'>" . $rownavfootermenu["title"] . "</a></li>" ;
							}

							?>
            			</ul>
            		</div>
            		<div class="col-sm-4 col-md-2">
                        <p>
            			<ul class="addres">
            				<li><strong>DEPOTS</strong></li>
							
							
							<?php
							
							if ($prefs['prefBelfastDepotName']) {echo "<li><em><strong>" . $prefs['prefBelfastDepotName'] . "</em></strong></li>" ; }	
							echo "<li>";
							if ($prefs['prefBelfastDepotAddress1']) {echo "<li>" . $prefs['prefBelfastDepotAddress1'] . ", " ; }	
							if ($prefs['prefBelfastDepotAddress2']) {echo "" . $prefs['prefBelfastDepotAddress2'] . ", " ; }	
							if ($prefs['prefBelfastDepotAddress3']) {echo "" . $prefs['prefBelfastDepotAddress3'] . ", " ; }	
							if ($prefs['prefBelfastDepotTown']) {echo "" . $prefs['prefBelfastDepotTown'] . ", " ; }	
							if ($prefs['prefBelfastDepotCounty']) {echo "" . $prefs['prefBelfastDepotCounty'] . ", " ; }	
							if ($prefs['prefBelfastDepotCountry']) {echo "" . $prefs['prefBelfastDepotCountry'] . "," ; }	
							if ($prefs['prefBelfastDepotPostcode']) {echo "" . $prefs['prefBelfastDepotPostcode'] . " " ; }
							echo "<br><br></li>";
							?>	
							
							
							<?php
							
							if ($prefs['prefDublinDepotName']) {echo "<li><em><strong>" . $prefs['prefDublinDepotName'] . "</em></strong></li>" ; }
							echo "<li>";
							if ($prefs['prefDublinDepotAddress1']) {echo "" . $prefs['prefDublinDepotAddress1'] . ", " ; }	
							if ($prefs['prefDublinDepotAddress2']) {echo "" . $prefs['prefDublinDepotAddress2'] . ", " ; }	
							if ($prefs['prefDublinDepotAddress3']) {echo "" . $prefs['prefDublinDepotAddress3'] . ", " ; }	
							if ($prefs['prefDublinDepotTown']) {echo "" . $prefs['prefDublinDepotTown'] . ", " ; }	
							if ($prefs['prefDublinDepotCounty']) {echo "" . $prefs['prefDublinDepotCounty'] . ", " ; }	
							if ($prefs['prefDublinDepotCountry']) {echo "" . $prefs['prefDublinDepotCountry'] . ", " ; }	
								if (!empty($prefs['prefDublinDepotPostcode'])) {echo "" . $prefs['prefDublinDepotPostcode'] . " " ; }
							echo "</li>";
							?>						
<!--
							
            				<li><em><strong>Belfast</strong></em></li>
            				<li>Rubb Shed, Pollock Dock, Northern Road, Belfast BT3 9AL</li>
                            <li><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp; <a href="tel:<?php echo getTel1Int($prefs); ?>"><?php echo getTel1Int($prefs); ?></a> (UK)<br><br></li>


            				<li><em><strong>Dublin</strong></em></li>
            				<li>Glascarn, Glascarn&nbsp;Lane, Ratoath, Co.&nbsp;Meath, A85 R652</li>
							
                            <li><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp; <a href="tel:<?php echo getTel2Int($prefs); ?>"><?php echo getTel2Int($prefs); ?></a> (RoI)</li> 
-->
            			</ul>
                        </p>
            		</div>
            		<div class="col-sm-4 col-md-2">
            			<ul class="addres">
							<?php
							echo "<p>" . getAddressShortList($prefs) . "</p>" ;
                            ?>
                            <!--
                            <li><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp; <a href="tel:<?php echo getTel1Int($prefs); ?>"><?php echo getTel1($prefs); ?></a> (UK)<br><br></li>
				            <li><p><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp; <a href="mailto:<?php echo getEmail($prefs); ?>"><?php echo getEmail($prefs); ?></a></p></li>
-->
            			</ul>
            		</div>
            		<div class="col-md-5">
            			<div class="row">
            				<div class="col-sm-6">
            					<ul class="phone">
                                    <li><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp; <a href="tel:<?php echo getTel1Int($prefs); ?>"><?php echo getTel1Int($prefs); ?></a> </li>
                                    <li><span class="col2"><i class="fas fa-phone-alt"></i></span>&nbsp;&nbsp; <a href="tel:<?php echo getTel2Int($prefs); ?>"><?php echo getTel2Int($prefs); ?></a> </li>
				                    <li><span class="col2"><i class="fas fa-at"></i></span>&nbsp;&nbsp; <a href="mailto:<?php echo getEmail($prefs); ?>"><?php echo getEmail($prefs); ?></a></li>

            					</ul>
            				</div>
            				<div class="col-sm-6 social">
                                <!--
            					<ul>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/fac.png"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/in.png"></a></li>
            						<li><a href="#" target="_blank"><img src="<?php echo $baseURL ;?>/images/tw.png"></a></li>
            					</ul>
-->
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-sm-12 social accreditationfooter">
            					<ul>
            						<li>
                                        <a href="#">
                                            <img src="<?php echo $baseURL ;?>/filestore/images/content/fsc-logo.png" class="img-responsive" alt="FSC - the mark of responsible forestry" title="FSC - the mark of responsible forestry- FSC C124905">
                                        </a>
                                    </li>
            						<li>
                                        <a href="#">
                                            <img src="<?php echo $baseURL ;?>/filestore/images/content/pefc-logo.png"class="img-responsive" alt="PEFC - Promoting Sustainable Forest Management"  title="PEFC - Promoting Sustainable Forest Management - PEFC/16-37-1352">
                                        </a>
                                    </li>
            						<li>
                                        <a href="#">
                                            <img src="<?php echo $baseURL ;?>/filestore/images/content/responsible-purchaser-logo.png"class="img-responsive" alt="Responsible Purchaser - Timber Trade Federation" title="Responsible Purchaser - Timber Trade Federation">
                                        </a>
                                    </li>
                                    
            						<li>
                                        <a href="#" target="_blank">
                                            <img src="<?php echo $baseURL ;?>/filestore/images/content/TTFederation.png" class="img-responsive" alt="Member of the Timber Trade Federation">
                                        </a>
                                    </li>
            					</ul>
            				</div>
            			</div>
            		</div>
            	</div>
                <div class="row imprint">
                    <div class="col-sm-6 ">
                        <p class="footerimprint">&copy; Copyright <?php echo $prefs["prefCopyrightStartYear"] . " - " . date('Y') . " " . getCompanyName($prefs) ; ?><br><a href='<?php echo $baseURL ;?>/privacy' target='_blank'>Privacy</a> | <a href='<?php echo $baseURL ;?>/site-policy' target='_blank'>T&Cs</a><br>...</p>
                    </div>
                    <div class="col-sm-6 footerimprint">
                        <p style="text-align: right">&nbsp;<br><a href='https://digita.agency' target='_blank'>website design, build and hosting by digita.agency</a></p>
                    </div>
                </div>
			<?php
                if ($prefs['prefShowFooterDebug'] == 'Yes') {
				    include("includes/footer-debug.php");
                }
			?>
            </div>
		</footer>


<!-- END footer.php -->
