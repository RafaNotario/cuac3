<?php
// conexion a base de datos
include('conexion.php');
$link = conectarse();

$nombre = $_REQUEST['nombre'];
$estado =  $_REQUEST['estado'];
$lada = $_REQUEST['lada'];
$telefono =  $_REQUEST['telefono'];
$correo = $_REQUEST['correo'];

$uploaddir = 'curriculums/';
$uploadfile = $uploaddir . basename($_FILES['archivo']['name']);
$ruta = $uploadfile;

if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {
	$query = "insert into usuario_cv (foto, nombre, estado, lada, telefono, correo, archivo, fecha_captura) 
				  values ('','".$nombre."','".$estado."','".$lada."','".$telefono."','".$correo."','".$ruta."','".date('Y-m-d')."')";
	$rs = mysql_query($query,$link);
		
	if(!$rs)
		echo "<script>  alert('Ocurrio algun error al cargar el archivo, vuelva a intentarlo'); </script>";	
	else
		echo "<script>  alert('La información del CV se almaceno correctamente'); </script>";
}




echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=subir_curriculum.php'>";
?>

