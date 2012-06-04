
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title_for_layout; ?> - <?php __('Lessonshark'); ?></title>
    <?php
        echo $html->css(array(
            'admin/meta-admin',
            'admin/admin', //Inbuilt
            'modalbox',//For ModalBox
            'simpletree',
        ));

        //for AJAX  
        echo $javascript->link('prototype');
        echo $javascript->link('scriptaculous.js?load=builder,effects');
        
        echo $javascript->link('simpletreemenu'); 
                                                       
        //for ModalBox
        echo $javascript->link('modalbox');
        echo $javascript->link('cakemodalbox');
        
        echo $scripts_for_layout;
    ?>
</head>
<body>

	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			<div class="inner">
				<h1 id="logo"><a href="#">Lessonshark Adminstration Panel</a></h1>
				<!--[if !IE]>start user details<![endif]-->
				<div id="user_details">
					<ul id="user_details_menu">
						<li class="first">Welcome -    	
                  <?php
                    if( $session->read('Admin.username') != null) { 
                      echo __("You are logged in as ", true) . $session->read('Admin.username'); 
                    }//End: If Authenticated
                    
                    if( $session->read('Coder.username') != null) { 
                      echo __("You are logged in as ", true) . $session->read('Coder.username'); 
                    }//End: If Authenticated
                  ?>
            </li>
						<!-- <li><a href="#">My Account</a></li> -->
						<li class="last">
<?php
		echo $html->link(__("Log Out", true), array('plugin' => 0, 'controller' => 'users', 'action' => 'logout'));
               
?>
            </li>
					</ul>
					<div id="server_details">
						<dl>
							<dt>Date/time:</dt>
							<dd><?php echo $today = date("F j, Y, g:i a"); ?></dd>
						</dl>
						<?php /*?><dl>
							<dt>Login ip:</dt>
							<dd><?php echo $_SERVER['REMOTE_ADDR'];?></dd>
						</dl><?php */?>
					</div>
				</div>
				<!--[if !IE]>end user details<![endif]-->
				
        <?php echo $this->element('admin/main_menu'); ?>
				
			</div>
		</div>
		<!--[if !IE]>end head<![endif]-->
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			
			<!--[if !IE]>start content bottom<![endif]-->
			<div id="content_bottom">
			
			<div class="inner">
  				<!--[if !IE]>start sidebar<![endif]-->
  			  <div id="sidebar"> 					
            <?php echo $this->element("admin/navigation"); ?>					
  				</div> 
  				<!--[if !IE]>end sidebar<![endif]-->
  				
						<!--[if !IE]>start section inner<![endif]-->
						<div class="section_inner"> 
                    <?php
                        //echo $session->flash();
                        echo $content_for_layout;
                    ?>									

						</div>
						<!--[if !IE]>end section inner<![endif]--> 
				
				
			</div>
			<!--[if !IE]>end content bottom<![endif]-->
			</div>
			
		</div>
		<!--[if !IE]>end content<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
<?php echo $this->element('admin/footer'); ?>	
	
</body>
</html> 
