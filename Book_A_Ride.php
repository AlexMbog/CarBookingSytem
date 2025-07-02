<?php
session_start();
include 'conn.php';
$userID = "";
$username = "";
$userNumber = ""; 

function getUserInfoIfLoggedIn($conn) {
    global $userID, $username, $userNumber; 
   
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        
        $userId = $_SESSION["User_ID"];

        $query = "SELECT * FROM users WHERE User_ID = '$userId'";
        $result = $conn->query($query);

      
        if ($result && $result->num_rows > 0) {
           
            $userInformation = $result->fetch_assoc();
            
           
            $userID = $userInformation['User_ID'];
            $username = $userInformation['User_Name'];
            
            $userNumber = $userInformation['User_Phone_Number'];
        } else {
            echo "User not found.";
        }
    } else {
      header("Location: user_login.php"); 
    }
}
getUserInfoIfLoggedIn($conn);


$query = "SELECT sacco_id, sacco_name FROM saccos";
$result = $conn->query($query);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $saccoId = isset($_POST['sacco_id']) ? $_POST['sacco_id'] : null;
    $numSeats = $_POST['numSeats'];
    $passengerName = $_POST['passengerName'];
    $contactNumber = $_POST['contactNumber'];
    $shareLocation = isset($_POST['shareLocation']) ? 1 : 0; 
    $locationInput = $_POST['locationInput']; 
    $destinationInput = $_POST['destinationInput']; 
    
    $query = "INSERT INTO bookings (booking_user_id, booking_num_seats, booking_passenger_name, booking_contact_number, booking_share_location, booking_location, booking_destination, booking_payment_status)
              VALUES (?, ?, ?, ?, ?, ?, ?, 0)"; 
    
    $stmt = $conn->prepare($query);
    
    // Check if the prepare() succeeded
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit();
    }

    $userID = $_SESSION['User_ID'];
    $stmt->bind_param("iiissss", $userID, $numSeats, $passengerName, $contactNumber, $shareLocation, $locationInput, $destinationInput);

    if ($stmt->execute()) {

        $bookingID = mysqli_insert_id($conn);
        
        header("Location: view_booking_1.php");

        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<htl lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beba beba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                  <i class="lni lni-travel"></i>
                </button>
                <div class="sidebar-logo">
                  <a href="Home.php">BeBA bEBa</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="Home.php" class="sidebar-link">
                       <i class="lni lni-car"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Book_A_Ride.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Book a Ride</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="user_login.php" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="user_register.php" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="select_sacco_book.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>My booking</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="mybookings.php" class="sidebar-link">My booking</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="select_sacco_book.php" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Plan booking</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="rental_success.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>My rental status</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    <div class="main p-3">
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search"  aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a class="user" href="#"> <i class="lni lni-user"></i>
          <span><?php echo $username; ?></span>
        </a>
      </div>
    </nav>
<!-----------------section----------------->
    <h1>Book a Ride</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="sacco_id">Select Sacco:</label>
        <select name="sacco_id" id="sacco_id">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['sacco_id'] . "'>" . $row['sacco_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="shareLocation" name="shareLocation">
            <label class="form-check-label" for="shareLocation">Share Live Location</label>
        </div>

   

      <form action="" method="post">
      <div class="form-group">
      <!-- Options for matatu selection will be populated dynamically -->
      </select>
      </div>
      
      <div id="locationInputs">
      <div class="form-group">
      <label for="locationInput">Enter Your Location:</label>
      <input type="text" class="form-control" id="locationInput" name="locationInput" placeholder="Start typing your location...">
      </div>
      <div class="form-group">
      <label for="destinationInput">Enter Destination:</label>
      <input type="text" class="form-control" id="location-input" name="destinationInput" placeholder="Start typing your destination...">
      </div>
      </div>
      <div class="form-group">
      <label for="numSeats">Number of Seats to Book:</label>
      <input type="number" class="form-control" id="numSeats" name="numSeats" min="1" required>
      </div>

      <!-- Passenger Information -->
      <div class="form-group">
      <label for="passengerName">Passenger Name:</label>
      <input type="text" class="form-control" id="passengerName" name="passengerName" value=" <?php echo htmlspecialchars($username); ?>" required>
      </div>

      <div class="form-group">
      <label for="contactNumber">Contact Number:</label>
      <input type="tel" class="form-control" id="contactNumber" name="contactNumber" value=" <?php echo htmlspecialchars($userNumber); ?>" required>
      </div>

      <!-- Hidden input to pass selected matatu ID -->
      <input type="hidden" id="selectedMatatuID" name="selectedMatatuID">

      <!-- Button to trigger location retrieval -->
      <button type="button" class="btn btn-primary mt-2" id="getLocationBtn">Get Current Location</button>
      <!-- Submit button -->
           
      <button type="submit" class="btn btn-primary mt-2">Book Now</button>

    </form>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0_el1E0JmHVvopFNDaPYMIc1UY1PgKgA"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans+Text:500&amp;lang=en">
<script>
      "use strict";

      const CONFIGURATION = {
        "ctaTitle": "Checkout",
        "mapOptions": {"center":{"lat":37.4221,"lng":-122.0841},"fullscreenControl":true,"mapTypeControl":false,"streetViewControl":true,"zoom":11,"zoomControl":true,"maxZoom":22,"mapId":""},
        "mapsApiKey": "AIzaSyD0_el1E0JmHVvopFNDaPYMIc1UY1PgKgA",
        "capabilities": {"addressAutocompleteControl":true,"mapDisplayControl":true,"ctaControl":true}
      };

      const SHORT_NAME_ADDRESS_COMPONENT_TYPES =
          new Set(['street_number', 'administrative_area_level_1', 'postal_code']);

      const ADDRESS_COMPONENT_TYPES_IN_FORM = [
        'location',
        'locality',
        'administrative_area_level_1',
        'postal_code',
        'country',
      ];

      function getFormInputElement(componentType) {
        return document.getElementById(`${componentType}-input`);
      }

      function fillInAddress(place) {
        function getComponentName(componentType) {
          for (const component of place.address_components || []) {
            if (component.types[0] === componentType) {
              return SHORT_NAME_ADDRESS_COMPONENT_TYPES.has(componentType) ?
                  component.short_name :
                  component.long_name;
            }
          }
          return '';
        }

        function getComponentText(componentType) {
          return (componentType === 'location') ?
              `${getComponentName('street_number')} ${getComponentName('route')}` :
              getComponentName(componentType);
        }

        for (const componentType of ADDRESS_COMPONENT_TYPES_IN_FORM) {
          getFormInputElement(componentType).value = getComponentText(componentType);
        }
      }

      function renderAddress(place, map, marker) {
        if (place.geometry && place.geometry.location) {
          map.setCenter(place.geometry.location);
          marker.position = place.geometry.location;
        } else {
          marker.position = null;
        }
      }

      async function initMap() {
        const {Map} = google.maps;
        const {AdvancedMarkerElement} = google.maps.marker;
        const {Autocomplete} = google.maps.places;

        const mapOptions = CONFIGURATION.mapOptions;
        mapOptions.mapId = mapOptions.mapId || 'DEMO_MAP_ID';
        mapOptions.center = mapOptions.center || {lat: 37.4221, lng: -122.0841};

        const map = new Map(document.getElementById('gmp-map'), mapOptions);
        const marker = new AdvancedMarkerElement({map});
        const autocomplete = new Autocomplete(getFormInputElement('location'), {
          fields: ['address_components', 'geometry', 'name'],
          types: ['address'],
        });

        autocomplete.addListener('place_changed', () => {
          const place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert(`No details available for input: '${place.name}'`);
            return;
          }
          renderAddress(place, map, marker);
          fillInAddress(place);
        });
      }
    </script> 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map;
        var geocoder = new google.maps.Geocoder();

        // Initialize the map
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8
            });
        }

        // Function to handle location retrieval
        document.getElementById('getLocationBtn').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Update location input fields with coordinates
                    document.getElementById('locationInput').value = latitude + ', ' + longitude;

                    // Reverse geocode to get human-readable address
                    geocoder.geocode({ 'location': { lat: latitude, lng: longitude } }, function (results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                // Update location input field with address
                                document.getElementById('locationInput').value = results[0].formatted_address;
                            } else {
                                console.error('No results found');
                            }
                        } else {
                            console.error('Geocoder failed due to: ' + status);
                        }
                    });

                    // Update the map with the user's location
                    map.setCenter({ lat: latitude, lng: longitude });
                    new google.maps.Marker({
                        position: { lat: latitude, lng: longitude },
                        map: map,
                        title: 'Your Location'
                    });
                }, function (error) {
                    console.error('Error getting location:', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        });

        // Toggle location inputs based on checkbox
        var shareLocationCheckbox = document.getElementById('shareLocation');
        var locationInputs = document.getElementById('locationInputs');
        shareLocationCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // Show location inputs if checkbox is checked
                locationInputs.style.display = 'block';
            } else {
                // Hide location inputs if checkbox is unchecked
                locationInputs.style.display = 'none';
            }
        });

        // Autocomplete for location and destination inputs
        var locationInput = document.getElementById('locationInput');
        var destinationInput = document.getElementById('destinationInput');
        var autocompleteLocation = new google.maps.places.Autocomplete(locationInput, { types: ['geocode'] });
        var autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, { types: ['establishment', 'geocode'] });

        // Initialize the map
        initMap();
    });
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./SCRIPTS/script.js"></script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
          var selectedMatatuID = "<?php echo isset($_POST['matatuID']) ? $_POST['matatuID'] : ''; ?>";
          var matatuSelect = document.getElementById('matatuSelect');

          // Create an option element
          var option = document.createElement('option');
          option.value = selectedMatatuID;
          option.textContent = "Matatu : " + selectedMatatuID;

          // Append the option to the select element
          matatuSelect.appendChild(option);
      });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
