<?php
//phpinfo();
?>

<h3>Geolocator</h3>
<div id="demo">
	loading position ...
</div>

<script>

var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
	console.log(".......");
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}


function refresh() {
	getLocation();
	setTimeout('refresh()', 1000);	
}

refresh()

</script>


