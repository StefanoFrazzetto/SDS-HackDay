var map,
	mapNode = document.querySelector("#map"),
	head = document.querySelector("head");

function initMap(){
	map = new google.maps.Map(mapNode, {
		zoom: 7,
		center : new google.maps.LatLng(56.8, -4.4),
		mapTypeId: 'roadmap'
	});
	map.data.loadGeoJson('json/geo.json', { idPropertyName: 'LAD13NM'});
	map.data.setStyle(styleFeature);
	getJobCount();
}

function styleFeature(feature){
	var color = '#000';
	
	if(feature.getProperty('hasColor')){
		color = feature.getProperty('color');
	}
	
	return {
		fillColor: color,
		strokeWeight: 0.5
	};
}

function getJobCount(){
	var get = new XMLHttpRequest();
	get.onreadystatechange = function(){
		if(get.readyState == 4 && get.status == 200){
			var response = JSON.parse(get.responseText);
			console.log(response);
			
			showMapData(response);
		}
	}
	get.open("GET", "adzuna/job", true);
	get.send();
}

function search(str){
	var get = new XMLHttpRequest();
	get.onreadystatechange = function(){
		if(get.readyState == 4 && get.status == 200){
			// TODO: Parse response and display it to the sidebar
		}
	};
	get.open("GET", "adzuna/job" + str, true);
	get.send();
}



function areaColor(highestJob, jobs){
	if(highestJob == job){
		return '#fff';
	}
}

function showMapData(data){
	var locations = data.locations;
	
	var countTotal = 0, highest = 0;
	
	for(var i = 0; i < locations.length; i++){
		if(locations[i].count > highest){
			highest = locations[i].count;
		}
		countTotal++;
	}
	
	for(var i = 0; i < locations.length; i++){
		var area = locations[i].location.area.pop(),
			count = locations[i].count;
		
		var feature = map.data.getFeatureById(area);
		console.log(area + " - " + count + " jobs - " + typeof feature);
		if(feature != null){
			feature.setProperty('hasColor', true);
			feature.setProperty('color', areaColor(highest, count));
		}
	}
	map.data.setStyle(styleFeature);
	console.log(countTotal);
}