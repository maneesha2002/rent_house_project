<?php

  include("../config/config.php");
  $admin_id = $_GET["admin_id"];
  $result = mysqli_query($db, "DELETE FROM admin WHERE admin_id=$admin_id");
  header("location:warden_list.php");





?>