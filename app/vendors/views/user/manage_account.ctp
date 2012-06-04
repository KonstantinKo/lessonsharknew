<?php
	echo $javascript->link('jquery/jquery');    
	echo $javascript->link('jquery/jquery.form'); 
	
?>
</div>
	
	<div class="main_containers_middle">
	<?php echo $this->element('front/dashSide');?>
		<div class="right_containre">
				  
		<?php echo $form->create('User',array('id'=>'postStoreForm','action'=>'manageAccount','name'=>'frmCreate','enctype'=>'multipart/form-data')); ?>
			<div class="login">Edit User Information</div>
				 <?php echo $form->input('id', array('label'=>'','class'=>'','type'=>'hidden','value'=>$loggedInUser['id']));?>
					<div class="sucessPrint">
					  <?php  echo $session->flash(); ?>
					</div>	
				<div style="float:left;margin-top:30px;">
 					
					
					<div class="inputTextClass">
						<?php echo $form->input('firstname', array('label'=>'First Name:','class'=>'text_box_register','value'=>$loggedInUser['firstname']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('lastname', array('label'=>'Last Name:','class'=>'text_box_register','value'=>$loggedInUser['lastname']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('email', array('label'=>'Email:','class'=>'text_box_register','value'=>$loggedInUser['email']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('country', array('label'=>'Country:','class'=>'text_box_register','value'=>$loggedInUser['country']));?>
					</div>	
					<div class="inputTextClass">
						<?php echo $form->input('state', array('label'=>'State:','class'=>'text_box_register','value'=>$loggedInUser['state']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('city', array('label'=>'City:','class'=>'text_box_register','value'=>$loggedInUser['city']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('address', array('label'=>'Address:','class'=>'text_box_register','value'=>$loggedInUser['address']));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('phone', array('label'=>'Phone:','class'=>'text_box_register','value'=>$loggedInUser['phone']));?>
					</div>
					
				
				</div>
			<div class="submit">
				<input value="Update" type="submit" id="registerSub" class="butons" >
			</div>
			  <?php echo $form->end();?>
	
