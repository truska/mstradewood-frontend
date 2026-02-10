<!-- START content-standard-by-rows.php () --> 
<?php
// GET CONTENT

$selectcontent = "SELECT * FROM `content` WHERE `id` = '" . $contentid  . "' AND `showonweb` = 'Yes' ORDER BY `order` " ;
				//	echo $selectcontent . "<br>";
					$querycontent = mysqli_query($conn,$selectcontent);
				//	$num_rows_content = mysqli_num_rows($querycontent);
				//	$count = 1 ;
				//	echo "Number of records = " . $num_rows_content . "<br>";
				//	$rowcontent = mysqli_fetch_assoc($querycontent) ;

?>

            	 <!-- L E F T  S I D E B A R   S E C T I O N -->

				
				<!-- C E N T E R  C I N T A C  T  S E C T I O N -->
				<?php

                        while ($rowcontent = mysqli_fetch_assoc($querycontent) ){

                            if ($rowcontent["showheading"] == 'Yes') {
                                echo "<div class='row'>" ;
                                    echo "<div class='col-sm-12 col-sm-offset-3'>" ;
                                        echo "<div class='inner-contact'>" ;
                                            echo "<h1>" . $rowcontent["heading"] . "</h1>" ;
                                        echo "</div>" ;
                                    echo "</div>" ;
                                echo "</div>" ;
                            }

                      //          echo "<div class='row row-wrp'>" ;
                                ?>
<style>
    .leftsidebar img {
         max-width:80%;
        padding-bottom:40px;
        padding-top:10px;
    }
</style>

                                <?php
                                    echo "<div class='col-sm-3 text-center'>" ;
                                        echo "<div class='leftsidebar'>" ;
                                            echo "" . $rowcontent["text2"] . "</p>" ;
                                            echo "<img src='" . $baseURL . "/filestore/images/content/" . $rowcontent["image"] . "'>" ;
                                        echo "</div>" ;
                                    echo "</div>" ;
                            
                                    echo "<div class='col-sm-9'>" ;
                                        echo "<div class='inner-contact'>" ;
                                            echo "" . $rowcontent["text"] . "</p>" ;
                                            //echo "<a href='https://www.pefc.org/'>https://www.pefc.org/</a>" ;
                                        echo "</div>" ;
                                    echo "</div>" ;
                            
                                echo "<div class='clearfix' style='padding-bottom:50px'></div>" ;
                        }

			//	echo "<div class='col-sm-9'>" ;
				?>

<!-- END content-standard-by-rows.php -->