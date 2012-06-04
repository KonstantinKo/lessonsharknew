<div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div> 
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){
		var count = 0;
	 $(function(){

	    $('#addmore').click(function(){
           if(count<2)
            {
	        count += 1;
	        
                 $('#container').append('<div style="width:500px;"><i>' + count + ' Group</i></div><div style="width:203px;float:left" >Location' + count + '</div>'+ '<div style="width:300px; float:left;"><input style="border-bottom: 3px solid gray;" id="TeacherLocation_' + count + '" name="data[TeacherDesciplineField][location][]' + '" type="text" /></div>' );

$('#container').append('<div style="width:203px;float:left;" >Rate' + count + '</div>'+ '<div style="width:300px; float:left;"><input style="border-bottom: 3px solid gray;" id="TeacherRate_' + count + '" name="data[TeacherDesciplineField][rate][]' + '" type="text" /></div>' );


 $('#container').append('<div style="width:203px;float:left">Duration' + count + '</div>'+ '<div style="width:300px; float:left;"><input    id="TeacherDuration_' + count + '" name="data[TeacherDesciplineField][duration][]' + '" type="text" style="border-bottom: 3px solid gray;" /></div>' );

           }
	    });
	});
	})
	
</script>

<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
  <div> <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile</div>
  <fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Learn </legend>
      
      <div id="showUserAdd">
          
	    <?php    echo $form->create('TeacherDesciplineField', array('url' => array('controller' => 'users', 'action' => 'addProfile',$id,'admin'=>true)));?><div><ul style="height: 15px;margin-bottom: 10px;width: 611px;"><li style="float:left;width:70px;color:#2B6DA4;">Learn</li><li style="float:left;width:70px;">Media</li><li style="float:left;width:70px;">Locations</li><li style="float:left;width:90px;">Availability</li><li style="float:left;width:90px;">Experience</li><li style="float:left;width:90px;">Policy</li></ul> </div>

<?php if($flag==1){?>  <div> Fill This Form To Add Another Discipline or <a href="/dev1/admin/users/addProfileMedia/<?php echo $id;?>"> Click Here</a> To Go To Next Step  </div> <?php } ?>
        <ul>
          <li><label style="padding-right:138px;">Discipline</label> <?php echo $form->select('dsid',$discpline,null, array('label'=>'false','div'=>''),'--Select Category--');?></li>     

          
          <li>

		
		<li><div style="width:203px;float:left" >Location</div><div style="width:300px; float:left;"><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][location][]" type="text" /></div></li>
		<li><div style="width:203px;float:left" >Rate</div><div style="width:300px; float:left;"><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][rate][]" type="text" /></div></li>
		<li style="width:513px;"><div style="width:203px;float:left" >Duration</div><div style="width:300px; float:left;"><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][duration][]" type="text" /></div></li>
		
         
            
         <div id="container">
             
         </div>
         <div id="container1">
	     <span><?php echo $form->button('add another offering' , array('id'=>'addmore'));?></span>
	   </div>
           <li/>
	  <li style="width:518px;"><div style="width:203px;float:left" >Description</div><div style="width:300px; float:left;"><?php echo $form->textarea('description');?></div></li>
           
          <li>
         
        
          <?php 
                //$options=array('admin'=>'Administrator','coder'=>'User');
                //echo $form->select('role',$options, null, null, false );
                ?>       
          </li>
       <li style="float:left;height:30px;width:100px;color:#000000;"></li>
        <li>
         <?php echo $form->submit('+ Add'); ?>
         </li>
          </li>
           
        </ul>
    <?php echo $form->end(); ?>
      </div>
     
  </fieldset>
</div>
