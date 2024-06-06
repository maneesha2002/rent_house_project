<?php

  include("../config/config.php");
  $id = $_GET["id"];
  $result = mysqli_query($db, "DELETE FROM owner WHERE tenant_id=$id");
  header("location:student_list.php");





?>