<?php echo $javascript->link('jquery');?>
<script>
	


		function getVal(a)
		{	

		$('#temp').val(a);	
		
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/studentDet/'+a,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 

		}
		function getshedule()
		{	

		var eng;
		eng = $('#temp').val();	
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/studentDet/'+eng,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 

		}
		function getLesson()
		{
			// here we have used hidden elsement for fetching the current student id	
		var eng;
		eng = $('#temp').val();	
		
				$.ajax
				({
					type: 'GET',
					url: '/dev1/teachers/lessonShedule/'+eng,
					success: function(data) {
							
					splt = data.split('$$');
						
						$('#contentFeatureReplace').html(splt[0])
						$('#contentToBeReplace').html(splt[1])

					}

					
				}); 

		} 	
		function getdetail()
		{
		
		  $('#detail').hide();
			
		  $('#editdetail').show();
		}





                
</script>

<style>

#contentFeatureReplace
{
	float:right;
}
#editdetail
{
	display:none;
}
.boxtext
{	
     border: 1px solid #D1D1D1;
     color: #666666;
     font-family: 'MyriadPro-Bold';
     text-align: center;
}
</style>




<?php  ?>
<div>
<div style="float:left;" id="lesson" onClick="getLesson()" >Lesson Shedule |</div><div style="float:left;" id="sdetail" onclick="getshedule()" >Student Details</div><br/>
	<div style="float:left;width:300px;">
		<input type="hidden" id="temp">
	<?php foreach($student_arr as $key=>$student)
	 {
	 ?>
	       <div id="<?php  echo $student; ?>" onClick="getVal(<?php echo $key;?>);"> 
	
			<?php echo $student; ?>
		</div>

<?php    } ?>
	</div>
</div>
<div id="contentFeatureReplace">
</div>


