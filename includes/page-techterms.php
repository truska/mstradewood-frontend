<!-- START page-techterms.php -->
		<div class="container inner inner-page">
		<!-- Breadcrumb Trail -->
			<div class="liquid-nav">
				<ul>
					<li>
						<a href="<?php echo $baseURL ;?>/welcome">Home</a>
					</li>
					<li>
						<a href="#"><?php echo $rowpage["name"] ; ?></a>
					</li>
				</ul>
			</div>
            
            <div class="row">
<style>
    .techterms {
        padding-bottom:30px;
    }
</style>
<?php
// GET CONTENT
			
		$selecttechterms = "SELECT * FROM `techterms` WHERE  `showonweb` = 'Yes' ORDER BY `order` , `name` ";
		//echo "selecttechtermstechterms = " . $selectcontent . "<br>" ;
		$querytechterms = mysqli_query($conn,$selecttechterms);
		$numrowstechterms1 = mysqli_num_rows($querytechterms);
		//echo "rows = " .$numrows1 . "<br>";
            echo "<div class='col-lg-12 inner-contact'>" ;
                
                echo "<div class='col-lg-9 col-md-9 col-sm-12 col-xs-12 '>" ;
                echo "<div class='col-sm-12 col-sm-offset-2'>" ;
                    echo "<h1>" . $rowpage["name"] . "</h1>" ;
                echo "</div>" ;
                $backcol = "#F5F5F5" ;
                    while ($rowtechterms = mysqli_fetch_assoc($querytechterms) )
                    {
                        echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='background-color:" . $backcol . ";'>" ;
                            echo "<a name='" . $rowtechterms["name"] . "'>" ;
                            echo "<div class='col-lg-2 col-md-3 col-sm-3 col-xs-12'>" ;
                                echo "<p><strong>" . $rowtechterms["name"] . "</strong></p>" ;
                            echo "</div>" ;

                            echo "<div class='col-lg-10 col-md-10 col-sm-9 col-xs-12 techterms'>" ;
                                echo "" . $rowtechterms["text"] . "" ;
                            echo "</div>" ;
                            if ($backcol == '#F5F5F5') {$backcol = '#ffffff';} else {$backcol = '#F5F5F5';}
                        echo "</div>" ;
                        echo "<div class='clearfix'></div>" ;
                    }

                echo "</div>" ;

                
                
                echo "<div class='col-lg-2 col-md-2 hidden-sm hidden-xs'>" ;
                    include("includes/content-standard-sidebar.php");
                echo "</div>" ;
                
            echo "</div>" ;
?>
			</div>		
		</div>

<!-- END page-page-techterms.php -->