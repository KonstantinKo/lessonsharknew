<?php
	if($hasErrors)
	{
		echo '<div id="flashMessage" class="error edit_general_notify">An error has occurred. See below for details.</div>';
	}
	else if($save)
	{
		echo '<div id="flashMessage" class="saved edit_general_notify">Your offering updates have been saved.</div>';
	}
?>

<!--Creates a border around the profile-->

<div class="profile_border">	
	
	<a href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'contentProfile')); ?>">
		<div class="new_edit_back"></div>
	</a>
	<div class="clr"></div>
	
	<div class="new_edit_tex"><h1>Your Lesson Offerings</h1></div>
	
	
	<div class="edit_lessons_text_twos">
		Use this area to define the types of lessons that you are offering. Select a discipline, then define the duration of each type of lesson, where this kind of lesson takes place, and the accompanying rate. Then, use the description field to detail how you teach and what students can expect from your lessons.		
	</div>
	
	<?php
		if($loc_count == 0)
		{
			echo '<div class="highlight_long break">You will not be able to save a lesson offering until you have a location, so <a href="'.$html->url(array('controller' => 'teachers', 'action'=>'editLocation')).'">add a location</a> first.</div>';
		}
	?>
	
	<?php  echo $form->create('TeacherDesciplineField', array('url' => array('controller' => 'teachers', 'action' => 'editProfile'))); ?>
		<div class="new_edit_select_lesson_box">
			<select id="TeacherDesciplineDname" name="data[TeacherDescipline][id]">
				<?php
					foreach($desciplines as $d)
					{
						echo '<option value="'.$d['TeacherDescipline']['id'].'">'.$d['TeacherDescipline']['dname'].'</option>'; 
					}
				?>
	       	</select>
	       	
	     	<div id="store" style="display: none;">
	     		<?php
	     			//loop through so we can rebuild later
					foreach($desciplines as $d)
					{
						echo '<option value="'.$d['TeacherDescipline']['id'].'">'.$d['TeacherDescipline']['dname'].'</option>'; 
					}
				?>	     	
	     	</div>
	     	<div id="temp" style="display: none;"></div>
	       	<input id="add_button" type="button" value="Add a Lesson Offering" class="regular_button">
	       	
       	</div>
  	<?php echo $form->end(); ?>
  	
  	<?php  echo $form->create('Offerings', array('url' => array('controller' => 'teachers', 'action' => 'editProfile'))); ?>
  	
	  	<div id="lesson_blank" class="lesson_heading">
	  		<ul>
	  			<li class="lesson_plus">Lesson Offering +</li>
	  		</ul>	
	  	</div>
	  	
	  	<div id="lesson_full" class="lesson_heading" style="display: none;">
	  		<ul id="lesson_groups">
	  		</ul>	
	  	</div>
	  	
	  	<a class="deleteLink" style="display: none;"><span class="deleter">Delete</span> Entire <span class="deleteOffering"></span> Offering</a>
	  	
	  	<?php 
	  		$offers = array('drums', 'guitar', 'piano', 'violin', 'voice');
	  		$nulloffers = array('drums', 'guitar', 'piano', 'violin', 'voice', 'none');
	  		
	  		foreach($offers as $o)  	
	  			echo $form->input('has_'.$o, array('id' => 'has'.$o, 'value' => $this->data['Offerings']['has_'.$o], 'label'  => '', 'div'=>'', 'style' => 'display: none;'));
	  	
	  		
	  		
			foreach($nulloffers as $n)
			{
				$i = 0;

				if(isset($errors[$n]))
					echo '<div class="'.$n.'_error" style="display: none;">true</div>';
				else
					echo '<div class="'.$n.'_error" style="display: none;">false</div>';
					
				echo $form->input('count_'.$n, array('id' => 'count'.$n, 'value' => $i, 'label'  => '', 'div'=>'', 'style' => 'display: none;'));
		?>	
			  	<div class="boxes lesson_box break <?php if($n == 'none') { echo 'noLesson'; } else { echo 'yesLesson'; } ?>" id="box_<?php echo $n; ?>" >
			  		<table cellpadding="0" cellspacing="0" class="offer_table">
			  			<thead>
			  				<th class="duration">Duration (min.)</th>
			  				<th class="location">Location(s)</th>
			  				<th class="rate">Rate (USD/hr)</th>
			  				<th class="delete">Delete</th>
			  			</thead>
			  			<tbody>
			  			
			  			<?php
			  				if(empty($this->data))
			  				{
			  			?>
				  				<tr id="<?php echo $n.'0row'; ?>">
				  					<td class="duration">
				  						<?php
				  							if($n == 'none')
				  								echo '&nbsp;'.$form->input($n.'.'.$i.'.duration', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>0));
				  							else
				  								echo '&nbsp;'.$form->input($n.'.'.$i.'.duration', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>3));
				  						?>
				  					</td>
				  					<td class="location">
				  						<select id="<?php echo $n.$i.'location'; ?>" name="data[<?php echo $n; ?>][<?php echo $i; ?>][location]">
											<?php
												if($loc_count < 1)
												{
													echo '<option value="0">Create a location</option>';
												}
												else
												{
													echo '<option value="0">Select a location</option>';
												
													foreach($locations as $k => $v)
													{
														echo '<option value="'.$k.'">'.$v.'</option>'; 
													}
												}
											?>
		       							</select>
				  					</td>
				  					<td class="rate">
				  						<?php
				  							if($n == 'none')
				  								echo '$&nbsp;'.$form->input($n.'.'.$i.'.rate', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>0));
				  							else
				  								echo '$&nbsp;'.$form->input($n.'.'.$i.'.rate', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>10));
				  						?>
				  					</td>
				  					<td class="delete">
				  						<a class="deleteOffer" name="<?php echo $n.'_'.$i; ?>">Delete</a>
				  						
				  						<!-- extra stuff -->
				  						<?php
				  							if($n == 'none')
				  								echo $form->input($n.'.'.$i.'.teacher_descipline_field_id', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>10, 'style' =>'display:none;'));
				  							else
				  								echo $form->input($n.'.'.$i.'.teacher_descipline_field_id', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>10, 'style' =>'display:none;'));
				  						?>
				  					</td>
				  				</tr>
				  		<?php
				  			}
				  			else
				  			{
				  				foreach($this->data[$n] as $key => $value)
				  				{
				  					if(is_numeric($key))
				  					{
				  		?>
								  		<tr id="<?php echo $n.$key.'row'; ?>">
						  					<td class="duration">
						  						<?php
						  							if($n == 'none')
						  							{
						  								echo '&nbsp;'.$form->input($n.'.'.$key.'.duration', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>0));
						  							
						  								if(isset($errors[$n][$key]['duration']) && !empty($errors[$n][$key]['duration']))
						  									echo '<div class="error-message">'.$errors[$n][$key]['duration'].'</div>';
						  							
						  							}
						  							else
						  							{
						  								echo '&nbsp;'.$form->input($n.'.'.$key.'.duration', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>3));
						  								
						  								
						  								if(isset($errors[$n][$key]['duration']) && !empty($errors[$n][$key]['duration']))
						  									echo '<div class="error-message">'.$errors[$n][$key]['duration'].'</div>';
						  							
						  							}
						  						?>
						  					</td>
						  					<td class="location">
						  						<select id="<?php echo $n.$key.'location'; ?>" name="data[<?php echo $n; ?>][<?php echo $key; ?>][location]">
													<?php
														if($loc_count < 1)
														{
															echo '<option value="-1">Create a location</option>';	
														}
														else
														{
															echo '<option value="0">Select a location</option>';
														
															foreach($locations as $k => $v)
															{
																if($this->data[$n][$key]['location'] == $k)
																	echo '<option value="'.$k.'" selected>'.$v.'</option>'; 
																else
																	echo '<option value="'.$k.'">'.$v.'</option>'; 
															}
														}
													?>
				       							</select>
				       							<?php
				       								if($loc_count < 1)
													{
														if(isset($errors[$n][$key]['location']) && !empty($errors[$n][$key]['location']))
					  										echo '<div class="error-message">'.$errors[$n][$key]['location'].'</div>';
													}
													else
													{
														if(isset($errors[$n][$key]['location']) && !empty($errors[$n][$key]['location']))
					  										echo '<div class="error-message">'.$errors[$n][$key]['location'].'</div>';
													}
												?>
						  					</td>
						  					<td class="rate">
						  						<?php
						  							if($n == 'none')
						  							{
						  								echo '$&nbsp;'.$form->input($n.'.'.$key.'.rate', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>0));
						  								
						  								if(isset($errors[$n][$key]['rate']) && !empty($errors[$n][$key]['rate']))
						  									echo '<div class="error-message">'.$errors[$n][$key]['rate'].'</div>';
						  							}
						  							else
						  							{
						  								echo '$&nbsp;'.$form->input($n.'.'.$key.'.rate', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>10));
						  								
						  								if(isset($errors[$n][$key]['rate']) && !empty($errors[$n][$key]['rate']))
						  									echo '<div class="error-message">'.$errors[$n][$key]['rate'].'</div>';
						  							}
						  						?>
						  					</td>
						  					<td class="delete">
						  						<a class="deleteOffer" name="<?php echo $n.'_'.$key; ?>">Delete</a>
						  						
						  						
						  						<!-- extra stuff -->
						  						<?php
						  							if($n == 'none')
						  								echo $form->input($n.'.'.$key.'.teacher_descipline_field_id', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>50, 'style' =>'display:none;'));
						  							else
						  								echo $form->input($n.'.'.$key.'.teacher_descipline_field_id', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>50, 'style' =>'display:none;'));
						  						?>
						  					</td>
						  				</tr>
				  		<?php
				  					}
				  				}
				  			}
				  		?>
				  							  		
			  			</tbody>
			  					
			  		</table>
			  		<div class="offer_add">
						<span class="add_button" name="<?php echo $n; ?>">+ Add another lesson package"</span>
					</div>
					<div>
						<div class="field_title">Description</div>
						<?php
							echo $form->textarea($n.'.description', array('escape' => true, 'class' => 'desc_area'));
							echo $form->input($n.'.description_id', array('label'  => false, 'div'=>'', 'size'=>25, 'maxlength'=>50, 'style' =>'display:none;'));
							
							if(isset($errors[$n]['description']) && !empty($errors[$n]['description']))
						  		echo '<div class="error-message">'.$errors[$n]['description'].'</div>';
						?>
					</div>
			  	</div>
		<?php
			}
		?>
	  	
	  	<div class="left_button break">
			<input type="submit" value="Save All Offerings" class="submit_button">
		</div>
	<?php echo $form->end(); ?>
	
	
</div>

<span id="listcount" style="display: none;">0</span>

<script>


	$(document).ready(function()
	{
        LoadOfferings();
        
	  	/******************************************
  		 * Add lesson offering
		 *****************************************/

		$("#add_button").live("click", function()
		{
			var offer_val = $('#TeacherDesciplineDname').val();
			var offer_text = $('#TeacherDesciplineDname option[value="' + offer_val + '"]').text();
			
			if(offer_val != -1)
			{
				if($('#lesson_blank').is(':visible'))
					$('#lesson_blank').hide();
					
				//remove all the other previous active ones
				$('#lesson_groups li').removeClass('lesson_active');
				
				RemoveErrors();
				
				//remove from the select list
				$('#TeacherDesciplineDname option[value="' + offer_val + '"]').remove();
				
				//if we have no options left, then append the no options
				if($('#TeacherDesciplineDname option').size() < 1)
					$('#TeacherDesciplineDname').append('<option value="-1">No desciplines left</option>');
				
				var list = '<li class="lesson_active" id="' + offer_text + '">' + offer_text + '</li>';
					
				if($('.' + offer_text + '_error').text() == 'true')
				{
					RemoveErrors();
					
					list = '<li class="error_active" id="' + offer_text + '">' + offer_text + '</li>';
				}
				
				$('.deleteOffering').text(offer_text);
				$('.deleteLink').show();
				
				$('#lesson_full').show();
				
				$('.lesson_box').hide();
				$('#box_' + offer_text.toLowerCase()).show();
				
				$('#has' + offer_text.toLowerCase()).val('1');
				
				$('#lesson_groups').append(list);
				
				var temp = parseInt($('#listcount').text()) + 1;
				
				$('#listcount').text(temp);
				
				var i = $('#count' + offer_text.toLowerCase()).val();
				i = i - 1;
				
				while(i > -1)
				{
					$('#' + offer_text.toLowerCase() + i + 'row').remove();
					i--;
				}
			}
		});
		
		/******************************************
  		 * Rotate between different lesson offerings
		 *****************************************/

		$("#lesson_groups li").live("click", function()
		{
			//remove all the other previous active ones
			$('#lesson_groups li').removeClass('lesson_active');
			
			RemoveErrors();
			
			
			var text = $(this).text().toLowerCase();
			
			$(this).addClass('lesson_active');
			
			if($('.' + text + '_error').text() == 'true')
			{
				RemoveErrors();
				
				$(this).removeClass('lesson_active').removeClass('block_error').addClass('error_active');
			}
			
			$('.deleteOffering').text($(this).text());
			$('.deleteLink').show();					
			
			$('.lesson_box').hide();
			$('#box_' + text).show();
			
			var id = $(this).attr('id');
		});
		
		/******************************************
  		 * Add more offers, locations
		 *****************************************/

		$(".add_button").live("click", function()
		{
			var text = $(this).attr('name');
			var count = $('#count' + text).val();
			
			count = parseInt(count) + 1;
			
			addMoreOfferings(text, count);
		});
		
		/******************************************
  		 * Delete offers, locations
		 *****************************************/

		$(".deleteOffer").live("click", function()
		{
			var name = $(this).attr('name');
			
			var nameArray = name.split('_');
			var desc = nameArray[0];
			var num = nameArray[1];
			
			var field_id = $('#' + desc + num + 'TeacherDesciplineFieldId').val();
			
			var html = '';
			
			if($('.offer_table tbody tr:visible').size() == 1)
			{
				//we need to save the last table row before deleting
				var text = desc;
				var count = $('#count' + text).val();
				
				html = $('#box_none tbody tr:eq(0)').html();
		
				html = html.replace(/none0/g, text + count);
				html = html.replace(/\[none\]\[0\]/g, '[' + text + '][' + count + ']');
				html = html.replace(/none_0/g, text + '_' + count);
				
				//get first maxlength
				html = html.replace('maxlength="0"', 'maxlength="3"');
				
				//get second maxlength
				html = html.replace('maxlength="0"', 'maxlength="10"');
				
				html = '<tr id="' + desc + num + 'row">' + html + '</tr>';
			}
			
			if(field_id == '')
			{
				//not saved in db, so just delete from ui
				
				$('#' + desc + num + 'row').remove();
				
				if($('.offer_table tbody tr:visible').size() == 0)
				{
					//append a new row if we have none left
					$('#box_' + desc + ' tbody').append(html);
				}
				
				//rehighlight rows				
				$('.offer_table tbody tr').removeClass('even');
	    		$('.offer_table tbody tr:nth-child(even)').addClass('even');				
			}
			else
			{
				//need to do ajax to delete from db
				
				$(this).text('Deleting...');
								
				var deleteUrl = '<?php echo $html->url(array('controller'=> 'teachers', 'action' => 'ajax_offering_delete')); ?>/';
						
				$.ajax(
				{
					url: deleteUrl + '-1/' + field_id,
					cache: false,
					success: function(data)
					{
						//record deleted
						$('#' + desc + num + 'row').remove();
				
						if($('.offer_table tbody tr:visible').size() == 0)
						{
							//append a new row if we have none left
							$('#box_' + desc + ' tbody').append(html);
						}
						
						//rehighlight rows				
						$('.offer_table tbody tr').removeClass('even');
			    		$('.offer_table tbody tr:nth-child(even)').addClass('even');
					}
				});
			}
		});
		
		/******************************************
  		 * Delete entire offering
		 *****************************************/

		$(".deleteLink").live("click", function()
		{
			var r = confirm("Are you sure you want to delete this entire offering?");

			if (r == true)
  			{
				var type = $(this).find('.deleteOffering').text().toLowerCase();
				
				$('.deleter').text('Deleting');
									
				var deleteUrl = '<?php echo $html->url(array('controller'=> 'teachers', 'action' => 'ajax_offering_delete')); ?>/';
						
				var leftover = $('#lesson_groups li').size();
				$('#leftover').text(leftover - 1);
				
				$.ajax(
				{
					url: deleteUrl + type + '/-1',
					cache: false,
					success: function(data)
					{
						//record deleted
						
						$('#has' + type).val(0);
						
						//add a new row that will act as the default row
						var count = $('#count' + type).val();
				
						count = parseInt(count) + 1;
				
						//	$('#count' + type).val(count);
				
						addMoreOfferings(type, count);
						
						//next we delete and remove all the old rows
						var i = count - 1;
						
						//loop through and remove all older stuff
						while(i > -1)
						{
							$('#' + type + i + 'row').remove();
							i--;
						}
						
						//now clean up description
						$('#' + type + 'Description').text('');
						$('#' + type + 'DescriptionId').val('');
						
						//remove the list elements (not sure which is active so remove both, only one will be active)
						$('#lesson_groups li.error_active').remove();
						$('#lesson_groups li.lesson_active').remove();
						
						//get what we have, and subtract one
						var leftover = parseInt($('#listcount').text() - 1);
						
						$('#listcount').text(leftover);
						
						var newtext = $('#lesson_groups li').eq(leftover - 1).text();
						
						$('.deleteOffering').text(newtext);
						$('.deleter').text('Delete');
											
						if(leftover > 0)
						{
							if($('#lesson_groups li').eq(leftover - 1).hasClass('block_error'))
							{
								$('#lesson_groups li').eq(leftover - 1).addClass('error_active');
							}
							else
							{
								$('#lesson_groups li').eq(leftover - 1).addClass('lesson_active');
							}
							
							var lower = newtext.toLowerCase();
							
							$('.boxes').hide();
							$('#box_' + lower).show();
						}
						else if(leftover == 0)
						{
							$('#lesson_full').hide();
							$('#lesson_blank').show();
							$('.deleteLink').hide();
							$('.boxes').hide();
							$('#box_none').show();
						}
						
						//rebuild select options
						
						//make a copy of the correct options
						$('#temp').html($('#store').html());
						
						//loop through the remaining list and remove ones we still are using
						if(leftover > 0)
						{
							$('#lesson_groups li').each(function(index)
							{
	    						var j = $(this).text();
	    						
	    						$('#temp option:contains("' + j + '")').remove();
							});
						}
						
						$('#TeacherDesciplineDname').html($('#temp').html());
					}
				});
			}
		});


    });
    
    function capitaliseFirstLetter(string)
	{
    	return string.charAt(0).toUpperCase() + string.slice(1);
	}
    
    
    function addMoreOfferings(text, count)
    {
		//increase count by 1
		count = count + 1;
		
		//update the counts for the next time
		$('#count' + text).val(count);
		
		var html = $('#box_none tbody tr:eq(0)').html();
		
		html = html.replace(/none0/g, text + count);
		html = html.replace(/\[none\]\[0\]/g, '[' + text + '][' + count + ']');
		html = html.replace(/none_0/g, text + '_' + count);
		
		//get first maxlength
		html = html.replace('maxlength="0"', 'maxlength="3"');
		
		//get second maxlength
		html = html.replace('maxlength="0"', 'maxlength="10"');
		
		html = '<tr id="' + text + count + 'row">' + html + '</tr>';
		
		$('#box_' + text + ' tbody').append(html);
		
		//remove the shading class then add it in correctly
	    $('.offer_table tbody tr').removeClass('even');
	    $('.offer_table tbody tr:nth-child(even)').addClass('even');		
    }
    
    function RemoveErrors()
    {
    	$('#lesson_groups li').each(function (i)
		{
			if($(this).hasClass('error_active'))
			{
				$(this).removeClass('error_active').addClass('block_error');
			}
		});
  	}
    
    function LoadOfferings()
    {
    	<?php
    		foreach($desciplines as $d)
			{ 
		?>
		
				var id = <?php echo $d['TeacherDescipline']['id']; ?>;
				var text = '<?php echo $d['TeacherDescipline']['dname']; ?>';
				
				<?php
					if(isset($errors[strtolower($d['TeacherDescipline']['dname'])]))
						echo 'var test = true;';
					else
						echo 'var test = false;';
				?>
								
		    	if($('#has' + text.toLowerCase()).val() == 1)
		    	{	
		    		$('#lesson_blank').hide();
		    		
		    		//remove all the other previous active ones
					$('#lesson_groups li').removeClass('lesson_active');
						
					//remove from the select list
					$('#TeacherDesciplineDname option[value="' + id + '"]').remove();
					
					//if we have no options left, then append the no options
					if($('#TeacherDesciplineDname option').size() < 1)
						$('#TeacherDesciplineDname').append('<option value="-1">No desciplines left</option>');
					
					var list = '';
					
					
					if(test || $('.' + text + '_error').text() == 'true')
					{
						RemoveErrors();
						
						list = '<li class="error_active" id="' + text + '">' + text + '</li>';
					}
					else
					{
						RemoveErrors();
						
						list = '<li class="lesson_active" id="' + text + '">' + text + '</li>';
					}
		    		
		    		$('#lesson_full').show();
		    		$('#lesson_groups').append(list);
		    		
		    		$('.deleteOffering').text(text);
					$('.deleteLink').show();
		    		
		    		//remove the shading class then add it in correctly
		    		$('.offer_table tbody tr').removeClass('even');
		    		$('.offer_table tbody tr:nth-child(even)').addClass('even');
		    		
		    		$('#box_none').hide();
		    		$('.lesson_box').hide();
		    		$('#box_' + text.toLowerCase()).show();
		    		
		    		var temp = parseInt($('#listcount').text()) + 1;
				
					$('#listcount').text(temp);			
		    	}
    	
    	<?php
    		}
		?>
    }    		
    
</script>


















