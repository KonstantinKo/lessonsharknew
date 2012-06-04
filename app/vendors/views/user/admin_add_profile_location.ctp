 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){
	     $('#homestudio').change(function() 
                {
		       var homevalue = $("#homestudio").val();
		       if(homevalue=='home')
		       {
			 $('#studio1').hide();	  		
			 $('#home1').show();
		       }
                      else if(homevalue=='studio')
		       {
                         $('#home1').hide();
	  		 $('#studio1').show();
		       }
		      else
			{ 
			 $('#home1').hide();
			 $('#studio1').hide();
			}	        
		       
               });   
	 })
	
</script>



<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;">
  <?php echo $html->image("sliderDot.gif"); ?>
</div>
<div class="topBar">
	<div> 
		<a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-  decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile
       </div>
<fieldset>
<legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Locations</legend>

<div id="showUserAdd">
  
   <?php    echo $form->create('TeacherMedias', array('url' => array('controller' => 'users', 'action' => 'addProfileLocation',$id,'admin'=>true)));?><div><ul style="height: 15px;margin-bottom: 10px;width: 611px;"><li style="float:left;width:70px;">Learn</li><li style="float:left;width:70px;">Media</li><li style="float:left;width:70px;color:#2B6DA4;">Locations</li><li style="float:left;width:90px;">Availability</li><li style="float:left;width:90px;">Experience</li><li style="float:left;width:90px;">Policy</li></ul> </div>
<ul>
  
<li>
<li>
	<div style="width:203px;float:left" >Opening</div> 
	<div style="width:300px; float:left;">
		<select id="homestudio" name="data[TeacherLocation][type]">
			<option value="" selected="selected">Select type</option><option value="home" >home</option>
		    	<option value="studio">studio</option> 
		</select>
	</div>
</li>     

	

<div id="home1">
	<li>
		<div style="width:203px;float:left" >	Zip	</div>
		<div style="width:300px; float:left;">
		  <input id="TeacherLocationZip" name="data[TeacherLocation][zip]" type="text" />
		</div>
		</li>
		<li>
		<div style="width:203px;float:left" >Radius</div>
	       <div style="width:300px; float:left;">
	       <input id="TeacherLocatonRadius" name="data[TeacherLocation][radius]" type="text" /></div>
	</li>

</div>

<div id="studio1">
	<li>
	<div style="width:203px;float:left" >Address1</div>
	<div style="width:300px; float:left;">
	<input id="TeacherLocationAddress1" name="data[TeacherLocation][address1]" type="text" />
	</div>
	</li>

	<li>
	<div style="width:203px;float:left" >Address2</div>
	<div style="width:300px; float:left;">
	<input id="TeacherLocatonAddress2" name="data[TeacherLocation][address2]" type="text" />
	</div>
	</li>

	<li>
	<div style="width:203px;float:left" >City</div>
	<div style="width:300px; float:left;">
	<input id="TeacherLocatonCity1" name="data[TeacherLocation][city]" type="text" /></div>
	</li>
	<li>
 	<div style="width:203px;float:left" >State</div>
        <div style="width:300px; float:left;">
	<input id="TeacherLocatonState" name="data[TeacherLocation][state]" type="text" />
        </div>
	</li>
	<li>
	<div style="width:203px;float:left" >Zip</div>
	<div style="width:300px; float:left;">
	<input id="TeacherLocatonZip" name="data[TeacherLocation][zip]" type="text" />
	</div>
	</li>
   </div>
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
