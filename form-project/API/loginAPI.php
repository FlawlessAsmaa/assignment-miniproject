<?php

function db_connect(){
  $server = false;
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
  if ($row['auth'] === '{k2}ZApM-01K2-R') {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title>Information Page</title>
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
        <a href="../insert.php">
        <button type="button" class="btn btn-secondary btn-lg btn-block">INSERT</button> </a>
        <a href="../update.php">
        <button type="button" class="btn btn-secondary btn-lg btn-block">UPDATE</button> </a>
        <a href="../select.php">
        <button type="button" class="btn btn-secondary btn-lg btn-block">SEARCH</button> </a>
        <a href="../delete.php">
        <button type="button" class="btn btn-secondary btn-lg btn-block">DELETE</button> </a>



      </div>


    <?php




    if ($row['password'] === $password) {
      $result[] = $row;
    } else if ($row['password'] !== $password && $row['username'] === $username){
      $not_found = array("error_code"=> "102","error_message" => "User credentials are not correct");
      print_r(json_encode($not_found));
    } else if ($row['password'] !== $password && $row['username'] !== $username) {
      $not_found = array("error_code" =>"101" ,"error_message"=> "User not found");
      print_r(json_encode($not_found));
    }
  } else {
      echo "<h2 align = 'center'>you are not authorized to use our system, token invalid </br> back to previous page </h2>";
      echo "<a href='../login.php.php'>
      <button type='button' class='btn btn-secondary btn-sm'>BACK</button> </a>";
    }
} else {
  echo "<h5 align = 'center'>ERROR - USER NOT FOUND </br> back to previous page</h5>";
  echo "<a href='../login.php'>
  <button type='button' class='btn btn-secondary btn-sm'>BACK</button> </a>";
}





 ?>

</body>
</html>
