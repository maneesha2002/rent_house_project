<?php  

session_start();
if(!isset($_SESSION["email"])){
  header("location:../index.php");
}

include("navbar.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UniLodge - Web Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">







<div class="col-lg-6">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View Owner Lists</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>

            <tr>
                <th>Owner Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>ID provided</th>
                <th>Action</th>
          
            </tr>
        </thead>
        <tbody>
<?php
include("../config/config.php");
$query ="SELECT * FROM owner";
$sql = mysqli_query($db,$query);
while($rows = mysqli_fetch_array($sql))
{

?>
               <tr>
                    <td><?php echo $rows["full_name"];?></td>
                    <td><?php echo $rows["email"];?></td>
                    <td><?php echo $rows["password"];?></td>    
                    <td><?php echo $rows["phone_no"];?></td>
                    <td><?php echo $rows["address"];?></td>
                    <td><?php echo $rows["id_type"];?></td>
                    <td>
                    <a href="Delete_Owner.php?owner_id=<?php echo $rows['owner_id']; ?>" class="btn btn-warning" >Delete</a></td>
                </tr>
<?php } ?>

        </tbody>
    </table>
</div>
   
    </div>
</div>

</div>
</body>
</html>

