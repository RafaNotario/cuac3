<?php

$servidor = "localhost";
$dbuser = "root";
$dbpass = "0ehn4TNU5I";
$dbnombre = "cuac";

$conex = new mysqli($servidor,$dbuser,$dbpass,$dbnombre);

if ($conex->connect_errno>0) {
	die("no se pudo conectar a la base de datos".$conex->connect_error."");
}else
	//echo "si se conecta";

?>