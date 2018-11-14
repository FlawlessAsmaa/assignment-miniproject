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
    <a href="../insert.php">
    <button type="button" class="btn btn-secondary btn-sm">INSERT</button> </a>
    <a href="../update.php">
    <button type="button" class="btn btn-secondary btn-sm">UPDATE</button> </a>
    <a href="../select.php">
    <button type="button" class="btn btn-secondary btn-sm">SEARCH</button> </a>
    <a href="../delete.php">
    <button type="button" class="btn btn-secondary btn-sm">DELETE</button> </a>
    <a href="../view.php">
    <button type="button" class="btn btn-secondary btn-sm">VIEW</button> </a>

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



$errors = array();
if (isset($_POST['id'])){
  $id = $_POST['id'];
}
if (isset($_POST['firstname'])){
  $firstname = $_POST['firstname'];
}
if (isset($_POST['lastname'])){
  $lastname = $_POST['lastname'];
}
if (isset($_POST['phone'])){
  $phone = $_POST['phone'];
}

if(strlen($firstname)<3){
  $errors[] = "First Name must be 5 or more charactes";
}

if(strlen($lastname)<3){
  $errors[] = "Last Name must be 5 or more charactes";
}

if(strlen($phone)<11 || !is_numeric($phone)){
  $errors[] = "Phone number is not in the correct format. ex: 905415415412";
}

if (count($errors) == 0) {
  $conn = db_connect();

  header("HTTP/1.0 200  Found");
  $sql = "SELECT * FROM contact WHERE id= '".$id."'";
  $con_results = mysqli_query($conn, $sql);
  if (mysqli_num_rows($con_results) > 0) {
    $sql = "UPDATE contact SET first_name='".$firstname."', last_name= '".$lastname."' WHERE id= '".$id."'";
    $con_results = mysqli_query($conn, $sql);
    if($con_results) {
    $sql = "UPDATE phone_numbers SET phone_number='".$phone."' WHERE contact_id= '".$id."'";
    $con_results = mysqli_query($conn, $sql);
    if ($con_results) {
      echo "<h3 align = 'center'> Update Successfully ! </h3>";
    } else {
      echo "<h3 align = 'center'> error updating phone_number table </h3>";
      header("HTTP/1.0 404 Not Found");
    }
  } else {
    echo "<h3 align = 'center'> error updating contact table </h3>";
    header("HTTP/1.0 404 Not Found");
  }
}else {
  echo "<h3 align = 'center'> id doesn't exist </h3>";
  header("HTTP/1.0 404 Not Found");
}
}else {
foreach ($errors as $error) {
  echo "<h3 align = 'center'> $error </h3>";
}
}


 ?>

</body>
</html>
