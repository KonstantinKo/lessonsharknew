<?php



$day   =array();
$month =array();
$year  =array();
$day['01']=1;
$day['02']=2;
$day['03']=3;
$day['04']=4;
$day['05']=5;
$day['06']=6;

$month['01']='jan';
$month['02']='feb';
$month['03']='mar';
$month['04']='apr';
$month['05']='may';

$year[2012]=2012;
$year[2013]=2013;


?>
<script>
	 function makeup()
	 {
	     	  var a;
		  var b;
		  a= $('#month').val();
		  b= $('#day').val();
		  c=$('#year').val();
		  d=$('#credit').val();	
		

	 $.ajax({
				  type: 'POST',
				  url : '/dev1/teachers/makeupAjax',
				  data: {month: a, day : b, year :c, credit:d },


			success: function(data) {
			 $.fancybox.close(); 
			
			splt = data.split('$$');

			$('#swapdiv').html('')
			$('#swapdiv').html(splt[0])

			}


		});

	 }


</script>
<div class="modal_main">
	<div class="modal_img"><img src="images/cross_img.PNG"/></div>
	<div class="modal_text_one">Add Make-Up Lesson</div>
	<div class="modal_texts_two">Date lesson took place:</div>
	<div class="select_main1">
      <?php  echo $form->create('User', array('url' => array('controller' => 'teachers', 'action' => 'makeup')));?>
      <?php echo $form->select('day',$day,null, array('label'=>'false','class'=>'select_box' ,'id'=>'day'),'-- Day--');?>
<?php echo $form->select('month',$month,null, array('label'=>'false','class'=>'select_box_two','id'=>'month'),'-- Month--');?>
<?php echo $form->select('year',$year,null, array('label'=>'false','class'=>'select_box', 'id'=>'year'),'--Year--');?>
</div>

<div class="modal_texts_three">How Many make-up credits were used?</div>
<?php echo $form->select('credit',$day,null, array('label'=>'false','class'=>'select_box_three', 'id'=>'credit'),'--Credit--');?>
<div class="clr"></div>
	<div class="save_btn" style="cursor:pointer;" onClick="makeup();"><?php echo $html->image('save_btnnew.png'); ?></div>
<?php echo $form->end(); ?>
</div>



