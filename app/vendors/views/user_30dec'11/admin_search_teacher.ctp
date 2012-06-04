<?php
   
    //Sets the update and indicator elements by DOM ID
    $paginator->options(array('update' => 'user_listing', 'indicator' => 'loader_listing'));    
?>
<div id="loader_listing" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
    <style type="text/css">
        div.disabled {
                display: inline;
                float: none;
                clear: none;
                color: #C0C0C0;
        }
    </style>
<div id="user_listing">
    <table cellpadding="0" cellspacing="0" style="margin-top:20px">
        <?php
           //Table headers
  
            $tableHeaders =  $html->tableHeaders(array(
                                                  $paginator->sort('lastname'),
                                                  $paginator->sort('firstname'),
                                                  $paginator->sort('username'),
                                                  $paginator->sort('zip-code'),
                                                  'Activate',
                                                   __('Actions', true)
                                                 ));
            echo $tableHeaders;
           
           //Data rows
	
   
           foreach ($data AS $key=>$user) {
	        
     //Edit mode in ModalBox
              $actions  =  $html->link('Edit',
              array('controller'=>'users','action' => 'edit', $user['User']['id']),
              array(
              	'title' => 'Edit User details',
              	'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"));
                
                
                $actions .=  $ajax->link( 
                    'Delete', 
                    array( 'controller' => 'users', 'action' => 'delete', $user['User']['id'] ), 
                    array( 'update' => $user['User']['id'], 'indicator'=>'loader_listing' ), 
                    'Are you sure you want to delete?'
                ); 
	      $actions  .=  $html->link('Add Profile',
              array('controller'=>'users','action' => 'addProfile', $user['User']['id']) );
                
                
               
                //Role
                ( $user['User']['role'] == 'admin' ) ? $role = "Administrator" : $role = "User";

                //Supervised actions
            		if($user['User']['supervised']==1){
            			$image = 'admin/accept.png';
            		} else {
            			$image = 'admin/reject.png';
            		}
                        
                $supervised_action =  $ajax->link( 
                    $html->image($image, array('border' => 0)), 
                    array( 'controller' => 'users', 'action' => 'changesuperstatus', $user['User']['id'] ), 
                    array( 'update' => 'supervised_'.$user['User']['id'], 'indicator'=>'loader_listing' )
                , null,false);
		       
               
                $rows[] = array(
                           $user['User']['lastname'],
                           $user['User']['firstname'],
                           $user['User']['username'],
                           $user['User']['zip'],
                           array( $supervised_action, array( 'id'=>'supervised_'.$user['User']['id'] ) ),
                                                 
                           $actions,
                          );
               

              echo $html->tableCells($rows, array('id'=>$user['User']['id']), array('id'=>$user['User']['id']));
              $rows = null; 
           }//End: foreach 
           
         ?>   
    </table>
</div>

<?php
    $paginator->options(array('url' => $this->passedArgs));
?>


<div class="paging">
  <!-- Shows the page numbers -->
  <?php
  echo $paginator->last( ' First ' ); 
  echo $paginator->prev('Previous ', null, null, array('class' => 'disabled'));
  echo $paginator->numbers();
  echo $paginator->next(' Next', null, null, array('class' => 'disabled')); 
  echo $paginator->last( ' Last ' ); 
  ?>
  
  <!-- prints X of Y, where X is current page and Y is number of pages -->
  <div class="counter"><?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?></div>
</div>

