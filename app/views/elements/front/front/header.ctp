<?php ?>

<?php echo $javascript->link('jquery');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>

<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>
<script>
j = $.noConflict();
j('document').ready(function(){ 

	j("#loginDiv").fancybox({
			'showCloseButton'	: true,
			'autoDimensions':false,
			'width' : 310,
			'height' : 191,
            'padding' :0,
		});

});

	
</script>

<!---main part start-->
<div class="main_container">
	<div class="main_container_top" >
		<div class="main_container_top_logo">
			<a class="headLinks" href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'index')); ?>">LessonShark</a></div>
			<div class="main_container_navi">
			<ul>
			<li><a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'become_a_student')); ?>">Become a Student</a></li>
			<li><a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'tour')); ?>">Become a Teacher</a></li>
			<li><a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'aboutus')); ?>">About LessonShark</a></li>
			</ul>
		</div>
		<div class="main_container_navi_login_btn">
			<a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'login')); ?>" id="loginDiv">
			<?php echo $html->image('login_btn.png'); ?></a>
			</div>
	</div>
                
</div>

<?php ?>
<?php echo  $javascript->link('jquery-1.7.1.min'); ?>
<?php echo $javascript->link('jquery.nivo.slider.pack'); ?>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
	
	$('#zip').focus(function()
	 {
	 	if($(this).val() == 'Zip Code')
		{
			$(this).val('');
		}
		  
	});
	$('#zip').blur(function()
	 {
		if($(this).val() == 'Zip Code' || $(this).val() == '')
		{
			$(this).val('Zip Code');
		}
	});
	
	$('#instrument').focus(function()
	 {
	 	if($(this).val() == 'Instrument')
		{
			$(this).val('');
		}
		  
	});
	$('#instrument').blur(function()
	 {
		if($(this).val() == 'Instrument' || $(this).val() == '')
		{
			$(this).val('Instrument');
		}
	});
});
	
</script>


<div class="about_sky_top_input">
		<input type="text" value="Instrument" id="instrument" class="about_sky_top_input_box"/>
		<input type="text" value="Zip Code" id="zip" class="about_sky_top_input_boxs"/>
		<div class="about_sky_find_bt" ></div>
</div>
