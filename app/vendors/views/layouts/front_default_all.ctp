
<!DOCTYPE html>

   
<html>
<head>

 <title><?php echo $title_for_layout ?></title>
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
	<div id="wrap">
			<?php echo $this->element('front/header'); ?>
	  		<div id="main">

				<?php echo $this->element('front/header_one'); ?>
		
				<?php  echo $content_for_layout; ?>
	
	 		</div>
	
			<div id="footer">
		
	 			<?php echo $this->element('front/footer'); ?>
	
			</div>
			<div class="home_lesson_middle_part_img" style="float:left; margin-top:-435px;"></div>
	</div>
</body>
</html>
