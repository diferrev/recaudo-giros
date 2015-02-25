<!DOCTYPE HTML>
<?php require_once("procedures/conec.php");?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Recaudo de Efectivo de Giros</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
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
			<span class="user__data">31431389 - ADRIANA NARANJO OLARTE</span>
			<a href="" class="user__logout tbn btn-sm btn-primary">Cerrar sesión</a>
		</div>
	</div>
</header>

<nav class="navbar navbar-default">
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
      </ul>
    </div>
  </div>
</nav>
