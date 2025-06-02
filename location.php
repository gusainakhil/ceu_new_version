<!DOCTYPE html>
<html>

<body>
  <table border='1'>
    <tr>
      <th>Location Link</th>
    </tr>

    <?php
    $con = new mysqli("localhost", "root", "", 'location');
    $sql = mysqli_query($con, "SELECT * FROM locate");
    while ($row = mysqli_fetch_assoc($sql)) {
      $locationLink = "https://www.google.com/maps?q=" . $row['coor']; ?>

      <tr>
        <td><a href='<?php echo $locationLink ?>' target='_blank'>View on Map</a></td>
      </tr>
    <?php } ?>

  </table>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    const x = document.getElementById("demo");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;

      // Send coordinates to backend using AJAX
      sendCoordinates(position.coords.latitude, position.coords.longitude);
    }

    function sendCoordinates(latitude, longitude) {
      $.ajax({
        type: "POST",
        url: "backend.php", // Specify your backend script URL
        data: {
          latitude: latitude,
          longitude: longitude
        },
        success: function(response) {
          console.log("Coordinates sent successfully");
        },
        error: function(error) {
          console.error("Error sending coordinates: ", error);
        }
      });
    }

    function showError(error) {
      switch (error.code) {
        case error.PERMISSION_DENIED:
          x.innerHTML = "User denied the request for Geolocation.";
          break;
        case error.POSITION_UNAVAILABLE:
          x.innerHTML = "Location information is unavailable.";
          break;
        case error.TIMEOUT:
          x.innerHTML = "The request to get user location timed out.";
          break;
        case error.UNKNOWN_ERROR:
          x.innerHTML = "An unknown error occurred.";
          break;
      }
    }

    // Call getLocation() when the page loads
    getLocation();
  </script>
</body>

</html>