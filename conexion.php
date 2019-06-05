<?php
 /**** VARIABLES GLOBALES ****/

 function conectarse()
  {
         if (!($nConn=mysql_connect("localhost","root","0ehn4TNU5I")))
           {
                  echo "Error conectando a la base de datos.";
                  exit();
           }
           if (!mysql_select_db("cuac",$nConn))
           {
                  echo "Error seleccionando la base de datos.";
                  exit();
           }
           return $nConn;
  }

$var = conectarse();
echo $var;
?>
