
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

 
<title>Lessonshark</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- CSS Starts-->
	
	 <?php echo $html->css('default'); ?>
	<?php echo $html->css('pascal'); ?>			 			
 	<?php echo $html->css('orman'); ?>
	<?php echo $html->css('nivo-slider'); ?>
	<?php echo $html->css('style1'); ?>
	 <?php //echo $html->css('style'); ?>	
<!-- CSS Ends -->
</head>

<body>
	 <?php echo $this->element('front/header'); ?>
	<?php echo $this->element('front/header_one'); ?>
	 <?php  echo $content_for_layout; ?>
	 <?php echo $this->element('front/footer'); ?>

</body>
</html>
