
<?php
require 'database.php';
$message ='';

if (!empty($_POST['nombre']) && !empty($_POST['email'])&& !empty($_POST['username'])&& !empty($_POST['password'])) {
$sql ="INSERT INTO users (nombre, email, username, password) VALUES (:nombre, :email, :username, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre',$_POST['nombre']);
$stmt->bindParam(':email',$_POST['email']);
$stmt->bindParam(':username',$_POST['username']);
$password =password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt->bindParam(':password',$password);
if ($stmt->execute()){
$message ='El usuario ha sido creado';
}else{
  $message ='Ha ocurrido un problema!!';

}
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Registro de usuario</title>
      <meta charset="utf-8">
      <meta name="viewpor" content="width-device=width, user-scalabe=no, initial-scale=1, maximun-scale=1, minimum-scale=1">
<link rel="stylesheet" href="assets/css/style2.css">


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  </head>
  <body>
<?php require 'partials/header.php'?>


<form action="signup.php" method="post" id="formulario">
	<h2>SignUp</h2>

  <center>  <?php if (!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?><span> or <a href="login.php">Login</a></span></center>
    <input type="text" name="nombre" placeholder="Ingrese su nombre" id="txtnombre">
    <input type="text" name="email" placeholder="Ingrese su email" id="txtemail">
  <input type="text" name="username" placeholder="Ingrese un usuario" id="txtusuario">
  <input type="password" name="password" placeholder="Ingrese una contraseña" id="txtpassword">
 <input type="password" name="conpassword" placeholder="Confirme su contraseña" id="contxtpassword">

  <input type="submit" value="Ingresar" id="btningresar">
  
</form>

  </body>
</html>
