<?php ?>

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
 <div class="profile_border">
	<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>	
	<div class="teach_pro_right_part">
  <?php   // foreach($media as $media1){ ?>
  <?php    foreach($media as $media1){ ?>
		<div class="media_right_vedio_img">	
			<iframe width="420" height="315"  frameborder="0" allowfullscreen src="<?php echo $media1['TeacherMedia']['url'];?>"></iframe>
		<?php   ?>			
		</div>
 <?php  } ?>					
	</div>
 </div>
</div>

