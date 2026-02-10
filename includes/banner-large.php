<!-- START banner-large.php -->


		<div class="banner">
			<div class="desktop">	
				<div id="home-banner-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<img src="<?php echo $baseURL ;?>/filestore/images/banners/banner-home-1.jpg" alt="Home banner 1">
							<div class="carousel-caption container inner"></div>
						</div>
						<div class="carousel-item">
							<img src="<?php echo $baseURL ;?>/filestore/images/banners/banner-home-2.jpg" alt="Home banner 2">
							<div class="carousel-caption container inner"></div>
						</div>
						<div class="carousel-item">
							<img src="<?php echo $baseURL ;?>/filestore/images/banners/banner-home-3.jpg" alt="Home banner 3">
							<div class="carousel-caption container inner"></div>
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#home-banner-carousel" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#home-banner-carousel" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
        
        
        
        
		<div class="mobile">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                
  <?php
        // GET Sections for mobile home page 
	   $selectsection = "SELECT * FROM `menu` WHERE `submenu1` = '0' AND `showonhomemobile` = 'Yes' ORDER BY `menu`, `submenu` " ;
		$querysection = mysqli_query($conn,$selectsection);
		if (!($querysection instanceof mysqli_result)) {
			$querysection = null;
		}

        $counter = 1 ;        
		while ($querysection && ($rowsection = mysqli_fetch_assoc($querysection)) ) {

               
            echo "<div class='panel panel-default'>" ;
                echo "<div class='panel-heading' role='tab' id='heading". $counter . "'>" ;
                echo "<a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse". $counter . "' aria-expanded='true' aria-controls='collapse". $counter . "'>
                         " . $rowsection["title"] . "<span class='caret'></span></a>" ;
                echo "</div>" ;
                echo "<div id='collapse". $counter . "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading". $counter . "'>" ;
                    echo "<div class='panel-body'>" ;
                        echo "<ul>" ;

                        // GET Sections for mobile home page 
                       $selectproduct = "SELECT * FROM `menu` WHERE `menu` = " . $rowsection["menu"] . " AND `submenu` = " . $rowsection["submenu"] . " AND `submenu1` > '0' AND `showonweb` = 'Yes' ORDER BY `submenu1` " ;
                            $queryproduct = mysqli_query($conn,$selectproduct);
                            if (!($queryproduct instanceof mysqli_result)) {
                                $queryproduct = null;
                            }

                        while ($queryproduct && ($rowproduct = mysqli_fetch_assoc($queryproduct)) ) {
                            
                            // GET Page Slug 
                           $selectpageslug = "SELECT `slug` FROM `pages` WHERE `id` = " . $rowproduct["page"] . " " ;
                                $querypageslug = mysqli_query($conn,$selectpageslug);
                            	$rowpageslug = ($querypageslug instanceof mysqli_result)
                                    ? (mysqli_fetch_assoc($querypageslug) ?: [])
                                    : [];
                            
                            // GET Product Slug 
                           $selectproductslug = "SELECT `slug` FROM `products` WHERE `id` = " . $rowproduct["product"] . " " ;
                                $queryproductslug = mysqli_query($conn,$selectproductslug);
                            	$rowproductslug = ($queryproductslug instanceof mysqli_result)
                                    ? (mysqli_fetch_assoc($queryproductslug) ?: [])
                                    : [];
            
                            $pageSlug = $rowpageslug["slug"] ?? '';
                            $productSlug = $rowproductslug["slug"] ?? '';
                            echo "<li><a href='" . $baseURL . "/" . $pageSlug . "/" . $rowproduct["product"] . "/" . $productSlug . "'>" . $rowproduct["title"] . "</a></li>" ;
                        }
            
                        echo "</ul>" ;
                    echo "</div>" ;
                echo "</div>" ;
            echo "</div>" ;
            $counter ++ ;
        }
  ?>              
                
                
                
                
                
 <!-- ---------------------------------- -->               

                
 <!-- ---------------------------------- -->               
                
                
			</div>
		</div>
	</div> 


<!-- END banner-large.php -->
