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
