<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width; initial-scale=1.0; minimum-scale=1.0; maximum-scale=1.0; user-scalable=1;"/>
<meta name="description" content="<?php echo $_SITE['desc'];?>"/>
<meta name="Generator" content="OpenCric"/>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title>
	<?php if (isset($pageTitle)) {
		echo htmlspecialchars($pageTitle);
	}
	else{
		echo htmlspecialchars($_SITE['name'].'-'.$_SITE['tagline']);
	}
	?>

</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_SITE['url'];?>/app-static/opencric.css?v=<?php echo time();?>">
<link rel="icon" type="image/x-favicon" href="<?php echo $_SITE['url'];?>/favicon.ico">
<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="header">
<a href="<?php echo $_SITE['url'];?>" title="Homepage">
<img src="<?php echo $_SITE['url'];?>/app-static/opencric-logo.png" alt="<?php echo $_SITE['name'];?>">
</a>
<a class="btn facebook_btn_right" href="<?php echo $_SITE['fb_url'];?>" rel="me">
	Like us
</a>
</div>