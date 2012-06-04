<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<?php echo $html->css('fullcalendar'); ?>
<?php echo $html->css('fullcalendar.print'); ?>
<?php echo $javascript->link('jquery-1.5.2.min');?>
<?php echo $javascript->link('fullcalendar.min');?>
<?php echo $javascript->link('jquery-ui-1.8.11.custom.min');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>



<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>



<script type='text/javascript'>
	 $.noConflict();
	 jQuery(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar =  jQuery('#calendar').fullCalendar({
	       
			
			events: "/lessonshark1/events/feed",
			dayClick: function(date, allDay, jsEvent, view)
			 {
				
				 jQuery("#eventdata").show();
			    	 jQuery("#eventdata").load("<?php echo Dispatcher::baseUrl();?>/events/add/"+allDay+"/"+ jQuery.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
		
				 jQuery('#clickDiv').click();
				
			    	
			 },
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			        },
			selectable: true,
			selectHelper: true,
			
			
			editable: true,
			
			
		});

	jQuery("#clickDiv").fancybox();
		
	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div style="display:none;">
<div id="eventdata">
<?php echo $this->requestAction(array('controller' => 'events', 'action' => 'add'), array('return')); ?>	

</div></div>


<div class="butons_demo"><a href="#eventdata" id="clickDiv">click here</a></div>

<div id='calendar'></div>

</body>
</html>
