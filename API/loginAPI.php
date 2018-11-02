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
  
  $conn = mysqli_connect($servername, $username, $password,$dbname);
  return $conn;
}  

$username = '';
$password = '';
//if (isset($_GET['username'])) {
  //$username = $_GET['username'];
//}

if (isset($_POST['username'])) {
  $username = $_POST['username'];
}

//if (isset($_GET['password'])) {
//  $password = $_GET['password'];
//}

if (isset($_POST['password'])) {
  $password = $_POST['password'];
}





//$info = array($username => $password);
//$JSON = json_encode($info);
// echo $JSON;

$result = array();
$conn = db_connect();
$sql = "SELECT * FROM users where username ='".$username."'" ;
$con_results = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($con_results);

if (mysqli_num_rows($con_results) > 0) {
  if ($row['auth'] === $_SERVER['HTTP_KEY']) {
    echo "you are authorized";
    if ($row['password'] === $password) {
      $result[] = $row;
      echo "you are using system now";
    } else if ($row['password'] !== $password && $row['username'] === $username){
      $not_found = array("error_code"=> "102","error_message" => "User credentials are not correct");
      print_r(json_encode($not_found));
    } else if ($row['password'] !== $password && $row['username'] !== $username) {
      $not_found = array("error_code" =>"101" ,"error_message"=> "User not found");
      print_r(json_encode($not_found));
    }
  } else {
      echo "you are not authorized to use our system, token invalid";
    }
} else {
  echo "ERROR - USER NOT FOUND";
}





 ?>
