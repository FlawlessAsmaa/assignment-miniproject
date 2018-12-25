<?php

//echo "asmaa";
function db_connect(){
	$server = true;
  if ($server === false){
    $servername = "localhost";
    $username 	= "root";
    $password 	= "";
    $dbname 		= "contacts";
  }else {
    $servername = "localhost";
    $username 	= "root";
    $password 	= "machine1";
    $dbname 	= "contacts";

  }

  // Create connection
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
if (! $conn) {
  echo "error connecting";
}
$sql = "SELECT * FROM users where username ='".$username."'" ;
$con_results = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($con_results);

if (mysqli_num_rows($con_results) > 0) {
  if ($row['auth'] === $_SERVER['HTTP_KEY']) {
    //echo "you are authorized";
    if ($row['password'] === $password) {
	  $response['response_code'] = array("code"=>"200","msg"=>"  Welcome to your Account ");
	  $response['data'] =  $row;
	  print_r(json_encode($response));
    } else if ($row['password'] !== $password && $row['username'] === $username){
		$response['response_code'] = array("code"=>"102","msg"=>" User credentials are not correct");
		$response['data'] =  '';
		print_r(json_encode($response));
		header('Content-Type: application/json');
		header("HTTP/1.0 404 Not Authorized");
    } else if ($row['password'] !== $password && $row['username'] !== $username) {
		$response['response_code'] = array("code"=>"101","msg"=>" User not found");
		$response['data'] =  '';
		print_r(json_encode($response));
		header('Content-Type: application/json');
		header("HTTP/1.0 404 Not Authorized");
    }
  } else {
      $response['response_code'] = array("code"=>"403","msg"=>" You are not Authorized");
	  $response['data'] =  'No data';
	  print_r(json_encode($response));
	  header('Content-Type: application/json');
	  header("HTTP/1.0 403 Not Authorized");
    }
} else {
	$response['response_code'] = array("code"=>"404","msg"=>"User not Found");
	$response['data'] =  'No data';
	print_r(json_encode($response));
	header('Content-Type: application/json');
	header("HTTP/1.0 404 Not Found");
  
}





 ?>
