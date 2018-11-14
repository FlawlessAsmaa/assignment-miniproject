
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="form.css">
    <meta charset="utf-8">
    <title>Select a Record</title>
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
      <a href="insert.php">
      <button type="button" class="btn btn-secondary btn-sm">INSERT</button> </a>
      <a href="update.php">
      <button type="button" class="btn btn-secondary btn-sm">UPDATE</button> </a>
      <a href="select.php">
      <button type="button" class="btn btn-secondary btn-sm">SEARCH</button> </a>
      <a href="delete.php">
      <button type="button" class="btn btn-secondary btn-sm">DELETE</button> </a>
      <a href="view.php">
      <button type="button" class="btn btn-secondary btn-sm">VIEW</button> </a>

  </div>
  <div>
  <div class="form-style-6">
    <h1>INSERT ID NUMBER</h1>

      <form method = "get" action="<?=$_SERVER['PHP_SELF'];?>">
        <input type ="number" name= "id" placeholder= "ID" />
        <input type="submit" value="Search" />
      </form>
    </div>
  </div>
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
      $contact = $row;
      if (mysqli_num_rows($con_results) > 0) {
        $sql = "SELECT * FROM phone_numbers WHERE contact_id = '".$id."'";
        $con_results2 = mysqli_query($conn, $sql);
        $phones = array();
        while($row2 = mysqli_fetch_assoc($con_results2)) {
          $phones['phone']=$row2['phone_number'];
        }
        ?>
        <table class="table table-bordered">
          <tr>
            <th >ID</th>
            <th >First Name</th>
            <th >Last Name</th>
            <th >Phone</th>
          </tr>
          <?php
          echo "<tbody>";
          echo "<tr>";
          echo "<td>".$contact['id']."</td>";
          echo "<td>".$contact['first_name']."</td>";
          echo "<td>".$contact['last_name']."</td>";
          echo "<td>".$phones['phone']."</td>";
          echo "</tr>";
          echo "</tbody>";
          echo "</table>";
          //print_r(json_encode($contact));
          //print_r(json_encode($phones));
      }else {
        foreach ($errors as $error){
          echo "<h3 align = 'center'> $error </h3>";


        }
        header("HTTP/1.0 404 Not Found");
        echo "<h3 align = 'center'> ID doesn't exist </h3>";
      }
    } else {
      foreach ($errors as $error) {
        //echo "<h3 align = 'center'> $error </h3>";
      }
  }


   ?>




</body>
</html>
