<div id="message"></div>

  <?php echo $javascript->link('jquery-1.7.1.js');?>
  <?php echo $javascript->link('jquery.ui.core.js');?>
  <?php echo $javascript->link('jquery.ui.widget.js');?>
  <?php echo $javascript->link('jquery.ui.mouse.js');?>
  <?php echo $javascript->link('jquery.ui.draggable.js');?>
  <?php echo $javascript->link('jquery.ui.sortable.js');?>	
  <?php echo $html->css('jquery.ui.all.css'); ?>

<script type="text/javascript">
	$(function() {
		$( "#sortable" ).sortable({
			revert: true
		});
		$( "#draggable" ).draggable({
			connectToSortable: "#sortable",
			helper: "clone",
			revert: "invalid"
		});
		
	});
$(window).load(function() {
	$('#TeacherMediaLabel').click(function()
	 {
		$('#TeacherMediaLabel').val('');  
	});
	$('#TeacherMediaUrl').click(function()
	 {
		$('#TeacherMediaUrl').val('');  
	});
});
	</script>
    <?php    echo $form->create('TeacherMedias', array('url' => array('controller' => 'teachers', 'action' => 'editMedia',$id)));?>

	
   <div class="new_edit_back"></div>
		<div class="clr"></div>
		<div class="new_edit_tex">Share Media</div>
		<div class="media_top_texts">Paste an html embed code from YouTube, Vimeo, or Soundcloud. </div>
		<div class="clr"></div>
                
                
	      <div class="media_top_text_box">
			
                  <div class="media_top_text_media"><div class="media_top_text">Media</div></div>
		
		<?php if($media){foreach($media as $media1){ ?>
                  <div class="media_main_input_left" >
			
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="<?php  echo $media1['TeacherMedia']['label'] ?>"  class="media_main_input"/>
			
			
		</div>
		<div class="media_main_input_right">
			<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input" value="<?php  echo $media1['TeacherMedia']['url'] ?>"/>
			<div class="media_main_input_right_delet"><?php  // echo $html->link(__('Delete', true), array( 'controller' => 'teachers', 'action' => 'delmedia',$id,$media1['TeacherMedia']['id']),array('id'=>'deletebutton'),'Are you sure you want to delete?'); ?>	
 </div>
			
		</div>
                  
 <?php } }else{
?>
     
     <div class="media_main_input_left"  >
				
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
			<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" type="text" value="Media Label" class="media_main_input"/>
                        <div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
			<input id="TeacherMediaLabel" name="data[TeacherMedia][label][]" onfocus="this.value=''" type="text" value="Media Label" class="media_main_input"/>
		</div>
		<div class="media_main_input_right">
			<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input" value="Url"/>
			
			
			<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]"  type="text" class="media_main_input_right_input" value="Url" />
			
		
		<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"  value="Url" />
			
		
		<input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"   value="Url" />
                
                <input id="TeacherMediaUrl" name="data[TeacherMedia][url][]" type="text" class="media_main_input_right_input"   value="Url" />
			
		</div>
 <?php } ?>
              </div>
   
  
 

   <div class="submit_image">	<input type="submit" value="Save"></div>
	<div class="clr"></div>
 
  
   

<?php echo $form->end(); ?>





