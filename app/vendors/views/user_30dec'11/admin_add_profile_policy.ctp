 
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){
		var count = 0;
	 $(function(){
         
	    $('#addpolicy').click(function(){
	if(count<2)
          {	      
	  count += 1;
	        
                 $('#container').append('<div style="width:203px;float:left;" >Title' + count + '</div>'+ '<div style="width:300px; float:left;"><input style="border-bottom: 3px solid gray;width:400px;"  id="TeacherTitle_' + count + '" name="data[TeacherPolicy][title][]' + '" type="text" /></div>' );


		 $('#container').append('<div style="width:203px;float:left">Details' + count + '</div>'+ '<div style="width:300px; float:left;"><textarea    id="TeacherDetails_' + count + '" name="data[TeacherPolicy][details][]' + '" rows="2" style="border-bottom: 3px solid gray!important;" ></textarea></div>' );

   	    }
	    });
             
	});
	})
	
</script>

<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
  <div> <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile</div>
  <fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Policy </legend>
      
      <div id="showUserAdd">
          
	    <?php    echo $form->create('TeacherPolicy', array('url' => array('controller' => 'users', 'action' => 'addProfilePolicy',$id,'admin'=>true)));?>
        <ul>
        
          
          <li>
  		
		<li style="margin-top:20px;"><div style="width:203px;float:left" >Title</div><div style="width:300px; float:left;"><input id="TeacherPolicy" name="data[TeacherPolicy][title][]" style="width:400px;" type="text" /></div></li>
		<li><div style="width:203px;float:left" >Details</div><div style="width:300px; float:left;"><textarea id="TeacherPolicy" name="data[TeacherPolicy][details][]" rows="2" ></textarea></div></li>
         
                
         <div id="container">
             
         </div>
         <div id="container1">
	     <span><?php echo $form->button('addmore' , array('id'=>'addpolicy'));?></span>
	   </div>
           <li/>
          <li><div style="width:203px;float:left" >Make Up Lessons</div><div style="width:300px; float:left;"><?php    echo $this->Form->textarea('makeuplesson');     ?></div></li>
               <li><div style="width:203px;float:left" >Cancellations and Holidays</div><div style="width:300px; float:left;"><?php    echo $this->Form->textarea('cancelation');     ?></div></li>
            <li>
         
        
          <?php 
                //$options=array('admin'=>'Administrator','coder'=>'User');
                //echo $form->select('role',$options, null, null, false );
                ?>       
          </li>
         <?php echo $form->submit('+ Add'); ?>
         
          </li>
           
        </ul>
    <?php echo $form->end(); ?>
      </div>
     
  </fieldset>
</div>
