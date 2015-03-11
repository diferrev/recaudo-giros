<!DOCTYPE HTML>
<?php
session_start();
if(!$_SESSION["documento"]){
	header("Location: login.php");
}
require("procedures/conec.php");
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Recaudo de Efectivo de Giros</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.3.custom.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<header class="header">
	<div class="container">
		<div class="col-sm-6">
			<h1 class="header__title">Recaudo de Efectivo de Giros</h1>
			<span class="header__subtitle">Apuestas Azar S.A.</span>
		</div>
		<div class="col-sm-6 user">
			<p class="user__data"><span id="cedulacajero"><?php echo $_SESSION["documento"];?></span> - <span id="nombrescajero"><?php echo $_SESSION["nombres"];?> <?php echo $_SESSION["apellidos"];?></span></p>
			<a href="" class="user__logout tbn btn-sm btn-primary" onclick="cargarContenido('#contenido','cambiar-passwd.php',this)">Cambiar contraseña</a> <a href="" class="user__logout tbn btn-sm btn-primary" onclick="logout(this)">Cerrar sesión</a>
		</div>
	</div>
</header>
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="" onclick="cargarContenido('#contenido','home.php',this)">Inicio</a></li>
        <li><a href="" onclick="cargarContenido('#contenido','recaudo.php',this)">Recaudo</a></li>
		<li><a href="" onclick="cargarContenido('#contenido','reportes.php',this)">Reportes</a></li>
		<?php if($_SESSION["rol"] == 1){?>
		<li><a href="" onclick="cargarContenido('#contenido','admin/index.php',this)">Administración</a></li>
		<?php }?>
      </ul>
    </div>
  </div>
</nav>
