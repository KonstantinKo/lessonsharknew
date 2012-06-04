<?php ?>
<!--<div style="float:left;width:300px;">
		
	<?php  /*foreach($student_arr as $key=>$student)
	 {
	 ?>
	       <div id="<?php  echo $student; ?>" onClick="getVal(<?php echo $key;?>);"> 
	
			<?php echo $student; ?>
		</div>

<?php    } */?>
	</div>-->
<input type="hidden" id="temp">
<?php  foreach($student_arr as $key=>$student)
	 {
	 ?>
	   <div class="shudual_carol" id="<?php  echo $key; ?>" onClick="getVal(<?php echo $key;?>);">
	   <?php echo $student; ?></div>
	    
   <?php } ?>


