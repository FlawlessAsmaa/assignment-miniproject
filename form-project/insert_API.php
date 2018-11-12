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
   echo "your record inserted successfully! ";
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
    echo $error;
  }
}



 ?>
