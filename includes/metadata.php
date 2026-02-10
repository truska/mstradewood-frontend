<!-- START metadata.php -->    
    
    <?php
		if ($rowpage["titletag"])
		{
			$titletag = $rowpage["titletag"] . "</title>" ;
		}
		else
		{
			if ($rowpage["name"])
					{
						$titletag = $rowpage["name"] . "</title>" ;
					}
					else
					{
						$titletag = $prefs['prefDefaultPageTitle'] . "</title>" ;
					}
		}
	if($segs[0] == 'product' OR $segs[0] == 'doors') {
		// Get product name
			// GET PRODUCT
			$selectproductmeta = "SELECT `id`,`name`,`section` FROM `products` WHERE `id` = " . $segs[1]  . " AND `showonweb` = 'Yes' " ;
			$queryproductmeta = mysqli_query($conn,$selectproductmeta);
			$rowproductmeta = mysqli_fetch_assoc($queryproductmeta) ;
		
			// GET PRODUCT
			$selectsectionmeta = "SELECT `name` FROM `sections` WHERE `id` = " . $rowproductmeta["section"]  . " AND `showonweb` = 'Yes' " ;
			$querysectionmeta = mysqli_query($conn,$selectsectionmeta);
			$rowsectionmeta = mysqli_fetch_assoc($querysectionmeta) ;
		
		$titletag = $rowproductmeta["name"] . " " . $rowsectionmeta["name"] . " | ".getSiteName($prefs)." | Belfast | Dublin " ;
	
	}






		echo "<title>" . $titletag . "</title>" ;

		if ($rowpage["metadescription"])
		{
			echo "<meta name='description' content='" . $rowpage["metadescription"] . "'>" ;
		}
		else
		{
			echo "<meta name='description' content='" . $prefs['prefDefaultMetaDescription'] . "'>" ;
		}


		if ($rowpage["metakeywords"])
		{
			echo "<meta name='keywords' content='" . $rowpage["metakeywords"] . "'>" ;
		}
		else
		{
			echo "<meta name='keywords' content='" . $prefs['prefDefaultMetaKeywords'] . "'>" ;
		}
?>

	<!-- Meta Tags -->
    <meta name="language" content="en-uk" />
    <meta name="robots" content="ALL">
    <meta name="revisit-after" content="30">
    <meta name="author" content="<?php echo getCompanyName($prefs) ; ?>">
    <meta name="copyright" content="<?php echo getCompanyName($prefs) ; ?>">
    <meta name="document-rights" content="Copyrighted Work">
    <meta name="document-rating" content="Safe for Kids">
    <meta name="document-type" content="Public">
    <meta name="document-class" content="Completed">
    <meta name="document-distribution" content="Global">

<?php
	if ($prefs['prefSiteSearchOn'] == 'No') {
    	echo "<meta name='googlebot' content='noindex'>" ;
	}
	else
	{
		if ($rowpage["pagesearch"] == 'No') {
			echo "<meta name='googlebot' content='noindex'>" ;
		}
		else
		{
			echo "<meta name='googlebot' content='index,follow,snippet,archive'>" ;
		}
	}
?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- END metadata.php -->    
