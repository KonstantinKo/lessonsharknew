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
<?php $time = array('01:00 AM'=>'01:00 AM','02:00 AM'=>'02:00 AM','03:00 AM'=>'03:00 AM','04:00 AM'=>'04:00 AM','05:00 AM'=>'05:00 AM','06:00 AM'=>'06:00 AM','07:00 AM'=>'07:00 AM','08:00 AM'=>'08:00 AM','09:00 AM'=>'09:00 AM','10:00 AM'=>'10:00 AM','11:00 AM'=>'11:00 AM','12:00 AM'=>'12:00 AM','01:00 PM'=>'01:00 PM','02:00 PM'=>'02:00 PM','03:00 PM'=>'03:00 PM','04:00 PM'=>'04:00 PM','05:00 PM'=>'05:00 PM','06:00 PM'=>'06:00 PM','07:00 PM'=>'07:00 PM','08:00 PM'=>'08:00 PM','09:00 PM'=>'09:00 PM','10:00 PM'=>'10:00 PM','11:00 PM'=>'11:00 PM','12:00 PM'=>'12:00 PM');  ?>  
	   
 <?php    echo $form->create('TeacherAvailability', array('url' => array('controller' => 'teachers', 'action' => 'profileAvailability',$id)));?><div><ul style="height: 15px;margin-bottom: 10px;width: 611px;"><li style="float:left;width:70px;">Learn</li><li style="float:left;width:70px;">Media</li><li style="float:left;width:70px;">Locations</li><li style="float:left;width:90px;color:#2B6DA4;">Availability</li><li style="float:left;width:90px;">Experience</li><li style="float:left;width:90px;">Policy</li></ul> </div>
	<ul>
	<li>
	<li>
	<div style="width:203px;float:left" >Location</div>
	<div style="width:300px; float:left;"><?php echo $form->select('location',$location,null, array('label'=>'false','div'=>''),'Select Location');?></div>
	</li>


	<li>
		<div style="width:203px;float:left" >Day Of Week</div><div style="width:300px; float:left;">
			<select id="dayofweek" name="data[TeacherAvailability][dayofweek]">
				<option value="" selected="selected">Select Day</option>
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
			<input id="dateExited1"  style=" width:120px;" name="data[TeacherAvailability][startdate]" type="text"  value="date"/><?php  echo $form->select('starttime',$time,null, array('label'=>'','div'=>'','class'=>'middle_second_inner_text_space_boxes'),'[Time]');?>
	       </div>
	</li>
	
	<li>
		<div style="width:203px;float:left" >End Time</div>
		<div style="width:300px; float:left;">
			<input id="dateExited" style=" width:120px;"  value="date" name="data[TeacherAvailability][enddate]" type="text" /><?php  echo $form->select('endtime',$time,null, array('label'=>'','div'=>'','class'=>'middle_second_inner_text_space_boxes'),'[Time]');?>
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
