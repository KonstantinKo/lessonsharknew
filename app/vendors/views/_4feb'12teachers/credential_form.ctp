<?php ?>
<div class="clr"></div>
		<div class="new_edit_tex">Verify Degree</div>
<div class="credientail_important_text"><span class="credientail_important_text_sapn">Important:</span> To run a background check, your social security number must match the name associated with your account and
the name entered below.</div>	
 <?php echo $form->create('School', array('url' => array('controller' => 'teachers', 'action' => '',$id))); ?>
<div class="credientail_input_text">First Name</div><div class="credientail_input_texts">Last Name</div><div class="credientail_input_texts">Social Security Number</div>

<div class="credientail_input_main">
	<input type="text" name="data[School][firstname]" class="credientail_input_box"/>
	<input type="text" name="data[School][lastname]" class="credientail_input_box"/>
	<input type="text" name="data[School][ssn]" class="credientail_input_box"/>
	
	<?php  // echo $form->input('schoolname', array('type'=>'select', 'label'=>'','class'=>'credientail_input_boxs', 'options'=>$schools,'Choose a College or University')); ?>
	<!--<option></option> -->
		
</div>
<div class="credientail_radio_main">
	<div class="left">
		<div class="radio_main">
		<input type="radio"  class="radio"/>
		<div class="text">6 Months</div>
		</div>
		<div class="clr"></div>
	<div class="radio_main">
		<input type="radio" class="radio"/>
		<div class="text">1 Year</div>
		</div>
	</div>
	<div class="right">
		<div class="left_text">(School Name)Sur-Charge:&nbsp; &nbsp; &nbsp; &nbsp;$4.00</div>
		<div class="clr"></div>
		<div class="left_texts">(School Name)Sur-Charge:&nbsp; &nbsp; &nbsp; &nbsp;$4.00</div>
		<div class="clr"></div>
		<div class="left_texter">Total:&nbsp; &nbsp; &nbsp; &nbsp;$9.00</div>
		<div class="main_btn">
			<div class="verfify"><a href="" id="aad"><?php echo $html->image('verfify_btn.png'); ?></a></div>
			<div class="verfify"><a href="" id="gdsf"><?php echo $html->image('cancel_btn.png'); ?></a></div>
		</div>
	</div>
 <?php echo  $form->end(); ?>
	</div>
		<div class="clr"></div>
		<div class="clr"></div>
	</div>
