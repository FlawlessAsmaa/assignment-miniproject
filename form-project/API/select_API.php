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

$id = '';
$errors = array();


if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
if (!is_numeric($id)) {
  $errors[] = "id must be numeric";
}
  if (count($errors) == 0) {
    $contact = array();
    $conn = db_connect();
    $sql = "SELECT * FROM contact WHERE id ='".$id."'";
    $con_results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($con_results);
    $contact[] = $row;
    if (mysqli_num_rows($con_results) > 0) {
      $sql = "SELECT * FROM phone_numbers WHERE contact_id = '".$id."'";
      $con_results2 = mysqli_query($conn, $sql);
      $phones = array();
      while($row2 = mysqli_fetch_assoc($con_results2)) {
        $phones['phone']=$row2['phone_number'];
      }

      print_r(json_encode($contact));
      print_r(json_encode($phones));
    }else {
      foreach ($errors as $error){
        echo "<h3 align = 'center'> $error </h3>";


      }
      header("HTTP/1.0 404 Not Found");
      echo "ID Doesn't Exist";
    }
  } else {
    foreach ($errors as $error) {
      echo "<h3 align = 'center'> $error </h3>";
    }
}


 ?>
