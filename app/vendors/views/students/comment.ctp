<div class="main_cont">
<?php  echo $form->create('User', array('url' => array('controller' => 'students', 'action' => 'comment')));?>
	<div class="main_inner">
		<div class="add_commentss">Add Comments		<div class="right_img"><?php echo $html->image('img_left.png'); ?></div>
		</div>
		<div class="clr"></div>
		<div class="main_text">Enter Comment Text</div>
		<textarea class="textarea" name="data[User][comment]"></textarea>
		<div class="dummy_text12">Your Teacher can view and reply to comments when logged in.
			When you post your comment, your teacher receives a notifi-
			cation so that they can reply.</div>
			<div class="post_btn"><input type="image" src="/dev1/img/img.png" ></div>
	
	
	</div>
<?php echo  $form->end(); ?>
</div>

