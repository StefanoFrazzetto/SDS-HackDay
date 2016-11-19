<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Debuggers - Interactive Job Map</title>
    <style type="text/css" href="{{ url('css/app.css') }}"></style>
    <style type="text/css" href="{{ url('css/style.css') }}"></style>
</head>

<body>

    <div id="map"></div>
    <script src="js/map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDICGxukonu4A08SP3IrAlM0madI_e1QBY&callback=initMap"></script>

    <div id="searchbar">
        <input type="text" name="search" placeholder="Search Job Title">
        <div id="searchResults"></div>
    </div>

    <div id="logoContainer">
        <a href="http://imgur.com/0Pv4XjA"><img src="http://i.imgur.com/0Pv4XjA.jpg" title="source: imgur.com"/></a>
    </div>

</body>
</html>