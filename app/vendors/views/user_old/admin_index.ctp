<div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
  <div> <a  style="text-decoration:none; color:black;" href="/lessonshark1/admin/users/home">User Management</a> / Student Management</a></div>
  <fieldset><legend onclick="Effect.toggle('showUserAdd','blind', {duration:0.50}); return false"> Add Student </legend>
      
      <div id="showUserAdd">
      <?php echo $form->create('User');?>
        <ul>
          <li><?php echo $form->input('lastname');?></li>
          <li><?php echo $form->input('firstname');?></li>
          <li><?php echo $form->input('username');?></li>
          <li><?php echo $form->input('password');?></li>
          <li><?php echo $form->input('email');?></li>
           <li><?php echo $form->input('zip');?></li>
          <li>
          
          <?php 
                //$options=array('admin'=>'Administrator','coder'=>'User');
                //echo $form->select('role',$options, null, null, false );
                ?>       
          </li>
          <li>
          <label for="UserSupervised" class="lableWidth" >Activate</label>
          <?php echo $form->input('supervised', array('style'=>'margin-top:2px; padding: 2px;', 'label'=>false) );?></li> 
          <li>
          <?php echo $ajax->submit('+ Add', array('url'=> array('controller'=>'users','action'=>'add'), 'update' => 'message','indicator'=>'loader', 'div'=>true, 'style'=>'width: 80px;float:right;margin-right:150px; ')); ?>
          </li>
        </ul>
    <?php echo $form->end(); ?>
      </div>
     
  </fieldset>
</div>  
 
<!-- START: User Listing -->
<fieldset><legend>Search Student </legend>
    <div class="topBar">
      <fieldset><legend onclick="Effect.toggle('showUserFilter','blind', {duration:0.50}); return false"> Filter </legend>
      
        <div id="showUserFilter">
            <?php echo $form->create('User', array('type'=>'post', 'name'=>'UserSearch','id'=>'UserSearch'));?>
            <ul>
              <li><?php echo $form->input('lastname');?></li>
              <li><?php echo $form->input('firstname');?></li>
              <li><?php echo $form->input('username');?></li>
              <li><?php echo $form->input('email');?></li>
              <li><?php echo $form->input('zip');?></li>
          
       
              <li>
              <?php echo $ajax->submit('Search', array('url'=> array('controller'=>'users','action'=>'search'), 'update' => 'user_listing','indicator'=>'loader_listing', 'div'=>true, 'style'=>'margin-right:125px;float:right;width:80px;')); ?>
              </li>
            </ul>
          <?php echo $form->end(); ?> 
            <div style="clear:both; font-weight:normal">Note: Please submit blank form to view all records.</div>
       </div>     
      </fieldset>
    </div>
<div id="loader_listing" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
    <!-- START: User Listing Table -->
    <div id="user_listing"><?php echo $this->requestAction('/admin/users/search'); ?></div>
    <!-- END: User Listing Table --> 
</fieldset>     
<!-- END: User Listing --> 
