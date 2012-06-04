<?php
	  
 $color = array(
				  '043D6F'
			       );
				$dataMultiple = array(5,1,2,9,10,4);
			//use google chart api to show the graph    
			$this->GoogleChart->setChartAttrs(array(
				    'type'         => 'line',
				    'title'     => '',
				    'data'         => $dataMultiple,
				    'size'         => array( 700, 400 ),
				    'color'     => $color,
				    'labelsXY'     => true,
				    'min'        => array(min(array(0,1,2,3,4,5,6,7,70))),
				    'max'        => array(max(array(0,1,2,3,4,5,6,7,70))),
				    'legend'    => false	
				     
				)
			    );


		    //show graph chart	
		    echo $googleChart; 
?>
