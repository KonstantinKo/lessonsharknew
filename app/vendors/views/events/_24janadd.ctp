<div id="demo">
<?php

    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'Location'));
    echo '<br/>At: ' . $displayTime;
    echo $form->input('start', array('type'=>'hidden','value'=>$event['Event']['start']));
    echo $form->input('end', array('type'=>'hidden','value'=>$event['Event']['end']));
    echo $form->input('allday', array('type'=>'hidden','value'=>$event['Event']['allday']));
    echo  $form->end(array('label'=>'Save' ,'name' => 'save'));
?>
</div>
