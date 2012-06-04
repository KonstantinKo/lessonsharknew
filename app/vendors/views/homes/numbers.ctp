<?php ?>
<?php echo  $javascript->link('jquery-1.7.1.min'); ?>
<?php echo $javascript->link('jquery.nivo.slider.pack'); ?>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
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
				<!--Left Navigation-->
				<div class="about_lesson_lesson_part">
					<div class="about_lesson_lesson_part_left_n">
						<div class="feature_background">
							<div class="feature_text_part">
								<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>

								<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
								<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
							<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div>
								<div class="white_feature_bar">
								<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div></div>
								<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div>
						</div>		
								<a style="margin-top:-110px" class="orange_create" href="http://www.lessonshark.com/dev1/teachers/">
									<div class="profile_text">Create a Free Profile</div>
								</a>
								<div style="margin-top:-50px"class="free_text">Completely Free. No credit card <br>information required. Cancel Anytime</div>

							</div>
					</div>

		<!--Right Content-->
			<div class="about_lesson_lesson_part_right_inner">
				<div class="past_text">The Past </div>
				<div class="text_box">
					<div class="your_keep_main">
						<div class="keep_text">You Keep</div>
						<div class="span">66%</div>
								</div>
							</div>
			
			<div class="the_past_main"style="padding-top:70px" >
				<div class="future_text" >The Future</div>
				<div class="blue_box">
					<div class="your_keep_main">
						<div class="keep_text">You Keep</div>
						<div class="span_second">92%</div>
						</div>
				</div>

		</div>
		<div class="stud_text">LessonShark makes money via a small profit share from student tuition.</div>
		<div class="techer_percent_left">
			<div class="sky_text"></div>
			<div class="techer_percent_text">The Teacher's Percentage</div>
			</div>
			
			<div class="techer_percent_left">
				<div class="sky_dark"></div>
					<div class="techer_percent_text">LessonShark's Percentage</div>
				</div>
			<div class="techer_saptater"></div>
			<div class="bring_main">
			<div class="bring_left">
				<div class="techer_percent_text">Students <span class="lesson_span">LessonShark</span> Brings You</div>	
			</div>
			<div class="bring_right">
				<div class="techer_percent_text">Students<span class="lesson_span"> You </span>Bring In</div>
				</div>
			<div class="mentor_img"></div>
		
		
		
		
		
			</div>
		</div>
