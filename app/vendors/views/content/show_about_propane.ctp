<li style="width:150px;" class="propaneSelect">
<?php echo $html->link(__(strtoupper($existCust[0]['Content']['title']), true), array('plugin' => 0, 'controller' => 'content', 'action' => 'propane',$existCust[0]['Content']['slug'])); ?>     
  <ul style="width:134px;margin-left:8px;">
      
      <?php
      foreach($existPages as $subPages)
      {
      ?>
         
          <li><?php echo $html->link(__($subPages['Content']['title'], true), array('plugin' => 0, 'controller' => 'content', 'action' => 'propane',$subPages['Content']['slug'])); ?></li>
      <?php
      }
      ?>
      
  </ul> 
</li>

  