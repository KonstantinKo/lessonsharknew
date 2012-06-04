<div class="profile_border">
<div class="new_edit_tex">Run A Background Check</div>
<div class="clr"></div>

<div id="backgroundCheckForm">

	
	<div class="bk_get_approved_banner">
		<div class="get_approved_txt">Get your profile badge:</div>
		<div class="bk_badge_shot"></div>
		<div class="bk_badge_profile_view"></div>

	</div>
	<div class="bk_right_side">
		<div class="bk_security_banner">
			LessonShark and SentryLink use <span style="color:#0099ff">32bit SSL Encryption</span> to keep your data safe.
		</div>
		<div class="bk_win_win_banner">
			<span class="win_win_title"><span style="color:#0099ff">Simple Approval Terms. </span>
			<br><br>
			&nbsp; We only approve Instructors who:</span>
			<ol>
				<li>Have <u>no</u> Felony convictions</li>
				<li>Are <u>not</u> on the National Sex Offender Registry</li>
			</ol>
		</div>
	</div>
	<div class="bk_form_area">
		<?php
		#debug($errors);
		echo $form->create("User", array("url" => array("controller" => "teachers", "action" => "backgroundCheck", $id))); ?>

		<div class="bk_form_area_left">

		<?php echo $form->input("User.firstname", array(
				"label" => "First Name", "error" => true, "value" => $teacher['User']['firstname']));
			echo $form->input("User.middlename", array(
				"label" => "Middle Name", "value" => $teacher['User']['middlename']));
			echo $form->input("User.lastname", array(
				"label" => "Last Name", "value" => $teacher['User']['lastname']));
			echo $form->input("Profile.SSN1", array(
				"label" => "Social Security Number", "maxlength" => 3, "value" => $teacher['Profile']['SSN1']));
			echo $form->input("Profile.SSN2", array(
				"label" => false, "maxlength" => 2, "value" => $teacher['Profile']['SSN2']));
			echo $form->input("Profile.SSN3", array(
				"label" => false, "maxlength" => 4, "value" => $teacher['Profile']['SSN3'])); ?>

		</div>
		<div class="bk_form_area_right">

			<?php #echo $form->input("Vref");
			echo $form->input("Profile.DOB", array(
				"label" => "Date of Birth", "value" => $teacher['Profile']['DOB'], 
				'minYear' => 1900, 'maxYear'=>date('Y')-2));
			/*
			echo $form->input("Profile.phone", array(
				"label" => "Phone", "value" => $teacher['Profile']['phone']));
			echo $form->input("User.email", array(
				"label" => "Email", "value" => $teacher['User']['email']));
			*/
			echo $form->input("Profile.address", array(
				"label" => "Address", "value" => $teacher['Profile']['address']));
			echo $form->input("Profile.city", array(
				"label" => "City", "value" => $teacher['Profile']['city']));
			echo $form->input("Profile.state_id", array(
				"label" => "State", "value" => $teacher['Profile']['state_id']));
			echo $form->input("Profile.zip", array(
				"label" => "Zip", "value" => $teacher['Profile']['zip']));
			#echo $form->input("Vpackage");

			echo $form->hidden("Profile.user_id", array("value" => $id));
			echo $form->hidden("Profile.id", array("value" => $teacher['Profile']['id']));
			echo $form->hidden("User.id", array("value" => $id)); ?>

		</div>


	</div>
			<div class="submit_container">
			<span>*Required</span>

			<?php echo '<div class="submit_image_bk"><input class="bk_submit_button" type="submit" value="Request Background Check"></div>';
		echo $form->end();
	?>
		</div>
</div>
</div>