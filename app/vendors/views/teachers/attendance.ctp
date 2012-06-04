<?php ?>
<script>
   
 function editattendance()
 {
  var a;
  var b;
  a= $('#comment').val();
  b= $('input[name="data[User][attendance]"]:checked').val();
  c=$('#lessonid').val();
  			   
			   
	
 $.ajax({
			  type: 'POST',
			  url: '/dev1/teachers/attendanceAjax',
			  data: {comment: a, attendance : b, lessonid :c},

			  
		success: function(data) {
		 $.fancybox.close();   	 
			   
		splt = data.split('$$');
			$('#threediv'+c).html('')
			$('#threediv'+c).html(splt[0])
		//	$('#contentToBeReplace').html(splt[1])

		}

	
	});
 
 }

</script>
<div class="main_cont">
    <b>Edit Attendance</b><br/><br/>
    <span style="margin-left:30px;">Cancelation</span><span style="float:right;margin-right:20px;">Lesson Completed</span>
    <?php echo $form->create('User' , array('url' =>array('controller' =>'teachers','action'=>'attendance') ));?>
    <div style="float:left;width:170px;margin-left:30px;">
        <input type="radio" name="data[User][attendance]" value="tutioncredit" >  Tution Credit<br/>
        <input type="radio" name="data[User][attendance]" value="nocredit" >      No-Credit   <br/>
        <input type="radio" name="data[User][attendance]" value="makeupcredit" >  Make-Up Credit<br/>
    </div> 
    <div style="float:right;margin-right:20px;">
        <input type="radio" name="data[User][attendance]" value="completed" >     Completed
    </div>	 
    <div style="margin-top:40px;margin-left:10px;">
        <textarea name="data[User][comment]" id="comment" style="width:400px;border: 1px solid #C9C9C9;"></textarea>
    </div>
    <div class="post_btn" style="cursor:pointer;" onClick="editattendance();" ><img src="/dev1/img/img.png" /></div>
    <?php echo  $form->end(); ?>
</div>
