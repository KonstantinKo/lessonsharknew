<?php ?>


<!--Creates a border around the profile-->


<div class="profile_border">	
	
	<a href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'contentProfile')); ?>">
		<div class="new_edit_back"></div>
	</a>
	<div class="clr"></div>
	
	<?php
		if($error)
		{
			echo '<div class="error edit_general_notify">An error has occurred. See below for details.</div>';
		}
		else if($save)
		{
			echo '<div class="saved edit_general_notify">Your profile updates have been saved.</div>';
		}
	?>
	
	<div class="new_edit_tex"><h1>General Profile Settings</h1></div>
	
	<!--Upload an image for your profile-->
	<?php echo $form->create('Profile', array('type' => 'file', 'url' => array('controller' => 'teachers', 'action' => 'editGeneral', 'picture'))); ?>
		<?php
			//fails with security on
			/*$options = array
			(
				'name' => 'MAX_FILE_SIZE',
				'value' => 4194304
			);
			
			echo $form->hidden('MAX_FILE_SIZE', $options);*/
		?>
		<div class="grey_box"><h2>Edit Profile Photo</h2></div>
		<div class="profile_box">
			<div class="edit_general_text_extra photo_upload_section"'>
				<div class="photo_text">
					<?php echo $form->input('image', array('label' => 'Upload a photo:&nbsp;', 'type' => 'file')); ?>
					<?php
						if($errors['image_empty'])
							echo '<div class="error-message">A photo is required.</div>';
						else if($errors['image_upload'])
							echo '<div class="error-message">An upload error occurred. The photo needs to be less than 5MB and a .JPG, .PNG, or .GIF.</div>';
					?>
					<div class="upload_button">
						<div class="left_button">	
							<input type="submit" value="Upload" class="submit_button">
						</div>
					</div>
				</div>
				<?php
					$pic = $userinfo['Profile']['image'];
					$ext = $userinfo['Profile']['image_extension'];
					
					if(!empty($pic))
					{
						echo '<div class="photo_image">';
						echo $html->image('profilePics/'.$id.'/'.$pic.'t.'.$ext.'?'.rand(1, 1000000), array('width' => '200', 'height' => '200'));
						echo '</div>';
					}
				?>
				<div class="clr"></div>
			</div>
		
		</div>
	<?php echo $form->end(); ?>
		
	<!--Booking Status Section Section-->
	<?php echo $form->create('Profile', array('url' => array('controller' => 'teachers', 'action' => 'editGeneral', 'booking'))); ?>
		<?php //echo $form->hidden('booking_status'); ?>
		<?php echo $form->input('booking_status', array('label'  => '', 'div'=>'', 'style' => 'display: none;')); ?>
		<div class="grey_box"><h2>Lesson Booking Status</h2></div>
		<div class="profile_box">
			<div>
				<span class="edit_general_text_two_span">
					<?php
						if($userinfo['Profile']['booking_status'] == 'open')	
							echo 'Booking is Currently Open';
						else
							echo 'Booking in Currently Closed';
					?>
				</span>
			</div>
			<div class="edit_general_text_twos">Close lesson booking if you don't want to receive any booking requests at this time.Your profile will be removed from search results but you will still be able to students manually through your Teacher Dashboard.<br></div>
			<div class="form_button_wrapper edit_general_btns">
				<div class="left_button">
					<?php
						if($userinfo['Profile']['booking_status'] == 'open')	
							echo '<input type="submit" value="Close Booking" class="submit_button">';
						else
							echo '<input type="submit" value="Open Booking" class="submit_button">';
					?>
				</div>
			</div>
		</div>
	<?php echo $form->end(); ?>

	<!--Preferred Age Limit Section-->
	<?php echo $form->create('Profile', array('url' => array('controller' => 'teachers', 'action' => 'editGeneral', 'age'))); ?>
		<div class="grey_box"><h2>Preferred Age Limit</h2></div>
		<div class="profile_box">
			<div class="profiles_text boxes">
				Age limit:&nbsp;
				<?php
					if(isset($this->data['Profile']['age_limit']))
						$age = ltrim($this->data['Profile']['age_limit'], '0');
					else
						$age = ltrim($userinfo['Profile']['age_limit'], '0');
					
					echo $form->input('age_limit', array('value' => $age, 'label'  => '', 'div'=>'','maxlength' => 2, 'size' => 2, 'class' => 'edit_general_older_box input_inline'));
				?>
				&nbsp;<span class="edit_general_text_two_span">&nbsp;<span class="edit_general_text_two_span"> years old or older</span>
			</div>
			<?php
				if($errors['age_limit'])
					echo '<div class="error-message">Age limit needs to be numeric.</div>';
			?>	
			<div class="edit_general_text_twos">Allow only students who are a certain age or older to book lesson with you.</div>
			<div class="form_button_wrapper edit_general_btns_last">
				<div class="left_button">	
					<input type="submit" value="Save Age Limit" class="submit_button">
				</div>
			</div>
		</div>
	<?php echo $form->end(); ?>
	
	
	
</div>




