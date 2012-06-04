 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<?php

       echo $html->css('ui/jquery.ui.all');
       echo $html->css('ui/demos');

       echo $javascript->link('jquery');
       echo $javascript->link('jquery/jquery.form');
       echo $javascript->link('ui/jquery.ui.core');
       echo $javascript->link('ui/jquery.ui.core');
       echo $javascript->link('ui/jquery.ui.widget');
       echo $javascript->link('ui/jquery.ui.datepicker');

       

?>
<script>
     
       $(function() {
               $( "#dateExited" ).datepicker();
		 $( "#dateExited1" ).datepicker();
       });
</script>
<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
		<div> 
		<a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-	decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile
		</div>
<fieldset>
	 <legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Availability </legend>

    <div id="showUserAdd">
  
	    <?php    echo $form->create('TeacherAvailability', array('url' => array('controller' => 'users', 'action' => 'addProfileAvailability',$id,'admin'=>true)));?><div><ul style="height: 15px;margin-bottom: 10px;width: 611px;"><li style="float:left;width:70px;">Learn</li><li style="float:left;width:70px;">Media</li><li style="float:left;width:70px;">Locations</li><li style="float:left;width:90px;color:#2B6DA4;">Availability</li><li style="float:left;width:90px;">Experience</li><li style="float:left;width:90px;">Policy</li></ul> </div>
	<ul>
	<li>
	<li>
	<div style="width:203px;float:left" >Location</div>
	<div style="width:300px; float:left;"><?php echo $form->select('location',$location,null, array('label'=>'false','div'=>''),'Select Location');?></div>
	</li>


	<li>
		<div style="width:203px;float:left" >Day Of Week</div><div style="width:300px; float:left;">
			<select id="dayofweek" name="data[TeacherAvailability][dayofweek]">
				<option value="0" selected="selected">Select Day</option>
				<option value="sunday" >Sunday</option>
				<option value="monday">Monday</option>
				<option value="monday">Tuesday</option>
				 <option value="monday">Wednesday</option>
				<option value="thursday">Thursday</option>
				<option value="friday">Friday</option>
				<option value="saturday">Saturday</option>	 
			</select>
		</div>
	</li>
 	<li>
		<div style="width:203px;float:left" >Start Time</div>
		<div style="width:300px; float:left;">
			<input id="dateExited1" value="date" style=" width:120px;" name="data[TeacherAvailability][startdate]" type="text" /><input id="time" type="text" style=" width:120px;"  value="time" name="data[TeacherAvailability][starttime]" />
	       </div>
	</li>
	
	<li>
		<div style="width:203px;float:left" >End Time</div>
		<div style="width:300px; float:left;">
			<input id="dateExited" style=" width:120px;"  value="date" name="data[TeacherAvailability][enddate]" type="text" /><input style=" width:120px;" id="time1" name="data[TeacherAvailability][endtime]"  value="time" type="text" />
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
