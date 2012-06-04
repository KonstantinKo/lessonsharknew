<?php 
	//
?>
<div class="forem_part_first_main teacher_register register_form">
	<?php echo $form->create('User',array('url'=> array('controller' => 'homes', 'action' => 'forgot'))); ?>
	   			
		<div class="headline"><h1>Forgot Your Password</h1></div>
		<div class="clr"></div>
		
	<?php
		if($show == 'start')
		{
	?>
		
			<div class="input_form">
				Enter your login email below. An email will be sent to you with a link to reset your password.
			</div>
			
			<div class="input_form">
				<?php echo $form->input('email', array('label'=>'Email address','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
				
				<?php
					if(!empty($errors))
					{
				?>			
						
						<div class="error-message">Email address is invalid.</div>
						
				<?php
					}
				?>
				
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
				An email will be sent to you shortly. To reset your password, click on the reset password link in 
				your email.
			</div>
			
			<div class="input_form">
				Note, sometimes the email gets sent to your spam or junk mail folder, so you should also check there if it doesn't appear.
			</div>
			
			<div class="input_form">
				TESTING ONLY<br/>
				This is only for testing purposes and will be removed. The following link will need to be sent in an email.<br/>
				<a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'reset', $key)); ?>">Reset password link</a>
			</div>
			
	
	<?php
		}
	?>
	
			