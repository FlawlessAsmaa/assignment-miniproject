<?php

$server = true;
function db_connect(){
  if ($server === false){
    $servername = "localhost";
    $username 	= "root";
    $password 	= "";
    $dbname 		= "contacts";
  }else {
    $servername = "localhost";
    $username 	= "root";
    $password 	= "machine1";
    $dbname 		= "contacts";

  }

  // Create connection
  $conn = mysqli_connect($servername, $username, $password,$dbname);
  return $conn;
}




$header = '';
$key = '{k2}ZApM-01K2-R';
if(isset($_SERVER['HTTP_KEY'])) {
  $header = $_SERVER['HTTP_KEY'];
}
//echo $header;
//$headers = apache_request_headers();
//$headers['key'];
if ($key === $header) {
  $method = $_SERVER['REQUEST_METHOD'];
  $id = '';
  $firstname = '';
  $lastname = '';
  $phone = '';
  $errors = array();
  header('Content-Type: application/json');
  switch ($method) {
    case 'GET':
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
            echo $error;


          }
          header("HTTP/1.0 404 Not Found");
          echo "ID Doesn't Exist";
        }
      } else {
        foreach ($errors as $error) {
          echo $error;
        }
    }

      break;


    case 'POST':
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];


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

    break;


    case 'PUT':
    if (isset($_GET['id'])){
      $id = $_GET['id'];
    }
    if (isset($_GET['firstname'])){
      $firstname = $_GET['firstname'];
    }
    if (isset($_GET['lastname'])){
      $lastname = $_GET['lastname'];
    }
    if (isset($_GET['phone'])){
      $phone = $_GET['phone'];
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
    break;

    case 'DELETE':
    //echo "in";
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }

    if (!is_numeric($id)) {
      $errors[] = "id must be numeric";
    }
    if (count($errors) == 0) {
    $conn = db_connect();
    $sql = "SELECT id FROM contact WHERE id = '".$id."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    $sql_contact = "DELETE FROM contact WHERE id ='".$id."'";
    $con_results = mysqli_query($conn, $sql_contact);
    if ($con_results) {
    echo "deleted successfully";
    }
    else {
      echo "Error in Query, Check!";
      header('Content-Type: application/json');
      header("HTTP/1.0 404 Not Found");
    }
    } else {
      echo "ID Does not exist";
      header('Content-Type: application/json');
      header("HTTP/1.0 404 Not Found");
    }

    }else {
      foreach ($errors as $error) {
        echo $error;
      }
      header("HTTP/1.0 404 Not Found");
    }
    break;

}

} else {
  echo "you are not authorized to use our system";
  header('Content-Type: application/json');
  header("HTTP/1.0 401 Unauthorized");
}


 ?>
