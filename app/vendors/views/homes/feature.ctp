<?php echo  $javascript->link('jquery-1.7.1.min'); ?>
<?php echo $javascript->link('jquery.nivo.slider.pack'); ?>
<script type="text/javascript">
    $(window).load(function() {
      
	$('#zip').click(function()
	 {
		$('#zip').val('');  
	});
	$('#instrument').click(function()
	 {
		$('#instrument').val('');  
	});
    });
    
       
    
	
	
    </script>
	<div class="about_sky_top_input">
				<input type="text" value="Instrument" id="instrument" class="about_sky_top_input_box"/>
				<input type="text" value="Zip Code" id="zip" class="about_sky_top_input_boxs"/>
				<div class="about_sky_find_bt"></div>
			</div>
			<!--lesson part start-->
			<div class="about_lesson_lesson_part">
				<div class="about_lesson_lesson_part_left_n">
					<div class="feature_background">
						<div class="feature_text_part">
							<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>
							
							<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
						<div class="white_feature_bar">	<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div></div>
						<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div>
							<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div>
							<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div>
					</div>		
							<a style="margin-top:-110px" class="orange_create" href="http://www.lessonshark.com/dev1/teachers/">
								<div class="profile_text">Create a Free Profile</div>
							</a>
							<div style="margin-top:-50px"class="free_text">Completely Free. No credit card <br>information required. Cancel Anytime</div>

						</div>
				</div>
	
<div class="dash_right">
	<!--old stuff	<div class="bu_main">
	<div class="buton_one"><div class="let_student_text">Let Students Find You</div></div>
		<div class="buton_one"><div class="let_student_texter">Track. Bill. Communicate.</div></div>

			</div>-->
	<div class="lesson_sark_main">
	<div class="sark_text">LessonShark <span style="color:#01A9DB">Teacher Profiles</div>
	<div style="margin-left:20px;"class="sark_middle_text">Use your Teacher Profile to show your skills, abilities, methods, experience, and unique personality. </div
></div>
<div class="action_main">
	<div class="img_action"></div>
	<div class="see_dashborad_text">See teacher profiles in action</div>
			</div>
		<div class="saprater_sark"></div>
		<div class="book_lesson_main">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_13.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Book Lessons</div>
					<div class="dummy_text">Students can book lessons with you right from your Teacher Profile. Once you accept the student, you will be able to monitor and manage the student's billing, lessons, and comments with your Teacher Dashboard.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_10.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Reputation</div>
					<div class="dummy_text">Ratings and Reviews from your past or present students show your glowing reputation to potential students. Good ratings also give your profile priority in search results.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_16.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Schedule</div>
					<div class="dummy_text">Use the Openings tab on your profile to show students where and when you're available for lessons. LessonShark keeps your openings in sync with your currently scheduled students so you don't have to constantly update your availability to avoid conflicts. </div>
			</div>		

	<div class="book_lesson_main">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_22.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Media</div>
					<div class="dummy_text">Give potential students a glimpse into your methods and personality by connecting videos from youtube or vimeo to your profile's Media tab. You can also connect SoundCloud audio clips.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_23.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Verify Your Degree</div>
					<div class="dummy_text">Show your educational acheivments with a "Verified Degree" badge on your profile. Run a Degree Verification on yourself with just a few clicks from the edit profile section.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_24.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Background Cheack</div>
					<div class="dummy_text">Show your integrity to potential students with a "Approved Background" badge on yoru profile. Run a background check on yourself with just a few clicks from the Edit Profile section. </div>
			</div>		

		<div style="margin-left:90px;"class="book_lesson">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('create_img_34.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Advertise Your Profile</div>
					<div class="dummy_text">Already use Craigslist, Adwords, or your website to advertsie your services? Use your LessonShark profile to supplement your portfolio and allow your students a secure portal to register with you.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('create_img_36.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Experience & Policies</div>
					<div class="dummy_text">List your Education, Teaching, and Performance experience for student's to view. Keep your students on the same page by detailing your cancellation and lesson policies.</div>
			</div>
	
</div>

</div>

</div>
</div>
