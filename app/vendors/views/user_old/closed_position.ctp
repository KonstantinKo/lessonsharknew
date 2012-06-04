	
<?php echo $javascript->link('jquery'); ?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>
<?php echo $javascript->link('jquery.tablesorter'); ?>


<?php echo $html->css('fancybox/jquery.fancybox-1.3.4');
	echo $html->css('styleTable');
 ?>
 <script>
  $('document').ready(function(){  
	
	 $(".popUpClosed").fancybox();
  });
</script>
<script type="text/javascript">
	$(function() {		
		$("#tablesorter-demo").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
		$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});	
</script>
	<div class="main_containers_middle">
		<?php echo $this->element('front/dashSide');?>
		<div class="right_containre">
			<div class="sucessPrint">
				  <?php  echo $session->flash(); ?>
			</div>	
         		<div class="last_main"> 
				<div class="iner_main"><img src="../img/images/close.png"/></div>
					<div class="iiner_between" id="comparisonContainer">
						<table id="tablesorter-demo" class="tablesorter">
						  <thead>						
							<tr>
								
								<th>Symbol</th>
								<th>Size</th>
								<th>Buy</th>
								<th>% Gain</th>
								
								<th>Sold</th>
							</tr>
						    </thead>
							<?php
										//print_r($currentdataTrades);die('here');
										$i=1;
									if(!empty($currentdataTrades))
									{
									
										foreach($currentdataTrades as $valCurrent)
										{
																	
											$i++;
											$even = $i%2;
											$percentGain = 100-$valCurrent['Trade']['entry_price']/ $valCurrent['Trade']['exit_price']*100;
											//$today =date('d,m,Y')
											?>
											<tr <?php if($even==0){?>class="row_col"<?php }?> >
												
												<td><?php echo $valCurrent['Trade']['symbol'];?></td>
												<td><?php echo $valCurrent['Trade']['share_size'];?></td>
												<td><?php echo $valCurrent['Trade']['entry_price'];?></td>
												<td><?php echo round($percentGain,2);?></td>
												<td><?php echo  $valCurrent['Trade']['exit_price'];?></td>

												
												
											</tr>
											<?php
											
										}
									}
									else
									{
									?>
										<tr>
											<td>No Trade has been closed.</td>
										</tr>
									<?php	
									}
									
									 ?>
				
								
							
					
						</table>
					</div>
								
					<div class="gry_bootem1"><img src="../img/images/gry_bcccc_16.png" width="671"/></div>
					
					
				</div>
				
			  
 	</div>
