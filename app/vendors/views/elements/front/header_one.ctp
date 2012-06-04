<?php ?>
<?php echo  $javascript->link('jquery-1.7.1.min'); ?>
<?php echo $javascript->link('jquery.nivo.slider.pack'); ?>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
	
	$('#zip').focus(function()
	 {
	 	if($(this).val() == 'Zip Code')
		{
			$(this).val('');
		}
		  
	});
	$('#zip').blur(function()
	 {
		if($(this).val() == 'Zip Code' || $(this).val() == '')
		{
			$(this).val('Zip Code');
		}
	});
	
	$('#instrument').focus(function()
	 {
	 	if($(this).val() == 'Instrument')
		{
			$(this).val('');
		}
		  
	});
	$('#instrument').blur(function()
	 {
		if($(this).val() == 'Instrument' || $(this).val() == '')
		{
			$(this).val('Instrument');
		}
	});
});
	
    </script>
<div class="about_sky_top_input">
			<input type="text" value="Instrument" id="instrument" class="about_sky_top_input_box"/>
			<input type="text" value="Zip Code" id="zip" class="about_sky_top_input_boxs"/>
			<div class="about_sky_find_bt" ></div>
		</div>
<div class="thepower_texts">A simpler, safer, smarter way to find a Teacher.</div>
		
		<!--lesson part start-->
		<div class="home_page_back_img">
			         <div id="wrapper">
    
					

					<div class="slider-wrapper theme-default">
					    <div class="ribbon"></div>
					
				  
					<div id="slides">
						<table style="width:992px;vertical-align:text-top">
						<tr valign="top">
						  <td >
							 <div style="text-align:center;width:331px;margin-bottom: 12px;">
							  <span class="home_steps_text">Find</span>
							 </div>
							<div class="home_page_slide_text" style="height:85px">Search for an Instructor based on your instrument and location. Choose an Instructor that fits you best.</div>
							<div class="home_slide_1"></div>
						  </td>
						  <td>
							 <div style="text-align:center;width:330px;margin-bottom: 12px;">
							  <span class="home_steps_text">Book</span>
							 </div>
							 <div class="home_page_slide_text">Complete the lesson booking process to formally register with your Teacher.</div>
							<div class="home_slide_2" style="margin-top:20px;margin-bottom:20px"></div>
					
						  </td>
						<td>
							<div style="text-align:center;margin-bottom: 12px;">
							  <span class="home_steps_text" >Learn</span>
							</div>
							<div class="home_page_slide_text" style="width:331px">Once you start lessons use LessonShark to keep track of your lesson schedule, comment on lessons, view billing history, and more.</div>
							<div class="home_slide_3" style="margin-top:20px"></div>
						</td>
						</tr>
						</table>
					</div>

					</div>

				    </div>
		</div>
		<!--home inner start-->
		<div class="home_page_inner" style="line-height:31px; margin-top: 50px;">
			<div class="home_page_inner_left">
				<div class="home_page_inner_left_tex"><span style="margin-left:48px"><span class="home_page_inner_left_tex_span">Students</span> use LessonShark 
				to </span> find and choose great Music Instructors.</div>
			</div>
			<div class="home_page_inner_right">
				<div class="home_page_inner_left_tex"><span style="margin-left:65px"><span class="home_page_inner_left_tex_span">Teachers</span> can create a free </span>
				account and profile to help grow 
				and manage their student roster</div>
			</div>
		</div>

