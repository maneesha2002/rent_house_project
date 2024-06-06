<?php
include("../config/config.php");

if(isset($_GET["owner_id"])) {
    // Sanitize the input
    $owner_id = mysqli_real_escape_string($db, $_GET["owner_id"]);
    
    // Attempt to delete the owner from the database
    $result = mysqli_query($db, "DELETE FROM owner WHERE owner_id=$owner_id");
    
    if($result) {
        // Deletion successful
        header("location: owner_list.php");
        exit(); // Make sure to exit after header redirection
    } else {
        // Deletion failed
        $error_message = "Error deleting owner: " . mysqli_error($db);
        echo "<script>alert('$error_message');</script>";
    }
} else {
    // If owner_id is not set
    $error_message = "Owner ID not provided.";
    echo "<script>alert('$error_message');</script>";
}
?>
