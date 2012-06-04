				

					</div>
		
	</div>
	
<?php //pr($selectedGarages);
//echo $name;
//echo "<br>";
//echo $dist;
//pr($_SESSION['searchQuery']['homes']);
$totalTime = $_SESSION['searchQuery']['homes']['returnTime']-$_SESSION['searchQuery']['homes']['arrivalTime'];
$dayHrs = abs($_SESSION['days'])*24;

$time = $_SESSION['time'];
if($time>0)
{
	$totalhrs = $dayHrs+$time;
}
else
{
	$totalhrs = $dayHrs-abs($time);
}


?>

	<div class="midContainer">
		<div class="clr"></div>
		<div class="midContainer_top_textnew">You are almost finished.<br>
				Double check to make sure the below itinerary matches your</div>
				<div class="confirm_sap"></div>
		<div class="confirm_middle_main_conten">
					<div class="confirm_middle_main_conten_left">
						<div class="confirm_middle_main_conten_left_img"></div>
						<div class="confirm_middle_main_conten_left_gry_box">
						<div class="confirm_middle_main_conten_left_gry_text">
						Youve selected <?php echo $selectedGarages['GarageAvailSpace']['facility_type']?> <?php echo $name;?>, which is <?php echo $dist;?> miles from <?php echo $_SESSION['searchQuery']['homes']['address'];?></div>
																		</div>
					
					
					<div class="confirm_middle_main_conten_left_gry_box">
						<div class="confirm_middle_main_conten_left_gry_text">
						Youve selected a <?php echo $selectedGarages['GarageAvailSpace']['facility_type']?> facility</div>
																		</div>
						<div class="confirm_middle_main_conten_left_gry_box">
						<div class="confirm_middle_main_conten_left_gry_text">
						Youve selected an hourly rate of $<?php echo $selectedGarages['Garage']['rate_hrs'];?></div>
																		</div>
<div class="confirm_middle_main_conten_left_gry_box">
						<div class="confirm_middle_main_conten_left_gry_text">
						Youve selected  <?php echo $totalhrs;?> hours of parking at this location</div>
																	
<div class="confirm_middle_main_conten_left_gry_box" style="border-top: 1px solid #FFFFFF;">
						<div class="confirm_middle_main_conten_left_gry_text">
						Youre total standard parking fee is $<?php echo $totalhrs*$selectedGarages['Garage']['rate_hrs'];?> for your stay</div>
																		</div>
					</div>
					<div class="confirm_middle_main_conten_left_green" style="margin-top:50px;">
					Click yes if this correct. To make changes to this reservation, click edit</div>
					<div class="confirm_middle_main_conten_left_btn_main">
						<div class="confirm_middle_main_conten_left_one">
							<?php echo $html->image('images/yes_btn.png'); ?>
						</div>
						<div class="confirm_middle_main_conten_left_two">
							<a href="/parker/homes/searchResult"><?php echo $html->image('images/edit_btn.png'); ?></a>
						</div>
					
					</div>
					
					</div>


					<div class="confirm_middle_main_conten_right">
						<div class="confirm_middle_main_conten_right_adv"></div>
					</div>
				
		
		
		
	
		
	</div>
</div>
