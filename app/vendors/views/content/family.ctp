<?php echo $javascript->link('slide-jquery.min');  ?>
<script>
		$(function(){
			$('#slides').slides({
				preload: false,
				generateNextPrev: false,
				slideSpeed:0,
				fadeSpeed:50
		
			});
		});
</script>
<style type="text/css" media="screen">
	 #slides
	 {
    margin-top:16px;
   }
	.slides_container {
	
		display:none;
	}

	.slides_container div.slide {
		width:960px;
		height:509px;
		display:block;
	}
	

	/*
		Optional:
		Reset list default style
	*/
	.pagination {
	  display:none;
  }
.slides_control {
    height: 509px !important;
}


</style>
<div id="slides">
  <div class="slides_container">
      <div class="slide">  
    	   	 <?php echo $html->image('family/TimelineMap_1950s_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	  
    	 <div class="slide">  
    	      <?php echo $html->image('family/TimelineMap_1960s_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    	      <?php echo $html->image('family/TimelineMap_1970s_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_1980s2_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_1980s3_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_1980s_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_1990s_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_2000s1_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_2000s2_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_2010s1_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div>
      <div class="slide">  
    		  <?php echo $html->image('family/TimelineMap_2010s2_July8.png',array('height'=>'509','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	
    	
    	
    
    
  </div>
   <map name="menuline">
      <area shape="rect" coords="910, 90,950,130" href="" class="next" alt="Sun1"/>
   </map>
</div>



    <div class="contact_main">
     <div class="left_contact" id="breadcrumblinks">
     
     <?php
   
       if(isset($pageParent) and $pageParent!='' )
          {
             echo $html->link(__(ucwords(strtolower($pageParent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageParent['Content']['slug'])).'&nbsp;&gt&nbsp;';
            echo "<span id='breadcrumblinksBold'>".$html->link(__(ucwords(strtolower($pageContent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug']))."</span >";
          }
        ?>
        
        <div style="float:left;border-left:1px solid #E8E8E8;margin-top:30px;">
        <div class="text_resi"><?php echo strtoupper($pageContent['Content']['title']);?></div>
        
       <?php echo $pageContent['Content']['body'] ;?>
      </div></div>
       <?php echo $this->element('front/contactSide');
       ?>
    </div>   
  
  </div>
