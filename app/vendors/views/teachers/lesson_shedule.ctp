<?php
$month    = array();
$year     = array();

$month['01']='jan';
$month['02']='feb';
$month['03']='mar';
$month['04']='apr';
$month['05']='may';

$month['06']='june';
$month['07']='july';
$month['08']='aug';
$month['09']='sep';
$month['10']='oct';
$month['11']='nov';
$month['12']='dec';

$year[2012]=2012;
$year[2013]=2013;
 ?>
<script>
    $('document').ready(function(){
	//alert('lesson Schdule');
	$("#makeup").fancybox({
		
	});
	
	 $("#attendance1").fancybox({
		
	});
	 $("#attendance2").fancybox({
		
	});
	 $("#attendance3").fancybox({
		
	});
	 $("#attendance4").fancybox({
		
	});
	 $("#attendance5").fancybox({
		
	});
	 $("#attendance6").fancybox({
		
	});





    })
 function getlessonid(id)   // this function is used for getting the lesson id on which the teacher click while edit attendance
	{
	
	    $("#lessonid").val(id);
	}

</script>

<div class="student_lessons_actve">
    <div class="active_text">Satus:<span class="active_text_span">Active</span></div>
</div>
<div class="months_main">
    <div class="months_left">
        <input type="radio" class="radio_main" name="datefilter" checked="true" value="thismonth" />
        <div class="radio_text">This Months</div>

    </div>
    <div class="text_or">OR</div>

    <div class="months_right">
	
        <div class="select_main">
            <input type="radio" class="select_radio" name="datefilter" value="monthbetween" />
	<?php echo $form->select('day',$month,null, array('label'=>'false','class'=>'select_text' ,'id'=>'monthfrom'),'Month');?>            
	
        </div>

        <div class="select_mains">

           <?php echo $form->select('day',$year,null, array('label'=>'false','class'=>'select_text' ,'id'=>'yearfrom'),'Year');?>        
        </div>

        <div class="select_main">
            <div class="select_to">to</div>
           <?php echo $form->select('day',$month,null, array('label'=>'false','class'=>'select_text' ,'id'=>'monthto'),'Month');?>        
        </div>


        <div class="select_mains">
          <?php echo $form->select('day',$year,null, array('label'=>'false','class'=>'select_text' ,'id'=>'yearto'),'Year');?>        
        </div>

        <div class="updates_btn" onClick="getLessonFilter()"><?php echo $html->image('updates_btn.png'); ?></div>

    </div>


</div>

<div class="months_main_tip">
    <div class="months_main_tip_left"><div class="months_main_tip_left_tx">Tips</div></div>
    <div class="months_dummy_pahra">All lessons automatically log as complete on their specified date.Click �Edit�
        under the lesson to change it or add tuition credit.

        <div class="months_dummy_pahra_to">Your students will be charged on the 1st of each month for either 4 or 5 lesson,dependinggon thier
            scheduled weekday</div>
        <div class="close_text"><a href="#">Close</a></div>
    </div>
</div>

<div class="table_main">
    <div class="table_main_left">
        <div class="table_main_left_inner">
            <div class="table_left_box"><div class="table_text_date">Date</div></div>
            <div class="table_left_box_to"><div class="table_text_date">Type</div></div>
            <div class="table_left_box_three"><div class="table_text_date">Details</div></div>
            <div class="table_left_box_fo"><div class="table_text_date">Make Up Credit</div></div>
            <div class="table_left_box_four"><div class="table_text_date">Student Balance</div></div>
            <div class="table_left_boxs"><div class="table_text_date">Profit</div></div>

        </div>
        <?php foreach($lesson as $lesson1) {
        $time		     = $lesson1['StudentLesson']['dateoflesson']; //starting day
        $date2		     = date('d/n',strtotime($time));  // used for showing  date in lesson column
	$day_new 	     = date('d/n/y'); 
        $lessondate2	     = date('d/n/y',strtotime($time)); 
	$lessondatetimestmap = strtotime($time);  //lessondatetimestmap
        $todaydatetimestmap = time(); // today datetimestmap
 	
	
          
	$lessonday= date('l',strtotime($time));//$time
        $day= date('d',strtotime($time));

        $lastday= date('Y-m-t',strtotime($time));
        $timestamp1 	    = strtotime($time);
        $timestamp2 	    = strtotime($lastday);
        $count_only 	    = array($lessonday);
        //echo $var	    = number_of_days_between($start_date, $finish_date, $count_only);

        $year1		    = date('Y',strtotime($time));
        $month1		    = date('m',strtotime($time));
        $day1		    = date('d',strtotime($time));

        $year2 		    = date('Y',strtotime($lastday));
        $month2 	    =date('m',strtotime($lastday));
        $day2 		    = date('d',strtotime($lastday));

        $start_date 	    = "$year1-$month1-$day1";
        $end_date    	    = "$year2-$month2-$day2";

        $date = mktime(0,0,0,$month1,$day1,$year1); //Gets Unix timestamp START DATE
        $date1 = mktime(0,0,0,$month2,$day2,$year2); //Gets Unix timestamp END DATE
        $difference = $date1-$date; //Calcuates Difference
        $daysago = floor($difference /60/60/24); //Calculates Days Old

        //echo "Total Days Between: ".$daysago;

        $i = 0;$count_day=0;
        while ($i <= $daysago +1) {
        if ($i != 0) { $date = $date + 86400; }
        else { $date = $date - 86400; }
        $today = date('l',$date);
        if( $lessonday==$today)
	{
		$count_day++;
	}

        $i++;
        }
        //echo $count_day;





        ?>
        <div class="table_main_left_inner_two">
            <div class="table_left_box"><div class="table_text_date_gree"><?php echo $date2; ?></div>
	     	</div>
            <div class="table_left_box_to"><div class="table_text_date_gree">Payment</div></div>
            <div class="table_left_box_three"><div class="table_text_date_gree"><?php if($lessondatetimestmap>$todaydatetimestmap){  echo $count_day; ?> Lesson at $25 each <?php  } else{ echo 'Completed'; } ?></div></div>
	   <div id="threediv<?php echo $lesson1['StudentLesson']['id']; ?>">
           <?php 

if($lesson1['StudentLesson']['tutioncredit']==1) // here we use if else for cheking which type of attendance is saved while editing attendance based on that there will be calculation done and data will be displayed 
			{ ?>
		<div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit'<?php echo  $lesson1['StudentLesson']['id'] ?>">1</div></div>
            <div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance <?php echo $lesson1['StudentLesson']['id'] ?>">+$0</div></div>
           <div class="table_left_boxs"><div class="table_text_date_gree" id="profit'<?php echo $lesson1['StudentLesson']['id'] ?>">$<?php echo $lesson1['StudentLesson']['paid']?> </div></div>
		<?php	}
			else if($lesson1['StudentLesson']['nocredit']==1)
			{ ?>
			    <div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit'<?php echo $lesson1['StudentLesson']['id'] ?> >">1</div></div>
            <div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance <?php echo $lesson1['StudentLesson']['id']?> ">-1 lesson</div></div>
           <div class="table_left_boxs"><div class="table_text_date_gree" id="profit<?php echo $lesson1['StudentLesson']['id']?> ">$<?php echo $lesson1['StudentLesson']['paid'] ?> </div></div>
  
			<?php }
			else if($lesson1['StudentLesson']['makeupcredit']==1)
			{ ?>
				<div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit<?php echo $lesson1['StudentLesson']['id'] ?> ">+1</div></div>
            <div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance <?php echo $lesson1['StudentLesson']['id'] ?>">-1 lesson</div></div>
      <div class="table_left_boxs"><div class="table_text_date_gree" id="profit'<?php echo $lesson1['StudentLesson']['id'] ?>">$ <?php echo $lesson1['StudentLesson']['paid'] ?> </div></div>
<?php 
			}
			else
			{
			}	
?>
	</div>

        </div>
        <?php } ?>



    </div>
    <div class="table_main_right">
        <div class="table_edit_comment">Edit/ Comment</div>
	<?php $count=0; foreach($lesson as $lesson1) { 
	$time		     = $lesson1['StudentLesson']['dateoflesson']; //starting day
        $date2		     = date('d/n',strtotime($time));  // used for showing  date in lesson column
	$day_new 	     = date('d/n/y'); 
        $lessondate2	     = date('d/n/y',strtotime($time)); 
	$lessondatetimestmap = strtotime($time);  //lessondatetimestmap
        $todaydatetimestmap  = time();   // today datetimestmap
 	$count++;			
		?>
        <div class="table_main_right_img" >
	<input type="hidden" id="lessonid"  value="">
	<?php if($lessondatetimestmap>$todaydatetimestmap){  } else{ ?> <a onClick="getlessonid(<?php echo $lesson1['StudentLesson']['id']; ?>)" href="/dev1/teachers/attendance" id="attendance<?php echo $count;?>" > <?php echo $html->image('detal_img.png'); ?></a><?php } ?>	
	</div>
               
       <?php } ?>
    </div>

</div>

<div class="light_banners">
    <div class="light_inner">
        <div class="light_inner_text">Matt Teacher:<span class="light_inner_text_sapn">Student cancelled but give plenty of notice</span></div>
        <div class="light_bootem">
            <div class="light_bootem_text"><a href="#">Edit-Delete</a></div>

        </div>
    </div>

</div>

<div class="table_mains">
    <div class="table_main_lefts" id="swapdiv">
        <?php foreach($makeup as  $makeup1) {
        $id=$makeup1['MakeupLesson']['id'];
	?>


        <div class="table_main_left_inner_two">
            <div class="table_left_box"><div class="table_text_date_gry"><?php echo $makeup1['MakeupLesson']['dateoflesson'];  echo '/'.$makeup1['MakeupLesson']['monthoflesson']; ?></div></div>
            <div class="table_left_box_to"><div class="table_text_date_gry">Lesson</div></div>
            <div class="table_left_box_three"><div class="table_text_date_gry">Make Up Lesson</div></div>
            <div class="table_left_box_fo"><div class="table_text_date_gry">-1</div></div>
            <div class="table_left_box_four"><div class="table_text_date_red"></div></div>
            <div class="table_left_boxs"><div class="table_text_date_red"></div></div>

        </div>




        <?php } ?>
        <?php foreach($futurelesson as  $futurelesson1) {
        //$id=$makeup1['MakeupLesson']['id'];
        //date($futurelesson1['StudentLesson']['dateoflesson'];
        $monthOne =date('m',strtotime($futurelesson1['StudentLesson']['dateoflesson']));
        $dayOne = date('d',strtotime($futurelesson1['StudentLesson']['dateoflesson']));
	?>


        <div class="table_main_left_inner_two">
            <div class="table_left_box"><div class="table_text_date_gry"><?php echo $monthOne  ?>/<?php echo $dayOne; ?></div></div>
            <div class="table_left_box_to"><div class="table_text_date_gry">Lesson</div></div>
            <div class="table_left_box_three"><div class="table_text_date_gry">Future</div></div>
            <div class="table_left_box_fo"><div class="table_text_date_gry">-1</div></div>
            <div class="table_left_box_four"><div class="table_text_date_red"></div></div>
            <div class="table_left_boxs"><div class="table_text_date_red"></div></div>

        </div>




        <?php } ?>
    </div>
</div>

<div class="value_main">
    <div class="table_left_box_fo"><div class="table_text_bi">1</div></div>
    <div class="table_left_box_four"><div class="table_text_bi">+$100</div></div>
    <div class="table_left_boxs"><div class="table_text_bi">$23.13</div></div>

</div>
<div class="clr"></div>
<div class="make_up_img"><a href="/dev1/teachers/makeup" id="makeup" ><?php echo $html->image('make_up_img.png'); ?></a></div>



<?php
foreach($payment as $pay)
		{
			// echo '<div>Date</div><div>'   .$pay['TeacherPayment']['payment_date']. '</div>';
			// echo '<div>Payment</div><div>'.$pay['TeacherPayment']['total_amount']. '</div>';
			// echo '<div ><a href="/lessonshark1/teachers/attendance" id="edit_attend" onClick="editattendance()" >Edit Attendance</a></div>';
		}
//pr($lesson);
?>
