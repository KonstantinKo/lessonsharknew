<div class="profile_border">

 	<!-- render sidebar -->
	<?php 

	echo $this->element('teachers/leftbar', array("teacher" => $teacher));
	
	if (!empty($teacherexperience)) {
		$education = $teacherexperience['TeacherExperience']['education'];
		$teaching = $teacherexperience['TeacherExperience']['teaching'];
		$performance = $teacherexperience['TeacherExperience']['performance'];
		//$teacher_id = $teacherexperience['TeacherExperience']['id'];
	}
	else 
	{
		$education = $teaching = $performance = "This teacher hasn't provided any experience content yet.";
	}

	//echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return'));

	?>

	<div class="content_area">

		<div class="exper_pro_right_part">
			<div class="exper_top_text">Verifications</div>
			<?php if ($teacher['Profile']['approved_background']) : ?>
			<div class="exper_pro_left_verify">
				<div class="exper_pro_left_ver_bac">
					<div class="exper_pro_left_ver_bac_bor">
						<div class="exper_pro_left_ver_img"><?php echo $html->image('tp_exp.png'); ?></div>
						<div class="exper_pro_left_ver_txt">LessonShark Approved Background</div>
					</div>
				</div>
			</div>
			<?php 
			endif;
			if ($teacher['Profile']['approved_degree']) : 
			?>
			<div class="exper_pro_left_verify">
				<div class="exper_pro_left_ver_bac">
					<div class="exper_pro_left_ver_bac_bor">
						<div class="exper_pro_left_ver_img" ><?php echo $html->image('tp_expde.png'); ?></div>
						<div class="exper_pro_left_ver_txt">LessonShark Approved Degree</div>
					</div>
				</div>
			</div>
			<?php 
			endif;
			if (!$teacher['Profile']['approved_degree'] && !$teacher['Profile']['approved_background']) :
			?>
				Neither background nor education of this teacher are confirmed.
			<?php endif; ?>


			<div class="clr"></div>
			<div class="exper_top_reusme">Resume</div>	
			<div class="exper_top_eduction_main">
				<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_excap.png'); ?></div>
				<div class="exper_top_eduction_right_text">Education</div>
				<div class="exper_top_eduction_right_text_dummy" style="height:85px;">
					<?php echo $education; ?>
				</div>
			</div>
	
			<div class="exper_top_eduction_main">
				<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_apple.png'); ?></div>
				<div class="exper_top_eduction_right_text_sapn">Teaching</div>
				<div class="exper_top_eduction_right_text_dummy" style="height:85px;">
					<?php echo $teaching; ?>
				</div>
			</div>
	
	
			<div class="exper_top_eduction_main">
				<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_lap.png'); ?></div>
				<div class="exper_top_eduction_right_text_sapns">Performance</div>
				<div class="exper_top_eduction_right_text_dummy" style="height:85px;">
					<?php echo $performance; ?>
				</div>
			</div>
  	</div>

	</div>

	<div class="clr"></div>
	
	<div class="profile_complete">
		<span>40%</span>&nbsp;<span>profile completeness</span>
	</div>
</div>