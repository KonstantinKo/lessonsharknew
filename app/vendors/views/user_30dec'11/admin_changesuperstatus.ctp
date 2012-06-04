<?php 
        //Supervised actions
    		if($status == 1){
    			$image = 'admin/accept.png';
    		} else {
    			$image = 'admin/reject.png';
    		}
 echo 
$ajax->link(
            $html->image($image, array('border' => 0)), 
            array( 'controller' => 'users', 'action' => 'changesuperstatus', $id ), 
            array( 'update' => 'supervised_'.$id, 'indicator'=>'loader_listing' )
            , null,false
          );
?>