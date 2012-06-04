<html>
<head>
<?php echo $javascript->link('jquery'); ?>
<?php echo $javascript->link('jquery.tablesorter');

	echo $html->css('styleTable');
 ?>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA7j_Q-rshuWkc8HyFI4V2HxQYPm-xtd00hTQOC0OXpAMO40FHAxT29dNBGfxqMPq5zwdeiDSHEPL89A" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {		
		$("#tablesorter-demo").tablesorter({sortList:[[0,0],[2,1]], widgets: ['zebra']});
		$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});	
</script>
  <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">

    var geocoder, location1, location2;
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




	//function initialize() {                                                   
	
		geocoder = new GClientGeocoder();
	
	//}
	var latlongArr = new Array(); 

	function showLocation(dest,src,id,total,cur) {

		//alert(total+'t');alert(cur);

		var destination = dest;
		
		geocoder.getLocations(src, function (response) {
		
			if (!response || response.Status.code != 200)
			{
				alert("Sorry, we were unable to geocode the first address");
			}
			else
			{
				location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
				geocoder.getLocations(destination, function (response) {
					if (!response || response.Status.code != 200)
					{
						alert("Sorry, we were unable to geocode the second address");
					}
					else
					{
						location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
						
						calculateDistance(id);
						
						var latLonval  = location2.lat +'='+ location2.lon +'='+id;
						
						
						latlongArr[cur]=latLonval;   
						
							
						if(cur == total)
						{
							initMap(latlongArr,id);
						}

						                                            
					}
				});
			}
		});
	}


	
	function calculateDistance(id)
	{
		try
		{

			var glatlng1 = new GLatLng(location1.lat, location1.lon);
			var glatlng2 = new GLatLng(location2.lat, location2.lon);
			var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
			var kmdistance = (miledistance * 1.609344).toFixed(1);
			//alert(miledistance);
			document.getElementById(id).innerHTML = miledistance;
		

		}
		catch (error)
		{
			alert(error);
		}
	}

    </script>


 <style type="text/css">
body { font: normal 10pt Helvetica, Arial; }
#map { width: 391px; height: 200px; border: 0px; padding: 0px; }
</style>
<script>

function initMap(latlonArr,id) {
var lat = String(latlonArr);
alert(latlonArr);
	   var element = lat.split(","); 
	   var cont    = element.length;
	  


	map = new google.maps.Map(document.getElementById("map"), {
	center: new google.maps.LatLng(0, 0),
	zoom: 14,
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	mapTypeControl: false,
	mapTypeControlOptions: {
	style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
	},
	navigationControl: true,
	navigationControlOptions: {
	style: google.maps.NavigationControlStyle.SMALL
	}
	});

        var i=1;
	for (i=1;i<=cont;i++)
	{
		var lat = element[i].split("="); 
		//alert(lat[0]);
		//alert(lat[1]);
		addMarker(lat[0],lat[1],'<b>2739 Highway 129 S</b>'+lat[2]);
		
	map.fitBounds(bounds);

	}
	/*addMarker(lat, longt,'<b>2739 Highway 129 S</b>'+id);
	addMarker(34.583949, -83.749985,'<b>2739 Highway 129 S</b>');
	addMarker(35.1148, -84.8252,'<b>2798 APD 40</b>');
	*/

	

}


</script>

</head>

<body style="margin:0px; border:0px; padding:0px;">
<div class="map_images">
<div id="map"></div> </div>
<div style="float:left;width:400px;" >
 <table id="tablesorter-demo" class="tablesorter">
																																     <thead>													
	<tr>
		<th id='location'>Locations</th>
		<th id='dispaly'>Distance away</th>
		<th id='parking'>Parking Type</th>
		<th id='rates'>Rates</th>

	</tr>
	</thead>

 	<?php $total= count($allGarages);
	      $i = 0; 	
	 foreach($allGarages as $garage)
	{
		$i++;
		$garageLOcation = $garage['Garage']['g_address'].",".$garage['Garage']['g_city'].",".$garage['Garage']['g_state'].",".$garage['Garage']['g_zip_code'];
		//echo $garageLOcation;
		$id = $garage['Garage']['id'];

		echo "<script type='text/javascript'>";
		echo "showLocation('".$garageLOcation."','".$address."','".$id."','".$total."','".$i."')";
		echo "</script>";	
		?>
							
		<tr >
			<td><?php echo $id;?></td>
			<td id="<?php echo $id;?>">0</td>
			<td>b</td>
			<td>100</td>
		
		</tr>
	<?php
	}	
	?>


</table>

</div>
</body>

 
