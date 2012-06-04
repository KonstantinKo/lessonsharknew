<?php ?>	
<div class="profile_border">
	<div class="new_edit_back"></div>
		<div class="clr"></div>

		<?php	//flash message display
			$flash = $session->flash();
		if($flash)
			echo $flash; ?>

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
				<div class="credtails_main_check_right">
					<div class="grey_box"><h2>Run a Background Check<h2></div>

				<div class="credtails_main_verfiy_dumy">Background checks are a great way to show potential student that your are a safe and trustworthy individual. An approved background check is required to complete your profile and make it searchable on lessonshark.com. Checks are run by our partner TruDiligence. Once your background check is approved, you will receive a "Background Check Approved" Badge below your profile picture for all potential students to see.</div>
				<div class="credtails_main_add_btns">
				<?php echo $html->link('Run Background Check', array("controller" => "teachers", "action" => "backgroundCheck", $id), array("class" => "bk_check_button")); ?>
				</div>
			</div>
		</div>

		<?php 
		echo $form->create('TeacherExperience', 
			array('url' => array('controller' => 'teachers', 'action' => 'editCredential', $id))); 

		$baseOptions = array("class" => "polcies_caceller_box_gry", "rows" => 2, "label" => false);
		$edOptions = $teachOptions = $perfOptions = $baseOptions;

		if (!empty($credentials)) {
			$edOptions["value"] = $credentials['TeacherExperience']['education'];
			$teachOptions["value"] = $credentials['TeacherExperience']['teaching'];
			$perfOptions["value"] = $credentials['TeacherExperience']['performance'];
		}

		?>

			<div class="credtails_education_text">
				<div class="grey_box">
					<h2>Education and Training<h2>
				</div>
			</div>
			<div class="clr"></div>
			<!-- Degree information will not be shown here until the degreeverify feature is implemented
			<div class="credtails_education_texts">B.A piano performance from Indiana University</div><div class="clr"></div> -->
			<div class="credtails_education_gry">List any pertinent training you have had.</div>
			<?php echo $form->input("education", $edOptions) ?>
			<!--
			<textarea class="polcies_caceller_box_gry" style="margin-top:5px" id="TeacherCredential" name="data[TeacherCredential][edu]" rows="2" >	
			</textarea>
			-->

			
			<div class="credtails_education_text">
				<div class="grey_box">
					<h2>Teaching Experience</h2>
				</div>
			</div>

			<div class="clr"></div>
			<div class="credtails_education_gry">Describe your previous teaching experience.</div>
			<?php echo $form->input("teaching", $teachOptions) ?>
			<!--
			<textarea 
			  class="polcies_caceller_box_gry" 
			  id="TeacherCredential" 
			  name="data[TeacherCredential][training]" 
			  rows="2">
			</textarea>
		-->


			<div class="credtails_education_text">
				<div class="grey_box">
					<h2>Performance Experience</h2>
				</div>
			</div>

			<div class="clr"></div>
			<div class="credtails_education_gry">Describe your performance experience.</div>
			<?php echo $form->input("performance", $perfOptions) ?>
			<!--
			<textarea 
			  class="polcies_caceller_box_gry"
			  id="TeacherCredential" 
			  name="data[TeacherCredential][perf]" 
			  rows="2"   >
			</textarea>
			-->

			<div class="credentials_save_btn">
				<input type="submit" class="submit_button" value="Save My Credentials">
			</div>

	 	<?php 
	 	echo $form->hidden("user_id", array("value" => $id));

	 	if (isset($credentials['TeacherExperience']['id']))
	 		echo $form->hidden("id", array("value" => $credentials['TeacherExperience']['id']));

	 	echo $form->end();
	 	?>
		
		<div class="clr"></div>
		
</div>
