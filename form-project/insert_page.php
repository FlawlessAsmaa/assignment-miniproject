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
    <h1>Provide Your Information</h1>


      <form method = "post" action = "insert_API.php">
        <input type ="text" name= "firstname" placeholder= "First Name" />
        <input type ="text" name= "lastname" placeholder= "Last Name" />
        <input type ="text" name= "phone" placeholder= "Phone"/>
        <input type="submit" value="Send" />
      </form>
    </div>
  </div>
</body>
</html>
