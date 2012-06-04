
<?php echo $javascript->link('jquery');?>
<?php $paymentval=1000; ?>
<script>
	$('document').ready(function(){

		 var homevalue = $(":checked").val()
		$('#credit').attr('checked', true);
	     		 $('#paypal1').hide();

		$("#paypal").click(function() 
		{

			 $('#credit1').hide();	  		
			 $('#paypal1').show();


		});
		$("#credit").click(function() 
		{

			 $('#paypal1').hide();
	  		 $('#credit1').show();


		});




	 })


</script>

<?php  
		$hidd='temp';
		$cardfname=''; 
		$cardlname='';
		$billingaddress=''; 
		$city='';
		$state=''; 
		$zip='';
		$cardtype=''; 
		$cardnumber='';
		$paypal='';
 foreach($billing as $bill)
	{	
		//pr($bill);die; 
		$cardfname=$bill['Billing']['cardfname']; 
		$cardlname=$bill['Billing']['cardlname'];
		$billingaddress=$bill['Billing']['billingaddress']; 
		$city=$bill['Billing']['city'];
		$state=$bill['Billing']['state']; 
		$zip=$bill['Billing']['zip'];
		$cardtype=$bill['Billing']['cardtype']; 
		$cardnumber=$bill['Billing']['cardnumber'];
		$ccv=$bill['Billing']['ccv'];
		$hidd=$bill['Billing']['id'];
	} 
?>
<!--lesson middle start-->
<div class="teacher_edit_main">
    <div class="teacher_edit_left">
        <div class="teacher_edit_text">Teacher Edit Account</div>
        <?php    echo $form->create('User', array('url' => array('controller' => 'students', 'action' => 'editStudent')));?>

        <?php foreach($teacher as $tech) 
        { 
        ?>

        <div class="teacher_edit_text_name"> Fast Name</div>
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
        <div class="teacher_edit_text">Edit Billing Information</div>
        <div class="teacher_radio_main">
            <input type="radio" class="teacher_radio_left"  name="credit" id="credit" />
            <div class="teacher_edit_texts" style="margin-left:10px;">Use Debit/Credit Card</div>

        </div>

        <div id="credit1">
            <div class="teacher_edit_text_name2">First Name on Card</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][cardfname]"  value="<?php echo $cardfname; ?>" />
            <div class="teacher_edit_text_name2">Last Name on Card</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][cardlname]" value="<?php echo $cardlname; ?>" />
	     <input id="User" name="data[User][hidd1]" class="teacher_edit_input" type="hidden"   value="<?php echo $hidd; ?>"/>	
            <div class="teacher_edit_text_name2">Billing Address</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][billingaddress]"  value="<?php echo $billingaddress; ?>"/>
            <div style="color: #003068;float: left;height:46px;font-family: 'MyriadPro-Regular';font-size: 14px;margin-left: 33px;margin-top: 8px;width: 365px;" >
                <div style="float:left;width:163px;">City</div><div style="float:left;width:91px;">State</div><div style="float:left;width:92px;">Zip</div>
                <input style="float:left;width:152px;  border: 1px solid #B2B2B2;height: 23px;" type="text" name="data[User][city]" value="<?php echo $city; ?>"><input type="text" style="float:left;width:75px;margin-left:10px;border: 1px solid #B2B2B2;height: 23px;" name="data[User][state]" value="<?php echo $state; ?>"><input type="text"
                                                                                                                                                                                                                                                                               name="data[User][zip1]" style="margin-left:10px;float:left;width:88px;border: 1px solid #B2B2B2;height: 23px;" value="<?php echo $zip ;?>">
            </div>
            <div class="teacher_edit_text_name2">Card Type:</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][cardtype]" value="<?php echo $cardtype; ?>" />

            <div class="teacher_edit_text_name2">Card Number</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][cardnumber]" value="<?php echo $cardnumber; ?>" />
            <div class="teacher_edit_text_name2">CCV</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][ccv]" value="<?php echo $ccv; ?>" />

        </div>
        <div class="teacher_radio_main">
            <input type="radio" class="teacher_radio_left" name="credit" id="paypal"/>
            <div class="teacher_edit_texts" style="margin-left:10px;">Use Paypal Account</div>

        </div>
        <div id="paypal1">
            <div class="teacher_edit_text_name2">Paypal Address:</div>
            <input type="text" class="teacher_edit_input2"  name="data[User][paypal]"  value="<?php echo $paypal; ?>" />
        </div>
        <?php }?>
    </div>

    <div class="edit_main">
        <div class="teacher_edit_right_bxs"><a href="#">Close Account<a></div>
                    <div class="edit_btn"><?php echo $html->image('back_button.png'); ?></div>
                    <div class="edit_btns"><input type="image" src="/dev1/img/save_acc.png"  ></div>
                    <?php echo $form->end(); ?>
                    </div>			



                    </div>

