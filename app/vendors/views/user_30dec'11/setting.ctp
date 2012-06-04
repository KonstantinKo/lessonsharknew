<?php
	echo $javascript->link('jquery/jquery');    
	echo $javascript->link('jquery/jquery.form'); 
	
?>
	<div class="main_containers_middle">
		<?php echo $this->element('front/dashSide');?>
		<div class="right_containre">
         		<div class="sucessPrint">
				  <?php  echo $session->flash(); ?>
			</div>			  
		<?php // echo $form->create('',array('id'=>'postStoreForm','controller'=>'Users','action'=>'addTrade','name'=>'frmCreate','enctype'=>'multipart/form-data')); ?>
		 <?php  if(!isset($totalAmount) ){
			$totalAmount="";
			echo $form->create('consoleSetting', array('url' => '/Users/setting'));		
		}

		else{
				
				
				echo $form->create('consoleSetting', array('url' => '/Users/settingEdit'));		
		}?>
			<div class="login">Console Page Setting</div>
				<div style="float:left;margin-top:30px;">
 					<div  class="inputTextClass">
						 <?php echo $form->input('total_amount', array('label'=>'Total Amount:','class'=>'text_box_register','value'=>$totalAmount));?>
					</div>

				<div  class="setSubmit">
					<input value="Save" type="submit" id="registerSub" class="butons" >
				</div>
	
				
				</div>
		
			
			  <?php echo $form->end();?>
            </div>
