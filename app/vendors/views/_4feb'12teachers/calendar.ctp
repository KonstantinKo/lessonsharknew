<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<?php echo $html->css('fullcalendar'); ?>
<?php echo $html->css('fullcalendar.print'); ?>
<?php echo $javascript->link('jquery-1.5.2.min');?>
<?php echo $javascript->link('fullcalendar.min');?>
<?php echo $javascript->link('jquery-ui-1.8.11.custom.min');?>

<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			
			
			events: "/lessonshark1/teachers/feed",
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			        },
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay)
			 {
				var title = prompt('Event Title:');
				if (title) 
				{
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			
			editable: true,
			
		});
		
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
<div id='calendar'></div>
</body>
</html>
