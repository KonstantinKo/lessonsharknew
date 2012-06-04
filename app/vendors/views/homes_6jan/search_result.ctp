		
	</div>
</div>
<?php echo $javascript->link('jquery'); ?>
<?php echo $javascript->link('jquery.tablesorter');

	echo $html->css('styleTable');
$letter = array('1'=>'A','2'=>'B','3'=>'C','4'=>'D','5'=>'E','6'=>'F','7'=>'G','8'=>'H','9'=>'I','10'=>'J','11'=>'K','12'=>'L','13'=>'M','14'=>'N','15'=>'O',
'16'=>'P','17'=>'Q','18'=>'R','19'=>'S','20'=>'T','21'=>'U','22'=>'V','23'=>'W','24'=>'X','25'=>'Y','26'=>'Z');

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

	function showLocation(dest,src,id,total,cur,letter,spaceId) {

		//alert(letter);

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

						calculateDistance(id,spaceId,letter);

						var latLonval  = location2.lat +'='+ location2.lon +'='+letter;


						latlongArr[cur]=latLonval;
						//alert(id);

						
						
						if(cur == total)
						{
							initMap(latlongArr,id);
						}


					}
				});
			}
		});
	}



	function calculateDistance(id,spaceId,letter)
	{
		try
		{

			var glatlng1 = new GLatLng(location1.lat, location1.lon);
			var glatlng2 = new GLatLng(location2.lat, location2.lon);
			var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
			var kmdistance = (miledistance * 1.609344).toFixed(1);
			//alert(miledistance);
			//var a = $('#a-'+id).val();
			var spId =$('#a-'+spaceId).val();

			$('#a-'+spaceId).val(spId+'-'+miledistance+'-'+letter);
			
			document.getElementById(id).innerHTML = miledistance+" Miles";


		}
		catch (error)
		{
			alert(error);
		}
	}

     </script>


 <style type="text/css">
body { font: normal 10pt Helvetica, Arial; }
#map { width: 283px; height: 325px; border: 0px; padding: 0px; }
</style>
<script>

function initMap(latlonArr,id) {
var lat = String(latlonArr);

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
		//alert(lat[2]);
		//alert(lat[0]);
		//alert(lat[1]);
		addMarker(lat[0],lat[1],lat[2]);

	map.fitBounds(bounds);

	}
	/*addMarker(lat, longt,'<b>2739 Highway 129 S</b>'+id);
	addMarker(34.583949, -83.749985,'<b>2739 Highway 129 S</b>');
	addMarker(35.1148, -84.8252,'<b>2798 APD 40</b>');
	*/



}


</script>
<?php
 $total = 0;
	 foreach($allGarages as $garageTotal)
	{
		if(!empty($garageTotal['GarageSpace']) and is_array($garageTotal['GarageSpace']))
		{
		 $total=  $total+1;	
		}	
	}
?>

<div class="midContainer">

				<div class="clr"></div>

		<div class="midContainer_left_part_iner_second">
		<div class="midContainer_top_textsd">Select which parking Facility best suits your needs.</div>
					<div class="midContainer_left_part_iner_second_leftes">
						<div class="sign_top_text_searches_new">Search results for : <?php echo $this->Session->read('searchQuery.homes.sapce');?> space near <?php echo $this->Session->read('searchQuery.homes.address');?>, <?php echo $this->Session->read('searchQuery.homes.arrivalTime');?>-<?php echo $this->Session->read('searchQuery.homes.returnTime');?></div>
						<div class="sign_top_text_searches_black_baner">There are <?php echo $total;?> options available</div>
						<div class="sign_top_text_searches_black_map">
							<div class="map_images">
								<div id="map"></div>
							 </div>
						</div>
																</div>

					<div class="midContainer_bee_imgty"></div>
				<?php 
					if(!empty($allGarages))
					{
				?>
					 <?php echo $form->create('homes',array('id'=>'postStoreForm','action'=>'confirmLocation','name'=>'frmCreate')); ?>
					<div class="midContainer_left_part_iner_second_right">
					<div class="midContainer_left_part_iner_second_right_sap"></div>
						
							<div class="sign_top_text_searches_table">


								
								<table id="tablesorter-demo" class="tablesorter">
																																     <thead>													
	<tr>
		<th  style="float:left;width:20px!important;background:#fff !important;background-image:none !important;">&nbsp;</th>
		<th id='location'></th>
		<th id='dispaly'></th>
		<th id='parking'></th>
		<th id='rates'></th>


	</tr>                      
	</thead>

 	<?php



	      $i = 0; 	
       foreach($allGarages as $garage)
	{

		if(!empty($garage['GarageSpace']) and is_array($garage['GarageSpace']))
		{
			$i++;
			$garageLOcation = $garage['Garage']['g_address'].",".$garage['Garage']['g_city'].",".$garage['Garage']['g_state'].",".$garage['Garage']['g_zip_code'];
			//echo $garageLOcation;	
			//echo $address;die;
			$id = $garage['Garage']['id'];

		
			?>
		
							
			<tr >
				<td style="float:left;width:20px!important;"> 
		<input type="radio" id="a-<?php echo $garage['GarageSpace']['GarageAvailSpace']['id'];?>" class="sign_top_text_searches_radio" name="data[homes][select]" value='<?php echo $garage['GarageSpace']['GarageAvailSpace']['id'];?>' <?php if($i==1){echo 'selected';}?>/></td>
				<td><?php echo $letter[$i];?></td>
				<td id="<?php echo $id;?>">0</td>
				<td><?php  echo $garage['GarageSpace']['GarageAvailSpace']['location'];?></td>
				<td>$<?php echo $garage['Garage']['rate_hrs'];?>&nbsp;/hr</td>
		
			</tr>
		<?php
			echo "<script type='text/javascript'>";
			echo "showLocation('".$garageLOcation."','".$address."','".$id."','".$total."','".$i."','".$letter[$i]."','".$garage['GarageSpace']['GarageAvailSpace']['id']."')";
			echo "</script>";
		}
	}	
	?>


</table>


								</div>

								<div class="sign_top_text_searches_submit_btn">
									<input type="image" src="/parker/img/images/sumit_btn.png" name="loginSbmt">	
								</div>

							</div>
					<?php echo $form->end();?>
					<?php
					}
					else
					{
					?>
						<div class="midContainer_left_part_iner_second_right">
							<div  class="noRecord">No Record Found</div>
						</div>
					<?php
						
					}
					?>
							</div>

	</div>
