<?php

include("conec.php");
conectar();
session_start();

$username = $_POST["username"];
$pwdactual = $_POST["pwdactual"];
$pwdnuevo = $_POST["pwdnuevo"];

$query1 = "SELECT * FROM usuarios WHERE login='".$username."' AND passwd=sha2('".$pwdactual."',512)";
$result1 = mysql_query($query1);
$numrows = mysql_num_rows($result1);

if($numrows == false){
	echo "ERROR";
}else{
	$query2 = "UPDATE usuarios SET passwd = sha2('".$pwdnuevo."',512) WHERE login='".$username."'";
	$result2 = mysql_query($query2);
	echo "OK";
}
?>