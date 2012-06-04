<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LessonShark Teacher Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></meta>

<!-- CSS Starts-->
    <?php echo $html->css('style1'); ?>

<!-- CSS Ends -->
<!--Calling on the Tooltip JS-->
<script type="text/javascript" src="http://media1.juggledesign.com/portfolio/js/jquery.js"></script>
</head>

<body>


	<!--end IF-->
	<!--Setting the main wrap for the layout-->
	<div id="wrap">
		
		<div id="main2">
	  <?php echo $this->element('front/header_profile'); ?>
		
	  <?php echo $content_for_layout; ?>
        </div>
		<div id="footer">
	  <?php echo $this->element('front/footer'); ?>
	    </div>
    </div>
    <script src="/dev1/js/jquery.simpletip-1.3.1.js" type="text/javascript" ></script>
<script type="text/javascript">
     $(document).ready(function() {
  $(".alex_example a").simpletip({fixed: true});
     });
</script>


</body>
</html>
