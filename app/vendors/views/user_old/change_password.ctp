<?php
	echo $javascript->link('jquery/jquery');    
	echo $javascript->link('jquery/jquery.form'); 
?>
<style>
.inputTextClass label {
    float: left;
    width: 150px;
}
.butons
{
	width:180px;
}
</style>	  



</div>
	
	<div class="main_containers_middle">
	<?php echo $this->element('front/dashSide');?>
		<div class="right_containre">
		<div class="sucessPrint">
		  <?php  echo $session->flash(); ?>
		</div>			  
		<?php echo $form->create('User',array('id'=>'postStoreForm','action'=>'changePassword','name'=>'frmCreate')); ?>
			<?php echo $form->input('id', array('label'=>'','class'=>'','type'=>'hidden','value'=>$loggedInUser['id']));?>
			<div class="login">Change Password</div>
				<div style="float:left;margin-top:30px;">
					<div  class="inputTextClass">
						<?php echo $form->input('oldpassword', array('label'=>'Old Password:','class'=>'text_box_register','type'=>'password'));?>
						 
					</div>

 					<div  class="inputTextClass">
						 <?php echo $form->input('password', array('label'=>'New Password:','class'=>'text_box_register'));?>
						 
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('repassword', array('label'=>'Confirm Password:','class'=>'text_box_register','type'=>'password'));?>
					</div>
					
				</div>
			<div class="submit">
				<input value="Change Password" type="submit" id="registerSub" class="butons" >
			</div>
			  <?php echo $form->end();?>
	

