 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){
		var count = 0;
	 $(function(){
         
	    $('#addpolicy').click(function(){
		 count=$('#cntPolicy').val();
	if(count<2)
          {	      
	  count += 1;
	        
                 $('#container').append('<input   id="TeacherTitle_' + count + '" name="data[TeacherPolicy][title][]' + '" type="text" class="polcies_caceller_box_polciy" value="Policy Title" /><input type="hidden" value="temp" name="data[TeacherPolicy][hidd][]"  >' );


		 $('#container').append('<textarea    id="TeacherDetails_' + count + '" name="data[TeacherPolicy][details][]' + '" rows="2" class="polcies_caceller_box_gry"  >Policy Details</textarea></div>' );

   	    }
	    });
             
	});
	})
	
</script>

<div class="new_edit_back"></div>
		<div class="clr"></div>
		<div style="margin-bottom:10px" class="new_edit_tex">Policies</div>
			<div class="clr"></div>
			<div class="location_middle_main">
			<!--polcies pages start-->
			
          
	    <?php  $make='';$cancel=''; foreach($teacherpolicy as $policy)
			{ 
						$make=$policy['TeacherPolicy']['makeuplesson'];
						 $cancel=$policy['TeacherPolicy']['cancelation'];
			}
		
	 echo $form->create('TeacherPolicy', array('url' => array('controller' => 'teachers', 'action' => 'editPolicy',$id)));?>
  		
		

<div class="polcies_caceller_text_main">
				<div class="polcies_caceller_sky_img"><?php echo $html->image('spaeker.png'); ?></div>
				<div class="polcies_caceller_black_text">Cancellations and Holidays</div>
				<div class="clr"></div>
				<div class="polcies_caceller_parhgraf">Include all necessary information regarding both Student and Teacher cancellations here. It's helpful to think of this section as a contract, as you and your students will be referring back to it when a cancellation or holiday arises in the schedule. This policy will be displayed to students upon sign up. </div>
					
				<textarea id="TeacherPolicy" name="data[TeacherPolicy][makeuplesson]" rows="2" class="polcies_caceller_box_gry" style="margin-left:57px;" ><?php echo $make; ?></textarea>
				</div>
		
			<div class="polcies_caceller_text_main">
				<div class="polcies_caceller_sky_img" style="margin-top:21px">
				 <?php echo $html->image('dark_blue.png'); ?></div>
				<div class="polcies_caceller_black_text" style="margin-top:28px">Make-Up Lessons</div>
				<div class="clr"></div>
				<div class="polcies_caceller_parhgraf"style="margin-top:-10px">When a cancellation arises, a great way to keep the student learning and keep your income steady is to offer make-ups. Make-ups can get out of hand however, and can allow students to become complacent about their weekly schedule. Again, this section is best approcahed as a contract, as it will be referred to time and time again by you and your students. </div>
				
				<textarea id="TeacherPolicy" name="data[TeacherPolicy][cancelation]" rows="2" class="polcies_caceller_box_gry" style="margin-left:57px;" ><?php if($cancel!="") {echo $cancel; }?></textarea>
				
				</div>



   <?php 
  $totalPolicy = count($teacherpolicy);
?>
<input type="hidden" id="cntPolicy" value="<?php echo $totalPolicy;?>"> 	
<?php
  
  foreach($teacherpolicy as $policy)
	   { 
		
	  ?>
		<input id="TeacherPolicy" name="data[TeacherPolicy][title][]" class="polcies_caceller_box_polciy" type="text"  value="<?php echo $policy['TeacherPolicy']['title']	;?> "/>
		<input type="hidden" id="TeacherPolicy" value="<?php echo $policy['TeacherPolicy']['id'];?>" name="data[TeacherPolicy][hidd][]">
		<textarea id="TeacherPolicy" name="data[TeacherPolicy][details][]" rows="2"  class="polcies_caceller_box_gry" ><?php echo $policy['TeacherPolicy']['details']	; ?></textarea>
   <?php  } ?>	
				
		 <div id="container">
             
                 </div>
         
				</div>
    <div class="clr"></div>
	<div class="polcies_caceller_blue_btn">
		<div class="polcies_caceller_box_add">
			<span id="addpolicy">+ Add Another Policy Section </span>	
	    </div>
	</div>
<div class="submit_image">	<input type="submit" value="Save"></div>
 <?php echo $form->end(); ?>
		<div class="clr"></div>
		
	
	<div class="clr"></div>
	</div>




		
        
          
   
     
