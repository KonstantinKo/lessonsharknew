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
		 <?php echo $form->create('Trade', array('url' => '/Users/addTrade'));?>
			<div class="login">Add Trade</div>
				<div style="float:left;margin-top:30px;">
 					<div  class="inputTextClass">
						 <?php echo $form->input('symbol', array('label'=>'Company:','class'=>'text_box_register'));?>
					</div>
					
					<div class="inputTextClass">
						<?php echo $form->input('share_size', array('label'=>'Quantity:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<?php echo $form->input('entry_price', array('label'=>'Price:','class'=>'text_box_register'));?>
					</div>
					<div class="inputTextClass">
						<div class="input text"><label for="UserEntryPrice">Trade Type:</label>
							<select name="data[Trade][share_type]" class="text_box_register_select">
								<option value="technical">Technical </option>	
								<option value="fundamental">Fundamental </option>	
                        	</select>
						</div>
					</div>
                    
				
					<div class="inputTextClass">
						<div class="input text"><label for="UserEntryPrice">Notes:</label>
							<textarea name="data[Trade][notes]" rows="6" cols="36" class="text_box_register_textarea"></textarea>
						</div>
					</div>
					
				
				</div>
			<div class="submit">
				<input value="Save" type="submit" id="registerSub" class="butons">
			</div>
			  <?php echo $form->end();?>
            </div>
