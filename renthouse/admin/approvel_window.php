<?php
include("../config/config.php");

// Check if the form was submitted for updating the VPN
if(isset($_POST['update']))
{    
    $property_id = $_GET['property_id'];
    $approvel = $_POST['approvel'];
  
    
    // Perform the update query
    $result = mysqli_query($db, "UPDATE add_property SET approvel='$approvel' WHERE property_id=$property_id");

    if ($result) {
        // Redirect to the display page on success
        header("Location: admin-index.php");
        exit();
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($db);
    }
}?>

<?php
//error_reporting(0);
//getting id from url
include("../config/config.php");
$property_id = $_GET['property_id'];
 
//selecting data associated with this particular id
$result = mysqli_query($db, "SELECT * FROM add_property WHERE property_id=$property_id");
 
while($row = mysqli_fetch_array($result))
{
    $property_id= $row['property_id'];
	$approvel= $row['approvel'];
     
 
}
?>
<html>
<head>
	<title>Property Approvel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container" style="width: 800px; margin-top: 100px;">
		<div class="row">
    <h3>Change the Approvel Settings</h3>

			<div class="col-sm-6"> 
	<form action="" method="post" name="form1">
		<div class="form-group">
				
				<input type="fix" name="id" class="form-control" value="<?php echo $property_id;?>" readonly>
			
		</div>
		<div class="form-group">
				<label>Approvel Status</label>
				<select name="approvel" class="form-control">
    <option value="yes" <?php if($approvel == 'yes') echo 'selected'; ?>>Yes</option>
    <option value="no" <?php if($approvel == 'no') echo 'selected'; ?>>No</option>
</select>

		</div>
	
		<div class="form-group">

				<input type="submit" value="Update" class="btn btn-primary btn-block" name="update">
			
		
	</form>
	<a href="./admin-index.php">Back</a>

</div>
</div>
</div>
</body>
</html>
