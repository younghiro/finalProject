function showRoute() {
    var source = document.getElementById('source');
    var dest = document.getElementById('dest');

    directionsService.route(
      {
          origin: {
            query: document.getElementById("source").value,
          },
          destination: {
            query: document.getElementById("des").value,
          },
          travelMode: google.maps.TravelMode.TRANSIT,
        })
        .then((response) => {
          directionsRenderer.setDirections(response);
        })
        .catch((e) => window.alert("Directions request failed due to " + DirectionsStatus));

    
    // this functions has many responses to check the results
    // https://developers.google.com/maps/documentation/javascript/directions?hl=ja#TravelModes
}