<div id="navigation">
	<ul>
		
        <li>
            <h3 style="font-size:15px;">Users</h3>
            <ul>
                <li><?php echo $html->link(__('View Users', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'index')); ?></li>
                <li><?php echo $html->link(__('Add Users', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'addUser')); ?></li>
            </ul>
        </li>
        
         <li>
            <h3 style="font-size:15px;">Category Management</h3>
            <ul>
                <li><?php echo $html->link(__('View categories', true), array('plugin' => 0, 'controller' => 'categories', 'action' => 'view')); ?></li>
                <li><?php echo $html->link(__('Add Categories', true), array('plugin' => 0, 'controller' => 'categories', 'action' => 'add')); ?></li>
            </ul>
        </li>
        
         <li>
            <h3 style="font-size:15px;">CMS Management</h3>
            <ul>
                <li><?php echo $html->link(__('View CMS Pages', true), array('plugin' => 0, 'controller' => 'content', 'action' => 'index')); ?></li>
                <li><?php echo $html->link(__('Add CMS Pages', true), array('plugin' => 0, 'controller' => 'content', 'action' => 'add')); ?></li>
            </ul>
        </li> 
        
    </ul>
</div>