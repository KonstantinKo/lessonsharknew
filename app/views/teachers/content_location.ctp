 <style type="text/css">

#map { width: 391px; height: 200px; border: 0px; padding: 0px; }
</style>
<script src="http://maps.google.com/maps?file=api&v=1&key=ABQIAAAAHUTHsWKazgTVBys7TTS2SRTMYfXy5bZrslHmql628dp616RHghR6iwxdAPlYB92upTStqZaoVEt3eQ" type="text/javascript"></script>
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
function initMap() {
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
	addMarker(34.583949, -83.749985,'<b>2739 Highway 129 S</b>');
	addMarker(35.1148, -84.8252,'<b>2798 APD 40</b>');
	addMarker(31.993329, -90.374439,'<b>26136 Highway 27</b>');
	addMarker(36.348611, -82.210833,'<b>1121 Highway 19E Bypass</b>');
	addMarker(30.866722, -88.593391,'<b>5183 Main St</b>');
	addMarker(37.315345, -79.53311,'<b>1088 Moneta Rd</b>');

center = bounds.getCenter();
map.fitBounds(bounds);

}
</script>
<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">

<div id="map"></div>

