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
						<div class="white_feature_bar">
					<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>
					</div>
					<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
				<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
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
		<!--Right Side-->	
			<div style="margin-top:30px;margin-left:30px;"class="lesson_text">LessonShark is here to help you find and manage your personal students.  </div>
					<div class="about_lesson_lesson_part_tour">
						<div style="margin-left:-10px">
						<!--place tour video here-->
						<iframe src="http://player.vimeo.com/video/37152440" width="550" height="340" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
						
					</div>
		</div>
