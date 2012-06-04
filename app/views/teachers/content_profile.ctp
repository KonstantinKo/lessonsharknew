<!--Creates a border around the profile-->

<div class="profile_border">
	
	<!--Renders the left side bar-->	
	<?php echo $this->element('teachers/leftbar'); ?>

	<div class="content_area">
	
		<div class="new_heading_tex">
			<h1>Lesson Offerings</h1>
			
			<?php
				if(!empty($lessons) && $is_me)
				{
					echo '<span class="editOffer"><a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editProfile')).'">Edit offerings</a></span>';
				}
			?>
		</div>
	
		<?php
			if(!$searchable && $is_me)
			{
				//echo '<div class="highlight">Your profile will not appear in search results until there is at least one leson offering and XX% complete in your profile.</div>';
			}
		?>
	
	
		<!--Lesson Offerings -->
		<?php
			if(empty($lessons))
			{
				echo '<div class="no_data">No lesson offerings at this time.</div>';
				
				if($is_me)
				{
					echo '<a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editProfile')).'">Add a lesson offering</a>';
				}
			}
			else
			{	
				foreach($descLessons as $d) :
					
		?>
			
					<div class="lesson_block">
						
						<div class="teach_pro_right_back_img">
							<div class="teach_pro_right_back_img_txt"><?php echo $tools->cleanup($d['TeacherDescipline']['dname']); ?></div>
						</div>
						
						<div class="teach_pro_right_back_rate">
							<div class="teach_pro_right_back_dollar">$<?php echo $a['TeacherDesciplineField']['rate']; ?></div>
							<div class="teach_pro_right_back_detail">(USD/hr)</div>
						</div>
						
						<div class="lesson_content">
							<table cellpadding="0" cellspacing="0" class="lesson_table">
								<tr>
									<th class="teach_pro_right_duration_head">Duration (min.):</th>
									<th class="teach_pro_right_location_head">Location(s):</th>
									<th class="teach_pro_right_rate_head">Rate (USD/hr):</th>
								</tr>
								
								<?php
									foreach($allLessons as $a)
									{
										if($d['TeacherDesciplineDescription']['teacher_descipline_id'] == $a['TeacherDesciplineField']['teacher_descipline_id'])
										{
								?>
								
											<tr>
												<td class="teach_pro_right_durat_list">
													<?php echo $tools->cleanup($a['TeacherDesciplineField']['duration']); ?>
												</td>
												<td class="teach_pro_right_loca_list">
													<?php echo $tools->cleanup($a['TeacherLocation']['name']); ?>
												</td>
												<td class="teach_pro_right_rate_list">
													<span class="dollar">$</span><?php echo $tools->cleanup($a['TeacherDesciplineField']['rate']); ?>
												</td>
											</tr>
								<?php
										}
									}
								?>
							</table>
							
							<div class="lesson_title">
								Description:
							</div>
							<div class="lesson_description">
								<?php echo$tools->cleanupAndKeepBR( $d['TeacherDesciplineDescription']['description']); ?>
							</div>
						</div>
						
						<div class="clr"></div>
					
					
					
					</div>
		
		<?php
				endforeach;

			}
		?>
	</div>
	
	
	
	<div class="clr"></div>
	
	<!--<div class="profile_complete">
		<span>40%</span>&nbsp;<span>profile completeness</span>
	</div>-->
</div>



