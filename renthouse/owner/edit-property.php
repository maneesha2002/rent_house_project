<?php
session_start();
if (!isset($_SESSION["email"])) {
  header("location:../index.php");
}

include("navbar.php");
include("engine.php");

$property_id = $_GET['property_id'];
$db = new mysqli('localhost', 'root', '', 'renthouse');

$provinces = array("Western Province", "Central Province", "Southern Province", "Eastern Province", "Northern Province", "North Western Province", "North Central Province", "Uva Province", "Sabaragamuwa Province");
$districts = array("Colombo", "Gampaha", "Kalutara", "Kandy", "Matale", "Nuwara Eliya", "Galle", "Matara", "Hambantota", "Trincomalee", "Batticaloa", "Ampara", "Jaffna", "Kilinochchi", "Mannar", "Mullaitivu", "Vavuniya", "Kurunegala", "Puttalam", "Anuradhapura", "Polonnaruwa", "Badulla", "Monaragala", "Ratnapura", "Kegalle");
$vdcMunicipality = array("VDC", "Municipality");
$propertyTypes = array("Full House Rent", "Flat Rent", "Room Rent");
$zones = array("Western", "Central", "Southern", "Eastern", "Northern", "North Western", "North Central", "Uva", "Sabaragamuwa");
$rents = array("Full House Rent", "Flat Rent", "Room Rent");

if ($db->connect_error) {
  echo "Error connecting database";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $property_id = validate($_POST['property_id']);
  $country = validate($_POST['country']);
  $province = validate($_POST['province']);
  $zone = validate($_POST['zone']);
  $district = validate($_POST['district']);
  $city = validate($_POST['city']);
  $vdc_municipality = validate($_POST['vdc_municipality']);
  $ward_no = validate($_POST['ward_no']);
  $tole = validate($_POST['tole']);
  $contact_no = validate($_POST['contact_no']);
  $property_type = validate($_POST['property_type']);
  $estimated_price = validate($_POST['estimated_price']);
  $total_rooms = validate($_POST['total_rooms']);
  $bedroom = validate($_POST['bedroom']);
  $living_room = validate($_POST['living_room']);
  $kitchen = validate($_POST['kitchen']);
  $bathroom = validate($_POST['bathroom']);
  $description = validate($_POST['description']);


  $sql = "UPDATE add_property SET country='$country',province='$province',zone='$zone',district='$district',city='$city',vdc_municipality='$vdc_municipality',ward_no='$ward_no',tole='$tole',contact_no='$contact_no',property_type='$property_type',estimated_price='$estimated_price',total_rooms='$total_rooms',bedroom='$bedroom',living_room='$living_room',kitchen='$kitchen',bathroom='$bathroom',description='$description',booked='$booked' WHERE property_id='$property_id'";
  if ($db->query($sql) === TRUE) {
?>

    <style>
      .alert {
        padding: 20px;
        background-color: #43ee43;
        color: white;
      }

      .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }

      .closebtn:hover {
        color: black;
      }
    </style>
    <script>
      window.location.href = "/renthouse/owner/owner-index.php";
      window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(500, function() {
          $(this).remove();
        });
      }, 2000);
    </script>
    <div class="container">
      <div class="alert" role='alert'>
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <center><strong>Your Product has been updated.</strong></center>
      </div>
    </div>
<?php
  } else {
    echo "<script>alert('Error Updating Property');</script>";
  }
} else {
  $sql = "SELECT * FROM add_property WHERE property_id='$property_id'";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {


      $country = $row['country'];
      $province = $row['province'];
      $zone = $row['zone'];
      $district = $row['district'];
      $city = $row['city'];
      $vdc_municipality = $row['vdc_municipality'];
      $ward_no = $row['ward_no'];
      $tole = $row['tole'];
      $contact_no = $row['contact_no'];
      $property_type = $row['property_type'];
      $estimated_price = $row['estimated_price'];
      $total_rooms = $row['total_rooms'];
      $bedroom = $row['bedroom'];
      $living_room = $row['living_room'];
      $kitchen = $row['kitchen'];
      $bathroom = $row['bathroom'];
      $description = $row['description'];
      $latitude = $row['latitude'];
      $longitude = $row['longitude'];
      $booked = $row['booked'];
      $owner_id = $row['owner_id'];
    }
  }
}


?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcpHIEKxOIQicmwKXBLLmcBFlj9P9YQdc&libraries=places" defer></script>


</head>

<body>

  <div class="container-fluid">
    <ul class="nav nav-pills nav-justified">
      <li class="active" style="background-color: #FFF8DC"><a data-toggle="pill" href="#home">Profile</a></li>
      <li style="background-color: #FAC0E6"><a data-toggle="pill" href="#menu4">Messages</a></li>
      <li style="background-color: #FAF0E6"><a data-toggle="pill" href="#menu1">Add Property</a></li>
      <li style="background-color: #FFFACD"><a data-toggle="pill" href="#menu2">View Property</a></li>
      <li style="background-color: #FFFAF0"><a data-toggle="pill" href="#menu3">Update Property</a></li>

    </ul>

    <div id="menu5" class="tab-pane">
      <center>
        <h3>Edit Property Details</h3>
      </center>
      <div class="container">


        <div id="map_canvas"></div>
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="country">Country:</label>
                <select class="form-control" name="country" required="required">
                  <option value="">--Select Country--</option>
                  <option <?php if ($country == "Sri Lanka") echo "selected"; ?> value="Sri Lanka">Sri Lanka</option>
                </select>
              </div>
              <div class="form-group">
                <label for="province">Province/State:</label>
                <select class="form-control" name="province" required="required">
                  <option value="">--Select Province--</option>
                  <?php
                  foreach ($provinces as $province) {
                    if ($province == $province) {
                      echo "<option value='$province' selected>$province</option>";
                    } else {
                      echo "<option value='$province'>$province</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="zone">Zone:</label>
                <select class="form-control" name="zone" required="required">
                  <option value="">--Select Zone--</option>
                  <?php
                  foreach ($zones as $zone) {
                    if ($zone == $zone) {
                      echo "<option value='$zone' selected>$zone</option>";
                    } else {
                      echo "<option value='$zone'>$zone</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="district">District:</label>
                <select class="form-control" name="district" required="required">
                  <option value="">--Select District--</option>

                  <?php
                  foreach ($districts as $district) {
                    if ($district == $district) {
                      echo "<option value='$district' selected>$district</option>";
                    } else {
                      echo "<option value='$district'>$district</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" placeholder="Enter City" name="city">
              </div>
              <div class="form-group">
                <label for="vdc/municipality">VDC/Municipality:</label>
                <select class="form-control" name="vdc_municipality">
                  <option value="">--Select VDC/Municipality--</option>
                  <?php
                  foreach ($vdcMunicipality as $vdc) {
                    if ($vdc == $vdc_municipality) {
                      echo "<option value='$vdc' selected>$vdc</option>";
                    } else {
                      echo "<option value='$vdc'>$vdc</option>";
                    }
                  }
                  ?>
                </select>

              </div>
              <div class="form-group">
                <label for="ward_no">Postal Code.:</label>
                <input type="text" value="<?php echo $ward_no; ?>" class="form-control" id="ward_no" placeholder="Enter Ward No." name="ward_no">
              </div>
              <div class="form-group">
                <label for="tole">View:</label>
                <input type="text" value="<?php echo $tole; ?>" class="form-control" id="tole" placeholder="Enter Tole" name="tole">
              </div>
              <div class="form-group">
                <label for="contact_no">Contact No.:</label>
                <input type="text" value="<?php echo $contact_no; ?>" class="form-control" id="contact_no" placeholder="Enter Contact No." name="contact_no">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="property_type">Property Type:</label>
                <select class="form-control" name="property_type">
                  <option value="">--Select Property Type--</option>
                  <?php
                  foreach ($propertyTypes as $propertyType) {
                    if ($propertyType == $property_type) {
                      echo "<option value='$propertyType' selected>$propertyType</option>";
                    } else {
                      echo "<option value='$propertyType'>$propertyType</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="estimated_price">Estimated Price:</label>
                <input type="estimated_price" value="<?php echo $estimated_price; ?>" class="form-control" id="estimated_price" placeholder="Enter Estimated Price" name="estimated_price">
              </div>
              <div class="form-group">
                <label for="total_rooms">Total No. of Rooms:</label>
                <input type="number" class="form-control" value="<?php echo $total_rooms; ?>" id="total_rooms" placeholder="Enter Total No. of Rooms" name="total_rooms">
              </div>
              <div class="form-group">
                <label for="bedroom">No. of Bedroom:</label>
                <input type="number" class="form-control" value="<?php echo $bedroom; ?>" id="bedroom" placeholder="Enter No. of Bedroom" name="bedroom">
              </div>
              <div class="form-group">
                <label for="living_room">No. of Living Room:</label>
                <input type="number" class="form-control" value="<?php echo $living_room; ?>" id="living_room" placeholder="Enter No. of Living Room" name="living_room">
              </div>
              <div class="form-group">
                <label for="kitchen">No. of Kitchen:</label>
                <input type="number" class="form-control" value="<?php echo $kitchen; ?>" id="kitchen" placeholder="Enter No. of Kitchen" name="kitchen">
              </div>
              <div class="form-group">
                <label for="bathroom">No. of Bathroom/Washroom:</label>
                <input type="number" class="form-control" value="<?php echo $bathroom; ?>" id="bathroom" placeholder="Enter No. of Bathroom/Washroom" name="bathroom">
              </div>
              <div class="form-group">
                <label for="description">Full Description:</label>
                <textarea type="comment" class="form-control" id="description" placeholder="Enter Property Description" name="description">
                  <?php echo $description; ?>
                </textarea>
              </div>
              <hr>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Update Property" name="edit-property">
              </div>
            </div>
          </div>
        </form>
        <br><br>
      </div>
    </div>
  </div>
</body>