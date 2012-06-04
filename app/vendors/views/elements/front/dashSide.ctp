	<div class="left_container">
				<div class="account_img"></div>
				
				<div class="text_main">
					<div class="arrow"><img src="../img/images/black_10.png"/></div>
					<div class="modsetting"><?php echo $html->link(__('Console Settings', true), array('plugin' => 0, 'controller' => 'Users', 'action' => 'setting')); ?></div>
					</div>
				<div class="text_main">
					<div class="arrow"><img src="../img/images/black_10.png"/></div>	
					<div class="modsetting"><?php echo $html->link(__('Manage Account', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'manageAccount')); ?></div>
				</div>
				<div class="text_main">
					<div class="arrow"><img src="../img/images/black_10.png"/></div>
					<div class="modsetting"><?php echo $html->link(__('Change Password', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'changePassword')); ?></div>
				</div>
				<div class="text_main">
					<div class="arrow"><img src="../img/images/black_10.png"/></div>
					<div class="modsetting"><?php echo $html->link(__('Log Out', true), array('plugin' => 0, 'controller' => 'Users', 'action' => 'logOut')); ?></div>
				</div>
				<div class="clr"></div>
				<div class="data_img"></div> <div class="clr"></div>
					<div class="text_main">
							<div class="arrow"><img src="../img/images/black_10.png"/></div>
							<div class="modsetting"><?php echo $html->link(__('Portfolio', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'dashboard')); ?></div>
						</div>
							<div class="clr"></div>
					<div class="text_main">
							<div class="arrow"><img src="../img/images/black_10.png"/></div>
							<div class="modsetting"><?php echo $html->link(__('Add Trade', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'addTrade')); ?></div>
						</div>
						
					<div class="clr"></div>
					
				
						  <div class="post_img"></div>
						<div class="text_main">
							<div class="arrow"><img src="../img/images/black_10.png"/></div>
							<div class="modsetting"><?php echo $html->link(__('Open Positions', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'openPosition')); ?></div>
						</div>
						<div class="text_main">
							<div class="arrow"><img src="../img/images/black_10.png"/></div>
							<div class="modsetting"><?php echo $html->link(__('Closed Positions', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'closedPosition')); ?></div>
						</div>
			</div>
