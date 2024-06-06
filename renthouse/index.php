<?php 
session_start();

include("navbar.php");

 ?>
 <html>

<div>
 <?php
 include("./components/jumbtron.php");
include("./components/carusel.php");


?>
</div>

<div class="bg"></div><br>
<div class="container active-cyan-4 mb-4 inline">
	<form method="POST" action="search-property.php">
  <input class="form-control" type="text" placeholder="Enter location to search house." name="search_property" aria-label="Search">
  </form>
</div>
<br><br>

<?php 

include("property-list.php");

 ?>
 <br><br>


 </html>