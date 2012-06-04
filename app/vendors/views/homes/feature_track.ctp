<?php ?>
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
<!--Search Bar-->
<div class="about_sky_top_input">
			<input type="text" value="Instrument" id="instrument" class="about_sky_top_input_box"/>
			<input type="text" value="Zip Code" id="zip" class="about_sky_top_input_boxs"/>
			<div class="about_sky_find_bt"></div>
		</div>
		
		<!--Left Navigation-->
		<div class="about_lesson_lesson_part">
			<div class="about_lesson_lesson_part_left_n">
				<div class="feature_background">
					<div class="feature_text_part">
						<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>
						
						<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
						<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
					<div class="white_feature_bar"><div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div></div>
						<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div>
						<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div>
				</div>		
						<a style="margin-top:-110px" class="orange_create" href="http://www.lessonshark.com/dev1/teachers/">
							<div class="profile_text">Create a Free Profile</div>
						</a>
						<div style="margin-top:-50px"class="free_text">Completely Free. No credit card <br>information required. Cancel Anytime</div>

					</div>
			</div>
	
<!--Right Content-->	
	

	<div class="lesson_sark_main" style="margin-left:-15px" >
	<div class="sark_text" style="margin-left:-40px;margin-top:20px">LessonShark <span style="color:#01DF01">Teacher Dashboard</span></div>
	<div class="sark_middle_text" style="margin-left:-20px">Finding ways to inspire and motivate your students is what you should focus on. Let LessonShark handle your student data, billing, and attendance. </div
></div>
<div class="action_main"style="margin-top:20px">
	<div class="img_action"></div>
	<div class="see_dashborad_text" >See The Dashboard in Action</div>
			</div>
		<div class="saprater_sark" style="margin-left:18px"></div>
		<div class="book_lesson_main" style="margin-right:40px">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('automatically_06.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Automatic Billing</div>
					<div class="dummy_text">LessonShark students are automatically billed on the 1st of the month for either 4 or 5 lessons. You receive your money immediately in your Paypal account and your dashboard is updated with the payment info. </div>
			</div>
			<div class="book_left">

					<div class="book_img"<div class="book_img"><?php echo $html->image('charlie_track_bill-comun-07.jpg'); ?></div><div class="clr"></div>			<div class="lessons_text">Automatic Attendance</div>					
					<div class="dummy_text">LessonShark automatically logs all of your lessons as complete so you don't have to manually edit attendance for every single lesson. If you have a cancellation, re-schedule, or make-up just edit attendance from the Schedule or Lessons view. </div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('advertise_16.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Schedule</div>
					<div class="dummy_text">View your weekly lessons in a calendar format and make changes or edits to lessons right from the calendar view. </div>
			</div>		

	<div class="book_lesson_main">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('easy_student_20.jpg'); ?></div><div class="clr"></div><div class="lessons_text">Running Blance</div>
					<div class="dummy_text">LessonShark shows you a running balance of what your student has paid for vs. lessons you have taught so you always know what is going on with your student's tuition balance.</div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('charlie_track_bill-comun-18.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Performance Data</div>
					<div class="dummy_text">See a running tally of how many students you have, lessons you've taught, money you've made, your current ratings, and more every time you log in. You can organize your data by month or you can set your own time period. </div>
			</div>
			<div class="book_left">
					<div class="book_img"><?php echo $html->image('charlie_track_bill-comun-19.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Add Your Own Students</div>
					<div class="dummy_text">Manage all of your students from one place. Invite your current students to use LessonShark at no cost to them and a lower percentage for you.</div>
			</div>		
		<div class="book_lesson">
				<div class="book_left">
					<div class="book_img"><?php echo $html->image('student_details_24.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Make-Up Credits</div>
					<div class="dummy_text">Add a comment to a future or past lesson to keep your student up to date and informed. Your student is notified when you comment so communication is easy. Students can also comment on lessons.</div>
			</div>
			<div class="book_left" style="width:210px">
					<div class="book_img"><?php echo $html->image('easy_student_26.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Student Details</div>
					<div class="dummy_text">Access all of your students' contact, address, and lesson information for easy communication and record keeping. To keep your records up to date, request changes to the details and allow your student to approve those changes.</div>
			</div>
			<div class="book_left">
				<div class="book_img"><?php echo $html->image('student_details_28.jpg'); ?></div><div class="clr"></div>
					<div class="lessons_text">Easy Student Set Up</div>
					<div class="dummy_text">Enjoy LessonShark's sign up process that keeps both the Teacher and Student in the loop when starting new lessons. </div>
			</div>

			</div>
			
			
		</div>
		
		</div>
		
		</div>
		</div>
