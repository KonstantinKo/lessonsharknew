<?php //pr($start);//pr($end); ?>
<style type="text/css">

#map { width: 360px; height:348px; border: 0px; padding: 0px; }
</style>
<?php echo $javascript->link('jquery');?>
<script>
$('document').ready(function(){
	     $('#loc').change(function() 
                {
		    $('#Teacher').submit();
               });  
	      $('#mon').click(function() 
                {	
		   $('#m').val('Monday');	
		    $('#Teacher').submit();
               });  
		 $('#tue').click(function() 
                {
		    $('#t').val('Tuesday');		
		    $('#Teacher').submit();
               });  
		 $('#thu').click(function() 
                {
			$('#th').val('Thursday');
		    $('#Teacher').submit();
               });  	
           $('#sat').click(function() 
                {
			$('#s').val('Saturday');
		    $('#Teacher').submit();
               });  	 
	 })
</script>
<?php

function geocode_yahoo($all)
{ 
//pr($all);
  //$code=14305;
	$arr_longlat=array();
	 foreach($all as $code1)
	{
	
   
    $url ="http://maps.google.com/maps/geo?q='".$code1."&output=xml&oe=utf8&sensor=false&key=ABQIAAAAS7UiKO51VxvIr9EwNIvTDBSyR8utKjYv1Tub8TtkUFPu8j4b1RRzLNKoRs8EU9qNSEt1itQ6Z6O6kg";
	//pr($url);
	$xml=@file_get_contents($url);
	$xmlOfCurrent = new SimpleXMLElement($xml);
	$array_res = Set::reverse($xmlOfCurrent);
		
	$pieces = explode(",", $array_res['Response']['Placemark']['Point']['coordinates']);
		$lat=$pieces[0];
		$long=$pieces[1];
 		
		$arr_longlat[$lat]=$long;
		
	}
return $arr_longlat;
}  
//pr($arr_longlat);
?>
<script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAS7UiKO51VxvIr9EwNIvTDBSyR8utKjYv1Tub8TtkUFPu8j4b1RRzLNKoRs8EU9qNSEt1itQ6Z6O6kg" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
<script type="text/javascript">
//Sample code written by August Li
var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/red.png",
new google.maps.Size(32, 32), new google.maps.Point(0, 0),
new google.maps.Point(16, 32));
var center = null;
var map = null;
var currentPopup;
var bounds = new google.maps.LatLngBounds();
function addMarker(lat, lng, info) {
var pt = new google.maps.LatLng(lat, lng);
bounds.extend(pt);
var marker = new google.maps.Marker({
position: pt,
icon: icon,
map: map
});
var popup = new google.maps.InfoWindow({
content: info,
maxWidth: 300
});
google.maps.event.addListener(marker, "click", function() {
if (currentPopup != null) {
currentPopup.close();
currentPopup = null;
}
popup.open(map, marker);
currentPopup = popup;
});
google.maps.event.addListener(popup, "closeclick", function() {
map.panTo(center);
currentPopup = null;
});
}
function initMap() 
{
	map = new google.maps.Map(document.getElementById("map"),
	 {
	  center: new google.maps.LatLng(0, 0),
	  zoom: 14,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
          mapTypeControlOptions:
	   {
		style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
	   },
	 navigationControl: true,
	 navigationControlOptions:
	 {
	  style: google.maps.NavigationControlStyle.SMALL
	 }
	 });

<?php
$new1= geocode_yahoo($all); 

foreach($new1 as $key=>$Value)
{

$lat=$key;
$lon=$Value;
// echo ("addMarker($lat, $lon,'<b>df</b>');\n");
 ?>
	addMarker(<?php echo  $lon;?> , <?php  echo $lat; ?>,'<b></b>');
	
<?php
 }
?>
//addMarker(34.583949, -83.749985,'<b>2739 Highway 129 S</b>');

center = bounds.getCenter();
map.fitBounds(bounds);

}
</script>
<div class="another wrapper" style="margin:0 auto;width:992px;">
 <div class="profile_border">
<?php  echo $this->requestAction(array('controller' => 'teachers', 'action' => 'leftSide'), array('return')); ?>

	
  <div class="teach_pro_right_part">
   <div class="teach_pro_right_part_sec">
<?php  echo $form->create('TeacherLocation', array('id'=>'Teacher','url' => array('controller' => 'teachers', 'action' => 'contentOpening',$id)));?>
			
			<?php echo $form->select('dsid',$teacherlocation,null, array('label'=>'false','div'=>'','id'=>'loc','class'=>'teach_pro_op_list'));?>
	<div class="teach_pro_op_days">
     <div class="teach_pro_op_dbox">
      <div class="teach_pro_op_dbox_txt" id="mon"><input type="hidden" id="m" name="data[TeacherLocation][m]" >Monday</div>
     </div>
     <div class="teach_pro_op_dbox">
     <div class="teach_pro_op_dbox_txt" id="tue"><input type="hidden" id="t" name="data[TeacherLocation][t]"  >Tuesday</div>
    </div>
     <div class="teach_pro_op_dbox_color" >
     <div class="teach_pro_op_dbox_txt" id="thu"><input type="hidden" id="th" name="data[TeacherLocation][th]"  >Thursday</div>
    </div>
     <div class="teach_pro_op_dbox">
     <div class="teach_pro_op_dbox_txt" id="sat"><input type="hidden" id="s" name="data[TeacherLocation][s]"  >Saturday</div>
    </div>
    </div>	
 <?php echo $form->end(); ?>		   
	

	<div class="teach_pro_op_time">
		<div class="teach_pro_op_time_colum">
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">8am</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">9am</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">10am</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">11am</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">12pm</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">1pm</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">2pm</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">3pm</div>
			</div>
		</div>		

		<div class="teach_pro_op_time_colum">	
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">3pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">4pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">5pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">6pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">7pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">8pm</div>
			</div>
			<div class="teach_pro_op_time_col_r"></div>
			<div class="teach_pro_op_time_col_r">
				<div class="teach_pro_op_time_col_txt">9pm</div>
			</div>
			<div class="teach_pro_op_time_col"></div>
			<div class="teach_pro_op_time_col">
				<div class="teach_pro_op_time_col_txt">10pm</div>
			</div>

		</div>	

		<div class="teach_pro_op_time_avail"></div>
		<div class="teach_pro_op_time_avail_txt">Available</div>
	</div>
	<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
		<div class="teach_pro_op_map" id="map">	</div>


	</div>	
   </div>
  </div>
 </div>
</div>
