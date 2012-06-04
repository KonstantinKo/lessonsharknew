<?php ?>
<style>
.main_container
{

height:auto;
margin:0 auto;
text-align: center;
}
</style>
<?php echo $javascript->link('jquery');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>

<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>
<script>
j = $.noConflict();
j('document').ready(function(){ 

	j("#loginDiv").fancybox({
			'showCloseButton'	: false,
			
			
		});

});

	
</script>
<!---main part start-->
<div class="main_container">
	<div class="main_container_top">
		<div class="main_container_wrap">
		   <div class="main_container_top_logo">LessonShark</div>
	 	   <div class="main_container_navi">
		   <ul>
		    <li><a href="/dev1/homes/faq">Become a Student</a></li>
		    <li><a href="#">Become a Teacher</a></li>
		    <li><a href="/dev1/homes/aboutus">About Lesson Shark</a></li>
		    </ul>
		</div>
	</div>
                <div class="main_container_navi_login_btn"><a href="/dev1/homes/login" id="loginDiv">logindiv</a></div>

</div>
