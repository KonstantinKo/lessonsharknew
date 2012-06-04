<?php
	if($hasErrors)
	{
		echo '<div id="flashMessage" class="error edit_general_notify">An error has occurred. See below for details.</div>';
	}
	else if($save)
	{
		echo '<div id="flashMessage" class="saved edit_general_notify">Your offering updates have been saved.</div>';
	}
?>

<!--Creates a border around the profile-->

<div class="profile_border">	
	
	<a href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'contentProfile')); ?>">
		<div class="new_edit_back"></div>
	</a>
	<div class="clr"></div>
	
	<div class="new_edit_tex"><h1>Add or Edit Your Teaching Locations</h1></div>
	
	
	<div class="edit_lessons_text_twos">
		Enter the locations where you teach during the week. <span class="location_top_text_span">Note: Full addresses are only displayed to students who book lesson with you.
		Prospective students viewing  your profile will only see zip codes.		
	</div>
	
	<div class="location_middle_left" >
		<div class="location_middle_one_inner">
			<div class="location_middle_one_tx">Locations</div>
		</div>
		<?php
			foreach($locations as $k => $v)
			{
		?>
				<div class="location_middle_one_txer" id="<?php echo $k; ?>">
					<?php echo $v; ?>
				</div>
		<?php
			}
		?>
		<div class="clr"></div>
		<div class="location_bootem_btn">
			<a href="<?php echo $html->url(array('controller' => '', 'action'=>'')); ?>" id="addlocation" ><?php echo $html->image('add_plus.png'); ?></a>
			<a href="?php echo $html->url(array('controller' => '', 'action'=>'')); ?>" id="deletelocation"><?php echo $html->image('delete_btn.png'); ?></a>
			<a href="?php echo $html->url(array('controller' => '', 'action'=>'')); ?>" id="editlocation"><?php echo $html->image('edit_loction.png'); ?></a>
		</div>
	</div>
		
	<div class="location_middle_middle">
		<?php  echo $form->create('TeacherLocation', array('url' => array('controller' => 'teachers', 'action' => 'editLocation'))); ?>
		
			<div class="location_bootem_studio_main" >
				<div class="location_bootem_studio_left">
					<input type="radio" name="data[TeacherLocation][type]"  value="home" id="home" checked="checked" class="location_radio_btn">
	   				<div class="location_radio_btn" style="margin-top:2px;margin-left:2px">In-Home Area</div>
					<!--<div class="location_qution_img" style="margin-top:2px;margin-left:4px"><?php echo $html->image('sky_qustion.png'); ?></div>-->
				</div>	   				
				<div class="location_bootem_studio_right">
					<input type="radio" name="data[TeacherLocation][type]" value="studio" id="studio" class="location_radio_btn">
					<div class="location_radio_btn" style="margin-top:2px;margin-left:2px">Studio Address</div>
					<!--<div class="location_qution_img" style="margin-top:2px;margin-left:4px"><?php echo $html->image('sky_qustion.png'); ?></div>-->
				</div>
			</div>
			<div class="clr"></div>
			
			<div class="input_form">
				<?php echo $form->input('TeacherLocation.name', array('label'=>'Area name','class'=>'location_in_home_input','div'=>'','maxlength' => 45));?>	
				<div class="clr"></div>
			</div>
			
			<div class="studio" style="display: none;">
				<div class="input_form">
					<?php echo $form->input('TeacherLocation.address1', array('label'=>'Address','class'=>'location_in_home_input','div'=>'','maxlength' => 45));?>	
					<div class="clr"></div>
				</div>
				
				<div class="input_form">
					<?php echo $form->input('TeacherLocation.address2', array('label'=>'Address 2','class'=>'location_in_home_input','div'=>'','maxlength' => 45));?>	
					<div class="clr"></div>
				</div>
				
				<div class="input_form">
					<?php echo $form->input('TeacherLocation.city', array('label'=>'City','class'=>'location_in_home_input','div'=>'','maxlength' => 45));?>	
					<div class="clr"></div>
				</div>
				
				<div class="input_form">
					<?php echo $form->input('TeacherLocation.state', array('State'=>'Address','class'=>'location_in_home_input','div'=>'','maxlength' => 45));?>	
					<div class="clr"></div>
				</div>
			</div>
				
			<div class="input_form">
				<?php echo $form->input('TeacherLocation.zip', array('label'=>'Zip code','class'=>'location_in_home_radius_bx location_in_home_input','div'=>'','maxlength' => 5, 'size' => 5));?>	
				<div class="clr"></div>
			</div>
			
			<div class="home">
				<div class="input_form">
					<?php echo $form->input('TeacherLocation.radius', array('label'=>'Radius (miles)','class'=>'location_in_home_radius_bx location_in_home_input','div'=>'','maxlength' => 5, 'size' => 5));?>	
					<div class="clr"></div>
				</div>
			</div>
			
			<div class="left_button break">
				<input type="submit" value="Save" class="submit_button">
			</div>
		<?php echo $form->end(); ?>
	</div>
	
	<div class="location_middle_right">
		GMap
	</div>
	
	
	
</div>

<span id="listcount" style="display: none;">0</span>

<script>


	$(document).ready(function()
	{
		/******************************************
  		 * Show home
		 *****************************************/

		$("#home").live("click", function()
		{
			$('.studio').hide();
			$('.home').show();
		});
		
		/******************************************
  		 * Show studio
		 *****************************************/

		$("#studio").live("click", function()
		{
			$('.home').hide();
			$('.studio').show();
		});
		
	});
	
</script>








  



 
