<?php 
	//
?>
<div class="forem_part_first_main teacher_register register_form">
	<?php echo $form->create('User',array('url'=> array('controller' => 'homes', 'action' => 'reset', $key))); ?>
	   			
		<div class="headline"><h1>Reset Your Password</h1></div>
		<div class="clr"></div>
		
	<?php
		if($show == 'start')
		{
	?>
			<div class="input_form">
				Enter a new password and confirm it below.
			</div>
			
			<div class="input_form">
				<?php echo $form->input('password', array('label'=>'Password','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
				<div class="clr"></div>
			</div>
			
			<div class="input_form">
				<?php echo $form->input('cpassword', array('type'=>'password','label'=>'Confirm password','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>	
				<div class="clr"></div>	
			</div>
		
			<div class="form_button_wrapper">
				<div class="center_button">
					<input type="submit" value="Submit" class="submit_button">
				</div>
			</div>
			
		 	<?php echo $form->end(); ?>
			</div>
		
			
	<?php
		}
		else if($show == 'finish')
		{
	?>
	
			<div class="input_form">
				Your password has been successfully reset. Use the above login link or go
				<a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'login')); ?>">here</a> to login.
			</div>
			
	
	<?php
		}
	?>
	
			