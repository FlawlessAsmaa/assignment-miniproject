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
  $password 	= "machine1";
  $dbname 		= "contacts";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password,$dbname);
  return $conn;
}


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$errors = array();

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

  $sql = "INSERT INTO contact"
       ." (first_name,last_name)"
       ." VALUES ('"
       .$_POST['firstname']
       ."' , '"
       .$_POST['lastname']
       ."');";
 $con_results = mysqli_query($conn, $sql);
 if ($con_results) {
   $contactID = mysqli_insert_id($conn);
   $sql = "INSERT INTO phone_numbers"
        ." (phone_title,phone_number, default_num ,contact_id)"
        ." VALUES ("
        ."'HOME'"
        .","
        .$_POST['phone']
        .","
        ."1"
        .","
        .$contactID
        .");";
   $con_results = mysqli_query($conn, $sql);

   echo "<h3 align = 'center'> your record inserted successfully! </h3>";
   if(!$con_results){
     die("SQL error " . mysqli_error($conn));
     header('Content-Type: application/json');
     header("HTTP/1.0 404 Not Found");
   }
 }else{
   die("SQL error " . mysqli_error($conn));
   header('Content-Type: application/json');
   header("HTTP/1.0 404 Not Found");
 }
} else {
  foreach ($errors as $error) {
    echo "<h3 align = 'center'> $error </h3>";
  }
}



 ?>

</body>
</html>
