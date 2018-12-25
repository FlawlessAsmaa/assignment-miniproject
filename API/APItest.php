<?php


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
  $contact = array ();
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
		$contact['id'] = $row['id'];
		$contact['first_name'] = $row['first_name'];
		$contact['last_name'] = $row['last_name'];
        if (mysqli_num_rows($con_results) > 0) {
          $sql = "SELECT * FROM phone_numbers WHERE contact_id = '".$id."'";
          $con_results2 = mysqli_query($conn, $sql);
          $phones = array();
          while($row2 = mysqli_fetch_assoc($con_results2)) {
            $contact['phone_number']=$row2['phone_number'];
          }
		  $response['response_code'] = array("code"=>"200","msg"=>" Your data retrieved Successfully ");
		  $response['data'] =  $contact;
		  print_r(json_encode($response));
        }else {
			header("HTTP/1.0 404 Not Found");
			$response['response_code'] = array("code"=>"404","msg"=>"  ID Doesn't Exist ");
			$response['data'] =  '';
			print_r(json_encode($response));

          }
        } else {
			header("HTTP/1.0 404 Not Found");
			$response['response_code'] = array("code"=>"404","msg"=>"  Error in your input data  ");
			$response['data'] =  $errors;
			print_r(json_encode($response));
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
	   header("HTTP/1.0 200 Found");
	   $response['response_code'] = array("code"=>"200","msg"=>"Data Inserted Successfully");
	   $response['data'] =  '';
	   print_r(json_encode($response));
       if(!$con_results){
		   header("HTTP/1.0 404 Not Found");
		   $response['response_code'] = array("code"=>"404","msg"=>" Error Inserting your record  ");
		   $response['data'] =  '';
		   print_r(json_encode($response));
       }
     }else{
		 header("HTTP/1.0 404 Not Found");
		 $response['response_code'] = array("code"=>"404","msg"=>" Error Inserting your record ");
		 $response['data'] =  '';
		 print_r(json_encode($response));
     }
    } else {
			header("HTTP/1.0 404 Not Found");
			$response['response_code'] = array("code"=>"404","msg"=>"  Error in your input data  ");
			$response['data'] =  $errors;
			print_r(json_encode($response));
      }
    

    break;
    case 'PUT':
    $json = json_decode(file_get_contents("php://input"), true);
    print_r($json);

    if(strlen($json['firstname'])<3){
      $errors[] = "First Name must be 5 or more charactes";
    }
    if(strlen($json['lastname'])<3){
      $errors[] = "Last Name must be 5 or more charactes";
    }

    if(strlen($json['phone'])<11 || !is_numeric($json['phone'])){
      $errors[] = "Phone number is not in the correct format. ex: 905415415412";
    }
    if (count($errors) == 0) {
      $conn = db_connect();
      header("HTTP/1.0 200  Found");
      $sql = "SELECT * FROM contact WHERE id= '".$json['id']."'";
      $con_results = mysqli_query($conn, $sql);
      if (mysqli_num_rows($con_results) > 0) {
        $sql = "UPDATE contact SET first_name='".$json['firstname']."', last_name= '".$json['lastname']."' WHERE id= '".$json['id']."'";
        $con_results = mysqli_query($conn, $sql);
        if($con_results) {
          $sql = "UPDATE phone_numbers SET phone_number='".$json['phone']."' WHERE contact_id= '".$json['id']."'";
          $con_results = mysqli_query($conn, $sql);
          if ($con_results) {
            header("HTTP/1.0 200  Found");
			$response['response_code'] = array("code"=>"200","msg"=>"  your record updated successfully");
			$response['data'] =  '';
			print_r(json_encode($response));
          } else {
            header("HTTP/1.0 404 Not Found");
			$response['response_code'] = array("code"=>"404","msg"=>"  Error updating your phone number");
			$response['data'] =  $errors;
			print_r(json_encode($response));
          }
        } else {
          header("HTTP/1.0 404 Not Found");
		  $response['response_code'] = array("code"=>"404","msg"=>"  Error updating your Record  ");
		  $response['data'] =  '';
		  print_r(json_encode($response));
        }
      }else {
		  header("HTTP/1.0 404 Not Found");
		  $response['response_code'] = array("code"=>"404","msg"=>"  ID doesn't Exist");
		  $response['data'] =  '';
		  print_r(json_encode($response));
      }
    }else {
		header("HTTP/1.0 404 Not Found");
		$response['response_code'] = array("code"=>"404","msg"=>"  Error in your input data  ");
		$response['data'] =  $errors;
		print_r(json_encode($response));
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
		header("HTTP/1.0 200 Found");
		$response['response_code'] = array("code"=>"200","msg"=>" your record deleted successfully  ");
		$response['data'] ='' ;
		print_r(json_encode($response));
    }
    else {
      header("HTTP/1.0 404 Not Found");
	  $response['response_code'] = array("code"=>"404","msg"=>"  Error in your Query  ");
	  $response['data'] =  '';
	  print_r(json_encode($response));
    }
    } else {
      header("HTTP/1.0 404 Not Found");
	  $response['response_code'] = array("code"=>"404","msg"=>" ID doesn't Exist ");
	  $response['data'] =  '';
	  print_r(json_encode($response));
    }

    }else {
      header("HTTP/1.0 404 Not Found");
	  $response['response_code'] = array("code"=>"404","msg"=>"  Error in your input data  ");
	  $response['data'] =  $errors;
	  print_r(json_encode($response));
    }
    break;

}

} else {
  echo "you are not authorized to use our system";
  header('Content-Type: application/json');
  header("HTTP/1.0 401 Unauthorized");
}


 ?>
