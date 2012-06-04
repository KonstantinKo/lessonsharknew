<div class="another wrapper" style="margin:0 auto;width:992px;">
 <div class="profile_border">
<?php $edu='';$tec='';$per='';$eid='temp';
	foreach($teacherexperience as $exp){ $edu=$exp['TeacherExperience']['education'];$tec=$exp['TeacherExperience']['teaching']; $per=$exp['TeacherExperience']['performance'];$eid=$exp['TeacherExperience']['id'];} 
 echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>	

<div class="exper_pro_right_part">
	<div class="exper_top_text">Verifications</div>
		<div class="exper_pro_left_verify">
		<div class="exper_pro_left_ver_bac">
			<div class="exper_pro_left_ver_bac_bor">
				<div class="exper_pro_left_ver_img"><?php echo $html->image('tp_exp.png'); ?></div>
					<div class="exper_pro_left_ver_txt">LessonShark Approved Background</div>
					
			</div>
		</div>
				
	</div>
	<div class="exper_pro_left_verify">
		<div class="exper_pro_left_ver_bac">
			<div class="exper_pro_left_ver_bac_bor">
				<div class="exper_pro_left_ver_img" ><?php echo $html->image('tp_expde.png'); ?></div>
					<div class="exper_pro_left_ver_txt">LessonShark Approved Degree</div>
					
			</div>
		</div>
				
	</div><div class="clr"></div>
	<div class="exper_top_reusme">Resume</div>	
	<div class="exper_top_eduction_main">
		<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_excap.png'); ?></div>
		<div class="exper_top_eduction_right_text">Education</div>
		<div class="exper_top_eduction_right_text_dummy" style="height:85px;"><?php  echo $edu; ?>
		
		</div>
	</div>
	
	<div class="exper_top_eduction_main">
		<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_apple.png'); ?></div>
		<div class="exper_top_eduction_right_text_sapn">Teaching</div>
		<div class="exper_top_eduction_right_text_dummy" style="height:85px;"><?php  echo $tec; ?>

		</div>
	</div>
	
	
	<div class="exper_top_eduction_main">
		<div class="exper_top_eduction_left_img"><?php echo $html->image('tp_lap.png'); ?></div>
		<div class="exper_top_eduction_right_text_sapns">Performance</div>
		<div class="exper_top_eduction_right_text_dummy" style="height:85px;"><?php  echo $per; ?>.
		
		</div>
	</div>
	
	
	
	
     </div>
	</div>

  </div>	
 </div>
</div>