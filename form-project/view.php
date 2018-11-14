<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="form.css">
    <meta charset="utf-8">
    <title>Insert a Record</title>
    <link rel="stylesheet" type="text/css" href="API.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="jumbotron">
    <h1 align="center" style="font-family:Georgia">CLIENTS ARE IN SAFE HANDS</h1>
    <img src=security.png class="rounded mx-auto d-block" alt="security" height="150" width="250">
  </div>
  <div class="container">
    <div align = "center">
    <a href="insert.php">
    <button type="button" class="btn btn-secondary btn-sm">INSERT</button> </a>
    <a href="update.php">
    <button type="button" class="btn btn-secondary btn-sm">UPDATE</button> </a>
    <a href="select.php">
    <button type="button" class="btn btn-secondary btn-sm">SEARCH</button> </a>
    <a href="delete.php">
    <button type="button" class="btn btn-secondary btn-sm">DELETE</button> </a>
    <a href="view.php">
    <button type="button" class="btn btn-secondary btn-sm">VIEW</button> </a>
  </br> </br> </br>
  </div>


<?php
function db_connect(){
  $servername = "localhost";
  $username 	= "root";
  $password 	= "";
  $dbname 		= "contacts";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password,$dbname);
  return $conn;
}
$conn = db_connect();
$contacts = array();
$phones = array();
$sql = "SELECT * FROM contact INNER JOIN phone_numbers on phone_numbers.contact_id = contact.id";
$con_results = mysqli_query($conn, $sql);
?>
<table class="table table-bordered">
  <tr>
    <th >ID</th>
    <th >First Name</th>
    <th >Last Name</th>
    <th >Phone</th>
  </tr>
  <?php
while($row = mysqli_fetch_assoc($con_results)) {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['first_name'] . "</td>";
  echo "<td>" . $row['last_name'] . "</td>";
  echo "<td>" . $row['phone_number'] . "</td>";

}


$sql = "SELECT phone_number FROM phone_numbers";
$con_results = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($con_results)) {
}
  echo "</tr>";
  echo "</table>";



/*foreach ($phones as $phone){
  print_r($phone);
}*/



?>



</body>
</html>
