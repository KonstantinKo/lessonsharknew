<div class="feature_background" <?php if($page == 'loggedIn') { echo 'style="height: 235px;"'; } ?>>
	<div class="feature_text_part">
	
	<?php
		if($tab == 'tour') 
		{
	?>
			<div class="white_feature_bar">
				<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="number_txt"><?php  echo $html->link(__('Tour', true), array( 'controller' => 'homes', 'action' => 'tour' ) ); ?></div>
	<?php
		}
	?>
	
	
	<div class="number_txt"><?php  echo $html->link(__('Features', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div>
			
	
	
	<?php
		if($tab == 'feature_profile') 
		{
	?>
			<div class="white_feature_bar">
				<div class="number_txt feature_inner"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="number_txt feature_inner"><?php  echo $html->link(__('Let Students Find You', true), array( 'controller' => 'homes', 'action' => 'feature' ) ); ?></div></div>
	<?php
		}
	?>
	
	
	
	<?php
		if($tab == 'feature_dashboard') 
		{
	?>
			<div class="white_feature_bar">
				<div class="number_txt feature_inner"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="number_txt feature_inner"><?php  echo $html->link(__('Track. Bill. Communicate.', true), array( 'controller' => 'homes', 'action' => 'featureTrack' ) ); ?></div>
	<?php
		}
	?>
	
	
	
	<?php
		if($tab == 'numbers') 
		{
	?>
			<div class="white_feature_bar">
				<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="number_txt"><?php  echo $html->link(__('The Numbers', true), array( 'controller' => 'homes', 'action' => 'numbers' ) ); ?></div>
	<?php
		}
	?>
	
	
	
	
	<?php
		if($tab == 'faq') 
		{
	?>
			<div class="white_feature_bar">
				<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="number_txt"><?php  echo $html->link(__('Teacher FAQ', true), array( 'controller' => 'homes', 'action' => 'faqSecond' ) ); ?></div>
	<?php
		}
	?>
			
			
			
			
	</div>
	
	<?php
		if($page == 'loggedOut') 
		{
	?>
	
			
	<a style="margin-top:-110px" class="orange_create" href="<?php echo $html->url(array('controller' => 'teachers', 'action'=>'register')); ?>">
		<div class="profile_text">Create a Free Profile</div>
	</a>
	<div style="margin-top:-50px"class="free_text">Completely Free. No credit card <br>information required. Cancel Anytime</div>

	<?php
		}
	?>
</div>
















