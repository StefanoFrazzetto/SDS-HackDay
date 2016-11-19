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
	var color = '#00FF2E';
	
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
	var num = (jobs / highestJob) * 100;
	var color = '';
	
	if(num > 90){
		color =  '#ae5e57';
	}
	if(num > 80){
		color =  '#af6c58';
	}
	if(num > 70){
		color =  '#b17b59';
	} 
	if(num > 60){
		color =  '#b2895a';
	} 
	if(num > 50){
		color =  '#b4985b';
	} 
	if(num > 40){
		color =  '#b5a65c';
	} 
	if(num > 30){
		color =  '#b6b55e';
	} 
	if(num > 20){
		color =  '#acb85f';
	} 
	if(num > 10){
		color =  '#a0b960';
	} else {
		color =  '#94bb61';
	}
	
	return color;
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