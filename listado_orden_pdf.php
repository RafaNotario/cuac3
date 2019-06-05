<?php
require('./fpdf/fpdf.php');

// conexion a base de datos
//include('conexion.php');


class PDF extends FPDF
{
   //Cabecera de orden del dia
   function Header()
   {

      $this->Image('./images/encabezado.jpg',10,8,80);

      $this->SetFont('Arial','B',12);

      $this->Cell(180,10,'Entornos Colaborativos Digitales',0,2,'R');
      $this->Cell(290,10,'para el Desarrollo de las',0,2,'C');
      $this->Cell(290,10,'Ciencias y la Tecnologia',0,2,'C');
	  $this->Ln(10);
	  
	  $this->Cell(120,10,'REUNION ORDEN DEL DIA',0,2,'R');		
   }
   
   function cabeceraVertical($cabecera)
    {
        $this->SetXY(30,65);
        $this->SetFont('Arial','B',10);        
		$this->Cell(60,8, utf8_decode('FECHA'),1, 2 , 'C' );
		$this->Cell(60,8, utf8_decode('TITULO'),1, 2 , 'C' );
		$this->Cell(60,60, utf8_decode('ASISTENTE'),1, 2 , 'C' );
		$this->Cell(60,60, utf8_decode('PUNTOS'),1, 2 , 'C' );
		
    }
 
    function datosVerticales($datos)
    {
		//$link = conectarse();
		//$id = $_REQUEST['id'];
        $this->SetXY(90, 65); //40 = 10 posiciónX_anterior + 30ancho Celdas de cabecera
        $this->SetFont('Arial','',10); //Fuente, Normal, tamaño
       
	   	//$query = "SELECT * FROM ordenes where id = ".$id."";
		//$rs = mysql_query($query,$link);
			
		//while($row = mysql_fetch_array($rs))
		//{
		//	$asistencia = "SELECT id_orden, id, nombre
						   	//FROM asistencia a, cat_usuarios u
						   //WHERE id_orden=".$id."
						   //AND a.id_usuario = u.id";
			//$rs_a = mysql_query($asistencia,$link);
			//$num = mysql_num_rows($rs_a);
        	$this->Cell(90,8, utf8_decode("2019-04-30"),1, 2 , 'L' );//$row['fecha']
			$this->Cell(90,8, utf8_decode("PRUEBA"),1, 2 , 'L' );//$row['titulo']
			//while($row_a = mysql_fetch_array($rs_a))
			//{
			//	$tam = 60 / $num;
				$this->Cell(90,$tam, utf8_decode("NOMBRE"),1, 2 , 'L' );//$row_a['nombre']
			//}
			$cadena = explode(",","TAREAS TREAS" );//$row['tareas']
			$tam_p = 60 / count($cadena);
			$cant = count($cadena);
					
			for($i=0; $i < $cant; $i++)
			{
				$this->Cell(90,$tam_p, utf8_decode($cadena[$i]),1, 2 , 'L' );	
			}
			
				 
			 
		}
    }
//}



//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
 
 
 
 
$pdf->cabeceraVertical("10");//$miCabecera
$pdf->datosVerticales($misDatos);

//Aquí escribimos lo que deseamos mostrar...
$pdf->Output();
?>
