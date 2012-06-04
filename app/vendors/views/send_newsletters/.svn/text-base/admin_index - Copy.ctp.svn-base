 <div id="message"></div>
<div id="loader" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
<div class="topBar">
  <fieldset><legend> Add User </legend>
  
      <?php echo $form->create('User');?>
      <ul>
        <li><?php echo $form->input('lastname');?></li>
        <li><?php echo $form->input('firstname');?></li>
        <li><?php echo $form->input('username');?></li>
        <li><?php echo $form->input('reviewer_name');?></li>
        <li>
        <label for="UserRole">Role</label><br >
        <?php 
              $options=array('admin'=>'Administrator','coder'=>'Coder');
              echo $form->select('role',$options, null, null, false );
              ?>       
        </li>
        <li>
        <label for="UserSupervised">Supervised</label><br >
        <?php echo $form->input('supervised', array('style'=>'margin-top:2px; padding: 2px;', 'label'=>false) );?></li> 
        <li>
        <?php echo $ajax->submit('+ Add', array('url'=> array('controller'=>'users','action'=>'add'), 'update' => 'message','indicator'=>'loader', 'div'=>true)); ?>
        </li>
      </ul>
    <?php echo $form->end(); ?> 
  </fieldset>
</div>  
 
<!-- START: User Listing -->
<fieldset><legend> Users </legend>
    <div class="topBar">
      <fieldset><legend> Filter </legend>
          <?php echo $form->create('User', array('type'=>'post', 'name'=>'UserSearch','id'=>'UserSearch'));?>
          <ul>
            <li><?php echo $form->input('lastname');?></li>
            <li><?php echo $form->input('firstname');?></li>
            <li><?php echo $form->input('username');?></li>
            <li><?php echo $form->input('reviewer_name');?></li>
            <li>
            <label for="UserRole">Role</label><br >
            <?php 
                  $options=array('admin'=>'Administrator','coder'=>'Coder');
                  echo $form->select('role',$options, null, null, 'Select Role' );
                  ?>       
            </li>
     
            <li>
            <?php echo $ajax->submit('Search', array('url'=> array('controller'=>'users','action'=>'search'), 'update' => 'user_listing','indicator'=>'loader_listing', 'div'=>true, 'style'=>'margin: 18px 10px; ')); ?>
            </li>
          </ul>
        <?php echo $form->end(); ?> 
          <div style="clear:both; font-weight:normal">Note: Please submit blank form to view all records.</div>
      </fieldset>
    </div>
<div id="loader_listing" style="display:none; relative:absolute; margin-top:2px;"><?php echo $html->image("sliderDot.gif"); ?></div>
    <!-- START: User Listing Table -->
    <div id="user_listing"><?php echo $this->requestAction('/admin/users/search'); ?></div>
    <!-- END: User Listing Table --> 
</fieldset>     
<!-- END: User Listing --> 