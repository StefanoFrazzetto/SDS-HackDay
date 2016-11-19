var map,
	mapNode = document.querySelector("#map"),
	head = document.querySelector("head");

function initMap(){
	map = new google.maps.Map(mapNode, {
		zoom: 7,
		center : new google.maps.LatLng(56.8, -4.4),
		mapTypeId: 'roadmap'
	});
	map.data.loadGeoJson('./json/geo.json', { idPropertyName: 'LAD13NM'});
	map.data.setStyle({
		fillColor: '#fff',
		strokeWeight: 0.5
	});
	getJobCount();
}

function getJobCount(){
	var get = new XMLHttpRequest();
	get.onreadystatechange = function(){
		if(get.readyState == 4 && get.status == 200){
			var response = JSON.parse(get.responseText);
			
			showMapData(response);
		}
	}
	get.open("GET", "/adzuna", true);
	get.send();
}

function showMapData(data){
	var locations = data.locations;
	
	for(var i = 0; i < locations.length; i++){
		var area = locations[i].location.area.pop();
		
		console.log(area);
	}
}