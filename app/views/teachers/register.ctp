<?php 
	//this is a test
?>
<div class="forem_part_first_main teacher_register register_form">
	<?php echo $form->create('User',array('url'=> array('controller' => 'teachers', 'action' => 'register'))); ?>
	   			
		<div class="headline"><h1>Teacher Registration</h1></div>
		<div class="clr"></div>
	
	<div class="input_form">
		<?php echo $form->input('User.firstname', array('label'=>'First name','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>	
		<?php //echo $form->error('User.firstname', 'boo', array());?>
		<div class="clr"></div>
	</div>
	
	<div class="input_form">
		<?php echo $form->input('User.lastname', array('label'=>'Last name','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>	
		<div class="clr"></div>	
	</div>
	
	<div class="input_form">
		<?php echo $form->input('User.email', array('label'=>'Email address','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
		<div class="clr"></div>
	</div>
	
	<div class="input_form">
		<?php echo $form->input('User.password', array('label'=>'Password','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
		<div class="clr"></div>
	</div>
	
	<div class="input_form">
		<?php echo $form->input('User.cpassword', array('type'=>'password','label'=>'Confirm password','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>	
		<div class="clr"></div>	
	</div>
	
	<div class="input_form">
		<?php echo $form->input('Profile.zip', array('label'=>'Zip code','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 5));?>		
		<div class="clr"></div>
	</div>
	
	<div class="terms">
		By clicking Done, you agree to our <a href="<?php echo $html->url(array('controller' => 'applications', 'action'=>'terms')); ?>">Terms of Use</a> and our <a href="<?php echo $html->url(array('controller' => 'applications', 'action'=>'privacy')); ?>">Privacy Policy</a>.
	</div>

	<div class="form_button_wrapper">
		<div class="center_button">
			<input type="submit" value="Done" class="submit_button">
		</div>
	</div>
	
 	<?php echo $form->end(); ?>
	</div>