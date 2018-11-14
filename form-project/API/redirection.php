<?php
/*if ($_SERVER['PHP_AUTH_USER']!== 'asmaa' && $_SERVER['PHP_AUTH_PW']!== 'asmaa')
{
  header ("WWW-Authenticate: Basic realm=\"Hello\"");
  header("HTTP\ 1.0 4.1 Unauthorized;");
  echo "You must enter a valid login ID and password to access this resource";
  exit;
}*/
/*$valid_passwords = array ("asmaa" => "asjdasdus456431", "oikawa" => "erty543etwfg34rt");
$valid_users = array_keys($valid_passwords);
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}

echo "<p>Welcome $user.</p>";
echo "<p>Phew, You Are Using our system now.</p>";
*/
$headerStringValue = $_SERVER['HTTP_KEY'];
if ($headerStringValue === '{k2}ZApM-01K2-R') {
  echo "autho";
}else {
  echo "no";
}
/*$headers  = apache_request_headers();
foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}*/

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
