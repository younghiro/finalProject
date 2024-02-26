let map;
let directionsService;
let directionsRenderer;
let sourceAutocomplete;
let desAutocomplete;


async function initMap() {
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  
  // check u can use the geolocation API
  if ("geolocation" in navigator) {
      var opt = {
        "enableHighAccuracy": true,
        "timeout": 10000,
        "maximumAge": 0,
      };
      navigator.geolocation.getCurrentPosition(setLocation, showErr, opt);
    } 
  else {
      alert("Your broweser can't meet W3C Geolocation standart");
    }
  
}

function setLocation(pos) {

  // get latitude and longinitude
  var lat = pos.coords.latitude;
  var lng = pos.coords.longitude;

  // set up latitude and longinitude
  latlng = new google.maps.LatLng(lat, lng);
  map = document.getElementById("map");
  opt = {
      zoom: 13,
      center: latlng,
  };
  // show google map on device screen
  mapObj = new google.maps.Map(map, opt);
  // set marker
  marker = new google.maps.Marker({
      position: latlng,
      map: mapObj,
      title: 'Current position',
  });

  directionsService = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(mapObj);

  sourceAutocomplete = new google.maps.places.Autocomplete(
    document.getElementById('source')
  )
  desAutocomplete = new google.maps.places.Autocomplete(
    document.getElementById('des')
  )
}


// error functions
function showErr(err) {
  switch (err.code) {
      case 1 :
          alert("You don't have the permission of the location info");
          break;
      case 2 :
          alert("We can't get your device location");
          break;
      case 3 :
          alert("Timeout error");
          break;
      default :
          alert(err.message);
  }
}

// initMap();