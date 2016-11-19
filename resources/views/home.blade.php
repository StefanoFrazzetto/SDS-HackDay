<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Debuggers - Interactive Job Map</title>
    {{--    <style type="text/css" href="{{ url('css/app.css') }}"></style>--}}
    <style type="text/css">
        html, body {
            font-size: 16px;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            position: fixed;
            height: 100%;
            width: 80%;
            float: left;
            margin: 0;
            padding: 0;
        }

        #searchbar {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 20%;
            background-color: lightgrey;
            float: left;
        }

        #searchbar input {
            min-height: 50px;
        }

        #searchResults {
            font-size: 1.35rem;
            margin: 5px;
            padding-left: 5px;
        }

        #logoContainer {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 0;
            margin-left: 5px;
        }

        #logoContainer img {
            max-width: 65%;
        }

        input[type=text] {
            height: 5%;
            width: 94%;
            font-size: 1.35rem;
            margin: 5px;
            padding-left: 5px;
        }

    </style>
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
    <a href="https://www.skillsdevelopmentscotland.co.uk/">
        <img src="http://www.levertraining.com/SiteAssets/employability-fife/SDS_LOGO.JPG" title="Skills Devleopment Scotalnd"/>
    </a>
</div>

<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
</body>

<script>
    $("input").on('keyup', function (e) {
        if (e.keyCode == 13) {
            search($("input").val());
        }
    });
</script>
</html>