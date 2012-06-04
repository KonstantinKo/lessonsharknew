	</div>
</div>	
<?php
	echo $javascript->link('jquery/jquery');    
	echo $javascript->link('jquery/jquery.form'); 
?>
<div class="midContainer">
		  
		<div class="contact_middle_container">
			<div class="contact_middle_container_left">
				<div class="contact_middle_container_left_top_banner">
				<div class="contact_middle_container_left_tex">Contact us</div></div>
				<div class="clr"></div>
				<div class="contact_middle_container_left_address">Adderss:</div><div class="clr"></div>
				<div class="contact_middle_container_left_street">1 space, near 1234 Main Street</div>
				<div class="contact_middle_container_left_street">Washington, DC 20002.</div>
				<div class="contact_middle_container_left_phone">Phone: 0000000000000</div>
				<div class="contact_middle_container_left_phones">Mob:00000000000000</div><div class="clr"></div>
				<div class="contact_middle_container_left_address">contact us: </div><div class="clr"></div>
				<div class="contact_middle_container_left_phones">www.preparedparker.com</div>
				<div class="contact_middle_container_left_phones">info@preparedparker.com</div>
				<div class="contact_middle_container_left_parker">Thanks for visit to Prepared Parker!</div>
			
			</div>
			<?php echo $form->create('Home',array('id'=>'ContactForm','action'=>'contactUs','name'=>'frmCreate')); ?>
			<div class="contact_middle_container_right">
				<div class="contact_middle_container_right_box">
					<div class="sucessPrint">
						  <?php  echo $session->flash(); ?>
					</div>	  	
					<div class="contact_middle_container_right_name_main">
						<div class="contact_middle_container_right_name_main_tex"  >First Name</div>
						<?php echo $form->input('fname', array('label'=>'','class'=>'contact_middle_container_right_input','div'=>''));?>
					</div>
					<div class="contact_middle_container_right_name_mains">
						<div class="contact_middle_container_right_name_main_tex"  >Last Name</div>
						
						<?php echo $form->input('lname', array('label'=>'','class'=>'contact_middle_container_right_input','div'=>''));?>
					</div>
					
				<div class="contact_middle_container_right_name_mains">
						<div class="contact_middle_container_right_name_main_tex"  >Email</div>
					
						<?php echo $form->input('email', array('label'=>'','class'=>'contact_middle_container_right_input','div'=>''));?>
					</div>
					
				<div class="contact_middle_container_right_name_mains">
						<div class="contact_middle_container_right_name_main_tex"  >Phone</div>
						
						<?php echo $form->input('phone', array('label'=>'','class'=>'contact_middle_container_right_input','div'=>''));?>
						
					</div>
					
			
				<div class="contact_middle_container_right_name_mains">
						<div class="contact_middle_container_right_name_main_tex">Message</div>
					
						
						<?php echo $form->input('message', array('label'=>'','class'=>'','div'=>'','cols'=>'35','rows'=>'5'));?>
					</div>
					<div class="clr"></div>
				<div class="contact_middle_container_submit_btn">
					<input type="image" src="/parker/img/images/sub.png" name="contact">	
				</div>
			
				</div>
			</div>
			 <?php echo $form->end();?>
	
		</div>
	</div>	
