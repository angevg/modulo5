<?PHP 
session_start();
require 'database.php';
if (!empty($_POST['username']) && !empty($_POST['password'])) {
 $records = $conn->prepare('SELECT id_users, username, password FROM users WHERE username=:username');
 $records->bindParam(':username', $_POST['username']);
 $records->execute();
$results= $records->fetch(PDO::FETCH_ASSOC);

 $message='';

if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
$_SESSION['id'] = $results['id_users'];
header('Location: /loginphp');
}
else{
  $message='usuario no existe';
}

}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Login</title>
      <meta charset="utf-8">
      <meta name="viewpor" content="width-device=width, user-scalabe=no, initial-scale=1, maximun-scale=1, minimum-scale=1">
<link rel="stylesheet" href="assets/css/style2.css">

  </head>
  <body>
<?php
require 'partials/header.php';
?>


<form action="login.php" method="post" id="formulario">
	<h2>Login</h2>


<center><span>or <a href="signup.php">SignUp</a></span></center>
<center><?php if (!empty($message)): ?>
<p><?= $message ?></p></center>
<?php endif; ?>
  <input type="text" name="username" placeholder="&#128272;
Ingrese su usuario" id="txtusuario">
  <input type="password" name="password" placeholder="&#128272;
Ingrese su contraseña" id="txtpassword">

 
  <input type="submit" value="Send">

</form>

  </body>
</html>
