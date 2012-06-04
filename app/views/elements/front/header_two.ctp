<?php ?>
<!--creates gradient side bars-->
<div class="main_edit_profile">
<style>
    .main_container
	{
	height:auto;
	margin:auto;

	}
</style>
<?php echo  $javascript->link('jquery-1.7.1.min'); ?>
<?php echo $javascript->link('jquery.nivo.slider.pack'); ?>
<script type="text/javascript">
    $(window).load(function() {
       
	$('#zip').click(function()
	 {
		$('#zip').val('');  
	});
	$('#instrument').click(function()
	 {
		$('#instrument').val('');  
	});
    });
    
       
    
	
	
    </script>
<!---main part start-->
<div class="main_container">
		<div class="main_container_top">
		<div class="main_container_top_logo"><a href="/dev1">LessonShark</a></div>
		<div class="new_edit_tex_help">Help/ My Account/<?php echo $html->link(__('Log Out', true), array( 'controller' => 'homes', 'action' => 'logout')); ?></div>
		<div class="clr"></div>
		<div class="new_edit_tex_helps">
          <a href="#">My Teacher Profile |</a>		
		  <a href="#"> Dashboard</a>		  
		  </div>
		</div>
		<!--navi part end-->
		<!--registre part end-->
	<div class="clr"></div>
</div>

 <div class="new_edit_main">
		<div class="new_edit_tex">Edit Profile</div>
		
<?php $tab= $_SESSION['tabname']; 
$id=2;
if($tab=='learn')
	{
		$learn='';$learn1='';
	}
else if($tab=='media')
	{
		$learn1='class="new_navigation_active"';
		$learn='';
	}
	
	else
	{
		$learn='class=""';
	}
?>
		<div class="new_navigation">
		<ul>
		<li<?php if($tab=='general') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('GENERAL', true), array( 'controller' => 'teachers', 'action' => 'editGeneral')); ?></li>
		<li <?php if($tab=='learn') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('LEARN', true), array( 'controller' => 'teachers', 'action' => 'editProfile')); ?></li>
		<li <?php if($tab=='media') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('MEDIA', true), array( 'controller' => 'teachers', 'action' => 'editMedia')); ?></li>
		<li <?php if($tab=='location') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('LOCATIONS', true), array( 'controller' => 'teachers', 'action' => 'editLocation')); ?></li>
		<li <?php if($tab=='availability') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('AVAILABILITY', true), array( 'controller' => 'events', 'action' => 'calendar')); ?></li>
		<li <?php if($tab=='credential') {?> class="new_navigation_active" <?php } ?>><?php echo $html->link(__('CREDENTIALS', true), array( 'controller' => 'teachers', 'action' => 'editCredential')); ?></li>
		<li <?php if($tab=='policy') {?> class="new_navigation_active" <?php } ?>><?php echo $html->link(__('POLICIES', true), array( 'controller' => 'teachers', 'action' => 'editPolicy')); ?></li>
		</ul>
		</div>
