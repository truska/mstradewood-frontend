<!-- START header.php -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($debug == "Yes") {
echo "<p>Logo file = " . $prefs['prefLogo'] . "</p>" ;
echo "<p>Logo Path = " . getLogo($prefs) . "</p>" ;
}
print_r($prefs);
?>
	<!--  H E A D E R   S E C T I O N A  -->
	<div class="top_header">
        <div class="container inner">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="logo">
                    	<a href="<?php echo $baseURL ;?>/welcome">
							
							<img src="<?php echo $baseURL . "/" . getLogo($prefs) ; ?>" title="<?php echo getCompanyName($prefs) ; ?>" alt="<?php echo getCompanyName($prefs) ; ?>" class="img-responsive logo"> 
						
                        	<!--<img src="<?php echo $baseURL ;?>/images/logo.jpg" alt="logo" title="manual logo"> -->           		
                    	</a>
                    </div>
                </div>
                <div class="col-md-9 col-xs-6">
                	<div class="row">
		                <div class="col-md-8 col-sm-12 ">
		                    <div class="logo_fabic text-center"> 
								<a href="<?php echo $baseURL ;?>/home1.html">
									<img src="<?php echo $baseURL ;?>/images/hd-icon-1.png" class="img-responsive" alt="Malone Fabics">
								</a>
								<a href="<?php echo $baseURL ;?>/welcome">
									<img src="<?php echo $baseURL ;?>/images/hd-icon-2.png"class="img-responsive" alt="Malone Fabics">
								</a>
								<a href="#">
									<img src="<?php echo $baseURL ;?>/images/hd-icon-3.png"class="img-responsive" alt="Malone Fabics">
								</a>
		                    </div>
		                </div>
		                <div class="col-md-4 col-sm-12 ">
		                    <div class="info_details">
		                        <ul class="text-right">
		                            <li><p><span>T:</span> 028 9046 0990</p></li>
									<li><p><span>E:</span> <a href="mailto:sales@mstimber.com">sales@mstimber.com</a></p></li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
	            </div>
            </div> <!--<End Row -->
        </div>
	</div>

<!-- ====================================================== -->

<?
$ShowStdCode = "No" ;
if ($ShowStdCode == "Yes")
{
?>

<header class="row header-area">
	<div class="col-md-8 col-sm-5 col-xs-12">
		<a href="<?php echo $homePageURL ; ?>">

			<img src="<?php echo $baseURL . "/" . getLogo($prefs) ; ?>" title="<?php echo getCompanyName($prefs) ; ?>" alt="<?php echo getCompanyName($prefs) ; ?>" class="img-responsive logo"> 
		<!--	<h1><?php echo getCompanyName($prefs) ; ?></h1> -->
		</a>	
	</div>

	<div class="col-md-4 col-sm-4 hidden-xs header-area-right">
		<?php 
		if (getTel1($prefs))
		{
			echo "<p id='reverseout'><span id='secondcol'><strong>T:</strong></span> " . getTel1($prefs) . "<br>" ;
		}
		if (getTel2($prefs))
		{
			echo "<span id='secondcol'><strong>M:</strong></span> " . getTel2($prefs) . "<br>" ;
		}
		if (getEmail($prefs))
		{
			echo "<span id='secondcol'><strong>E:</strong></span> <a href='mailto:" . getEmail($prefs) . "'>" . getEmail($prefs) . "</a></p>" ;
		}
		?>
	</div>
	
	<div class="col-xs-12 hidden-lg hidden-md hidden-sm header-area-right">
		<p id="reverseout">
		<?php
		if (getTel1($prefs))
		{
			echo "<span id='secondcol'>T:</span> " . getTel1($prefs) . "" ;
		}
		if (getTel1($prefs) AND getTel2($prefs))
		{
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;" ;
		}
		if (getTel2($prefs))
		{
			echo "<span id='secondcol'>M:</span> " . getTel2($prefs) . "" ;
		}

		?>
			
		</p>
		<p id="reverseout"><span id="secondcol">
			E:</span> <a href="mailto:<?php echo getEmail($prefs) ; ?>"><?php echo getEmail($prefs) ; ?></a>
		</p>
	</div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h2><?php echo $prefs['prefTagline'] ; ?></h2>
	</div>
	
	<?php
}
?>
</header>

<!-- END header.php -->