<?php
function conectar()
{
	mysql_connect("localhost", "root", "Zafiro2014");
	mysql_select_db("recaudogiros");
	@mysql_query("SET NAMES 'utf8'");
}

function desconectar()
{
	mysql_close();
}
?>