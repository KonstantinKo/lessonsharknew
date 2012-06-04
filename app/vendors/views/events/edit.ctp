<?php

    echo $form->create('Event', array('target'=> '_parent') );
    echo $form->input('id',array('type'=>'hidden','value'=>$event['Event']['id']));
    echo $form->input('title' , array('value'=>$event['Event']['title']));
    echo 'When: ' .$displayTime; ?>
    <a href="<?php echo Dispatcher::baseUrl();?>/events/delete/<?php echo $event['Event']['id'];?>" onClick="return confirm('Do you really want to delete this event?');">Delete</a>
    <?php echo $form->end(array('label'=>'Save' ));
    //Below is just a cancel button. See previous post for the back() function
 ?>
   

