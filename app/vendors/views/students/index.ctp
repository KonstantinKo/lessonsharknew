	<div class="error">
<?php $arr_year=array(); $arr_year['1']='1 year';$arr_year['2']='2 year';$arr_year['3']='3 year';$arr_year['4']='4 year';$arr_year['5']='5 year';$arr_month=array(); $arr_month['1']='1 month';$arr_month['2']='2 month';$arr_month['3']='3 month';$arr_month['4']='4 month';$arr_month['5']='5 month'; ?>
      <ul> <?php echo $message;
	
		 ?> </ul>
    </div>
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){

		 var homevalue = $(":checked").val()
		$('#student').attr('checked', true);
	     
		  if(homevalue=='guardian')
		       {
			 $('#adult').hide();	  		
			 $('#parent').show();
		       }
                      else if(homevalue=='student')
		       {
                         $('#parent').hide();
	  		 $('#adult').show();
		       }
		      else
			{ 
			 $('#parent').hide();
	  		 $('#adult').show();
			 
			}	      

	     

		$("#guardian").click(function() 
		{
				
			 $('#adult').hide();	  		
			 $('#parent').show();
			
		});
		$("#student").click(function() 
		{
			
			 $('#parent').hide();
	  		 $('#adult').show();
			
		});
                
                


	 })
	
	
</script>
<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>
<!--adult student pages start -->

	<div class="adult_main_text">CREATE AN ACCOUNT </div>
	<?php    echo $form->create('User', array('url' => array('controller' => 'students', 'action' => 'index'						)));?>
	
		<div class="adult_main_select_main">
			<div class="adult_main_selects">I am<span class="adult_main_selects_sapn">    (select one)</span></div>
			<div class="adult_radio_main">
			   <input type="radio" class="adult_radio" name="data[User][type1]" value="guardian" id="guardian" />
			   <div class="adult_radio_text">The parent or guardian of a student who is  under 18 years old.</div>
			</div>

			<div class="adult_radio_main">
			<input type="radio"class="adult_radio" name="data[User][type1]" value="student" id="student" />
			<div class="adult_radio_text">An adult student over the age of 18.</div>
			</div>
		</div>
	<div id="adult" >	
	  <div class="adult_main">
		<div class="adult_input_main">
			<div class="adult_inputleft">
				<div class="adult_inputs_text">First Name</div>
				<?php echo $form->input('firstname', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				<div class="adult_inputs_text">Last Name</div>
				
				<?php echo $form->input('lastname', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				<div class="adult_inputs_text">Email Address</div>
				<?php echo $form->input('email', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				<div class="adult_inputs_text">Password</div>
				<?php echo $form->input('password', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				<div class="adult_inputs_text">Confirm Password</div>
				<?php echo $form->input('cpassword', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				<div class="adult_inputs_text">Zip Code</div>
				<?php echo $form->input('zip', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
			</div>

		<div class="adult_inputright">
			<div class="adult_inputs_text">Instrument</div>
			<?php echo $form->select('dsid1',$des,null, array('label'=>'false','div'=>'','class'=>'adult_inputs_zips'));?>


			<div class="adult_inputs_text">How long have you taken lesson?</div>
			<?php echo $form->select('noofyear',$arr_year,null, array('label'=>'false','div'=>'','class'=>'adult_inputs_zips'));?>




			<div class="adult_inputs_texter">and</div>
			<?php echo $form->select('noofmonth',$arr_month,null, array('label'=>'false','div'=>'','class'=>'adult_inputs_zips'));?>

		</div>

	    </div>
	</div>
	</div>
	
		<div id="parent">
		   <div class="adult_main">	
			<div class="adult_input_main">
				<div class="adult_inputleft">
					<div class="adult_inputs_text">Parent/Guardian First Name</div>
				<?php echo $form->input('parentfname', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
					<div class="adult_inputs_text"> Parent/Guardian Last Name</div>
					<?php echo $form->input('parentlname', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
					<div class="adult_inputs_text">Student's First Name</div>
					<?php echo $form->input('firstname1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
					<div class="adult_inputs_text">Student Last Name</div>
					<?php echo $form->input('lastname1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
					<div class="adult_inputs_text">Email Address</div>
					<?php echo $form->input('email1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
					<div class="adult_inputs_text">Password</div>
					<?php echo $form->input('password1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				
				
					<div class="adult_inputs_text">Confirm Password</div>
					<?php echo $form->input('cpassword1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				
					<div class="adult_inputs_text">Zip Code</div>
					<?php echo $form->input('zip1', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				</div>
				
				<div class="adult_inputright">
					<div class="adult_inputs_text">Instrument</div>
					<?php echo $form->select('dsid',$des,null, array('label'=>'false','div'=>'','class'=>'adult_inputs_zips'));?>
				
				
					<div class="adult_inputs_text">Student Age</div>
					<?php echo $form->input('age', array('label'=>'','class'=>'adult_inputs','div'=>''));?>
				
				
				</div>
			</div>									
	</div>
	</div>
	<div class="aulit_main_btn">
	<div class="aulit_left_btn"><?php echo $html->image('back_to_profile.png'); ?></div>
	<div class="aulit_left_btn"><input type="image" src="/dev1/img/create_btn.png" ></div>
	</div>
<?php echo $form->end(); ?>
</div> 
<!--adult student pages end -->

