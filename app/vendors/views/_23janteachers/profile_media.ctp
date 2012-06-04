 <div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div>
<div id="message"></div>

  
    <?php    echo $form->create('TeacherMedias', array('url' => array('controller' => 'teachers', 'action' => 'profileMedia',$id)));?>

	
   <div class="new_edit_back"></div>
		<div class="clr"></div>
		<div class="new_edit_tex">Share Media</div>
		<div class="media_top_texts">Paste an html embed code supplied by You Tube, Vimeo,or Soundcloud </div>
		<div class="clr"></div>
                
                
		<div class="media_top_text_box">
			<div class="media_top_text_media"><div class="media_top_text">Media</div></div>
		<div class="media_main_input_left">
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
                        <div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
		</div>
		<div class="media_main_input_right">
			<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input" value="Url"/>
			
			
			<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input" value="Url" />
			
		
		<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"  value="Url" />
			
		
		<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"   value="Url" />
			
                        
                <input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"   value="Url" />
			
		</div>
	</div>
   
  
 

   <div class="submit_image">	<input type="submit" value="Save"></div>
	<div class="clr"></div>
 
  
   

<?php echo $form->end(); ?>




