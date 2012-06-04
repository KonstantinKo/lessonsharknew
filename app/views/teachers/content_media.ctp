<!--
<style>
 .media_right_vedio_img iframe 
	{	
		border:1px solid #999999;
		padding:4px;
		width:513px;
		height:315px;
	}
</style>


<div class="another wrapper" style="margin:0 auto;width:992px;">
-->


<div class="profile_border">

	<!-- render sidebar -->
	<?php echo $this->element('teachers/leftbar', array("teacher" => $teacher)); ?>

	<!-- <div class="teach_pro_right_part"> -->
	<div class="content_area">
		<div class="new_heading_tex_media_profile">
			<!--<h1>Media of <?php //echo $teachername ?></h1>-->
			
			<?php /*
				if(!empty($media) && $is_me)
				{
					echo '<span class="editOffer"><a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editMedia')).'">Edit my Media</a></span>';
				}
			*/?>
		</div>


  <?php 

  if(empty($media))
	{
		echo '<div class="no_data">No media present at this time.</div>';
		
		if($is_me)
		{
			echo '<a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editMedia')).'">Add something</a>';
		}
	}
	else
	{	
  	foreach($media as $item) : 
  	?>
	

			<!--Main individual video container-->
			<div class="media_right_vedio_img">	
			<?php	switch ($item['TeacherMedia']['site']) {
					case 'youtube':
						echo '<iframe width="530" height="315" src="http://www.youtube.com/embed/'.$item['TeacherMedia']['url'].'" frameborder="0" allowfullscreen></iframe>';
						break;

					case 'vimeo':
						echo '<iframe src="http://player.vimeo.com/video/'.$item['TeacherMedia']['url'].'" width="530" height="313" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						break;

					case 'soundcloud':
						echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$item['TeacherMedia']['url'].'&show_artwork=true"></iframe>';
						break;
				}
				
				?>
				<div class="media_right_vedio_content">

					<?php echo "<h2>{$item['TeacherMedia']['label']}</h2></div>"; ?>
			</div>

 		<?php 

 		endforeach; 
 	}?>	

		</div>
	</div>

	<div class="clr"></div>
	
	<div class="profile_complete">
		<span>40%</span>&nbsp;<span>profile completeness</span>
	</div>
</div>


<!--</div>-->

