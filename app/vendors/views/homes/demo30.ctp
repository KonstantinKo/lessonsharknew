<?php /*?><div class="gry_main"><div class="top_bor"></div>
	<?php echo $this->element('front/topheader');?>
	
 </div><?php */?>
<?php 

	echo $html->css('ui/jquery.ui.all');
	echo $html->css('ui/demos');

	echo $javascript->link('jquery');
	echo $javascript->link('jquery/jquery.form');
	echo $javascript->link('ui/jquery.ui.core'); 
	echo $javascript->link('ui/jquery.ui.core');
	echo $javascript->link('ui/jquery.ui.widget'); 
	echo $javascript->link('ui/jquery.ui.datepicker'); 

	

?>

    
<style>
/* css for demop page*/
.lableTrade{width:160px;float:left;font-size:14px;font-weight:bold;}
.valueTrade{float:left;font-size:12px;}
.container{width:48%;float:left;line-height:0px;}
.containerMain{float:left;padding-bottom:20px;border-bottom: 1px dotted;border-top: 1px dotted;}
.userRequirementForm{float:left;width:250px;margin-top: 25px;}
.inputMainClass{float:left;padding-left: 50px;}
.inputMainClass input{ float: left;height: 40px;margin-bottom: 5px;width: 150px; padding-left: 5px;}
#replaceChart{margin-top:20px;float:left;}

/* end css for demop page*/
</style>
<script>
   
   $(document).ready(function() {
	
    $('#tradeForm').ajaxForm({
        /*target: '#error-message-top',*/
        resetForm: false,
        beforeSubmit: function() {
            $('#error-message-top').html('Loading...');
        },
	 
        success: function(response) {
		alert(response);
        if (jQuery.trim(response)!='') {
    		 			  $('#replaceChart').html(jQuery.trim(response));	
					  $('#error-message-top').hide();		
              }
    		 else {
                $('#error-message-top').html('Thanks for contact us. We will contact you very soon...');
                //$('#error-message-top').fadeOut(5000); // optionally hide your form
                $('#error-message-top').delay(5000);
                //window.location="<?php echo $html->url(array('controller'=>'tasks','action'=>'findTask')) ?>"; //to redirect to the second registration page
          } 
        }
    });
}); 

  </script>	
<script>
	$(function() {
		$( "#dateEntered" ).datepicker();
	});
	$(function() {
		$( "#dateExited" ).datepicker();
	});
	</script>



	
	<div  style="width:1000px;float:left;text-align:center;">
	<h3>User Trade Details</h3>
	
	
		<div class="containerMain">
			<span class="container">
				<p class="lableTrade">Symbols:</p>
				<p class="valueTrade"><?php echo $demoTrade['Trade']['symbol'];?></p>
			</span>
			<span class="container">
				<p class="lableTrade">Entry Price:</p>
				<p class="valueTrade"><?php echo '$'.$demoTrade['Trade']['entry_price'];?></p>
			</span>
			<span class="container">
				<p class="lableTrade">Exit Price:</p>
				
				<p class="valueTrade"><?php echo date("d M y", strtotime($demoTrade['Trade']['entry_date'])).' To '.date("d M y", strtotime($demoTrade['Trade']['exit_date']));?></p>
			</span>
			<span class="container">
				<p class="lableTrade">Approximate Profit:</p>
				<p class="valueTrade"><?php echo '$'.$totalProfit;?></p>
			</span>
		</div>
		<div class="userRequirementForm">
		<div class="error-message-top" id='error-message-top'>  
		  <!-- Error will be shown Here -->
    		</div>		
		<?php echo $form->create('Home',array('id'=>'tradeForm','controller'=>'homes','action'=>'checkTradeDetails','name'=>'submittrade')); ?>
			<div class="inputMainClass">
				 <input type="text"  value="Company Symbol"  onclick="this.value='';" name="data[Home][symbol]" onblur="this.value=!this.value?'Company Symbol ':this.value;"/>
				 <input type="text"  value="Price of Per Share"  onclick="this.value='';" name="data[Home][price]" onblur="this.value=!this.value?'Price of Per Share':this.value;"/>
		 	
	    			<input type="text"  value="Quantity" onclick="this.value='';" name="data[Home][quantity]" onblur="this.value=!this.value?'Quantity':this.value;"/>
				<input type="text" id="dateEntered" value="Date Entered" onclick="this.value='';" name="data[Home][date_entered]" onblur="this.value=!this.value?'Date Entered ':this.value;"/>
				<input type="text"  value="Exit Price" onclick="this.value='';" name="data[Home][exit_price]" onblur="this.value=!this.value?'Exit Price ':this.value;"/>
				<input type="text"  id="dateExited" value="Date Exited" onclick="this.value='';" name="data[Home][dete_exited]" onblur="this.value=!this.value?'Date Exited ':this.value;"/>
				<input type="submit" value="Get Info" id="getInfoSbmt">
				
			</div>
		<?php echo $form->end();?>
		</div>
		<span id="replaceChart">
		<?php	
		 $color = array(
				  '043D6F'
			       );
		
		//use google chart api to show the graph    
		$this->GoogleChart->setChartAttrs(array(
			    'type'         => 'line',
			    'title'     => '',
			    'data'         => $arrayForGraph,
			    'size'         => array( 700, 400 ),
			    'color'     => $color,
			    'labelsXY'     => true,
			    'min'        => array(min(array(0,1,2,3,4,5,6,7,700))),
			    'max'        => array(max(array(0,1,2,3,4,5,6,7,700))),
			    'legend'    => false	
			     
			)
		    );


		    //show graph chart	
		    echo $googleChart; 
		?></span>
