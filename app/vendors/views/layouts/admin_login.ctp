<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title_for_layout; ?> - <?php __('Lessonshark'); ?></title>
    <?php
        echo $html->css(array('meta-admin-login',));
        echo $scripts_for_layout;
    ?>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start header<![endif]-->
		<div id="header"> 
			<div class="inner"> 
				<h1 id="logo"><a href="#">Meta Admin v1 Clever Adminstration Panel</a></h1>
			</div>
		</div>
		<!--[if !IE]>end header<![endif]-->
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			
    <?php
        echo $content_for_layout;
    ?>
			
		</div>
		<!--[if !IE]>end content<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
