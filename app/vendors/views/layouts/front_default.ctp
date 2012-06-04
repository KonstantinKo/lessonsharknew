<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>LessonShark</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!-- CSS Starts-->
    <?php echo $html->css('style1'); ?>
 
<!-- CSS Ends -->
</head>

<body>
	<div id="wrap">
	  <?php echo $this->element('front/header'); ?>
		<div id="main">
	  <?php echo $content_for_layout; ?>
		</div>
		<div id="footer">
	  <?php echo $this->element('front/footer'); ?>
	    </div>
    </div>
</body>
</html>











