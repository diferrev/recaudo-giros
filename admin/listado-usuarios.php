<?php require_once("../procedures/conec.php")?>
<?php require_once("../functions.php")?>
<?php conectar();?>
<?php
	$qusuarios = "SELECT u.cod_cajero, u.login, u.estado, r.codigo, r.nombre FROM usuarios u, roles r WHERE u.cod_rol = r.codigo ORDER BY u.login;";
	$usuarios = ejecutarQuery($qusuarios);
?>
<h3 class="header_adminmodule">Listado de usuarios</h3>
<div id="alert" class="alert"></div>
<table class="table table-hover table-condensed">
	<tr>
		<th>Documento</th>
		<th>Login</th>
		<th>Estado</th>
		<th>Rol ID</th>
		<th>Rol Nombre</th>
	</tr>
 <?php while($usuario = mysql_fetch_array($usuarios)){?>
	<tr>
		<td><?php echo $usuario[0];?></td>
		<td><?php echo $usuario[1];?></td>
		<td><?php echo $usuario[2];?></td>
		<td><?php echo $usuario[3];?></td>
		<td><?php echo $usuario[4];?></td>
		<td><a href="" onclick="editarUsuario(<?php echo $usuario[0];?>)"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="" onclick="resetearPwd(<?php echo $usuario[0];?>)"><span class="glyphicon glyphicon-lock"></span></a></td>
	</tr>
 <?php } ?>
</table>