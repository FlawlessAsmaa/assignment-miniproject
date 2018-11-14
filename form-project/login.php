<html>
  <head>
    <link rel="stylesheet" type="text/css" href="API.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body id="LoginForm">

<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>

   <p>Please enter your Username and Password</p>
   </div>
    <form id="Login" method="post" action="API/loginAPI.php">
        <div class="form-group">
            <input type="text" class="form-control" id="inputEmail" placeholder="Username" name = "username">
        </div>
  <div class="form-group" action = "">
      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name = "password">
    </div>
<button type="submit" class="btn btn-primary" value = "submit" name = "Submit-btn">Login</button>
</form>
    </div>
</div></div>
</body>
</html>
