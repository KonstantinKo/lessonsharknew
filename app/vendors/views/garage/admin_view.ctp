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
	<?php
	//pr($data);die;
	?>
<div id="user_listing">
    <table cellpadding="0" cellspacing="0" style="margin-top:20px">
        <?php
           //Table headers
            $tableHeaders =  $html->tableHeaders(array(
                                                  __('Sr.', true),
                                                  $paginator->sort('Garage ID','garage_id'),
						  $paginator->sort('Garage Name','garage_name'),
                                                  $paginator->sort('Garage Email','g_email'),
                                                  'Phone',
						  $paginator->sort('Zip Code','g_zip_code'),
						
                                                  $paginator->sort('Description','g_description'),
                                                  __('Active', true),
                                                  __('Actions', true)
                                                 ));
            echo $tableHeaders;

           //Data rows
           foreach ($data AS $key=>$store) {
	          
		          //Edit mode in ModalBox
              /*$actions  =  $html->link('Edit',
              array('controller'=>'users','action' => 'edit', $user['User']['id']),
              array(
              	'title' => 'Edit User details',
              	'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"));
              */
              
              $actions  =  $html->link('Edit',
              array('controller'=>'garages','action' => 'edit', $store['Garage']['id']));
              
                
                $actions .=  $ajax->link( 
                    'Delete', 
                    array( 'controller' => 'garages', 'action' => 'delete', $store['Garage']['id'] ), 
                    array( 'update' => $store['Garage']['id'], 'indicator'=>'loader_listing' ), 
                    'Are you sure you want to delete?'
                ); 
		$actions .=  '<br>'. $html->link('Add Space',
              array('controller'=>'garages','action' => 'addSpace', $store['Garage']['id']));

		$actions .=  $html->link('Add Images',
              array('controller'=>'garages','action' => 'addGarageImage', $store['Garage']['id']));

                $image = "";
                //Supervised actions
            		if($store['Garage']['g_status'] == 1 ){
            			$image = 'admin/accept.png';
            		} else {
            			$image = 'admin/reject.png';
            		}     
                        
		           $activeImg =  $ajax->link($html->image($image, array('border' => 0)),
                array( 'controller' => 'garages', 'action' => 'active', $store['Garage']['id'] ),
                array( 'update' => 'img_'.$store['Garage']['id'], 
                'complete' => 'alert( "Garage has been updated." )') , null,false) ;
                  
              $viewLink   =  $html->link($store['Garage']['garage_id'],
              array('controller'=>'garages','action' => 'storeView', $store['Garage']['id']));
             
                
                $rows[] = array(
                           ++$key.'.',
                           $store['Garage']['garage_id'],   
                           $store['Garage']['garage_name'],
                           substr($store['Garage']['g_email'], 0, 10),  
                           substr($store['Garage']['g_phone'], 0, 10),
			   substr($store['Garage']['g_zip_code'], 0, 10),
                           substr($store['Garage']['g_description'], 0, 70),
                           //@number_format($store['Store']['t_upfront_amount'], 2, '.', ''), 
                           array($activeImg, array( "id" => "img_".$store['Garage']['id']) ),                      
                           $actions,
                          );
              echo $html->tableCells($rows, array('id'=>$store['Garage']['id']), array('id'=>$store['Garage']['id']));
              $rows = null; 
           }//End: foreach 
           
         ?>   
    </table>
     <?php echo $this->element('pagination'); ?>
</div>

<?php
    $paginator->options(array('url' => $this->passedArgs));
?>




