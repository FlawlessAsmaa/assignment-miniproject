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

$id ='';
$errors = array();
if (isset($_POST['id'])){
  $id = $_POST['id'];
}
echo "id is " .$id. "   okay  ";

if (!is_numeric($id)) {
  $errors[] = "id must be numeric ";
}

if (count($errors) == 0) {
  $conn = db_connect();

  header("HTTP/1.0 200  Found");
  $sql = "SELECT * FROM contact WHERE id= '".$id."'";
  $con_results = mysqli_query($conn, $sql);
  if (mysqli_num_rows($con_results) > 0) {
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


 ?>
