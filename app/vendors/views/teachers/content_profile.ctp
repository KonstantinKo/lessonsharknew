<?php ?>
<?php echo $javascript->link('jquery');?>
<script type="text/javascript">
	
	 function getVal(id)
		{
			$('#'+id).hide();
		}
</script>
<!--Creates a border around the profile-->
<div class="another wrapper" style="margin:0 auto;width:992px;">
 <div class="profile_border">
<!--Renders the left side bar-->	
<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>	

  <div class="teach_pro_right_part">
	<div class="teach_pro_right_part_sec">
		<div class="teach_pro_right_discrip_txt">Skip to:</div>
		<div class="teach_pro_right_txt_head"><?php foreach($discipline as $des22){ foreach($des22 as $des_new){ $ds=$des_new['TeacherDesciplineField']['dsid'];  $dse=$discpline_old[$des_new['TeacherDesciplineField']['dsid']];}?>
			<div style="float:left;" onclick="getVal(<?php echo $ds;?>)"><?php  echo $dse; ?>/		     	      </div> <?php }?>
		</div>

<?php foreach($discipline as $des22){ foreach($des22 as $des_new){  $ds=$des_new['TeacherDesciplineField']['dsid']; $dse=$discpline_old[$des_new['TeacherDesciplineField']['dsid']];} ?>
<!--The code below is throwing validation errors because of "<div id="2"> where 2 is not allowed". Please fix!-->
	<div id="<?php  echo $ds; ?>">		
		<div class="teach_pro_right_back_img">
			<div class="teach_pro_right_back_img_txt"><?php echo $dse; ?></div>
		</div>
		<div class="teach_pro_right_lists">
			<div class="teach_pro_right_durate">
				<div class="teach_pro_right_duration_head">Duration (Min.):</div>
				<div class="teach_pro_right_durat_list">

				<?php foreach($des22 as $des1)
				{ ?>	
	   				<div class="teach_pro_right_durat_point"><?php echo $des1['TeacherDesciplineField']['duration'];?></div>
				<?php } ?>	
	      		</div>	
			</div>

			<div class="teach_pro_right_locate">
				<div class="teach_pro_right_duration_head">Location(s):</div>
				<div class="teach_pro_right_locate_list">

				<?php foreach($des22 as $des1)
				{  $description=$des1['TeacherDesciplineField']['description']; ?>															
					<div class="teach_pro_right_locate_point"><?php echo $des1['TeacherDesciplineField']['location']; ?>
					</div>
<?php } ?>		    
                </div>
			</div>



			<div class="teach_pro_right_durate">
				<div class="teach_pro_right_duration_head">Rate (USD/h):</div>
				<div class="teach_pro_right_durat_list"></div>
		    </div>
        </div>
		<div class="teach_pro_right_txt_bottom">Description</div>
		<div class="teach_pro_right_discrip_txt_bott"><?php echo $description; ?></div>
	</div>
<?php } ?>

    </div>	
  </div>

 </div>
</div>	

