



function initialize() {
   var latRand = Math.floor((Math.random()* 170.000) - 85.000 +1);
    var lngRand = Math.floor((Math.random()* 359.998) - 179.999 +1);
    var geoLoc = "";
   
   

   
   
   // Map properties
   
   
   
   var mapOptions = {
        center: new google.maps.LatLng(latRand, lngRand),
        zoom: 9,
          	

	mapTypeControl: true,
    	mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    	mapTypeId: google.maps.MapTypeId.HYBRID,
		
	zoomControl: true,
    	zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL},
        	
	scaleControl: true,
		};
    // Map creation
    var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
    // Creates geo coder to find address info
    var geocoder = new google.maps.Geocoder();
    
    // Creates marker on main map
    var marker = new google.maps.Marker({
    	position: map.getCenter(),
    	map: map,
    	title: 'Click to zoom'
  	});
    
    // Click event for marker on main map
    google.maps.event.addListener(marker, 'click', function() {	
		
	map.setCenter(marker.getPosition());
	infowindow.open(map,marker);
	});
    
    // Geolocation sensor    
	var userPos;
	var userLng;
	var userLat;
          navigator.geolocation.getCurrentPosition(function(position) {
            userPos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			userLng = position.coords.longitude;
			userLat = position.coords.latitude;
	  });
	
	google.maps.event.addDomListener(document.getElementById('findMe'), 'click', function() {
	
	    map.setCenter(userPos);
	    map.setZoom(15);
	   
		
		var userMarker = new google.maps.Marker({
    	position: map.getCenter(),
    	map: map,
    	title: 'Click to zoom'
		});
		
		var userPosWindow = new google.maps.InfoWindow({
              size: new google.maps.Size(50,50),
			  map: map,
              content: 'Location found using HTML5.'
			  
            });
			
		userPosWindow.setContent('Your current location is:' + '<br/>' + 'Latitude: ' + userLat + ', Longitude: ' + userLng);
		userPosWindow.open(map,userMarker);
		
		document.getElementById('location').value = "";
		document.getElementById('longitude').value = userLng;
		document.getElementById('latitude').value = userLat;
		
		
		var userMarker2 = new google.maps.Marker({
    	position: map2.getCenter(),
    	map: map2,
    	title: 'Click to zoom'
		});
		
            });
    
     
    // Creates small overview map 
    var map2 = new google.maps.Map(document.getElementById('miniMap'), { 
        center: new google.maps.LatLng(latRand, lngRand),
        zoom: 2,    		
    	mapTypeId: google.maps.MapTypeId.TERRAIN,
	disableDefaultUI: true
		});
    
    //Creates marker for small overview map
    var marker2 = new google.maps.Marker({
    	position: map2.getCenter(),
    	map: map2,
  	});
    
    // Click event for marker on small map. This will center the big map
    google.maps.event.addListener(marker2, 'click', function() {
	map.setCenter(marker.getPosition());
	});
    
    // Makes sure that the small map follows any change to the big map.
    google.maps.event.addListener(map, 'center_changed', function() {
	map2.setCenter(map.center);
	});
	
    
    // Creates the info window
    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(50,50)
      	});
    
    // Creates panoramio layer for photos
    var panoramioLayer = new google.maps.panoramio.PanoramioLayer();

    
    
    //Adds panoramio layer
	
	
	
	photolayer = document.getElementById('photolayer');
	
	if (photolayer.checked === true) {
		panoramioLayer.setMap(map);
	}
	
	// Listener to check if panoramio layer tick box is checked.
	
	google.maps.event.addDomListener(photolayer, 'click', function (event) {
		if (photolayer.checked === true) {
			panoramioLayer.setMap(map);
		} else {
			panoramioLayer.setMap(null);
		}
	});
	
	//checkPhoto();
	
    // panoramioLayer.setTag(tag.value);
    // to restrict get rid of panaramio photos.
    // 
    //Click event for clicking on panoramio photo
    google.maps.event.addListener(panoramioLayer, 'click', function(event) {
	var attribution = document.createTextNode(event.featureDetails.title + ": " + event.featureDetails.author);
	});
    
    //Searches for location information from the coordinates and places location name in infowindow.
    geocoder.geocode({'latLng': map.center}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
		geoLoc = results[1].formatted_address;
		
		//Creates format to put in hyperlink and find on Wikipedia.
		
		var geoLocLength = 0;
		var geoSpace = 0;
		var geoLocNew = "";
		var geoStart = 0;
		
		for (i=0;i<geoLoc.length; i++) {
		     if (parseInt(geoLoc.charAt(i)) == 'NaN') {
					    geoStart = i;
						break;
				}
		}
		
		for (i=0;i<geoLoc.length; i++) {
		    if (geoLoc.charAt(i) === "," || geoLoc.charAt(i) === "-") {
					    break;
			} else if (isFinite(parseInt(geoLoc.charAt(i))) === false) {
					    geoLocLength++;
				}
		}
		
		geoLocNew = geoLoc.substr(0,geoLocLength);
		geoLocNew = geoLocNew.replace(/\s/g,"_");
		
		infowindow.setContent(geoLoc + '<br><a href="http://en.wikipedia.com/wiki/' + geoLocNew + '" target="_blank">Search on Wikipedia</a>');
		infowindow.open(map, marker);
		document.getElementById('location').value = geoLoc;
            } else {
		infowindow.setContent('Latitude: ' + latRand + ', Longitude: ' + lngRand);
		infowindow.open(map, marker);
            }
          } else {
		infowindow.setContent('Latitude: ' + latRand + ', Longitude: ' + lngRand);
		infowindow.open(map, marker);
          }
        });

	document.getElementById('longitude').value = lngRand;
	document.getElementById('latitude').value = latRand;
    document.getElementById('location').value = geoLoc;
    }
	


	