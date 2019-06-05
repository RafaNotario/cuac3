<?php
 
include("conexion.php");

$nombre = $_POST['nombre'];
$usua = $_POST['usuario'];//apes
$passw = $_POST['password'];//nick
$pues = $_POST['puesto'];//dir
$afil = $_POST['afiliacion'];//cel
$cuer = $_POST['cuerpo'];//correo
$niv = $_POST['nivel'];//rfc
$fech = $_POST['datepick'];//fech
$mail = $_POST['email'];//fech


	if ($_FILES['fot']['error']===4) {
		die('Es necesario establecer una imagen');
	}else if ($_FILES['fot']['error']===0) {

	$imagenBinaria = addslashes(file_get_contents($_FILES['fot']['tmp_name']));

	$res ="INSERT INTO cat_usuarios(nombre,usuario,password,puesto,afiliacion,cuerpo,nivel,datepick,email,foto) VALUES(
		'".$nombre."','".$usua."','".limpia_espacios($passw)."','".$pues."','".limpia_espacios($afil)."','".limpia_espacios($cuer)."','".limpia_espacios($niv)."','".limpia_espacios($fech)."','".limpia_espacios($mail)."','".$imagenBinaria."')";

	$result = mysqli_query($conex,$res);
	//$var =  mysqli_affected_rows($conex);
		if($result == "1")
		{
			//$data = mysqli_fetch_array($result);
			echo "1";

		}else{
			echo "2";
		}
	 }



$result->close();

function limpia_espacios($cadena){
	$cadena = str_replace(' ','',$cadena);
	return $cadena;
}

?>


