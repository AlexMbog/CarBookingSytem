let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12, // Adjust zoom level as needed
    center: { lat: 0, lng: 0 }, // Set initial center to default location
  });

  // Retrieve location data from the database (you'll need to replace this with your actual code to fetch data from the database)
  // For demonstration purposes, let's assume you have the location stored in a variable called `location`
  const location = "<?php echo $booking['booking_location']; ?>";

  // Create a marker for the retrieved location
  const geocoder = new google.maps.Geocoder();
  geocoder.geocode({ address: location }, function (results, status) {
    if (status === "OK") {
      const latLng = results[0].geometry.location;
      new google.maps.Marker({
        position: latLng,
        map: map,
      });
      map.setCenter(latLng); // Center the map on the retrieved location
    } else {
      console.error("Geocode was not successful for the following reason: " + status);
    }
  });
}

// This function is called when the location data is retrieved (you may need to adapt this part based on how you retrieve the location data)
const eqfeed_callback = function (results) {
  // Not needed for this implementation since we're directly adding a single marker in initMap
};

window.initMap = initMap;
window.eqfeed_callback = eqfeed_callback;
