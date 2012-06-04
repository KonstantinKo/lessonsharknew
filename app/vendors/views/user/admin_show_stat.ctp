<?php ?>
<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
	<div>
		  <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a>
		 / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a>
		 / Show Statistics
	</div>
	<fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Teacher Details </legend>

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
				    font-size: 13px;
				    padding: 5px 5px 5px 20px;
				    font-weight: inherit;
  				    font-style:italic;
				    color:#999999;	
				}
				.stat_first
				{
				 width:650px;
				 height:800px;
				 
				}
				.stat_second
				{
				  color:green;margin-bottom:20px;
				}
				.stat_third
				{
				 
				  width:200px;
				}	
			</style><?php //pr($teacher); 
				$date1=0;
					foreach($teacher as $value)
					 {
					   $timestamp = strtotime($value['User']['created']);  
					   $date1     = date('d-m-Y', $timestamp);
					  ?><div class="stat_third" ><?php  $date1; ?></div>

				   <?php }
                               
				?>
<div class="stat_first">
<div style="float:left;width:630px;margin:10px;border-bottom:1px solid;">
		<div style="width:50%;float:left;">
			<span class="headOfDetails">Sign Up Date</span>
		
			<span class="valueOfDetails" style="margin-left:108px;"><?php echo $date1; ?></span>
		</div>
		<div style="width:50%;float:left;">
			<span class="headOfDetails" style="margin-left:60px;">Number of student</span>
			<span class="valueOfDetails"><?php echo $count_student; ?></span>
		</div>
		<div style="width:100%;float:left;">
			<span class="headOfDetails">Total Student Signup This Month</span>
			<span class="valueOfDetails"><?php echo $count_this_month_student; ?></span>
			<span class="headOfDetails" style="margin-left:105px;padding-right: 18px;">Teacher's Profit</span>
			<span class="valueOfDetails" ><?php echo $teacher_profit; ?></span>
		</div>
		<div style="width:100%;float:left;">
			<span class="headOfDetails">Total Student Signup Last Month</span>
			<span class="valueOfDetails"><?php echo $count_last_month_student; ?></span>
			<span class="headOfDetails" style="margin-left:105px;padding-right: 18px;">Profile Complete</span>
			<span class="valueOfDetails" ><?php echo $profile_complete; ?>%</span>
		</div>
		
	</div>

			
				
				
			</div>

		</div>

	</fieldset>
</div>
