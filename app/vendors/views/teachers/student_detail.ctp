<?php echo $javascript->link('jquery');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>

<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>
<script>

 $('document').ready(function(){
	//alert('lesson Schdule');
	$("#addstudent").fancybox({
		
	});
 })


	
</script>


<script>
		function getVal(a)
		{	

		 $('#temp').val(a);	
		
			     $.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/studentDet/'+a,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				});
			  $('#names div').removeClass('shudual_carol_inn');
			  $('#'+a).addClass("shudual_carol_inn");		
			  $("#sheduletop").removeClass("student_second_middle_right_button").addClass("student_second_middle_right_btn1");
			  $("#sdetail").removeClass("student_lessons").addClass("student_lesson");
			  $("#lessontop").removeClass("student_second_middle_right_btn").addClass("student_second_middle_right_button1");
			  $("#lesson").removeClass("student_lesson").addClass("student_lessons");
		}
		function deleteMakeup(a) // for deleting makeup lesson
		{
			
			 $.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/deleteMakeup/'+a,
					success: function(data) {
							
					alert('here');

					}

					
				});
			
		}
		function getshedule()
		{	

		var eng;
		eng = $('#temp').val();	
			 if(eng=='')
			 {
			   return ;
  			 }
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/studentDet/'+eng,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 
		$("#sheduletop").removeClass("student_second_middle_right_button").addClass("student_second_middle_right_btn1");
		$("#sdetail").removeClass("student_lessons").addClass("student_lesson");
		$("#lessontop").removeClass("student_second_middle_right_btn").addClass("student_second_middle_right_button1");
		$("#lesson").removeClass("student_lesson").addClass("student_lessons");
			

		}
		function getLesson()
		{
		        // here we have used hidden element for fetching the current student id	
			var eng;
			eng = $('#temp').val();	
			if(eng=='')
			{
			  return ;
  			}
		
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/lessonShedule/'+eng,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 
			
			$("#lessontop").removeClass("student_second_middle_right_button1").addClass("student_second_middle_right_btn");
			$("#lesson").removeClass("student_lessons").addClass("student_lesson");
			$("#sheduletop").removeClass("student_second_middle_right_btn1").addClass("student_second_middle_right_button");
			$("#sdetail").removeClass("student_lesson").addClass("student_lessons");

		} 
		function getLessonFilter()   // this  function works same as get lesson . but the difference will be it filters data based on month choosen
		 {
			
		        // here we have used hidden element for fetching the current student id	
			var eng;
			var monthfrom;
			var yearfrom;
			var monthfrom;
			var yearto;
			eng 		= $('#temp').val();
			 if(eng=='')
			 {
			  return ;
  			 }	
				
			b= $('input[name="datefilter"]:checked').val();  // here we fetch checkbox value based on that we apply condition here
			if(b="monthbetween")
			{
				monthfrom 	= $('#monthfrom').val();	
				yearfrom 	= $('#yearfrom').val();	
				monthto 	= $('#monthto').val();	
				yearto 		= $('#yearto').val();
				$.ajax
				({
					 type: 'POST',
					 url: '/dev1/teachers/lessonShedule',
					 data: { monthfrom: monthfrom, yearfrom : yearfrom, yearto :yearto,monthto:monthto, id:eng },
					 success: function(data) 
					 {
					       splt = data.split('$$');
										$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 	
		
			}
			else 
			{
			  $.ajax
				({
					type: 'GET',
					url: '/lessonshark1/teachers/lessonShedule/'+eng,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 
			
			}	
			
					
		       
			
			$("#lessontop").removeClass("student_second_middle_right_button1").addClass("student_second_middle_right_btn");
			$("#lesson").removeClass("student_lessons").addClass("student_lesson");
			$("#sheduletop").removeClass("student_second_middle_right_btn1").addClass("student_second_middle_right_button");
			$("#sdetail").removeClass("student_lesson").addClass("student_lessons");

		} 		
		function getShedule1()
		{
			// here we have used hidden element for fetching the current student id	
		var eng;
		eng = $('#temp').val();	
		
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/calendar',
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])
						$('#content').html('')
						$('#contentTo').html('')	

					}

					
				});   
			$("#studentshedule").removeClass("student_inner_left").addClass("student_inner_lefts");
			$("#lesson123").removeClass("shudual_text").addClass("shudual_white");

			$("#studentlesson").removeClass("student_inner_lefts").addClass("student_inner_left");
			$("#lesson12").removeClass("shudual_white").addClass("shudual_text");	
		} 	
		function getStudent()
		{
			// here we have used hidden element for fetching the current student id	
		      //var eng;
		//eng = $('#temp').val();	
		
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/lessonStudent',
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#content').html(splt[0])
						$('#contentTo').html(splt[1])
						$('#contentFeatureReplace').html('')
						$('#contentToBeReplace')	.html('')

					}

					
				}); 
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/studentName',
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#names').html(splt[0])
						

					}

					
				}); 
			$("#studentlesson").removeClass("student_inner_left").addClass("student_inner_lefts");
			$("#lesson12").removeClass("shudual_text").addClass("shudual_white");	
			$("#studentshedule").removeClass("student_inner_lefts").addClass("student_inner_left");
			$("#lesson123").removeClass("shudual_white").addClass("shudual_text");
		} 	
		
		function getdetail()
		{
		  $('#detail').hide();
		  $('#editdetail').show();
		}

	   function editattendance()
		{
		
		$("#edit_attend").fancybox({
				'showCloseButton'	: false,
			
			
			});
		}


                
</script>

<style>

#contentFeatureReplace
{
	float:right;
}
#editdetail
{
	display:none;
}
.boxtext
{	
     border: 1px solid #D1D1D1;
     color: #666666;
     font-family: 'MyriadPro-Bold';
     text-align: center;
}
</style>




<?php  ?>

<div class="teacher_dashboard_main">		  	
<div class="teacher_dashboard">Dashboard</div>
<div class=" student_images">
<div class="student_text">
<div class="student_spaes"></div>
<div class="student_requsted_texts">You have a new student booked for<span class="student_requsted_texts_span"> 08/27/2011 at 5:00pm</span></div>
<div class="student_requsted__gry_img"><img src="images/gry_white.png"/></div>
<div class="student_requsted_yellow"></div>

</div>

</div>
<!--teacher  middle part start-->
<div class="student_requsest_ratting_main">
<div class="student_requsest_ratting_left"><div class="student_requst_overview">Overview</div></div>
<div class="student_requsest_ratting_right">
<div class="student_requst_overview_left">
<select class="student_select">
<option>Octover</option>
<option>Octover</option>
</select>

<select class="student_select">
<option>2011</option>
<option>2011</option>
</select>
</div>
<div class="student_requst_overview_right">
<div class="student_requst_total_main">
<div class="student_requst_texts">Total Student</div>
<div class="student_requst_texts">Total Lesson</div>
<div class="student_requst_texts">Total Earnings</div>
<div class="student_requst_text">Avg.Profit/Student/Lesson</div>
<div class="student_requst_textyy">Avg.Rating</div>
</div>

<div class="student_requst_total_main">
<div class="student_requst_blue">10</div>
<div class="student_requst_blue">12</div>
<div class="student_requst_blue">$4,000</div>
<div class="student_requst_bi">$32.45</div>
<div class="student_requst_textyy_red">4.5</div>
</div>


<div class="student_main_img">
<div class="student_main_imgs"><?php echo $html->image('gry_star.png'); ?></div>
<div class="student_main_imgs"><?php echo $html->image('gry_star.png'); ?></div>
<div class="student_main_imgs"><?php echo $html->image('gry_star.png'); ?></div>
<div class="student_main_imgs"><?php echo $html->image('gry_star.png'); ?></div>
<div class="student_main_imgs"><?php echo $html->image('white_gry_star.png'); ?></div>

</div>

</div>

</div>

</div>

<!--Student second  middle-->
<div class="student_second_middle">
<div class="student_second_middle_left_two">
<div class="student_second_middle_left">
<div class="student_inner_left" id="studentshedule"><div class="shudual_text" id="lesson123" onClick="getShedule1()">Schedule</div></div>
<div class="student_inner_left" style="width:130px;" id="studentlesson"><div class="shudual_text"  id="lesson12" onClick="getStudent()" >Student</div></div>
<div class="shudual_white_student">Students</div>
<div class="main_nav">
<ul>
<li><a href="#">First Name</a></li><span class="nav_sap"></span>
<li><a href="#">Last Name</a></li>
</ul>
</div>
<div id="names">

</div>

</div>

<div class="clr"></div>
<div class="second_box">
<div class="view_text">View Students:</div>
<div class="clr"></div>
<div class="active_main">
<input type="checkbox" class="check_box"/>
<div class="check_text">Active</div>
</div>
<div class="clr"></div>
<div class="active_main">
<input type="checkbox" class="check_box"/>
<div class="check_text">Stopped</div>
</div>

<div class="red_btn"><a href="/dev1/teachers/addStudent" id="addstudent"><?php echo $html->image('red_add_btn.png'); ?></a></div>

</div>


</div>


<div id="content">
</div>
<div >
</div>
<div class="student_second_middle_right_part" id="contentFeatureReplace">
</div>


