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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $property_id = validate($_GET['property_id']);
  // table property_photo
  $sql_prev = "DELETE FROM property_photo WHERE property_id='$property_id'";
  $sql_prev2 = "DELETE FROM review WHERE property_id='$property_id'";

  $sql = "DELETE FROM add_property WHERE property_id='$property_id'";
  $result = $db->query($sql_prev);
  $result2 = $db->query($sql_prev2);
  $result = $db->query($sql);
  if ($result) {
?>

    <style>
      .alert {
        padding: 20px;
        background-color: #DC143C;
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
      window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(500, function() {
          $(this).remove();
        });
      }, 2000);
      window.location.href = "/renthouse/owner/owner-index.php";
    </script>
    <div class="container">
      <div class="alert" role='alert'>
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <center><strong>Your Property has been Deleted.</strong></center>
      </div>
    </div>
<?php
  } else {
    echo "<script>alert('Error Deleting Property');</script>";
  }
}


?>