<?php 
require_once 'Conexion.php';
	try{
		$dbh = new Conexion();

		$stm = $dbh->prepare("select * from cat_usuarios");//order by id_cli desc
		$stm->execute();

		$datos = $stm->fetch();

			echo $datos[2].'<br/>';

	}catch(PDOException $e){
		echo $e->getMessage();
	}
		$dbh = null;
 ?>