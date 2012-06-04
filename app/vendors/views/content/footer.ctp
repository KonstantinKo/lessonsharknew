
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

   <div class="slider"></div>

    <div class="contact_main">
     <div class="left_contact">
    
        <div style="float:left;border-left:1px solid #E8E8E8;margin-top:30px;">
      
        <div class="text_resi"><?php echo $pageContent['Content']['title'];?></div>
        
       <?php echo $pageContent['Content']['body'] ;?>
      </div>
      </div>
       <?php echo $this->element('front/contactSide');
       ?>
    </div>   
  
  </div>
