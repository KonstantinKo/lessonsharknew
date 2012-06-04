<?php 
    //Supervised actions
    //echo $status;
		if($g_status ==1 ){
			$image = 'admin/accept.png';
		} else {
			$image = 'admin/reject.png';
		}  

     $activeImg =  $ajax->link($html->image($image, array('border' => 0)),
      array( 'controller' => 'Garages', 'action' => 'active', $id ),
      array( 'update' => 'img_'.$id, 
      'complete' => 'alert( "Task has been updated." )') , null,false) ;
     echo $activeImg;
?>
