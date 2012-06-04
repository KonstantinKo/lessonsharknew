 <div class="slider"></div>  
     	<div class="main_services">
       	 <?php 
          foreach($scrollCat as $data)
           {
           $body=strip_tags($data['Content']['body']);
           ?>
          <div class="left_srvices" style="width:318px;">
      				<div class="residential_text"><?php echo strtoupper($data['Content']['title']);?></div>
      				<div class="BRINING_text">
              
              <?php 
              
              if($data['Content']['id'] == "16"){
              //RESIDENTIAL
                 echo "Bringing families the comfort of gas for 60 years.";
              }elseif($data['Content']['id'] == "17"){
                 //COMMERCIAL
                 echo "Trust Blossman to fuel your business. We'll deliver.";
              }elseif($data['Content']['id'] == "18"){
                 //CONSTRUCTION
                 echo "Temp heat, appliances, gas connection? We've got you covered.";
              }
              //echo substr($body,0,50 ).'..'
              
              ?></div>
        				<div class="more_about">
        			  <?php echo $html->link(__('MORE ABOUT '.strtoupper($data['Content']['title']), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$data['Content']['slug']));?><?php echo $html->image('images/arrow_nav.png',array('height'=>'15','width'=>'10')); ?> 
        					<div class="img_sine"></div>
      			  </div>
      	
      		</div>
      		<?php
          }
          ?> 
          
           <div class="left_srvices" style="width:318px;clear:both;">
      				<div class="residential_text"><?php echo strtoupper($scrollAgri['Content']['title']);?></div>
      				<div class="BRINING_text"><?php //echo strip_tags(substr($scrollAgri['Content']['title'],0,50 ));?>From the orchard to the coop to the field.</div>
        				<div class="more_about">
        			  <?php echo strtoupper($html->link(__('MORE ABOUT '.$scrollAgri['Content']['title'], true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$scrollAgri['Content']['slug'])) );?><?php echo $html->image('images/arrow_nav.png',array('height'=>'15','width'=>'10')); ?> 
        					<div class="img_sine"></div>
      			  </div>
      	
      		</div>
      		 <div class="left_srvices" style="width:318px;">
      				<div class="residential_text"><?php echo strtoupper($scrollAutoGas['Content']['title']);?></div>
      				<div class="BRINING_text"><?php //echo strip_tags(substr($scrollAutoGas['Content']['title'],0,50 ));?>Fuel your fleet with propane autogas instead of gasoline.</div>
        				<div class="more_about">
        			  <?php echo strtoupper($html->link(__('MORE ABOUT '.$scrollAutoGas['Content']['title'], true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$scrollAutoGas['Content']['slug'])) );?><?php echo $html->image('images/arrow_nav.png',array('height'=>'15','width'=>'10')); ?> 
        					<div class="img_sine"></div>
      			  </div>
      	
      		</div>
      		 <div class="left_srvices" style="width:318px;">
      				<div class="residential_text"><?php echo strtoupper($scrollMover['Content']['title']);?></div>
      				<div class="BRINING_text"><?php //echo strip_tags(substr($scrollMover['Content']['title'],0,50 ));?>Propane mowers are cost-effective and eco-friendly!</div>
        				<div class="more_about">
        			  <?php echo strtoupper($html->link(__('MORE ABOUT '.$scrollMover['Content']['title'], true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$scrollMover['Content']['slug'])) );?><?php echo $html->image('images/arrow_nav.png',array('height'=>'15','width'=>'10')); ?> 
        					<div class="img_sine"></div>
      			  </div>
      	
      		</div>
          
                 
      </div>
  <?php /*?>   <div class="slider"></div>  
     	<div class="main_services">
    		<div class="left_srvices">
    				<div class="residential_text">RESIDENTIAL</div>
    				<div class="BRINING_text">Bringing families the comfort of gas for 60 years.</div>
    				<div class="more_about">
    					MORE ABOUT RESIDENTIAL
    					<div class="img_sine"></div>
    			  </div><br /></br><br /></br><br /></br>
    	
    				<div class="residential_text">AGRICULTURE</div>
    				<div class="BRINING_text">From the orchard to the coop to the field.</div>
    				<div class="more_about">MORE ABOUT AGRICULTURE<div class="img_sine"></div>
    			  </div>
    		</div>  
	
	
    		<div class="middle_srvices">
    			<div class="residential_text">COMMERCEIAL</div>
    			<div class="BRINING_text">Trust Blossman to fuel your business. We'll deliver.</div>
    		
    			<div class="more_about">MORE ABOUT COMMERCEIAL<div class="img_sine"></div>
    			</div><br /></br><br /></br><br /></br>
    			
    			<div class="residential_text">AUTOGAS</div>
    			<div class="BRINING_text">Fuel your fleet with propane autogas instead of gasoline.</div>
    		
    			<div class="more_about">MORE ABOUT AUTOGAS<div class="img_sine"></div>
    			</div>
    	
    		</div>
	
	
      	<div class="right_srvices">
      		<div class="residential_text">CONSTURCTION</div>
      			<div class="BRINING_text">Temp heat, appliances, gas connection? We've got you covered.</div>
      		
      			<div class="more_about">MORE ABOUT CONSTRUCTION<div class="img_sine"></div>
      			</div><br /></br><br /></br><br /></br>
      			
      			<div class="residential_text">MOWERS</div>
      			<div class="BRINING_text">Propane mowers are cost-effective and eco-friendly!</div>      		
      			<div class="more_about">MORE ABOUT MOWERS<div class="img_sine"></div>
      			</div>
      	 	
	</div>
      	</div><?php */ ?>