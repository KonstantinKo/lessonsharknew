<div class="error">
      <ul> <?php echo $message; ?> </ul>
    </div> 
<?php echo $javascript->link('jquery');?>
<script>
	$('document').ready(function(){
		var count = 0;
	 $(function(){
		$('#newform').click(function(){ $('#formnew').show();});
	   
           
	});
	})
	 function getVal(id)
	{
	   var count = 0;
		
           if(count<8)
            {
	        count += 1;
	       
                 $('#container1'+ id).append('<div style="float: left; width: 146px;margin-bottom:5px;border-bottom: 1px dotted #468897;height: 32px;"><div class="new_edit_mintus_main_left"  ><input    id="TeacherDuration_' + count + '" name="data[TeacherDesciplineField][duration][]' + '" type="text"  /></div><div class="new_edit_mintus_main_right">Minutes</div></div>' );

$('#container2'+id).append(' <div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 304px;margin-bottom:5px;"><div class="new_accordian_main_bx"  ><input type="hidden" value="temp" name="data[TeacherDesciplineField][hidd][]"  ><input id="TeacherLocation_' + count + '" name="data[TeacherDesciplineField][location][]' + '" type="text" /></div></div>' );


 $('#container3'+id).append('<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;"><div class="new_edit_mintus_main_right">$</div><div class="new_edit_mintus_main_lefts"><input id="TeacherRate_' + count + '" name="data[TeacherDesciplineField][rate][]' + '" type="text" /></div></div>' );
$('#container4'+id).append('<div style="float: left; border-bottom: 1px dotted #468897;height: 32px;width: 61px;margin-bottom:5px;"><div class="new_edit_right_delete_x" >x</div><div class="new_edit_right_delete">Delete</div></div>' );

           }
	    }
function delalert()
{
   confirm("Are you sure you want to delete?")
}
</script>


<div class="new_edit_back"></div>
		<div class="clr"></div>
<div class="new_edit_tex">Offerings</div>
		<div class="new_edit_tex_dumy">Use this area to manage the disciplines that you teach.Use the description to detail how you teach each discipline and what a student can<br>expect from these lesson.Once that done,add your lesson offerings for each discipline.
</div>
<?php $id1=1; foreach($discipline as $des22){ foreach($des22 as $des_new){$dse=$discpline_old[$des_new['TeacherDesciplineField']['dsid']];}?>

<?php  echo $form->create('TeacherDesciplineField', array('url' => array('controller' => 'teachers', 'action' => 'editProfile',$id,$idnew='no')));?>
			<div class="new_edit_select_main">
			<?php // $discpline_old[]?>
			<?php echo $form->select('dsid',$discpline_old,null, array('label'=>'false','div'=>''),$dse);?>
		
		   </div>
<div class="new_edit_lesson_package_main">
			<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Duration(min)</div>
				</div>
				
				<div class="new_edit_mintus_main" id="container1<?php echo $id1; ?>" >
					<?php foreach($des22 as $des1){  ?>
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;">		
						<div class="new_edit_mintus_main_left"  ><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][duration][]" type="text"  maxlength="3" value="<?php echo $des1['TeacherDesciplineField']['duration'];?>" /></div>
						<div class="new_edit_mintus_main_right">Minutes</div>
				</div>
					<?php }?>
				</div>
				
				
			</div>  

<div class="new_edit_package_beet">
				<div class="new_edit_package_beet_inner">
				   <div class="new_edit_package_left_inner_text">Location(s)</div>
			        </div>
			        <div class="new_accordian_main" id="container2<?php echo $id1; ?>">
					<?php foreach($des22 as $des1){  ?>
					 <div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 304px;margin-bottom:5px;"> 				        	<div class="new_accordian_main_bx"  >
					<input type="hidden" value="<?php echo $des1['TeacherDesciplineField']['id'];?>"name="data[TeacherDesciplineField][hidd][]"  >
	 					   <input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][location][]" type="text" value="<?php echo $des1['TeacherDesciplineField']['location'];?>"/>
						</div>
	 				</div>
					<?php }?>
			
				</div>
			
			<div class="new_accordian_main_btm_tx" >
	     <?php echo $form->button('+ Add another lesson package' , array('id'=>'addmore','onclick'=>'getVal('.$id1.')'));?></div>
			
			
</div>

<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Rate(USD/hr)</div>
				</div>
<div class="new_edit_mintus_main" id="container3<?php echo $id1; ?>">
				<?php foreach($des22 as $des1){ $description=$des1['TeacherDesciplineField']['description']; ?>
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;">
						<div class="new_edit_mintus_main_right">$</div>
						<div class="new_edit_mintus_main_lefts">
							<input id="TeacherDesciplineFieldRate" maxlength="3" name="data[TeacherDesciplineField][rate][]" type="text" value="<?php echo $des1['TeacherDesciplineField']['rate'];?>"/>
						</div>
					</div>
				<?php }?>	
									
				</div>
				
				
				
					
				</div>
<div class="new_edit_right">
				<div class="new_edit_right_inner">
				   <div class="new_edit_package_left_inner_text">Delete</div>
				</div>
				<div class="new_edit_right_delete_main" id="container4<?php echo $id1; ?>" >
				<?php foreach($des22 as $des1){ ?>
						<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 61px;margin-bottom:5px;">
							<div class="new_edit_right_delete_x" >x</div>
							<div class="new_edit_right_delete" ><?php echo $html->link(__('Delete', true), array( 'controller' => 'teachers', 'action' => 'delrecord',$id,$des1['TeacherDesciplineField']['id']),array('id'=>'deletebutton'.$id1),'Are you sure you want to delete?'); ?>	
 
</div>
						</div>
				<?php }?>
				</div>
					
			
			</div>
			
		
		
			</div>
<div class="new_edit_description">Description</div>
		<div class="new_edit_description_box"><div class="new_edit_description_box_two"><?php echo $this->Form->input('description', array('type' => 'textarea', 'value'=>$description, 'label'=>false)); ?> </div></div>
		
		<div class="clr"></div>
 <div class="submit_image">	<input type="submit" value="Save"></div>
 <?php echo $form->end(); ?>

 
<?php $id1++;}?>


<!--                code for adding new form -->

<div id="formnew" style="display:none;">

<?php  echo $form->create('TeacherDesciplineField', array('url' => array('controller' => 'teachers', 'action' => 'editProfile',$id,$idnew='yes')));?>
			<div class="new_edit_select_main">
			<?php // $discpline_old[]?>
			<?php echo $form->select('dsid',$discpline_old,null, array('label'=>'false','div'=>''),'--select category--');?>
		
		   </div>
<div class="new_edit_lesson_package_main">
			<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Duration(min)</div>
				</div>
				
				<div class="new_edit_mintus_main" id="container1<?php echo $id1; ?>" >
					
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;">		
						<div class="new_edit_mintus_main_left"  ><input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][duration][]" type="text"   /></div>
						<div class="new_edit_mintus_main_right">Minutes</div>
				</div>
					
				</div>
				
				
			</div>  

<div class="new_edit_package_beet">
				<div class="new_edit_package_beet_inner">
				   <div class="new_edit_package_left_inner_text">Location(s)</div>
			        </div>
			        <div class="new_accordian_main" id="container2<?php echo $id1; ?>">
					
					 <div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 304px;margin-bottom:5px;"> 				        	<div class="new_accordian_main_bx"  >
					<input type="hidden" name="data[TeacherDesciplineField][hidd][]"  >
	 					   <input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][location][]" type="text" />
						</div>
	 				</div>
					
			
				</div>
			
			<div class="new_accordian_main_btm_tx" >
	     <?php echo $form->button('+ Add another lesson package' , array('id'=>'addmore','onclick'=>'getVal('.$id1.')'));?></div>
			
			
</div>

<div class="new_edit_package_left">
				<div class="new_edit_package_left_inner">
					<div class="new_edit_package_left_inner_text">Rate(USD/hr)</div>
				</div>
<div class="new_edit_mintus_main" id="container3<?php echo $id1; ?>">
				
					<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 146px;margin-bottom:5px;">
						<div class="new_edit_mintus_main_right">$</div>
						<div class="new_edit_mintus_main_lefts">
							<input id="TeacherDesciplineFieldRate" name="data[TeacherDesciplineField][rate][]" type="text" />
						</div>
					</div>
					
									
				</div>
				
				
				
					
				</div>
			<div class="new_edit_right">
				<div class="new_edit_right_inner">
				   <div class="new_edit_package_left_inner_text">Delete</div>
				</div>
				<div class="new_edit_right_delete_main" id="container4<?php echo $id1; ?>" >
				
						<div style="float: left; border-bottom: 1px dotted #468897;height: 32px; width: 61px;margin-bottom:5px;">
							<div class="new_edit_right_delete_x" >x</div>
							<div class="new_edit_right_delete" >Delete</div>
						</div>
				
		       </div>
					
			
			</div>
			
		
		
			</div>
<div class="new_edit_description">Description</div>
		<div class="new_edit_description_box"><div class="new_edit_description_box_two"><?php echo $form->textarea('description');?> </div></div>
		
		<div class="clr"></div>
<?php $id1++;  ?><div class="submit_image">	<input type="submit" value="Save"></div>
 <?php echo $form->end(); ?>
</div>
 

<div class="new_edit_btm_btn" id="newform">+ Add Another Group Of Offerings</div>
	</div>
