<?php echo $javascript->link('jquery');?>



<img alt='' src='http://chart.apis.google.com/chart?cht=lc&amp;chs=750x150&amp;chd=t:200,300,700,400,300,600,1600&chxr=1,0,2000&chds=0,1700&chco=043D6F,FF0000&chxt=x,y&chxl=0:|1|3|4|5|6
|7&chm=B,F7FCFD,0,0,0|o,043D6F,0,1,10,0|o,043D6F,0,7,10,0&chg=20,10,1,5&chls=3,1,0'>

<?php /*?>
	
<img style="width: 700px;" alt="" src="http://chart.apis.google.com/chart?cht=p3&chs=450x200&chd=t:2,4,3,1&chl=Phones|Computers|Services|Other&chtt=Company%20Sales&chco=ff0000">

<img style="width: 700px;" alt="" src="http://chart.apis.google.com/chart?cht=p&chtt=&chd=t:51,11,12,19&chl=0|1|2|3&chs=700x400&chco=043D6F&chm=B,F7FCFD,0,0,0&chxt=x,y&chf=a,s,ffffff&chds=0,700&chxr=1,0,700&chbh=a&chg=20,10,1,5"><?php */?>


<?php	
		 $color = array(
				  '043D6F',
				   'FF1123',
				   '50B332'		
			       );
		$dataMultiple = array(25,25,50,60);
		//use google chart api to show the graph    
		$this->GoogleChart->setChartAttrs(array(
			    'type'         => 'pie',
			    'title'     => '',
			    'data'         => $dataMultiple,
			    'size'         => array( 200, 300 ),
			    'color'     => $color,
			    'labelsXY'     => true,
			     'chl'   	=>'',	
			    'min'        => array(min(array(0,1,2,3,4,5,6,7,700))),
			    'max'        => array(max(array(0,1,2,3,4,5,6,7,700))),
			    'legend'    => array('Apple','Google','rel','tata')
			     
			)
		    );


		    //show graph chart	
		    echo $googleChart; 
		?>
