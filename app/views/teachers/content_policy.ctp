<div class="another wrapper" style="margin:0 auto;width:992px;">
 <div class="profile_border">
<?php $makeup=''; $cancel=''; foreach($teacherpolicy as  $policy) { $cancel=$policy['TeacherPolicy']['cancelation']; $makeup=$policy['TeacherPolicy']['makeuplesson']; } ?>
<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>	
<div class="exper_pro_right_part">
	<div class="exper_top_eduction_main">
		<div class="exper_top_eduction_left_img"><?php echo  $html->image('spaeker.png'); ?></div>
		<div class="exper_top_eduction_right_polcy">Cancellations and Holidays</div>
		<div class="exper_top_eduction_right_text_dummy">
		<?php  echo $cancel; ?>
		
		</div>
	</div>
	
	<div class="exper_top_eduction_main">
		<div class="exper_top_eduction_left_img"><?php echo $html->image('dark_blue.png'); ?>	</div>
		<div class="exper_top_eduction_right_polcy">Make Up Lessons</div>
		<div class="exper_top_eduction_right_text_dummy">
		<?php  echo $makeup; ?>
		</div>
	</div>
	<?php foreach($teacherpolicy as  $policy) {  ?>
	<div class="exper_top_eduction_policy">
		<div class="exper_top_eduction_right_polcy"><?php pr($policy['TeacherPolicy']['title']);?></div>
		<div class="exper_top_eduction_right_text_dummy">

<?php echo $policy['TeacherPolicy']['details']; ?>
		</div>
	</div>
	<?php } ?>

</div>
 </div>
</div>