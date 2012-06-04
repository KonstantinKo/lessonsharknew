
<?php echo $javascript->link('jquery');?>
<?php $paymentval=1000; ?>
<script>
	$('document').ready(function(){

		 var homevalue = $(":checked").val()
		$('#credit').attr('checked', true);
	     		 $('#paypal1').hide();
		  if(homevalue=='guardian')
		       {
			 $('#adult').hide();	  		
			 $('#parent').show();
		       }
                      else if(homevalue=='student')
		       {
                         $('#parent').hide();
	  		 $('#adult').show();
		       }
		      else
			{ 
			 $('#parent').hide();
	  		 $('#adult').show();
			 
			}	      

	     

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

<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>
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
	<div id="credit1">
	<div class="book_lesson_left"  >
		
		<div class="book_lesson_card_text">Card Type</div>
		<select class="book_lesson_select">
		<option>Visa</option>
		<option>Visa</option>
		<option>Visa</option>
		<option>Visa</option>
		</select>
		<div class="book_lesson_card_texts">First Name on card</div>
		<input type="text" class="book_lesson_input"/>
	
		<div class="book_lesson_card_texts">Last Name on card</div>
		<input type="text" class="book_lesson_input"/>

		<div class="book_lesson_card_texts">Card Number</div>
		<input type="text" class="book_lesson_input"/>
	
		<div class="book_lesson_card_texts">Expiration Date</div>

		<div class="select_main">
			<select class="select_main_lft">
			<option>01</option>
			<option>01</option>
			<option>01</option>
			</select>
			<select class="select_main_lft">
			<option>2011</option>
			<option>2011</option>
			<option>2011</option>
			</select>
		</div>
		<div class="book_lesson_card_texts">CCV(Security Code)</div>
			<input type="text" class="book_lesson_input"/>

			<div class="book_lesson_card_texts">Billing Street Address</div>
			<input type="text" class="book_lesson_input"/>


			<div class="book_lesson_card_texts"></div>
			<input type="text" class="book_lesson_input"/>

			<div class="book_lesson_card_texts">City</div>
			<input type="text" class="book_lesson_input"/>

			<div class="book_lesson_card_texts">State</div>
			<input type="text" class="book_lesson_input"/>

			<div class="book_lesson_card_texts">Zip Code</div>
			<input type="text" class="book_lesson_input"/>

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
				<?php  foreach($discipline as $package)
				{?>
					<div class="enter_billing_iner_main">
						<div class="iner_lefts">12/15/2010</div>
						<div class="iner_rights"><?php  echo '$'.$package['TeacherDesciplineField']['rate'];  ?></div>

					</div>
					<div class="enter_billing_iner_main">
						<div class="iner_lefts">12/15/2010</div>
						<div class="iner_rights"><?php  echo '$'.$package['TeacherDesciplineField']['rate'];  ?></div>

					</div>

				<?php  } ?> 
				
			</div>

		</div>
		<div class="enter_total">Total:$67.00</div>
		<div class="clr"></div>
		<div class="enter_total_two">Due Now:$67.00</div>

		<div class="billing_celender_inner_txer">JANUARY</div>
		<div class="billing_celender_inner">
			<div class="enter_billing_iner_main">
				<div class="enter_billing_iner_main">
					<div class="iner_left">Lesson Date</div>
					<div class="iner_right">Tuition per Lesson</div>

				</div>

				<div class="enter_billing_iner_main">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>

				</div>

				<div class="enter_billing_iner_mains">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>

				</div>

			</div>

		</div>
		<div class="enter_total">Total:$67.00</div>
		<div class="clr"></div>
		<div class="enter_total_two">Due Now:$67.00</div>
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
			<div class="enter_main_left"><?php echo $html->image('back_to_profile.png'); ?></div>
			<div class="enter_main_lefts"><input type="image" src="/lessonshark1/img/authorised_payment.png" ></div>
			<div class="enter_quton_img"><?php echo $html->image('dark_img.png'); ?></div>
		</div>
	</div>

    </div>



	</div>

	
<div id="paypal1">
<div class="billing_information_main"  >
		
		<div class="enter_paybal_texter">Paypal Address</div>
		<div class="clr"></div>
		<input type="text" class="enter_billing_input"/>
		<div class="enter_check_box">
			<input type="checkbox" class="enter_check"/>
			<div class="enter_check_text">I agree to the<span class="enter_check_text_sapn"> terms of use</span> </div>
			</div>


			<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick-subscriptions">
				<input type="hidden" name="business" value="ashu_s_1326719184_biz@yahoo.com">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="no_shipping" value="1">
				
				<input type="hidden" name="a3" value="<?php echo $paymentval; ?>">
				<input type="hidden" name="p3" value="1">
				<input type="hidden" name="t3" value="D">
				<input type="hidden" name="src" value="1">
				<input type="hidden" name="sra" value="1">
		
											
		
		<div class="enter_check_boxs">
			<input type="checkbox" class="enter_check"/>
			<div class="enter_check_text">I authorize automatic tuition payment for either<br>
			4 or 5 lesson on the 1st day
		</div>
			</div>
			<div class="enter_main_btn">
				<div class="enter_main_left"><?php echo $html->image('back_to_profile.png'); ?></div>
				<div class="enter_main_lefts"><input type="image" src="/dev1/img/authorised_payment.png" ></div>
				<div class="enter_quton_img"><?php echo $html->image('c_img_03.png'); ?></div>
			</div>
		</form>		
		
		</div>
		<div class="billing_information_right">
			<div class="billing_celender_inner_tx">DECEMBER</div>
		<div class="billing_celender_inner">
			<div class="enter_billing_iner_main">
				<div class="enter_billing_iner_main">
					<div class="iner_left">Lesson Date</div>
					<div class="iner_right">Tuition per Lesson</div>
				
				</div>
				
				<div class="enter_billing_iner_main">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>
				
				</div>
				
				<div class="enter_billing_iner_mains">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>
				
				</div>
			
			</div>
			
		</div>
			<div class="enter_total">Total:$67.00</div>
			<div class="clr"></div>
			<div class="enter_total_two">Due Now:$67.00</div>
			
					<div class="billing_celender_inner_txer">JANUARY</div>
		<div class="billing_celender_inner">
			<div class="enter_billing_iner_main">
				<div class="enter_billing_iner_main">
					<div class="iner_left">Lesson Date</div>
					<div class="iner_right">Tuition per Lesson</div>
				
				</div>
				
				<div class="enter_billing_iner_main">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>
				
				</div>
				
				<div class="enter_billing_iner_mains">
					<div class="iner_lefts">12/15/2010</div>
					<div class="iner_rights">$33.00</div>
				
				</div>
			
			</div>
			
		</div>
			<div class="enter_total">Total:$67.00</div>
			<div class="clr"></div>
			<div class="enter_total_two">Due Now:$67.00</div>
		</div>
		
			
			
			
			
			
		</div>
		
	</div>




</div>
</div>
</div>
</div>




