<style>
.error {
    background: none repeat scroll 0 0 #FBE3E4;
    border-color: #FBC2C4;
    color: #D12F19;
}	
</style>
<div class="customers form">
<?php

// let the controller action decide weather to close the modalbox
if (isset($closeModalbox) && $closeModalbox) echo "<div id='closeModalbox'></div>";

// output an ajax or a normal form
if ($ajax->isAjax()) {
	// show ajax form
	echo $ajax->form('User', 'post', array(
		'model'    => 'User',
		'url'      => array( 'controller' => 'users', 'action' => 'edit'),
		'update'   => 'MB_content',
		'complete' => 'closeModalbox()'
	));
} else {
	// show default form
	echo $form->create('User');
}
?>
	<fieldset>
	<?php
		echo $form->input('id');
    echo $form->input('lastname');
    echo $form->input('firstname');
    echo $form->input('username');
    echo $form->input('password');
    echo $form->input('email');
    echo $form->input('zip');
  ?>
        

  
	</fieldset>
<div class="submit">
	<input class="MB_focusable" value="Submit" type="submit">
<div>

<?php echo $form->end();?>
</div>
