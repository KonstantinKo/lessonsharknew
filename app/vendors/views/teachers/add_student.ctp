<?php ?>

<script>
 function addstudent()
	 {
	     	  var a;
		  var b;
		  a= $('#email').val();
		  b= $('#fee').val();
		  c=$('#remaining').val();
		  //d=$('#credit').val();	
		alert(a);

	 		$.ajax({
				  type: 'POST',
				  url : '/dev1/teachers/addStudentAjax',
				  data: {email: a, fee : b, remaining :c },


			success: function(data) {
			 $.fancybox.close(); 
			
			//splt = data.split('$$');

			//$('#swapdiv').html('')
			//$('#swapdiv').html(splt[0])

			}


		});

	 }
</script>
<?php    echo $form->create('Student', array('url' => array('controller' => 'teachers', 'action' => 'addStudent',$id)));?>
 
Email: <input type="text" class="student_select" id="email" name="data[Student][email]" >
 <input type="text"  class="student_select" id="fee" name="data[Student][fee]" >
 <input type="text"  class="student_select" id="remaining" name="data[Student][remaining]" >	
 <div class="submit_image"  onClick="addstudent();" >	<?php echo $html->image('save_btnnew.png'); ?></div>
 
 <?php  echo $form->end(); ?>
