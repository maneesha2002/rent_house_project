<?php  

session_start();
if(!isset($_SESSION["email"])){
  header("location:../index.php");
}

include("navbar.php");




include("../config/config.php");
if(isset($_POST["submit"]))
{
    //post all value
    extract($_POST);
    $query = "INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES (NULL, '".$email."','".$password."');";

    mysqli_query($db,$query);
    header("location:webadmin_index.php");
    
}




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

    <!-- Page Wrapper -->
    <div id="wrapper">

    

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add  Warden Admins</h1>

                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                              
                                <div class="card-body">
<!-- Add Endpoints form -->
                                <form action="" method="post">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Password</label>
                                    <input type="email" class="form-control" name="email" id="password" >
                                </div>
                               <br>
                                <div class="mb-3">
                                    <label for="devicecount" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password">
                                </div>
                                <br>
                                <br>
                                 <div class="mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Warden</button>
                                  </div>
                                </form>
 <!-- End of Add Endpoints form -->
                                </div>
                            </div>

                         
                        </div>