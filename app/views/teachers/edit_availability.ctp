

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<?php echo $html->css('fullcalendar'); ?>
<?php echo $html->css('fullcalendar.print'); ?>
<?php echo $javascript->link('jquery-1.5.2.min');?>
<?php echo $javascript->link('fullcalendar.min');?>
<?php echo $javascript->link('jquery-ui-1.8.11.custom.min');?>
<?php echo $javascript->link('ui/jquery.ui.core');?>
<?php echo $javascript->link('ui/jquery.ui.widget');?>
<?php echo $javascript->link('ui/jquery.ui.mouse');?>
<?php echo $javascript->link('ui/jquery.ui.button');?>
<?php echo $javascript->link('ui/jquery.ui.draggable');?>
<?php echo $javascript->link('ui/jquery.ui.position');?>
<?php echo $javascript->link('ui/jquery.ui.resizable');?>
<?php echo $javascript->link('ui/jquery.ui.dialog');?>
<?php echo $javascript->link('ui/jquery.ui.effects.core');?>
<?php echo $javascript->link('jquery.fancybox/fancybox/jquery.fancybox-1.3.4'); ?>



<?php echo $html->css('fancybox/jquery.fancybox-1.3.4'); ?>



<script type='text/javascript'>
	
 	$.noConflict();
 	jQuery(document).ready(function() {
		
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var currentBox = null;
		
		var calendar =  jQuery('#calendar').fullCalendar({
			//hides M/D    
			columnFormat:{
				agendaWeek:'dddd'
			},
			//hides all day area
			allDaySlot:false,

			//Set the time interval
			slotMinutes: 15,
			
			//sets the calendar to display only times after 8AM
			minTime:{
				agendaWeek:'6'
			},
			maxTime:{
				agendaWeek:'24' //sets calendar to display only times before 11pm
			},
			events: "/dev1/events/feed",

			selectable: true, //allows user to drag&drop a block
			selectHelper: true, //displays start/end time
			select: function(start, end, allDay) {
			
				var eventdialog = jQuery('<div></div>')
				
					//var title = prompt('Event Title:');
					//This is the content
					
					.html('This is the Dialog Box')
					
					.dialog({
						autoOpen: false,
						title: 'New Availability Block',
						modal:true
				
				}); //end of event dialog

				//open the dialog
				if (!currentBox) {
					eventdialog.dialog('open');
					currentBox = eventdialog;
				}
				

				// prevent the default action, e.g., following a link
				return false;
				////Render the event when user clicks Save button (not complete)
				if (eventdialog) { //render the event
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
			},  ///

			eventClick: function(calEvent, jsEvent, view) {
				jQuery("#eventdata1").show();
				jQuery("#eventdata1").load("<?php echo Dispatcher::baseUrl();?>/events/edit/"+calEvent.id);
				jQuery('#clickDiv1').click();
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc)
			{	
				if (dayDelta>=0) 
				{
					dayDelta = "+"+dayDelta;
				}
				if (minuteDelta>=0) 
				{
					minuteDelta="+"+minuteDelta;
				}
				jQuery.post("/dev1/events/resize/"+event.id+"/"+dayDelta+"/"+minuteDelta);
			},

			eventColor: '006BB8',
			eventBackgroundColor:'null',
			eventTextColor: '#fff',
			eventBorderColor: 'red',
			unselectAuto: 'false',

	    events: [
	      {
	        title  : 'Available',
	        start  : '2012-05-22 10:30:00',
					end	   : '2012-05-22 14:30:00',
	        allDay : false // will make the time show
	      }
	    ],
		});

		jQuery('#calendar').fullCalendar('changeView', 'agendaWeek');
		
		jQuery("#clickDiv").fancybox();
	  jQuery("#clickDiv1").fancybox();
		
		
		//jQuery Dialog Start
		var dialog = jQuery('<div></div>')
			.html('This dialog will show every time!')
			.dialog({
				autoOpen: false,
				title: 'Basic Dialog'
			});

		jQuery('#opener').click(function() {
			dialog.dialog('open');
			// prevent the default action, e.g., following a link
			return false;
		});//jQuery Dialog End

		jQuery(".ui-widget-overlay").live("click", function (){
	    jQuery("div:ui-dialog:visible").dialog("close");
	  });
	}); //end of Document Ready


	
	

</script>
<script>
	jQuery(document).ready(function() {

	});
</script>
<script>

</script>

</head>
<body>
	<div class="profile_border">
		<div class="new_edit_tex_media"> 
			<h1>Share Availability</h1> 
		</div> 
		<div class="availability_top_texts"> 

			Click and drag to create an <span class="blue_txt">Opening
		Block</span>. Potential students can book lessons within your availability. If you have a student booked for a time during an availability block, Lessonshark will automatically make you unavailable.

		</div>

		<div id="event_dialog" title="Event D"></div> 
		<div style="display:none;">
			<div id="eventdata"> 
			<?php echo $this->requestAction(array('controller' => 'events', 'action' =>
				'add'), array('return')); ?>

			</div> 
		</div> 
		<div style="display:none;"> 
			<div id="eventdata1"> 
			<?php echo $this->requestAction(array('controller' => 'events', 'action' => 'edit'), array('return')); ?>
			</div> 
		</div>
		<div style="display:none;"> 
			<div class="butons_demo">
				<a href="#eventdata" id="clickDiv">click
		here</a>
			</div> 
			<div class="butons_demo">
				<a href="#eventdata1" id="clickDiv1">click here</a>
			</div>
		</div> 
	<!--The below div is where the calendar displays--> 
	<div id='calendar'></div>
	</div>
</body>
</html>
