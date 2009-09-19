<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		
		<title><?php echo $title ?></title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords" content="<?php echo $meta_keywords ?>" />
		<meta name="description" content="<?php echo $meta_description ?>" />
		
		<?php echo
		html::style('media/css/screen.css', array('media' => 'screen')) ?>
		<?php echo $stylesheets ?>	
	 
		<script type="text/javascript">
			// Set page globals
			var BASE_URL = '<?php echo url::site() ?>';
		</script>
		
		<?php echo
		html::script('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js') ?>
		<?php echo $javascripts ?>
		
	</head>
	<body>
		
		<div id="header">
			<div class="links">
				<a href="<?php echo url::site(Route::get('default')->uri())?>">Home</a> | 
				<a href="<?php echo url::site(Route::get('docs/guide')->uri())?>">User Guide</a> |
				<a href="http://github.com/azampagl/kohana-examples" target="_blank">The Code</a>
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