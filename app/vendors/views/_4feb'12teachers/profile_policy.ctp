 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
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

<div class="new_edit_back"></div>
		<div class="clr"></div>
			<div class="clr"></div>
			<div class="location_middle_main">
			<!--polcies pages start-->
			
          
	    <?php    echo $form->create('TeacherPolicy', array('url' => array('controller' => 'teachers', 'action' => 'profilePolicy',$id)));?>
  		
		

<div class="polcies_caceller_text_main">
				<div class="polcies_caceller_sky_img"><?php echo $html->image('spaeker.png'); ?></div>
				<div class="polcies_caceller_black_text">Cancellations and Holidays</div>
				<div class="clr"></div>
				<div class="polcies_caceller_parhgraf">Include all necessary information regarding both Student and Teacher cancellations here. 
				It,s helpful to this <br>section as a contract,as you and your students  will be refering back it when
				a cancellection or holidays aries in<br> the schedule.This policy will be displayed to students upon sign up</div>
					
				<textarea id="TeacherPolicy" name="data[TeacherPolicy][makeuplesson]" rows="2" class="polcies_caceller_box_gry"  ></textarea>
				</div>
		
			<div class="polcies_caceller_text_main">
				<div class="polcies_caceller_sky_img"><?php echo $html->image('dark_blue.png'); ?></div>
				<div class="polcies_caceller_black_text">Cancellations and Holidays</div>
				<div class="clr"></div>
				<div class="polcies_caceller_parhgraf">Include all necessary information regarding both Student and Teacher cancellations here. 
				It,s helpful to this <br>section as a contract,as you and your students  will be refering back it when
				a cancellection or holidays aries in<br> the schedule.This policy will be displayed to students upon sign up</div>
				
				<textarea id="TeacherPolicy" name="data[TeacherPolicy][cancelation]" rows="2" class="polcies_caceller_box_gry"></textarea>
				
				</div>




		<input id="TeacherPolicy" name="data[TeacherPolicy][title][]" class="polcies_caceller_box_polciy" type="text"  value="Policy Title" />
		
				<textarea id="TeacherPolicy" name="data[TeacherPolicy][details][]" rows="2"  class="polcies_caceller_box_gry" ></textarea>
				
				</div>
				<div class="clr"></div>
					

<div class="submit_image">	<input type="submit" value="Save"></div>
		<div class="clr"></div>
		
	
	<div class="clr"></div>
	</div>




		
         
          
    <?php echo $form->end(); ?>
     
