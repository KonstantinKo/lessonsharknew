<?php

echo $javascript->link('jquery/jquery'); 

echo $javascript->link('jquery/jquery.form'); 

?>
<style> .error-message{ float:left;height:auto;margin-left:123px;color:red;}</style>
<div class="forem_part_first_main">
	<?php echo $form->create('User',array('url'=>'/teachers/')); ?>
	   			
		<div class="form_part_teacher_text">Teacher Registration</div>
		<div class="clr"></div>
	
	<div style="height:auto;">		 	
		<div class="forem_part_first_name">First Name</div>
		<?php echo $form->input('firstname', array('label'=>'','class'=>'forem_part_first_inputs','div'=>''));?>	
	</div>
	<div style="height:auto;">		
		<div class="forem_part_first_name">Last Name</div>
		<?php echo $form->input('lastname', array('label'=>'','class'=>'forem_part_first_inputs','div'=>''));?>	
	</div>
		<div class="forem_part_first_name">Email Address</div>
		<?php echo $form->input('email', array('label'=>'','class'=>'forem_part_first_inputs','div'=>''));?>	
		<div class="forem_part_first_name">Password</div>
		<?php echo $form->input('password', array('label'=>'','class'=>'forem_part_first_inputs','div'=>''));?>	
		<div class="forem_part_first_name">Confirm Password</div>
		<?php echo $form->input('cpassword', array('label'=>'','class'=>'forem_part_first_inputs','div'=>'','type'=>'password'));?>	
		
		
		<div class="forem_part_first_name">Zip Code</div>
		<br>
		<br>
		<br>
		<?php echo $form->input('zip', array('label'=>'','class'=>'forem_part_first_inputs','div'=>''));?>
		
		<div class="forem_part_done_btn"><span class="Email_addressyr"> <input type="submit" value="Done"></span></div>
	
 	<?php echo $form->end(); ?>
	</div>



