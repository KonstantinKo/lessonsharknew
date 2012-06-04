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

	//function initialize() {                                                   
	
		geocoder = new GClientGeocoder();
	
	//}

	function showLocation(dest,src,id) {

		
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
						
						initMap(location2.lat,location2.lon,id);

						                                            
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


</head>

<body style="margin:0px; border:0px; padding:0px;">
<div class="map_images">
<div id="map"></div> </div>
<div style="float:left;width:400px;" >
 <table id="tablesorter-demo" class="tablesorter">
																																     <thead>													
	<tr>
		<th>Locations</th>
		<th>Distance away</th>
		<th>Parking Type</th>
		<th>Rates</th>

	</tr>
	</thead>

 	
	<?php foreach($allGarages as $garage)
	{
	$garageLOcation = $garage['Garage']['g_address'].",".$garage['Garage']['g_city'].",".$garage['Garage']['g_state'].",".$garage['Garage']['g_zip_code'];
	//echo $garageLOcation;
	$id = $garage['Garage']['id'];

	echo "<script type='text/javascript'>";
	echo "showLocation('".$garageLOcation."','".$address."','".$id."')";
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

 
