// function initCoords() {
//     if (navigator.geolocation) {
//       navigator.geolocation.getCurrentPosition(initMap, locationError);
//     } else {
//       showError("Your browser does not support Geolocation!");
//     }
//   }

function initMap(pos) {
    const center = { lat: pos.coords.latitude, lng: pos.coords.longitude }; // Tokyo, for example

    
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: center,
    });

    const request = {
        query: "ボードゲーム",
        location: center,
        radius: '5000',
    };

    const service = new google.maps.places.PlacesService(map);
    service.textSearch(request, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && results) {
            for (let i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
            map.setCenter(results[0].geometry.location);
        }
    });

    function createMarker(place) {
        if (!place.geometry || !place.geometry.location) return;
        new google.maps.Marker({
            map,
            position: place.geometry.location,
            title: place.name
        });
    }
}