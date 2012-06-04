<?php ?>	
	<div class="new_edit_back"></div>
		<div class="clr"></div>
		<div class="new_edit_tex">Credentials</div>
		<!-- verfify part start-->
		<div class="clr"></div>
		<div class="credtails_main_inner">
			<!--We'll add the DegreeVerify feature after alpha launch
			<div class="credtails_main_verfiy_left">
				<div class="credtails_main_verfiy_text">Verify A Degree</div>
				<div class="credtails_main_verfiy_dumy">Lesson shark has partnered with the national Student<br>
				Clearinhouse to allow you to verify your degree.Once verifed,<br> a"Degree Verified" badge will appear below your profile<br>
				picture for all potentail students to see.Also the title of your <br>degree and the school that you obtained the degree from will<br>
				be displayed in the "Credentials" tab on your profile.verfiying<br> your degree costs $20.00.Some degree are verfied instantly<br>
				while other may take up to 4 busiess days.
				</div> 
				<div class="credtails_main_add_btn"><a href="/dev1/teachers/credentialForm/2" id="deletelocation"><?php echo $html->image('add_verfify.png'); ?></a></div>
				</div>
			</div>-->
				<div class="credtails_main_check_right"><div class="credtails_main_verfiy_text">Run a Background Check</div>
				<div class="credtails_main_verfiy_dumy">Background checks are a great way to show potential student that your are a safe and trustworthy individual. An approved background check is required to complete your profile and make it searchable on lessonshark.com. Checks are run by our partner TruDiligence. Once your background checks is approved, you will receive a "Background Check Approved" Badge  below your profile picture for all potential students to see. Background checks require a once a year fee of $30 to process.	</div>
				<div class="credtails_main_add_btns"><a href="" id="deletelocation"><?php echo $html->image('run.png'); ?></a></div>
			</div>
		</div>
		<div class="credtails_education_text">Education and Training</div><div class="clr"></div>
	<!-- Degree information will not be shown here until the degreeverify feature is implemented
		<div class="credtails_education_texts">B.A piano performance from Indiana University</div><div class="clr"></div> -->
		<div class="credtails_education_gry">List any pertinent training you have had.</div>
		<textarea class="polcies_caceller_box_gry" style="margin-top:5px" id="TeacherCredential" name="data[TeacherCredential][edu]" rows="2" >	
		</textarea>

		
		<div class="credtails_education_text">Training Experience</div><div class="clr"></div>
		<div class="credtails_education_gry">Describe your previous teaching experience.</div>
		<textarea 
		  class="polcies_caceller_box_gry" 
		  id="TeacherCredential" 
		  name="data[TeacherCredential][training]" 
		  rows="2"   >
		</textarea>


<div class="credtails_education_text">Performance Experience</div><div class="clr"></div>
		<div class="credtails_education_gry">Describe your performance experience.</div>
		<textarea 
		  class="polcies_caceller_box_gry"
		  id="TeacherCredential" 
		  name="data[TeacherCredential][perf]" 
		  rows="2"   >
		</textarea>
		<div class="submit_image" >	<input type="submit" value="Save" style="margin-left:46px"></div>
		 <?php echo $form->end(); ?>
		
		<div class="clr"></div>
		

