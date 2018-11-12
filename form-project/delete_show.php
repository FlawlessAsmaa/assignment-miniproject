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

$errors = array ();
$id = '';
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
    }else {
      echo "id doesn't exist";
      header("HTTP/1.0 404 Not Found");
    }
  }
  else {
    foreach ($errors as $error) {
      echo $error;
    }
}


 ?>



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
    <button type="button" class="btn btn-secondary btn-sm">INSERT</button>
    <button type="button" class="btn btn-secondary btn-sm">UPDATE</button>
    <button type="button" class="btn btn-secondary btn-sm">SEARCH</button>
    <button type="button" class="btn btn-secondary btn-sm">DELETE</button>

  </div>
  <div>
  <div class="form-style-6">
    <h1>Return Your Information</h1>


    <form method = "post" action = "delete_API.php">
      <input type="hidden" name="_method" value="DELETE">
      <input type ="text" name= "id" placeholder= "ID" value = "<?php echo $id;?>"/>
      <input type ="text" name= "firstname" placeholder= "First Name" value = "<?php echo $row['first_name'];?>" disabled/>
      <input type ="text" name= "lastname" placeholder= "Last Name"  value = "<?php echo $row['last_name'];?>" disabled/>
      <input type ="text" name= "phone" placeholder= "Phone"  value = "<?php echo $phones['phone']?>" disabled/>
      <input type="submit" value="Send" name = "DELETE"/>
    </form>
    </div>
  </div>

  </body>
</html>
