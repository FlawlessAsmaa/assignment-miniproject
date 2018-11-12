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
      echo "success";
    } else {
      echo "error updating phone_number table";
      header("HTTP/1.0 404 Not Found");
    }
  } else {
    echo "error updating contact table";
    header("HTTP/1.0 404 Not Found");
  }
}else {
  echo "id doesn't exist";
  header("HTTP/1.0 404 Not Found");
}
}else {
foreach ($errors as $error) {
  echo $error;
}
}


 ?>
