<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<style>
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
		#map {
			height: 100%;
		}
	</style>
    <title>Debuggers - Jobs concentration map</title>
</head>
<body>
<div id="map"></div>
		<script src="{{ url('js/map.js') }}"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDICGxukonu4A08SP3IrAlM0madI_e1QBY&callback=initMap"></script>
</body>
</html>