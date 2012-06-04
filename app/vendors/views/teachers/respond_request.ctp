<?php foreach($billing as $detail){ $id=$detail['TeacherStudentDetail']['id'];} ?>
<div class="teach_pro_right_part">
<!--enter info student pages start -->
<div class="book_lesson_info_twomain" >
	<div class="book_lesson_left" >
		<div class="enter_billings">Enter Billing Information</div>
		<div class="clr"></div>
		<div class="enter_billing_method">Billing Method</div>
		<div class="clr"></div>
		<div class="enter_paybal_main">
			<input type="radio" name="credit" class="enter_paybal_radio" id="paypal" />
			<div class="enter_paybal_text" >Paypal</div>
		</div>
		<div class="clr"></div>
		<div class="enter_paybal_main">
			<input type="radio" name="credit" class="enter_paybal_radio" id="credit"/>
			<div class="enter_paybal_text"  >Credit Card</div>
		</div>
	</div>	
	  <div class="book_lesson_right">

		<div class="billing_information_rights">
			<div class="billing_celender_inner_tx">DECEMBER</div>
			<div class="billing_celender_inner">
				<div class="enter_billing_iner_main">
					<div class="enter_billing_iner_main">
						<div class="iner_left">Lesson Date</div>
						<div class="iner_right">Tuition per Lesson</div>

					</div>

				
					<div class="enter_billing_iner_main">
						<div class="iner_lefts">12/15/2010</div>
						<div class="iner_rights">df</div>

					</div>
					
				

			</div>

		</div>
		<div class="enter_total">Total:$1</div>
		<div class="clr"></div>
		<div class="enter_total_two">Due Now:$2</div>

		<div class="billing_celender_inner_txer">JANUARY</div>
		<div class="billing_celender_inner">
			<div class="enter_billing_iner_main">
				<div class="enter_billing_iner_main">
					<div class="iner_left">Lesson Date</div>
					<div class="iner_right">Tuition per Lesson</div>

				</div>

			
					<div class="enter_billing_iner_main">
						<div class="iner_lefts">12/15/2010</div>
						<div class="iner_rights"></div>

					</div>
					
				

			</div>

		</div>
		<div class="enter_total">Total:$1</div>
		<div class="clr"></div>
		<div class="enter_total_two">Due Now:$2</div>
	</div>

	<div class="btn_main">
		<div class="enter_check_box">
			<input type="checkbox" class="enter_check"/>
			<div class="enter_check_text">I agree to the<span class="enter_check_text_sapn"> terms of use</span> </div>
		</div>


		<div class="enter_check_boxs">
			<input type="checkbox" class="enter_check"/>
			<div class="enter_check_text">I authorize automatic tuition payment for either<br>4 or 5 lesson on the 1st day
			</div>
		</div>
		<div class="enter_main_btn">
			<div class="enter_main_left"><?php echo $html->image('back_to_profile.png'); $value='accept'; $value1='reject'; ?></div>
			<div class="enter_main_lefts"><input type="image" src="/lessonshark1/img/authorised_payment.png" ></div>
			<div class="enter_quton_img"><?php echo $html->link(__('Accept', true), array( 'controller' => 'teachers', 'action' => 'acceptReject',$id,$value)); ?><?php echo $html->image('dark_img.png'); ?>
<?php echo $html->link(__('Reject', true), array( 'controller' => 'teachers', 'action' => 'acceptReject',$id,$value1)); ?><?php echo $html->image('dark_img.png'); ?>
</div>
		</div>
	</div>

    </div>



	</div>

	





</div>
</div>
</div>
</div>




