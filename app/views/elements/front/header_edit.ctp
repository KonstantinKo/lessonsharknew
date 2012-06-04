<?php ?>

<?php echo $javascript->link('jquery');?>
<?php echo $javascript->link('common');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>

<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>
<script>
//j = $.noConflict();
$('document').ready(function(){ 

	$("#loginDiv").fancybox({
			'showCloseButton'	: true,
			'autoDimensions':false,
			'width' : 310,
			'height' : 191,
            'padding' :0,
		});

});

	
</script>

<?php
	//we aren't logged in yet so show this header
	if($page == 'loggedOut')
	{
?>
	<!---main part start-->
	<div class="main_container">
		<div class="main_container_top main_container_extra" >
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
				<a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'login_fancy')); ?>" id="loginDiv">
				<?php echo $html->image('login_btn.png'); ?></a>
				</div>
		</div>
	                
	</div>
<?php
	}
?>

<?php
	//we are logged in now so show this header
	if($page == 'loggedIn')
	{
?>
	<!---main part start-->
	<div class="main_container">
		<div class="main_container_top main_container_extra">
			<div class="main_container_top_logo">
				<a class="headLinks" href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'index')); ?>">LessonShark</a></div>
				<div class="main_container_navi">
			</div>
			<div class="new_edit_tex_help">
				<div class="in_header_links">
					<?php echo $html->link(__('My Account', true), array( 'controller' => 'homes', 'action' => '')); ?>
					&nbsp;|&nbsp;
					<?php echo $html->link(__('Help', true), array( 'controller' => 'homes', 'action' => '')); ?>
					&nbsp;|&nbsp;
					<?php echo $html->link(__('Log Out', true), array( 'controller' => 'homes', 'action' => 'logout')); ?>
				</div>
				<div class="new_header_tabs">
			  		<a href="#">
			  			<div class="header_tabs">Dashboard</div>
			  		</a>
			  		<?php
			  			if($role == 'teacher')
			  			{
			  		?>		
			    			<a href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'contentProfile')); ?>">
			  					<div class="header_tabs">My Teacher Profile</div>
			  				</a>
			  		<?php
			  			}
			  		?>
			 	</div>
			</div>
			
		  	<div class="clr"></div>
		  	


		</div>
	                
	</div>
<?php
	}
?>


<div class="profile_container">
	<div class="profile_container_top profile_header">
		
		<div class="teach_navigation_edit">
			<ul class="teacher_header_list">
				
				<li<?php if($tab=='general') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('GENERAL', true), array( 'controller' => 'teachers', 'action' => 'editGeneral')); ?></li>
				<li <?php if($tab=='learn') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('LEARN', true), array( 'controller' => 'teachers', 'action' => 'editProfile')); ?></li>
				<li <?php if($tab=='media') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('MEDIA', true), array( 'controller' => 'teachers', 'action' => 'editMedia')); ?></li>
				<li <?php if($tab=='location') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('LOCATIONS', true), array( 'controller' => 'teachers', 'action' => 'editLocation')); ?></li>
				<li <?php if($tab=='availability') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('AVAILABILITY', true), array( 'controller' => 'events', 'action' => 'calendar')); ?></li>
				<li <?php if($tab=='credential') {?> class="new_navigation_active" <?php } ?>><?php echo $html->link(__('CREDENTIALS', true), array( 'controller' => 'teachers', 'action' => 'editCredential')); ?></li>
				<li <?php if($tab=='policy') {?> class="new_navigation_active" <?php } ?>><?php echo $html->link(__('POLICIES', true), array( 'controller' => 'teachers', 'action' => 'editPolicy')); ?></li>
				
			</ul>
		</div>
		
		<div class="clr"></div>
	
	
	</div>
</div>
