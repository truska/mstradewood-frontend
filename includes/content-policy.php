<!-- START content-policy.php -->
<!--Middle section-->
<?php

//Set up Content Pages Data 
$selectcontent = "SELECT * FROM `content` WHERE `page` = '" . $rowpage["id"] . "' AND `showonweb` = 'Yes' ORDER BY `sort` ";
$querycontent = mysqli_query($conn, $selectcontent );
?>

<section class="policy-content textsection">
  <div class="container">
    <div class="editContainer">

    <div class="row Middle-section">
      <div class="col-xs-12 policy-content">
    <!--    <h2 class="heading2Size">Privacy Policy</h2> -->
        <p class="ptextSize">In this document the following references apply:</p>
			<p>Where reference is made to "business or site owner, we or us" we are referring to <?php echo getCompanyName($prefs) ; ?> <br>
			Our registered address is: <?php echo getAddressLong($prefs) ; ?> <br>
			
			Our Telephone number is: <?php echo getTel1($prefs) ; ?> <br>
			<?php
				if ($prefs['prefCompanyNo']) {
					echo "Our Company Number is: " . $prefs['prefCompanyNo'] . "<br>" ;
				}
				if ($prefs['prefVATNo']) {
					echo "Our VAT Number is: " . $prefs['prefVATNo'] . "<br>" ;
				}
				if ($prefs['prefPolicyDate']) {
					echo "This policy is effective from: " . $prefs['prefPolicyDate'] . "<br>" ;
				}
			?>
		  </p>

      </div>
    </div> 
		
		
	  <?php
	  while ($rowcontent = mysqli_fetch_assoc( $querycontent ) )
	  {
    	echo "<div class='row Middle-section'>" ;
			echo "<div class='col-xs-10 policy-content'>" ;
				if ($rowcontent["showheading"] == 'Yes') {
					echo "<h2 class='heading2Size'>" . $rowcontent["heading"] . "</h2>" ;
				}
				echo "<p class='ptextSize'>" . $rowcontent["text"] . "</p>" ;
			echo "</div>" ;
    	echo "</div>  " ;
	  }
	  ?>
		

		

		
		
		
  </div>
  </div>
</section>
<!-- END ccontent-policy.php -->
