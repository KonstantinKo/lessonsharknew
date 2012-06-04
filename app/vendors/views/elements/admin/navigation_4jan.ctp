<div id="navigation">
	<ul>
    	<li>
            <h3 style="font-size:15px;">User Management</h3>
            <ul>
                <li><?php echo $html->link(__('Student Management', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'index', 'admin'=>true)); ?></li>
		<li><?php echo $html->link(__('Teacher Management', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'teacherManagement', 'admin'=>true)); ?></li>
		<li><?php echo $html->link(__('Lessonshark Details', true), array('plugin' => 0, 'controller' => 'users', 'action' => 'detail', 'admin'=>true)); ?></li>
		
            </ul>
        </li>
        <?php /*?>
	 <li>
            <h3 style="font-size:15px;">Garage Management</h3>
            <ul>
                <li><?php echo $html->link(__('View Garage', true), array('plugin' => 0, 'controller' => 'garages', 'action' => 'view','admin'=>'true')); ?></li>
                <li><?php echo $html->link(__('Add New Garage', true), array('plugin' => 0, 'controller' => 'garages', 'action' => 'add','admin'=>'true')); ?></li>
                
            </ul>
        </li> 
	
	 <li>
            <h3 style="font-size:15px;">CMS Management</h3>
            <ul>
                <li><?php echo $html->link(__('View CMS Pages', true), array('plugin' => 0, 'controller' => 'content', 'action' => 'index')); ?></li>
                <li><?php echo $html->link(__('Add CMS Pages', true), array('plugin' => 0, 'controller' => 'content', 'action' => 'add')); ?></li>
                
                  
                  
            </ul>
        </li> 
	   <li>
            <h3 style="font-size:15px;">Newsletter</h3>
            <ul>
                <li><?php echo $html->link(__('Send Newsletter', true), array('plugin' => 0, 'controller' => 'send_newsletters', 'action' => 'send')); ?></li>
               
            </ul>
        </li>    
      <?php */?>
    </ul>
</div>
