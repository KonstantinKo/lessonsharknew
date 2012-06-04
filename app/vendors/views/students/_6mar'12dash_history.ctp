<?php echo $javascript->link('jquery');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>

<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>
	
<script>
j = $.noConflict();
j('document').ready(function(){ 
	 j('#StudentYear').change(function() 
                {
		
		    j('#StudentAddForm').submit();
               });  

	j("#login").fancybox({
			'showCloseButton'	: false,
			
			
		});

});

</script>


<?php 
 $total='';
 $amount=''; 
 $date1=''; 
 $today = '';
 $pending='';
foreach($payment as $payment1)
{
	 $total=$payment1['TeacherPayment']['total_amount'];
	 $amount=$payment1['TeacherPayment']['amount']; 
	 $date1=$payment1['TeacherPayment']['payment_date']; 
         $today = date("m/d");
	$pending=$total-$amount;		
	//$phone  ='not available';

          
}
$month= array();
$month[1]='January';
$month[2]='Feburary';
$month[3]='March';
$month[4]='April';
$month[5]='May';
$month[6]='June';
$month[7]='July';
$month[8]='August';
$month[9]='September';
$month[10]='October';
$month[11]='November';
$month[12]='December';
$year=array();
$year[2011]='2011';
$year[2012]='2012';
$year[2013]='2013';
$year[2014]='2014';

 foreach($record as $rec)
	{
	
	  $firstname=$rec['User']['firstname'];
	  $phone=$rec['User']['phone']; 
	  $email=$rec['User']['email'];
	} 
?>
<div class="student">
    <div class=" student_images">
        <div class="student_text">
            <div class="student_spaes"></div>
            <div class="student_requsted_text">Your teacher has requested a change to your account</div>
            <div class="student_requsted_yellow"></div>
            <div class="student_right_text">Get 10% of on</div>
            <div class="student_right_text">Next Month's lessson</div>

        </div>
    </div>
<?php  echo $form->create('Student', array('url' => array('controller' => 'students', 'action' => 'dashHistory')));?>
    <div class="student_history_main">
        <div class="student_historytex">Lesson History</div>
       	<?php echo $form->select('month',$month,null, array('label'=>'false','div'=>'','class'=>'student_select'));?>
	<?php echo $form->select('year',$year,null, array('label'=>'false','div'=>'','class'=>'student_dropdown'));?>
       
    </div>
 <?php echo $form->end(); ?>
    <div class="student_main">
        <div class="student_part_left">
            <div class="student_iner_left_middle">
                <div class="studen_middle_inner_part">
                    <div class="student_date_text"><span class="span_date">Date</span></div>
                    <div class="student_date_two"><span class="span_date">Description</span></div>
                    <div class="student_date_three"><span class="span_date">Details</span></div>
                    <div class="student_date_text"><span class="span_date">Make-up Credit Blance</span></div>
                    <div class="student_date_text"><span class="span_date">Tution Blance</span></div>
                    <div class="student_date_last"><span class="span_date">Comments</span><div class="buble_img"><img src="images/bubble_icons_03.jpg"/></div></div>

                </div>
                <div class="studen_middle_inner_second">
                    


                   

                    <div class="student_date_text"><span class="span_color"><?php echo $today;?></span></div>
                    <div class="student_date_two"><span class="student_automatciall_text">Automatic<br>Payment</br></span></div>
                    <div class="student_date_three"><span class="span_color">5 Lessons Payment</span></div>
                    <div class="student_date_text"><span class="span_color">+1</span></div>
                    <div class="student_date_text"><span class="span_color"><?php echo '$'.$pending; ?></span></div>
                    <div class="student_date_last"><span class="span_color"><?php echo $html->image('plus_aad_03.jpg'); ?></span></div>

                </div>

            </div>

            <div class="student_iner_left">
                <div class="student_lesson_details_left">
                    <div class="student_lesson_text">Lesson Details</div>
                    <div class="student_lesson_details_left_iiner">
                        <div class="student_lesson_details_text">Lesson Location</div>
                        <div class="student_lesson_lorum_lane">
                            <div class="student_lesson_text_two">Teachers Studio at: </div>
                            <div class="student_lesson_span">123 Lorem Lane New York, NY, 12345	</div>

                        </div>
                        <div class="student_lesson_lorum_lane_two">


                        </div><div class="student_lesson_lorum_lane">
                            <div class="student_lesson_text_two">Lesson Duration: </div>
                            <div class="student_lesson_span">30 mintues	          </div>

                        </div><div class="student_lesson_lorum_lane">
                            <div class="student_lesson_text_two">Scheduled Weekday:</div>
                            <div class="student_lesson_span">Monady	      </div>
                        </div><div class="student_lesson_lorum_lane">
                            <div class="student_lesson_text_two">Lesson Time: </div>
                            <div class="student_lesson_span">4pm	      </div>
                        </div><div class="student_lesson_lorum_lane">
                            <div class="student_lesson_text_two">Start Date: </div>
                            <div class="student_lesson_span">october 25,2010 </div>



                        </div>

                        <div class="student_edit_bu"><a href="/dev1/students/editShedule" id="login">logindiv</a></div>

                    </div>

                </div>
                <div class="student_teacher_details_right">
                    <div class="student_lesson_text">Teacher Details</div>
                    <div class="student_lesson_details_left_iiner">
                        <div class="student_lesson_lorum_lane">
                            <a href="/dev1/teachers/contentPolicy/<?php echo $tid; ?>"> <div class="studen_poltices_bu"></div></a>
                        </div>
                        <div class="student_lesson_text_four">See cancellation, Holidays, make-ups etc details that apply</div>
                        <div class="student_lesson_text_foures">Name:<span class="student_lesson_text_span"><?php echo $firstname; ?></span></div>
                        <div class="student_lesson_text_foures">Phone:<span class="student_lesson_text_span"><?php echo $phone; ?></span></div>
                        <div class="student_lesson_text_foures">Email:<span class="student_lesson_text_span"><?php echo $email; ?></span></div>
                        <a href="/dev1/teachers/contentProfile/<?php echo $tid; ?>"><div class="student_mellis_profile"></div></a>

                    </div>

                </div>

            </div>
        </div>

        <div class="student_sap"></div>
        <div class="student_part_right">
            <div class="student_rating">Ratings</div>
            <div class="student_rating_text">Rate your teacher in under a minute!</div>
            <div class="student_rating_texts">Ratings give other students insight into what your teacher is like.</div>
            <div class="student_rating_texts">By rating your teacher you help others make more informed decisions about which teacher to choose.</div>
            <div class="student_bu"><?php echo $html->image('review_now_11.jpg'); ?></div>
            <div class="student_saprater"></div>
            <div class="student_rating_re">Review</div>
            <div class="student_rating_text">The power is yours!</div>
            <div class="student_rating_texts">By rating your teacher you help others make more informed decisions about which teacher to choose.</div>
            <div class="student_bu"><?php echo $html->image('beetween_sap_22.jpg'); ?></div>

        </div>

    </div>


</div>

