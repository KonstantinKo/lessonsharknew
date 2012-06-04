<?php
$day=array();
$day['1']='monday';
$day['2']='tuessay';
$day['3']='wednesday';
$day['4']='thursday';
$day['5']='friday';

$time=array();
$time['1']='1';
$time['2']='2';
$time['3']='3';
$time['4']='4';
$time['5']='5';


 ?>

<div class="home_page_pop_box">
<?php  echo $form->create('User', array('url' => array('controller' => 'students', 'action' => 'editShedule')));?>
<input type="hidden" name="data[User][hidd]" value="<?php echo $tid; ?>" >
<div>Location</div><?php echo $form->select('location',$loc,null, array('label'=>'false','div'=>'','class'=>'student_select'));?>
<div>Time</div><?php echo $form->select('time',$time,null, array('label'=>'false','div'=>'','class'=>'student_select'));?>
<div>Day</div><?php echo $form->select('day',$day,null, array('label'=>'false','div'=>'','class'=>'student_select'));?>
<div>Duration</div><?php echo $form->select('duration',$duration,null, array('label'=>'false','div'=>'','class'=>'student_dropdown'));?>
<input type="submit" value="Save">
<?php echo  $form->end(); ?>
</div>


