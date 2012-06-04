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
		height:360px;
		display:block;
	}
	

	/*
		Optional:
		Reset list default style
	*/
	.pagination {
	  display:none;
  }


</style>
<div id="slides">
  <div class="slides_container">
      <div class="slide">  
    	   	 <?php echo $html->image('propane/AboutPropane1.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    	     <?php echo $html->image('propane/AboutPropane2.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    	      <?php echo $html->image('propane/AboutPropane3.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    	      <?php echo $html->image('propane/AboutPropane4.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane5.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane6.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane7.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane8.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane9.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane10.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	 <div class="slide">  
    		  <?php echo $html->image('propane/AboutPropane11.png',array('height'=>'350','width'=>'960','USEMAP'=>'#menuline'));  ?>
    	</div> 
    	
    	
    	
    
    
  </div>
   <map name="menuline">
      <area shape="rect" coords="920,230,950,180" href="" class="next" alt="Sun1"/>
   </map>
</div>



    <div class="contact_main">
     <div class="left_contact" id="breadcrumblinks">
     
      <?php
   
       if(isset($pageParent) and $pageParent!='' )
          {
             echo $html->link(__(ucwords(strtolower($pageParent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageParent['Content']['slug'])).'&nbsp;&gt&nbsp;';
			 if ($pageContent['Content']['id'] == "52" ){
			 	 echo "<span id='breadcrumblinksBold'>".$html->link(__($pageContent['Content']['title'], true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug']))."</span>";
			 }
			 else
			 { 
           		 echo "<span id='breadcrumblinksBold'>".$html->link(__(ucwords(strtolower($pageContent['Content']['title'])), true), array('plugin' => 0, 'controller' => 'Content', 'action' => 'page',$pageContent['Content']['slug']))."</span>";
			}	 
          
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
