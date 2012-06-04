<?php   foreach($billing as $bill)
	{	 
		$paypal=$bill['Billing']['paypalid']; 
		$amazon=$bill['Billing']['amazonid'];
		$hidd=$bill['Billing']['id'];
	} 
?>
<!--lesson middle start-->
<div class="teacher_edit_main">
<div class="teacher_edit_left">
<div class="teacher_edit_text">Teacher Edit Account</div>
<?php    echo $form->create('User', array('url' => array('controller' => 'teachers', 'action' => 'editTeacher')));?>

<?php foreach($teacher as $tech) 
{ 
?>
<div class="teacher_edit_text_name"> First Name</div>
<input id="User" name="data[User][firstname1]" class="teacher_edit_input" type="text"   value="<?php echo $tech['User']['firstname']?>"/>
<div class="teacher_edit_text_name"> Last Name</div>
<input id="User" name="data[User][lastname1]" class="teacher_edit_input" type="text"   value="<?php echo $tech['User']['lastname']?>"/>


<div class="teacher_edit_text_name">email Address</div>
<input id="User" name="data[User][hidd]" class="teacher_edit_input" type="hidden"   value="<?php echo $tech['User']['id']?>"/>
<input id="User" name="data[User][email]" class="teacher_edit_input" type="text"   value="<?php echo $tech['User']['email']?>"/>

<div class="teacher_edit_text_name">Password</div>
<input type="password" class="teacher_edit_input"  name="data[User][password]" value="<?php echo $tech['User']['password']?>" />

<div class="teacher_edit_text_name">Confirm Password</div>
<input type=" text" class="teacher_edit_input" name="data[User][cpassword]"  value="type password"/>

<div class="teacher_edit_text_name">Zip Code</div>
<input type=" text" class="teacher_edit_inputs"  name="data[User][zip]" value="<?php echo $tech['User']['zip']?>"/>

</div>
<div class="teacher_edit_right">
<div class="teacher_edit_text">Getting Paid</div>
<div class="teacher_radio_main">
<input type="radio" class="teacher_radio_left"/>
<div class="teacher_edit_texts">Recieve Payments with Paypal</div>
<input id="User" name="data[User][hidd1]" class="teacher_edit_input" type="hidden"   value="<?php echo $hidd;?>"/>
<input type=" text"   name="data[User][amazon]" value="<?php echo $bill['Billing']['amazonid'] ?>" class="teacher_edit_right_bx"/>

</div>
<input type="radio" class="teacher_radio_left"/>
<div class="teacher_edit_texts">Recieve Payments with Amazon Payments</div>
<input type=" text" name="data[User][paypal]" value="<?php echo $bill['Billing']['paypalid'] ?>" class="teacher_edit_right_bx"/>

<?php }?>
</div>

<div class="edit_main">
<div class="teacher_edit_right_bxs"><a href="#">Close Account<a></div>
<div class="edit_btn"><?php echo $html->image('back_button.png'); ?></div>
<div class="edit_btns"><input type="image" src="/dev1/img/save_acc.png" ></div>
<?php echo $form->end(); ?>
</div>			



</div>

