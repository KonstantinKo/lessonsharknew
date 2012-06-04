<?php ?>

<div class="main_container">
		<div class="main_container_top_profile">
		  <div class="main_container_top_logo"><a  href="/dev1">LessonShark</a></div>
		  <div class="new_edit_tex_help">Help/ My Account/<?php echo $html->link(__('Log Out', true), array( 'controller' => 'homes', 'action' => 'logout')); ?></div>
		  <div class="clr"></div>
		  <div class="new_edit_tex_helps">
            <a href="#">My Teacher Profile |</a>		
		    <a href="#"> Dashboard</a>		  
		  </div>
		</div>

<?php $tab='';$id=14; $tab= $_SESSION['tabname1'];  ?>
</div>

<!--teacher page start-->
<div class="teach_main" >		
	<div class="teach_pro_main">
		<div class="teach_pro_first_bar">
			<div class="teach_pro_first_bar_txt"></div>
		</div>
		<div class="teach_navigation">
			<ul>
				<li<?php if($tab=='learn') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('LEARN', true), array( 'controller' => 'teachers', 'action' => 'contentProfile',$id)); ?></li>

	<li<?php if($tab=='opening') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('OPENINGS', true), array( 'controller' => 'teachers', 'action' => 'contentOpening',$id)); ?></li>
								
					<li<?php if($tab=='media') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('MEDIA', true), array( 'controller' => 'teachers', 'action' => 'contentMedia',$id)); ?></li>				
				<li<?php if($tab=='experience') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('EXPERIENCE', true), array( 'controller' => 'teachers', 'action' => 'contentCredential',$id)); ?></li>	
			
				<li<?php if($tab=='policy') {?> class="new_navigation_active" <?php } ?> ><?php echo $html->link(__('POLICIES', true), array( 'controller' => 'teachers', 'action' => 'contentPolicy',$id)); ?></li>					
			</ul>
        	<div class="teach_pro_percent">
				<div class="teach_pro_percent_txt">Profile <span class="style1">0%</span> Complete</div>
			</div>
		</div>
	</div>
</div>
