<?php 
	echo $html->css('ui/jquery.ui.all');
	echo $html->css('ui/demos');
	echo $javascript->link('jquery');
	echo $javascript->link('jquery/jquery.form');
	echo $javascript->link('ui/jquery.ui.core'); 
	echo $javascript->link('ui/jquery.ui.core');
	echo $javascript->link('ui/jquery.ui.widget'); 
	echo $javascript->link('ui/jquery.ui.datepicker'); 
	echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4');

?>
	
<script>
	$(function() {
		$( "#popUpClose" ).datepicker();
	});
	
</script>
<style>
.inputTextClass label {
    float: left;
    width: 100px;
    font-size:14px;	
}
.butons
{
	width:135px;
}
</style>
</div>
	<div class="middle_container" style="width:470px;">
	
				  
		 <?php echo $form->create('Trade', array('url' => '/Users/closeTrade/'.$id));?>
			<div class="login">Close Trade</div>
				<div style="float:left;margin-top:30px;">
 					<div  class="inputTextClass">
						 <?php echo $form->input('exit_price', array('label'=>'Exit Price:','class'=>'text_box_register'));?>
					</div>
					
					<div class="inputTextClass">
						 <div class="input text"><label for="TradeExitPrice">Closed Date:</label><input type="text" id="popUpClose" maxlength="50" class="text_box_register" name="data[Trade][exit_date]"></div>					
					</div>
					
				</div>
			<div class="submit">
				<input value="Close Trade" type="submit" id="registerSub" class="butons" >
			</div>
			  <?php echo $form->end();?>
	
