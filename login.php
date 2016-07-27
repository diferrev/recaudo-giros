<!DOCTYPE HTML>
<?php 
session_start();
if(!isset($_SESSION["documento"])){

?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Recaudo de Efectivo de Giros</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css" />
</head>

<body style="background-color:rgb(34, 49, 63);">
<div class="containerLogin">
	<header class="header text-center">
		<h1 class="header__title">Recaudo de Efectivo de Giros</h1>
		<span class="header__subtitle">Super Servicios del Valle S.A.</span>
	</header>
	<div class="alert" id="alert"></div>
	<form action="" method="post" role="form" name="formLogin" id="formLogin">
		<p>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
			<input type="text" class="form-control" placeholder="Nombre de usuario" name="username" id="username"/>
		</div>
		</p>
		<p>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
			<input type="password" class="form-control" placeholder="Contraseña" name="password" id="password"/>
		</div>
		</p>
		<p class="text-center">
			<input type="button" value="Iniciar sesión" class="btn btn-primary" onclick="login()"/>
		</p>
	</form>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<?php
}else{
	header("Location: /recaudogiros");
}
?>
</body>
</html>