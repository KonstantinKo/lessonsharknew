<?php echo $javascript->link('jquery'); ?>
<?php echo $javascript->link('jquery.tablesorter');

	echo $html->css('styleTable');
 ?>

<script type="text/javascript">
	$(function() {		
		$("#tablesorter-demo").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
		$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});	
</script>

<div class="main_containers_middle">
		<?php echo $this->element('front/dashSide');?>
			<div class="right_containre">
				<div class="performance">Performance</div>
				<div class="graef_img">
					 <?php  //echo $html->image('images/graf.png'); ?>
			<?php
				//set the max value to show the overall performance graph.
				$maxValue = $totalPortfolioamount+2000;
			?>
					
						<img alt='' src="http://chart.apis.google.com/chart?cht=lc&amp;chs=680x150&amp;chd=t:<?php echo $overPerformanceVal;?>&chxr=1,0,<?php echo $maxValue;?>&chds=0,<?php echo $maxValue;?>&chco=043D6F,FF0000&chxt=x,y&chxl=0:|<?php echo $overPerformanceDates;?>&chm=B,F7FCFD,0,0,0|o,043D6F,0,1,8,0|o,043D6F,0,2,8,0|o,043D6F,0,3,8,0|o,043D6F,0,4,8,0|o,043D6F,0,5,8,0&chg=20,10,1,5&chls=3,1,0&chf=a,s,043D6F">
				</div>
				<div class="about_main">
					<?php echo $html->image('images/gry_13.png'); ?>
					
					<div class="beetween_main_left">
						<div class="arrow_main"><div class="clr"></div>
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Total value</div>	
							<div class="doller_text">$<?php echo $totalPortfolioamount;?></div>
							
						</div>
						<div class="arrow_main"><div class="clr"></div>
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Invested value</div>	
							<div class="doller_text">$<?php echo $totalOpenTrade;?></div>
							
						</div>
						<div class="arrow_main"><div class="clr"></div>
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Gained value</div>	
							<div class="doller_text">$<?php echo $OverallGain;?></div>
							
						</div>
						
						
						<div class="clr"></div>
					
					</div>
					<div class="beetween_main_right">
						<div class="arrow_main">
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Dollar Gain :</div>
							<div class="doller_text">$<?php echo $totalGain;?></div>	
						</div>
						<div class="clr"></div>
						<div class="arrow_main">
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">% Gain :</div>
							<div class="doller_text"><?php echo $totalGainPercent;?></div>	
						</div>
						<?php /*?><div class="arrow_main">
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Total Value:</div>
							<div class="doller_text">$10000</div>	
							
						</div>
						
						<div class="clr"></div>
						<div class="arrow_main">
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">Dollar Gain :</div>
							<div class="doller_text">$10000</div>	
						</div>
						<div class="clr"></div>
						<div class="arrow_main">
							<div class="arrowss_img"><?php echo $html->image('images/arrow_12.png'); ?></div>
							<div class="text_valu">% Gain :</div>
							<div class="doller_text">$10000</div>	
						</div><?php */?>
					</div>		
				
					<div class="gry_bootem"><?php echo $html->image('images/gry_bcccc_16.png'); ?></div>
						
						
					
					</div>
					<div class="middle_main">
						<p class="text_current">Current</p>
							<div class="graphContainer">
								<div style="float:left;width:330px;">
										<div class="top_img"><img src="(../img/images/blackkk_23.png)"/></div>
											<div class="left_main">
													
										<img style="width: 300px;" alt="" src="http://chart.apis.google.com/chart?cht=p&chtt=&chd=t:<?php echo $pieChartValue;?>&chdl=<?php echo $pieChartLegends;?>&chs=300x200&chco=043D6F,FF1123,50B332&chxr=1,0,700&chxr=1,100,1700">
										</div>
										<div class="footerBody">
											<img src="../img/images/console_25.png">
										</div>
										<div class="clr"></div>
										
								</div>	
									
								<div style="float:right;width:330px;">
										<div class="top_imgs"><img src="../img/images/blackkk_23.png)"/></div>
											<div class="right_bottom_main">
													<img style="width: 300px;" alt="" src="http://chart.apis.google.com/chart?cht=p&chtt=&chd=t:<?php echo $pieChartSectorValue;?>&chdl=<?php echo $pieChartSectorLegends;?>&chs=300x200&chco=043D6F,FF1123,50B332&chxr=1,0,700&chxr=1,100,1700">
										</div>
										<div class="footerBodyRight">
											<img src="../img/images/console_25.png">	
										</div>
										<div class="clr"></div>
										
								</div>
								
								<div class="last_main"> 
									<div class="iner_main"><img src="../img/images/open_option_35.png"/></div>
									<div class="iiner_between" id="comparisonContainer">
										<table id="tablesorter-demo" class="tablesorter">
																																     <thead>													
											<tr>
												<th>Date</th>
												<th>Symbol</th>
												<th>Size</th>
												<th>Buy</th>
												<th>% Gain</th>
												
												<th>Price</th>

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
											$percentGain = 100-$allCompanyEntryPrice[$valCurrent['@attributes']['symbol']]/$valCurrent['LastTradePriceOnly']*100;
											//$today =date('d,m,Y')
											?>
											<tr <?php if($even==0){?>class="row_col"<?php }?> >
												<td><?php echo date('d M Y' , strtotime($valCurrent['LastTradeDate'])); ?></td>
												<td><?php echo $valCurrent['@attributes']['symbol'];?></td>
												<td><?php echo $symbolsWithSize[$valCurrent['@attributes']['symbol']];?></td>
												<td><?php echo $allCompanyEntryPrice[$valCurrent['@attributes']['symbol']];?></td>
												<td><?php echo round($percentGain,2);?></td>
												<td><?php echo $valCurrent['LastTradePriceOnly'];?></td>
												
											</tr>
											<?php
											
										}
									}	
									else
									{
										?>
											<tr>
												<td colspan="4">Not yet traded</td>			
											<tr>
										<?php										
										
									}
				
									 ?>
				
											
										<?php // }?>
										
										
										
										</table>
									</div>
												
									<div class="gry_bootem1"><img src="../img/images/gry_bcccc_16.png" width="671"/></div>
									
									
									<div class="clr"></div>
									
								</div>
								
								<div class="clr"></div>
							</div>	
							
						</div>
				</div>
							
		</div>
		<div class="clr"></div><div>

