<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		
		<title><?php echo $title ?></title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="<?php echo $meta_keywords ?>" />
		<meta name="description" content="<?php echo $meta_description ?>" />
		
		<?php echo
		html::style('media/css/screen.css', array('media' => 'screen')) ?>
		<?php foreach ($styles as $file => $type) echo html::style($file, array('media' => $type)), "\n" ?>
	 
		<script type="text/javascript">
			// Set page globals
			BASE_URL = '<?php echo url::site() ?>';
		</script>
		
		<?php echo
		html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js') ?>
		<?php foreach ($scripts as $file) echo html::script($file), "\n" ?>
		
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-10740449-1");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
		
	</head>
	<body>
		
		<div id="header">
			<div class="links">
				<a href="<?php echo url::site(Route::get('default')->uri())?>">Home</a> | 
				<a href="<?php echo url::site(Route::get('docs/guide')->uri())?>">User Guide</a> |
				<a href="http://github.com/azampagl/kohana-examples" target="_blank">The Code</a> |
				<a href="http://kohanaphp.com" target="_blank">Kohana PHP</a>
			</div>
		</div>
		
		<div id="content-header">
			<div class="title"><h1><?php echo $title ?></h1></div>
			<div class="loading"><div id="loading"></div></div>
		</div>	
		
		<div id="content">
			<?php echo $content ?>
		</div>
		
	</body>
</html>