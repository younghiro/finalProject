function showRoute() {
    var source = document.getElementById('source');
    var dest = document.getElementById('dest');

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(mapObj);

    directionsService.route(
      {
          origin: {
            query: document.getElementById("source").value,
          },
          destination: {
            query: document.getElementById("des").value,
          },
          travelMode: 'TRANSIT',
          provideRouteAlternatives: true,
        })
        .then((response) => {

            directionsRenderer.setDirections(response);

            var routes = response.routes;

            routes.forEach(function(route, index) {
            polyline = new google.maps.Polyline({
            path: route.overview_path,
            strokeColor: '#' + Math.floor(Math.random()*16777215).toString(16),
            strokeOpacity: 0.8,
            strokeWeight: 4,
            map: mapObj 
            });
          });

          

        })

        .catch((e) => window.alert("Directions request failed due to " + directionsService.DirectionsStatus));
    
    // this functions has many responses to check the results
    // https://developers.google.com/maps/documentation/javascript/directions?hl=ja#TravelModes
}