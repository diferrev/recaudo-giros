<nav class="col-md-3 col-sm-3">
	<div class="list-group">
		<a href="" class="list-group-item active">Asesores</a>
		<a href="" class="list-group-item" onclick="cargarContenido('#contenido','admin/asesores.php',this)">Ver todos</a>
		<a href="" class="list-group-item" onclick="cargarContenido('#content-admin','admin/crear-asesor.php',this)">Crear nuevo</a>
		<a href="" class="list-group-item" onclick="cargarContenido('#content-admin','admin/consultar-asesor.php',this)">Consultar asesor</a>
	</div>
</nav>
<section id="content-admin" class="col-md-9 col-sm-9">
	<h3 class="header_adminmodule">Listado de asesores</h3>
	<div id="alert" class="alert"></div>
	<div id="content-table">
		<?php include("listado-asesores.php");?>
	</div>
</section>