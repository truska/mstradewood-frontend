<!-- START google.php -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150302054-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-150302054-1');
</script>


<?php
// Set so this will not kick in and hard ceded tracking info used
if ($prefs['prefGoogleAnalyticsOn'] == 'N/A') // Yes
{
	if ($prefs['prefGoogleAnalyticsCode'] )
	{
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $prefs['prefGoogleAnalyticsCode'] ; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $prefs['prefGoogleAnalyticsCode'] ; ?>">');
</script>
<?php
	}
}
?>

<!-- END google.php -->