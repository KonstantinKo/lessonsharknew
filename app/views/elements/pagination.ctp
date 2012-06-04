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
