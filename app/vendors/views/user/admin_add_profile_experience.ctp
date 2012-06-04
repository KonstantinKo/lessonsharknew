 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
		<div> 
		<a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-	decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile
		</div>
<fieldset>
	 <legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Experience</legend>

    <div id="showUserAdd">
  
	    <?php    echo $form->create('TeacherExperience', array('url' => array('controller' => 'users', 'action' => 'addProfileExperience',$id,'admin'=>true)));?>
	<ul>
	<li>
	
 	
	<li>
		<div style="width:203px;float:left" >Experience</div>
		<div style="width:300px; float:left;">
			    <?php    echo $this->Form->textarea('experience');     ?>

		</div>
	</li>
	      
	   <li/>
	  <li>
	 

	  </li>
	 <?php echo $form->submit('+ Add'); ?>
	 
  </li>
   
</ul>
<?php echo $form->end(); ?>
</div>

</fieldset>




</div>
