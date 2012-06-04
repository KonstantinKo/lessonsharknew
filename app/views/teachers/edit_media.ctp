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
		$('#TeacherMediaLabel').click(function() {
			$('#TeacherMediaLabel').val('');  
		});
		$('#TeacherMediaUrl').click(function() {
			$('#TeacherMediaUrl').val('');
		});
	});
</script>

<div class="profile_border">
	<?php echo $form->create('TeacherMedia', array('url' => array('controller' => 'teachers', 'action' => 'editMedia', $id)));?>
	<div id="message"></div>	
	<div class="new_edit_back"></div>
	<div class="clr"></div>
	<div class="new_edit_tex_media">Share Media</div>
	<div class="media_top_texts">
		<div class="media_top_texts_cont1">
			<span>How to:</span>
			<div class="media_edit_description_2">
				Paste an embed code from 
				<div class="media_green_hilight">YouTube</div>,
				<div class="media_green_hilight">Vimeo</div>, or
				<div class="media_green_hilight">SoundCloud</div>.
				Your media will display on your profile's 'Media' tab.
			</div>
		</div>
		<div class="media_top_texts_cont1">
			<span>Choose Wisely!</span>
			<div class="media_edit_description_2">Your Media tab is where students learn about who you are as a person and as a Teacher. If you were a student, what would you look for in a Teacher? 
			</div>
		</div>
	</div>
	<div class="clr"></div>
	<div class="media_top_text_box">
  	<div class="media_top_text_media">
			<div class="media_top_text">My Media</div>
		</div>
		
		<?php 
		if ($media) 
		{
			$i = 0;
			foreach($media as $media1) {
				echo $this->element('teachers/mediaform', array(
					"i" => $i, "media" => $media1, "form" => $form, "errors" => $errors));
				$i++;
			}

			for ($i = count($media); $i < 5; $i++) {
		  	echo $this->element('teachers/mediaform', array(
		  		"i" => $i, "media" => false, "form" => $form, "teacher_id" => $id, "errors" => $errors));
			}

		} else {
			for ($i=0; $i < 5; $i++) {
		  	echo $this->element('teachers/mediaform', array(
		  		"i" => $i, "media" => false, "form" => $form, "teacher_id" => $id, "errors" => $errors));
			}
		}
		?>
		</div>

		<input class="submit_button_media" type="submit" value="Save My Media">
		<div class="clr"></div>
	<?php echo $form->end(); ?>
</div>





