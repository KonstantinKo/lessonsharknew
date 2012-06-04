<?php
	echo $javascript->link('jquery/jquery');    
	echo $javascript->link('jquery/jquery.form'); 
?>
	  

<div class="gry_main"><div class="top_bor"></div>
			<?php echo $this->element('front/topheader');?>
 </div>

</div>
	
	<div class="middle_container">
		<div class="container_left">
		<div class="sucessPrint">
		  <?php  echo $session->flash(); ?>
		</div>			  
		<?php echo $form->create('User',array('id'=>'postStoreForm','action'=>'signUp','name'=>'frmCreate','enctype'=>'multipart/form-data')); ?>
			<div class="login">Contact Us</div>
				<div style="float:left;margin-top:30px;">
 					<div  class="inputTextClass">
						 <?php echo $form->input('username', array('label'=>'User Name:','class'=>'text_box_register'));?>
						 
					</div>
					<div  class="inputTextClass">
						 <?php echo $form->input('password', array('label'=>'Password:','class'=>'text_box_register'));?>
						 
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('firstname', array('label'=>'First Name:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('lastname', array('label'=>'Last Name:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('email', array('label'=>'Email:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('country', array('label'=>'Country:','class'=>'text_box_register'));?>
					</div>	
					<div class="inputTextClass">
						<?php echo $form->input('state', array('label'=>'State:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('city', array('label'=>'City:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('address', array('label'=>'Address:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('phone', array('label'=>'Phone:','class'=>'text_box_register'));?>
					</div>
					
				
				</div>
			<div class="submit">
				<input value="Register" type="submit" id="registerSub" >
			</div>
			  <?php echo $form->end();?>
	
