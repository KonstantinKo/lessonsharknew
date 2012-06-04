
<?php
  if($pageContent['Content']['type']==1)
  {  


    if(!empty($pageContent['Content']['h_image']))
    {
      ?>
      <div style="float:left;margin-top:16px;">
          <?php echo $html->image('header/'.$pageContent['Content']['h_image'],array('height'=>'300','width'=>'960'));  ?>
      </div>
      <?php
    }
    else
    {
    ?>
    <div class="slider"></div>
     <?php
     }
      
    if($pageContent['Content']['id']==15)
    { 
       ?>
      <div class="contact_main">
        <div style="float:left;;margin-top:30px;">
        
           <?php echo $pageContent['Content']['body'] ;?>
           
        </div>
    
     </div> 
      
       <?php
    }
    else
    {
    ?>
       <div class="contact_main">
   <div class="left_contact">
   
    	<div style="float:left;border-left:1px solid #E8E8E8;margin-top:30px;">
      <div class="text_resi"><?php echo $pageContent['Content']['title'];?></div>
      
     <?php echo $pageContent['Content']['body'] ;?>
    </div></div>
     <?php echo $this->element('front/contactSide');
     ?>
  </div>  
    <?php
    }
    ?>
   <?php
  }
  else if($pageContent['Content']['type']==2)
  { 
    if($pageContent['Content']['id']=='16')
     {
          echo $this->requestAction(array('controller' => 'Content', 'action' => 'residentialHeader'), array('return')); 
     }
     else
     {     
  if(!empty($pageContent['Content']['h_image']))
    {
      ?>
      <div style="float:left;margin-top:16px;">
          <?php echo $html->image('header/'.$pageContent['Content']['h_image'],array('height'=>'300','width'=>'960'));  ?>
      </div>
      <?php
    }
    else
    {
    ?>
    <div class="slider"></div>
     <?php
     }
     }
     ?> 
   
      <div class="contact_main">
       <div class="left_contact" id="breadcrumblinks">
       
     
       <?php echo $html->link(__(ucwords(strtolower($pageParent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageParent['Content']['slug'])); ?>&nbsp;&gt;&nbsp;
        <span id="breadcrumblinksBold"><?php echo $html->link(__(ucwords(strtolower($pageContent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug'])); ?> </span>
        <div style="float:left;border-left:1px solid #E8E8E8;margin-top:30px;">
        <div class="text_resi"><?php echo $pageContent['Content']['title'];?></div>
      
      <?php echo $pageContent['Content']['body'] ;
          ?></div></div> <?php
            echo $this->element('front/contactSide');
       ?>
       
      </div>
      
  <?php
  }
  else if($pageContent['Content']['type']==3)
  {
  
  if($pageContent['Content']['parent_id']==16)
  {
      echo $this->requestAction(array('controller' => 'Content', 'action' => 'residentialHeader'), array('return')); 
  }
  else
  {
     
    if(!empty($pageContent['Content']['h_image']))
    {
      ?>
      <div style="float:left;margin-top:16px;">
          <?php echo $html->image('header/'.$pageContent['Content']['h_image'],array('height'=>'300','width'=>'960'));  ?>
      </div>
      <?php
    }
    else
    {
    ?> 
    <div class="slider"></div>
     <?php
     }
   }  
     ?> 

     
     
    
         <div class="contact_main">
     <div class="left_contact" id="breadcrumblinks">
      <?php if(isset($pageOfSubCat) and $pageOfSubCat!='' )
          {
             echo $html->link(__(ucwords(strtolower($pageOfSubCat['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageOfSubCat['Content']['slug'])).'&nbsp;&gt&nbsp;';
          }
        ?>
        <?php echo $html->link(__(ucwords(strtolower($pageParent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageParent['Content']['slug'])); ?>&nbsp;&gt&nbsp;
        
        <span id="breadcrumblinksBold"><?php
         //Change breadcrumb if its 'Become A Customer'  OR 'All-Electric Homes' pages
         if ($pageContent['Content']['id'] == "33" || $pageContent['Content']['id'] == "37" || $pageContent['Content']['id'] == "38" || $pageContent['Content']['id'] == "45"|| $pageContent['Content']['id'] == "49" || $pageContent['Content']['id'] == "56"){
           echo $html->link(__($pageContent['Content']['title'], true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug']));
         }else{
        ?>
        <?php 
        echo $html->link(__(ucwords(strtolower($pageContent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug'])); ?>
        <?php
         }//END: Check
        ?>
        </span>
      	<div style="float:left;border-left:1px solid #E8E8E8;margin-top:30px;">
        <div class="text_resi"><?php echo $pageContent['Content']['title'];?></div>
        
       <?php echo $pageContent['Content']['body'] ;?>
      </div></div>
       <?php echo $this->element('front/contactSide');
       ?>
    </div>  
   
      

    
    <?php
  } 
?>
</div>
