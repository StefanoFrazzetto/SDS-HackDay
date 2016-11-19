var map,
	mapNode = document.querySelector("#map"),
	head = document.querySelector("head");

function initMap(){
	map = new google.maps.Map(mapNode, {
		zoom: 7,
		center : new google.maps.LatLng(56.8, -4.4),
		mapTypeId: 'roadmap'
	});
	map.data.loadGeoJson('./json/geo.json');
	map.data.setStyle({
		fillColor: '#fff',
		strokeWeight: 0.5
	});
}