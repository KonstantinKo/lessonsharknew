<?php echo $javascript->link('jquery/jquery.form'); ?>
<style>
.submit input
{
    background: #fff;
    border: 1px solid #CCCCCC;
    color: #999999;
    float: left;
   
    height: 26px;
    margin: 8px !important;
    margin-left: 10px;
    margin-right: 10px;
    padding: 3px 0;
    width: 138px;
}
</style>  
<script>
   
   $(document).ready(function() {
    $('#NewsLetterForm').ajaxForm({
        target: '#error-message-top',
        resetForm: false,
        beforeSubmit: function() {
            $('#error-message-top').html('Loading...');
        },
        success: function(response) {
        if (jQuery.trim(response)!='') {
    		 			  $('#error-message-top').html(jQuery.trim(response));			
              }
    		 else {
                $('#error-message-top').html('Thanks for joining us. We will notify you regarding every change...');
                //$('#error-message-top').fadeOut(5000); // optionally hide your form
                $('#error-message-top').delay(5000);
                //window.location="<?php echo $html->url(array('controller'=>'tasks','action'=>'findTask')) ?>"; //to redirect to the second registration page
          } 
        }
    });
}); 

</script>
<div class="f_bottom"> 
<div id="error-message-top">

</div>  
     <?php echo $form->create('NewsLetter',array('id'=>'NewsLetterForm','action'=>'submitEmailCheck','name'=>'submitEmail'));
     
      // echo $form->input('n_email', array('label'=>'','value'=>'EMAIL','id'=>'newsEmail')); 
       ?>
      <input type="text" value="EMAIL" name="data[NewsLetter][n_email]" onblur="this.value=!this.value?'EMAIL':this.value;" onclick="this.value='';"  >
       <?php
      
       echo $form->end('JOIN NEWSLETTER');?>   
    
      
      
      <input type="text" value="" name="" />
      <a href="#">SEARCH</a>
      <h1>CALL 1.877.BLOSSMAN</h1>
      <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>