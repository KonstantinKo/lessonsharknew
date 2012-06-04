<?php 
	//this is a test
?>

<script type="text/javascript">
    
	$('#loginDiv').hide();
	
</script>

<div class="forem_part_first_main teacher_register register_form">
	<?php echo $form->create('User', array('url' => array('controller' => 'homes', 'action' => 'login'))); ?>
	   			
		<div class="headline"><h1>Login</h1></div>
		<div class="clr"></div>
		
		<?php
			if(!empty($errors))
			{
				echo '<div class="error-message login_message">'.$errors.'</div>';
			}
		?>
	
	
	
	<div class="input_form">
		<?php echo $form->input('email', array('label'=>'Email address','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
		<div class="clr"></div>
	</div>
	
	<div class="input_form">
		<?php echo $form->input('password', array('label'=>'Password','class'=>'forem_part_first_inputs','div'=>'','maxlength' => 45));?>		
		<div class="clr"></div>
	</div>
	
	<div class="input_form">
		<a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'forgot')); ?>">Forgot Your Password?</a>
	</div>
	
	
	<div class="form_button_wrapper">
		<div class="center_button">
			<input type="submit" value="Login" class="submit_button">
		</div>
	</div>
	
 	<?php echo $form->end(); ?>
	</div>




