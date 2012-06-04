<div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div> 
<?php echo $javascript->link('jquery111');?>
<script>
	$('document').ready(function(){
		var count = 0;
	 $(function(){

	    $('#addmore').click(function(){
           if(count<8)
            {
	        count += 1;
	        
                 $('#container1').append('<div style="float: left; width: 146px;margin-bottom:5px;border-bottom: 1px dotted #468897;height: 32px;"><div class="new_edit_mintus_main_left"  ><input    id="TeacherDuration_' + count + '" name="data[TeacherDesciplineField][duration][]' + '" type="text" maxlength="3"  /></div><div class="new_edit_mintus_main_right">Minutes</div></div>' );

$('#container2').append(' <div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 304px;margin-bottom:5px;"><div class="new_accordian_main_bx"  ><input id="TeacherLocation_' + count + '" name="data[TeacherDesciplineField][location][]' + '" type="text" /></div></div>' );


 $('#container3').append('<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;"><div class="new_edit_mintus_main_right">$</div><div class="new_edit_mintus_main_lefts"><input id="TeacherRate_' + count + '" name="data[TeacherDesciplineField][rate][]' + '" type="text" maxlength="3" /></div></div>' );
$('#container4').append('<div style="float: left; border-bottom: 1px dotted #468897;height: 32px;width: 61px;margin-bottom:5px;"><div class="new_edit_right_delete_x" >x</div><div class="new_edit_right_delete">Delete</div></div>' );

           }
	    });
	});
	})
	
</script>


<div class="new_edit_back"></div>
		<div class="clr"></div>
<div class="new_edit_tex">Offerings</div>
		<div class="new_edit_tex_dumy">Use this area to manage the disciplines that you teach.Use the description to detail how you teach each discipline and what a student can<br>expect from these lesson.Once that done,add your lesson offerings for each discipline.<?php if($des){?><div style="margin-top:10px;font-weight:bold;"> You have already added These Offering Packages:</div><?php }?> <div><?php foreach($des as $des1){ pr($des1);}  ?></div></div>


<?php    echo $form->create('TeacherDesciplineField', array('url' => array('controller' => 'teachers', 'action' => 'profile',$id)));?>
			<div class="new_edit_select_main">
			<?php echo $form->select('dsid',$discpline,null, array('label'=>'false','div'=>''),'--Select Category--');?>
		
		   </div>
<div class="new_edit_lesson_package_main">
			<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Duration(min)</div>
				</div>
				
				<div class="new_edit_mintus_main" id="container1" >
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;"><div class="new_edit_mintus_main_left"  ><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][duration][]" type="text" maxlength="3" /></div><div class="new_edit_mintus_main_right">Minutes</div></div>
					
				</div>
				
				
			</div>  

<div class="new_edit_package_beet">
				<div class="new_edit_package_beet_inner">
				   <div class="new_edit_package_left_inner_text">Location(s)</div>
			        </div>
			        <div class="new_accordian_main" id="container2">
			         <div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 304px;margin-bottom:5px;"> 				        	<div class="new_accordian_main_bx"  >
 					<input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][location][]" type="text" />
				  </div></div>
			
				</div>
			
			<div class="new_accordian_main_btm_tx" >
	     <?php echo $form->button('+ Add another lesson package' , array('id'=>'addmore'));?></div>
			
			
</div>

<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Rate(USD/hr)</div>
				</div>
<div class="new_edit_mintus_main" id="container3">
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;"><div class="new_edit_mintus_main_right">$</div>
					<div class="new_edit_mintus_main_lefts"><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][rate][]" type="text" maxlength="3" /></div></div>
					
				</div>
				
				
				
					
				</div>

			
		
		
			</div>
<div class="new_edit_description">Description</div>
		<div class="new_edit_description_box"><div class="new_edit_description_box_two"><?php echo $form->textarea('description');?></div></div>
<div class="clr"></div>

	<div class="submit_image">	<input type="submit" value="Save">
 <?php echo $form->end(); ?>
</div>

		

	</div>



