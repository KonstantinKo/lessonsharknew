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
				<!--Left Navigation-->
				<div class="about_lesson_lesson_part">
					<div class="about_lesson_lesson_part_left_n">
						<div class="feature_background">
							<div class="feature_text_part">
								<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>

								<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
								<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
							<div style="padding-left:20px;font-size:15px"class="number_txt"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div>
								
								<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div>
							<div class="white_feature_bar">
								<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div></div>
						</div>		
								<a style="margin-top:-110px" class="orange_create" href="http://www.lessonshark.com/dev1/teachers/">
									<div class="profile_text">Create a Free Profile</div>
								</a>
								<div style="margin-top:-50px"class="free_text">Completely Free. No credit card <br>information required. Cancel Anytime</div>

							</div>
					</div>

		<!--Right Content-->
			
			
			<div class="about_lesson_lesson_part_rightyu">
				<div class="studentfqu_text">Student F.A.Q</div>
			<div class="faq_second_right_parts">
				<div class="circule"></div>
			<div class="right_texts">What are the main advantages to using LessonShark?</div>
			<div class="inner_text">Teachers using LessonShark keep an average of 90% of their student's tuition.
			Our software helps you find and manage your students.

			In short:
			LS lets you be a Teacher, so you don't have to be a teacher/manager/secretary/advertiser/accountant/bookkeeper/programmer.

			For more specifics check out the <a href="/feature">Features</a> page.
			</div>
			<div class="back_tops">back to top</div>
			</div>
			
			<div class="faq_second_right_parts">
				<div class="circule"></div>
			<div class="right_texts">How is working with LS (LessonShark) different from working with any other lessons agency?</div>
			<div class="inner_text">You're not a hired contractor on LessonShark, so you're free to do business however you wish. With a traditional agency, Teachers are hired by the agency and what the agency says goes.
			Also, With LS you'll keep an average of 90% (see <a href="/teachers/numbers">The Numbers</a> page for details) of your student's tuition. With a lessons agency you would only keep about 67% - that's a gain of about 25%.
			 </div>
			<div class="back_tops">back to top</div>
			</div>
			
			<div class="faq_second_right_parts">
				<div class="circule"></div>
			<div class="right_texts">Lorem ipsum dolor sit amet,consectetur adipiscing elt.Ut tempor eros?</div>
			<div class="inner_text">Even though "lorem ipsum" may arouse curiosity because of its resemblance to classical Latin, it is not intended to have meaning. Where text is comprehensible in a document, people tend to focus on the textual content rather than upon overall presentation, so publishers use lorem ipsum when displaying a typeface or design elements and page layout in order to direct the focus to the publication style and not the meaning of the text. In spite of its basis in Latin, use of lorem ipsum is often </div>
			<div class="back_tops">back to top</div>
			</div>
			
			<div class="faq_second_right_parts">
				<div class="circule"></div>
			<div class="right_texts">Lorem ipsum dolor sit amet,consectetur adipiscing elt.Ut tempor eros?</div>
			<div class="inner_text">Even though "lorem ipsum" may arouse curiosity because of its resemblance to classical Latin, it is not intended to have meaning. Where text is comprehensible in a document, people tend to focus on the textual content rather than upon overall presentation, so publishers use lorem ipsum when displaying a typeface or design elements and page layout in order to direct the focus to the publication style and not the meaning of the text. In spite of its basis in Latin, use of lorem ipsum is often </div>
			<div class="back_tops">back to top</div>
			</div>
			
			</div>
		</div>
