<?php echo $javascript->link('jquery'); ?>
<div style="float:left;width:400px;">
  
      <?php echo $form->create('homes',array('id'=>'postStoreForm','action'=>'showDistance','name'=>'frmCreate')); ?>
  	<fieldset>
  	<h2>Search Garage</h2><br/>
  	
  	<?php
	      echo $form->input('address', array('label'=>'Address*:'));
	      echo $form->input('zip', array('label'=>'Zip*:'));

    	?>
    
  <?php echo $form->end('Submit');?>

</div>
 
