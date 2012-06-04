<?php
$rclass = '';
$pclass = '';

if($role == 'teacher')
{
	$rclass = 'raise';
	$pclass = 'raise2';
}
?>

<div class="teach_pro_left_part <?php echo $rclass; ?>">

	<?php
	
	$pic = $teacher['Profile']['image'];
	$ext = $teacher['Profile']['image_extension'];
	$id = $teacher['Profile']['user_id'];
	
	$class = 'teach_pro_left_pic_default';
	
	if(!empty($pic))
	{
		$class = 'teach_pro_left_pic';
	}
	?>
	
	<div class="<?php echo $class; ?>">
	
		<?php	
		if(!empty($pic))
		{									
			echo $html->image('profilePics/'.$id.'/'.$pic.'t.'.$ext.'?'.rand(1, 1000000), array('width' => '248', 'height' => '248'));
		}
		?>	
				
	
	
		<?php if($is_me) : ?>
			<div class="photo_link <?php echo $pclass; ?>">
				<a href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'editGeneral')); ?>">
					<div class="teach_pro_left_pic_edit"></div>
				</a>
			</div>
			
			<a style="display:none;" href="<?php echo $html->url(array('controller' => '', 'action'=>'')); ?>">
				<div class="teach_pro_left_pic_edit_photo"></div>
			</a>
		<?php	endif; ?>
	</div>

	<div class="teach_pro_left_pic_name">
		<div class="teach_pro_left_name_txt"><?php echo $tools->cleanup($teachername); ?></div>
	</div>

	<div class="teach_pro_left_pic_dis">
		<div class="teach_pro_left_dis_txt">
		
		<?php
		if(!empty($lessons))
		{
			$row = 0;
			
			foreach($lessons as $l)
			{
				if($row != 0)
					echo ' / ';
					
				echo strtoupper($l['TeacherDescipline']['dname']);
				
				$row++;
			}
		}
		else
		{
			if($is_me) 
			{
				echo '<span class="lessonoffer"><a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editProfile')).'">Add a lesson offering</a></span>';
			}
			else
			{
				echo 'No leessons offered at this time';
			}
		}						
		?>
		
		</div>
	</div>
	
	
	<?php if($bgcheck) : ?>
		<div class="teach_pro_left_verify">
			<div class="teach_pro_left_ver_bac">
				<div class="teach_pro_left_ver_bac_bor">
					<div class="teach_pro_left_ver_img_bk"></div>
					<div class="teach_pro_left_ver_txt_bk">Approved Background</div>
				</div>
			</div>
			<div class="teach_pro_left_ver_ques"></div>
		</div>
	<?php	else : ?>
		<div class="teach_pro_left_no_verify">
			<div class="teach_pro_left_no_back">
				<div class="teach_pro_left_ques" style="display: none;"></div>
			</div>
			<?php if($is_me) : ?>
				<a href="">
					<div class="teach_pro_left_run_back"></div>
				</a>
			<?php	endif; ?>
		</div>
	<?php endif; ?>

	<div class="teach_pro_left_verify" style="display: none;">
		<div class="teach_pro_left_ver_bac">
			<div class="teach_pro_left_ver_bac_bor">
				<div class="teach_pro_left_ver_img_dv"></div>
				<div class="teach_pro_left_ver_txt_dv">Verified Degree</div>
			</div>
		</div>
		<div class="teach_pro_left_ver_ques"></div>
	</div>

	<div class="clr"></div>

	<?php	if(count($ratings) > 0) :	?>

		<div class="teach_pro_left_rating">
			<div class="teach_pro_left_rate_btn">
				<div class="teach_pro_left_rate_text">Ratings (5)</div>
			</div>
			<div class="teach_pro_left_review_btn">
				<div class="teach_pro_left_rate_text style2">Reviews (5)</div>
			</div>
			<div class="teach_pro_left_rate_part">
				<div class="teach_pro_left_rate_point_head">
					<div class="teach_pro_left_rate_head">LessonShark Legitimate Ratings</div>
					
					<!--ToolTip-->
					<div class="alex_example">
					  <a>
					  	<img src="../img/tp_qp.png" width="40px" height="40px"/>
					  	Hover over me
					    <div class="teach_pro_left_rate_quest" style="display: none; left: 309.5px; top: 530px;">A simple tooltip</div>
					  </a>
					</div>
					<!--End Tooltip-->

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Overall</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Skill/Proficiency</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Communication</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">On-Time for Lessons</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Attendance</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Results-Oriented</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Attitude</div>
						<div class="teach_pro_left_rate_quest"></div>
						<div class="teach_pro_left_rate_point_rank"></div>
						<div class="teach_pro_left_rate_per_rank">4.5</div>
					</div>

					<div class="teach_pro_left_rate_point">
						<div class="teach_pro_left_rate_point_text">Personality:<br/>Focused, Laid-Back Fun</div>
						<div class="teach_pro_left_rate_quest"></div>
					</div>
				</div>
			</div>
		</div><!-- Added by Konstantin. Not sure yet. -->

	<?php	else : ?>
				
		<div class="init_rating_box_left">
			<div class="init_rating_title">
				No Ratings Yet.
				<div class="ratings_exclamation"></div>
			</div>
			
			<div class="init_rating_text">
				Any student you manage with LessonShark can submit ratings.
				<br/><br/>
				To get ratings, you can <a href="#">add your private students</a> for free. Once they've signed up, they can submit a rating. 
				<br/><br/>
				<a href="#">What are the advantages of adding my private students to LessonShark?</a>
			</div>
		</div>
		
	<?php	endif; ?>
</div>
