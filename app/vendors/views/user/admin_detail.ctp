<?php
   
    //Sets the update and indicator elements by DOM ID
    $paginator->options(array('update' => 'user_listing', 'indicator' => 'loader_listing'));    
?>

<?php ?>
<?php

       echo $html->css('ui/jquery.ui.all');
       echo $html->css('ui/demos');

       echo $javascript->link('jquery');
       echo $javascript->link('jquery/jquery.form');
       echo $javascript->link('ui/jquery.ui.core');
       echo $javascript->link('ui/jquery.ui.core');
       echo $javascript->link('ui/jquery.ui.widget');
       echo $javascript->link('ui/jquery.ui.datepicker');

       

?>
<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
<div>
  <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Details
</div>
<fieldset>
  <legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"><span style="font-size:16px;"> Teacher Details</span> </legend>

<div id="showUserAdd">

<style>
	.headOfDetails
	{
	  float: left;
	    font-size: 15px;
	    padding: 5px;
	}
	.valueOfDetails
	{
	    float: left;
	    font-size: 15px;
	    padding: 5px 5px 5px 20px;
	    color:#999999;	
	    font-style:italic;	
	}
</style>
<script>
$(function() 
{
   $( "#datestart" ).datepicker
    ({
    changeMonth: true,
    changeYear: true
    });
   $( "#dateend" ).datepicker
    ({
	changeMonth: true,
	changeYear: true
    });
});

</script>
<?php
$count_teacher=0; 
	foreach($teacher_total as $teacher)
	  {

           $count_teacher++;
	  }


?>


<div style="width:650px;">
	<div style="float:left;width:630px;margin:10px;border-bottom:1px solid;">
		<?php    echo $form->create('FilterRecord', array('url' => array('controller' => 'users', 'action' => 'detail','admin'=>true)));?>
				<div style="width:100%;float:left;">
					<span class="headOfDetails">Filter By</span>
					<span class="valueOfDetails"><input id="datestart"  style=" width:120px;" name="data[datestart]" type="text"  value="start"/></span>
		<span class="valueOfDetails"><input id="dateend"  style=" width:120px;" name="data[dateend]" type="text"  value="end"/></span>
<input type="submit" value="Search" style="width:100px;float:left;"/>				
</div>
		 
		<?php echo $form->end(); ?>
		
	</div>


	<div style="float:left;width:630px;margin:10px;border-bottom:1px solid;">

		<div style="width:40%;float:left;">
			<span class="headOfDetails" >Lessonshark Total Profit</span>
			<span class="valueOfDetails"><?php echo $total_rev;?></span>
		</div>
		
		<div style="width:40%;float:left;">
			<span class="headOfDetails" style="width:173px;">Total Teachers</span>
			<span class="valueOfDetails"><?php echo $count_teacher;?></span>
		</div>
		<div style="width:40%;float:left;">
			<span class="headOfDetails" style="width:171px;">Total Cancelled Teacher</span>
			<span class="valueOfDetails"><?php echo $total_teacher_cancel;?></span>
		</div>
                <div style="width:40%;float:left;">
			<span class="headOfDetails">Total Lessonshark Profit</span>
			<span class="valueOfDetails"><?php echo $profit1;?></span>
		</div>
                <div style="width:40%;float:left;">
			<span class="headOfDetails" style="width:167px;">Total Teachers Profit</span>
			<span class="valueOfDetails" ><?php echo $total_teacher_profit;?></span>
		</div>

	</div>


 <div style="  float: left;    margin-left: 10px;    margin-right: 10px;    min-height: 200px;
">
    
<div style="font-size: 16px;    margin-bottom: 10px;    margin-left: 4px;    margin-top: 10px;color: #FF7800;border-bottom:1px solid #FF7800;width:125px;"> List Of Teachers</div>
 <div style="margin-left:18px;">

<?php  $count_teacher=0; 
	foreach($teacher_total as $teacher)
	  {
?>
               <div style="width:195px;float:left;color:black!important;"> <?php echo $teacher['User']['username'];$count_teacher++;?></div>	<?php

	  }

?>
</div>
 </div>
</div>

</div>
<?php echo $this->element('pagination'); ?>
<?php
	
    $paginator->options(array('url' => $this->passedArgs));
?>




</fieldset>
</div>


