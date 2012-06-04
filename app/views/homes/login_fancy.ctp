<?php ?>
<div class="home_page_pop_box">
<?php

   echo $form->create('User', array('url' => array('controller' => 'homes', 'action' => 'login')));?>
	
			<div class="home_page_pop_box_text">Email Address:</div>
			<input type="text" class="home_page_pop_box_input" name="data[User][email]"/>
			<div class="home_page_pop_box_text">Password</div>
			<input type="password" class="home_page_pop_box_input" name="data[User][password]"/>
			<div class="home_page_pop_box_texter"><a href="<?php echo $html->url(array('controller' => 'homes', 'action'=>'forgot')); ?>">Forgot Your Password?</a></div>
			<div class="home_page_pop_go_btn">
	
			<input type="submit" value="Login"></div>
 <?php echo  $form->end(); ?>
</div>


