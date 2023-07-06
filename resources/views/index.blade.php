<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GoogleMap</title>
</head>
<body>
    <div id="map" style="height: 100vh; width: 100%;"></div>

    <script>
        function initMap() {
            const center = { lat: 35.6895, lng: 139.6917 }; // Tokyo, for example
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
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap">
    </script>
</body>
</html>
