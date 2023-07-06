<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GoogleMap</title>
</head>
<body>
    <div id="map" style="height: 100vh; width: 100%;"></div>


    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    {{-- <script src="{{ asset('/js/setLocation.js') }}"></script> //追加 --}}
    
    {{-- <script src="{{ asset('/js/currentBoardGame.js') }}"></script> //追加 --}}
    <script>
        if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
  } else {
    console.log("Geolocation is not supported by your browser.");
  }
  
  function successCallback(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    console.log("Latitude: " + latitude);
    console.log("Longitude: " + longitude);
  }
  
  function errorCallback(error) {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        console.log("User denied the request for Geolocation.");
        break;
      case error.POSITION_UNAVAILABLE:
        console.log("Location information is unavailable.");
        break;
      case error.TIMEOUT:
        console.log("The request to get user location timed out.");
        break;
      case error.UNKNOWN_ERROR:
        console.log("An unknown error occurred.");
        break;
    }
  }
    </script>
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap">
    </script> --}}
</body>
</html>
