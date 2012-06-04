 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
<div> <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile</div>
<fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Media </legend>

<div id="showUserAdd">
  
    <?php    echo $form->create('TeacherMedias', array('url' => array('controller' => 'teachers', 'action' => 'profileMedia',$id)));?><div><ul style="height: 15px;margin-bottom: 10px;width: 611px;"><li style="float:left;width:70px;">Learn</li><li style="float:left;width:70px;color:#2B6DA4;">Media</li><li style="float:left;width:70px;">Locations</li><li style="float:left;width:90px;">Availability</li><li style="float:left;width:90px;">Experience</li><li style="float:left;width:90px;">Policy</li></ul> </div>
<ul>
  
 <li>

	

	<li><div style="width:203px;float:left" >Label</div><div style="width:300px; float:left;"><input id="TeacherMediaLabel" name="data[TeacherMedia][label]" type="text" /></div></li>
	<li><div style="width:203px;float:left" >Url</div><div style="width:300px; float:left;"><input id="TeacherMediaUrl" name="data[TeacherMedia][url]" type="text" /></div></li>
   
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
