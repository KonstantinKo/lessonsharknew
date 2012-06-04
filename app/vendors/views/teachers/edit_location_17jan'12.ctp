 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){

		 var homevalue = $(":checked").val()
		       if(homevalue=='home')
		       {
			 $('#studio1').hide();	  		
			 $('#home1').show();
		       }
                      else if(homevalue=='studio')
		       {
                         $('#home1').hide();
	  		 $('#studio1').show();
		       }
		      else
			{ 
			 $('#home1').hide();
			 $('#studio1').hide();
			}	      

	     

		$("#home").click(function() 
		{
			 $('#studio1').hide();	  		
			 $('#home1').show();
			
		});
		$("#studio").click(function() 
		{
			 $('#home1').hide();
	  		 $('#studio1').show();
			
		});


	 })
	function getedit(lid, id)
		{
			$('#'+lid).addClass("location_middle_one_inner_gry");
			$('#deletelocation').attr('href', '/lessonshark1/teachers/dellocation/'+id+'/'+lid);
			$('#editlocation').attr('href', '/lessonshark1/teachers/editLocation/'+id+'/'+lid);
			
			
		}
	
</script>





<div class="new_edit_back"></div>
		<div class="clr"></div>
		<div class="new_edit_tex">Add or Edit Your Teaching Locations</div>
		<div class="clr"></div>
		<div class="location_top_text">Enter the locations where you teach during the week.<span class="location_top_text_span">Note:full addresses are only displayed to students who book lesson with you.<br>
		prospective students viewing  your profile will only see zip codes.</span>
		</div>
		<div class="location_middle_main">
			<div class="location_middle_left">
				<div class="location_middle_one_inner"><div class="location_middle_one_tx">Locations</div></div>
				<!--<div class="location_middle_one_inner_gry"><div class="location_middle_one_txer">Abbey Road Studio</div></div>-->
				<?php foreach($teacherlocation as $location)
				{?>
			 		<div class="location_middle_one_txer" id="<?php echo $location['TeacherLocation']['id']; ?>" onclick="getedit(<?php echo $location['TeacherLocation']['id'].','. $id ?>)"><?php echo $location['TeacherLocation']['city']; ?></div>
				<?php  } ?>				
				
				<div class="clr"></div>
				<div class="location_bootem_btn">
					<a href="/lesonshark1/teachers/editLocation/"<?php echo $id; ?>  id="addlocation" ><?php echo $html->image('add_plus.png'); ?></a>
					<a href="" id="deletelocation"><?php echo $html->image('delete_btn.png'); ?></a>
					<a href="" id="editlocation"><?php echo $html->image('edit_loction.png'); ?></a>
					
				</div>
			</div>

<?php   pr($loc); echo $form->create('TeacherMedias', array('url' => array('controller' => 'teachers', 'action' => 'editLocation',$id)));?>
			<div class="location_middle_right">

						

				<div class="location_bootem_studio_main" >
					<div class="location_bootem_studio_left">
					
	   					<input type="radio" name="data[TeacherLocation][type]" value="studio" id="studio" class="location_radio_btn">
						<div class="location_radio_btn">Studio Address</div>
						<div class="location_qution_img"><?php echo $html->image('sky_qustion.png'); ?></div>
				        </div>
					<div class="location_bootem_studio_right">
						<input type="radio" name="data[TeacherLocation][type]" value="home" id="home" checked="checked" class="location_radio_btn">
	   					<div class="location_radio_btn">In-Home Area</div>
						<div class="location_qution_img"><?php echo $html->image('sky_qustion.png'); ?></div>
					</div>
				</div>
				<div id="home1">				
					<div class="location_in_home" >In-Home Area Name</div>
					<input id="TeacherLocationZip" name="data[TeacherLocation][city1]" type="text" class="location_in_home_zips" />
					<div class="location_in_home_zip">Zip Code</div>
					<input id="TeacherLocationZip" name="data[TeacherLocation][zip]" type="text" class="location_in_home_zips" />
					<div class="location_bootem_studio_lefter">
						<div class="location_in_home_radius">Radius</div>
						<div class="location_qution_imges"><?php echo $html->image('sky_qustion.png'); ?></div>
					</div>
				        <div class="clr"></div>
				       <input id="TeacherLocatonRadius" name="data[TeacherLocation][radius]" type="text" class="location_in_home_radius_bx"/>
				
				      <div class="location_in_home_miles">Miles</div>
			     </div>


				<div id="studio1">
					<div class="location_in_home" >Address1</div>
					<input id="TeacherLocationAddress1" name="data[TeacherLocation][address1]" type="text" class="location_in_home_input"/>
					<div class="location_in_home" >Address2</div>
					<input id="TeacherLocatonAddress2" name="data[TeacherLocation][address2]" type="text" class="location_in_home_input" />
					<div class="location_in_home" >City</div>
					<input id="TeacherLocatonCity1" name="data[TeacherLocation][city]" type="text" class="location_in_home_input" />
					<div class="location_in_home" >State</div>
					<input id="TeacherLocatonState" name="data[TeacherLocation][state]" type="text"  class="location_in_home_input" />
					<div class="location_in_home" >Zip</div>
					<input id="TeacherLocatonZip" name="data[TeacherLocation][zip1]" type="text" class="location_in_home_input" />
					
			        </div>				





				
			
			     </div>
		<div class="submit_image">	<input type="submit" value="Save"></div>
 <?php echo $form->end(); ?>
		
		
		</div>
		<div class="clr"></div>
		
	
	<div class="clr"></div>





  



 
