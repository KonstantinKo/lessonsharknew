<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
  <div> <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / <a style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/teacherManagement">Teacher Management</a> / Add Profile</div>
  <fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Learn </legend>
      
      <div id="showUserAdd">
      <?php echo $form->create('User');?>
        <ul>
          <li>  <?php echo $form->input('dname', array('label'=>'Descipline name' , 'class'=>'text') ); ?></li>     

          <li> <?php echo $form->input('rate', array('label'=>'Rate' , 'class'=>'text') ); ?></li>
          <li> <?php echo $form->input('location');?></li>
          <li> <?php echo $form->input('duration');?></li>
           <li> <?php echo $form->input('description');?></li>
          <li>
        
          <?php 
                //$options=array('admin'=>'Administrator','coder'=>'User');
                //echo $form->select('role',$options, null, null, false );
                ?>       
          </li>
         
          <?php echo $ajax->submit('+ Add', array('url'=> array('controller'=>'users','action'=>'add'), 'update' => 'message','indicator'=>'loader', 'div'=>true, 'style'=>'width: 80px;float:right;margin-right:150px; ')); ?>
          </li>
        </ul>
    <?php echo $form->end(); ?>
      </div>
     
  </fieldset>
</div>  
 

