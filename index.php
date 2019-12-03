<?php
session_start();

require 'database.php';

if (isset($_SESSION['id_users'])) {
  $records= $conn->prepare('SELECT id_users, nombre, email, username, password FROM users WHERE id_users=:id_users');
  $records->bindParam(':id_users', $_SESSION['id_users']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = null;

  if (count($results) > 0) {
   $user = $results;
  }
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Welcome</title>
      <meta charset="utf-8">
      <meta name="viewpor" content="width-device=width, user-scalabe=no, initial-scale=1, maximun-scale=1, minimum-scale=1">
<link rel="stylesheet" href="assets/css/style.css">

  </head>
  <body>
  	
<?php
require 'partials/header.php';
?>

<?php  if (!empty($user)): ?>
  <br>WElcome. <?= $user['nombre'] ?>
<br>You Are here
  <a href="Logout.php">Logout</a> or

<?php else: ?>
	<h2>Login or SignUp</h2>
  <a href="Login.php">Login</a> or
   <a href="signup.php">SignUp</a>
<?php endif; ?>



  </body>
</html>
