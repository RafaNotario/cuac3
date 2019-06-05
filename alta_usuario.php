<?php 
session_start();
/*@require_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->setFlag("debug", true);
$xajax->configure("cleanBuffer", true);
$xajax->configure("characterEncoding","ISO-8859-1");
$xajax->configure("decodeUTF8Input",true);
$xajax->configure("javascript URI","xajax/");

// conexion a base de datos
include('conexion.php');
$link = conectarse();
*/
//<---------------------------------------------------------------------------------------------
//datos para login
function guarda($form)
{ 
	$response = new xajaxResponse();
	global $link;
	
	$nombre	 	= strtoupper($form["nombre"]);
	$usuario 	= strtoupper($form["usuario"]);
	$password 	= strtoupper($form["password"]);
	$puesto		= $form["puesto"];
	$afiliacion	= $form["afiliacion"];
	$cuerpo		= $form["cuerpo"];
	$nivel		= $form["nivel"];
	$email		= $form["email"];
		
	if($nombre == "")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Ingresa el nombre del usuario</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('nombre').focus()");
	}	
	
	if($usuario == "")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Ingresa el usuario</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('usuario').focus()");
	}	
	
	if($password == "")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Ingresa el password</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('password').focus()");
	}	
	
	if($nivel == "S")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Selecciona el nivel</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('nivel').focus()");
	}	
	
	
	
	$query = "INSERT INTO cat_usuarios values('','".$nombre."','".$usuario."','".$password."','$puesto','$cuerpo','$afiliacion','".$email."','$nivel','0','0')";
	$rs = mysql_query($query,$link);
	
	if(!$rs)
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Hubo un error al guardar la informaci&oacute;n/strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
	}
	else
	{
		
		$html = '<div class="alert alert-success alert-dismissible fade in" role="alert">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Se guardo de manera correcta la orden</strong> 
                </div>';										
		$response->assign("mensaje", "innerHTML" ,$html);		
	}
	
	$response->script("setTimeout('window.location.href = \'lista_usuarios.php\'',3000)");
	//$response->script("setTimeout('xajax_ordenar()',1000);");
			
	return $response;
}


//Registto de funciones xajax
//$xajax->registerFunction("guarda");
//$xajax->processRequest();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CA - FCC COMPUTACION</title>
	<?php //echo $xajax->printJavascript("xajax/"); ?>
    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/floatexamples.css" rel="stylesheet" />
    
    <!-- ion_range -->
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />

    <!-- colorpicker -->
    <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                         <a href="index.php" class="site_title"><span>ENTORNOS</span></a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <br />
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido</span>
                            <h2><?php echo $_SESSION['cl_nombre']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                       <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                              <li><a href="#">PERFIL</a></li>
                              <li><a href="index2.php">ORDEN DEL DIA</a></li>                                      
                              <li><a href="#">OPC 3</a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['cl_nombre']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a></li>
                                </ul>
                            </li>                

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
            
            
            <div class="col-md-12">
               <div class="x_panel">
            	   <div class="x_title">
                       <h2>Alta de Usuarios</h2>
                	   <div class="clearfix"></div>
                   </div>
                   <div class="x_content">
                   <br />
            	   
                   <!-- FORMULARIO DE CAPTURA PARA DAR DE ALTA --->
                   <div class="col-md-6 center-margin">

	<form accept-charset="utf-8" id="enviaDatos" method="post"  enctype="multipart/form-data">
                      
                    <div class="form-group">
                    	<label>NOMBRE</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="INGRESA EL NOMBRE COMPLETO DEL USUARIO">
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>USUARIO</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="INGRESA EL USUARIO PARA EL SISTEMA">
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>PASSWORD</label>
                        <input type="text" id="password" name="password" class="form-control" placeholder="INGRESA EL PASSWORD">
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>PUESTO</label>
                        <input type="text" id="puesto" name="puesto" class="form-control"  value="1" placeholder="INGRESA EL PUESTO">
                    </div>
                    <br>
                                        
                    <div class="form-group">
                    	<label>AFILIACIÓN</label>
                        <input type="text" id="afiliacion" name="afiliacion" class="form-control" placeholder="INGRESA LA AFILIACIÓN">
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>CUERPO ACADEMICO</label>
                        <input type="text" id="cuerpo" name="cuerpo" class="form-control" value="1" placeholder="ENTORNO ACADEMICO">
                    </div>
                    <br>
                    <div class="form-group">
                    	<label>NIVEL</label>
                        	<select id="nivel" name="nivel" class="form-control">
                        		<option value="S">--- SELECCIONE ---</option>
                            <option value="T"> OPC 1</option>
                            <option value="U"> OPC 2 2</option>
                           </select>
                     </div> 
                     <br>                      
        <div class="form-group">
            <label for="datepick"> Fecha de Inscripcion </label>
              <input type="date" name="datepick" id="datepick" value="<?php echo date('Y-m-d'); ?>" class="form-control">
        </div>                                    <br>                     
                    <div class="form-group">
                    	<label>E-MAIL</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="ejemplo@cs.buap.mx">
                    </div>
                    <br>
                  <div class="form-group">
                    <label for="fot"> IMAGEN:</label>
                    <input type="file" name="fot" id="fot" class="btn-info">
                  </div>

                    <div class="form-group">
                      	<div class="col-md-12 col-sm-12 col-xs-12">
                        	<button type="button" class="btn btn-primary">Cancelar</button>
                        	<button type="submit" class="btn btn-success"> ENVIAR </button>
                  		</div>
                    </div>                     
                    <br>
            	 </form>
                   </div>
            		<!--  TERMINA FORMULARIO  -->
                   </div>
               </div>
            </div>        

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">ENTORNOS COLABORATIVOS | CUERPOS ACADEMICOS | FCC - COMPUTACION <a href="http://www.cs.buap.mx" target="_blank">www.cs.buap.mx</a>. |
                                             </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>
    </div>
<div id="resultadoBusqueda"></div>

  <script type="text/javascript">

  $('#enviaDatos').on("submit",function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("enviaDatos"));
    console.log(formData);
    $.ajax({
      url: "CONTROLLER/create.php",
      type: "POST",
      datatype: "HTML",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    }).done(function(data){
      $("#resultadoBusqueda").html(data);
        if (data ==1 ) {
            //toastr.success('Correctamente', 'CLIENTE GUARDADO', {timeOut: 5000});
            alert("EXITO");
        }else{

          if (data == 5) {
                //toastr.warning('Ya exite usuario', 'Warning', {timeOut: 5000})
            alert("EXISTE");
          }else{
//          toastr.error('ERROR','No se realizo el guardado', {timeOut: 5000})
        alert("NADA");
        $('#res').html("Ha ocurrido un error.");
          $('#res').css('color','red');
          }
        }
    })
  });  

    function LimpiarCampos(){
      document.nuevo_cliente.idCli.value="";
      document.nuevo_cliente.rfc.value="";
      document.nuevo_cliente.nom.value="";
      document.nuevo_cliente.apes.value="";
      document.nuevo_cliente.cel.value="";
      document.nuevo_cliente.mail.value="";
      document.nuevo_cliente.idCli.focus();
    }

  $("#myBtn").click(function(){
    $("#resultadoBusqueda").load("pruebas/getUser.php");
  });

  function volteaFech(fech){
    var day = fech[0]+fech[1];
    var month = fech[3]+fech[4];
    var year= fech[6]+fech[7]+fech[8]+fech[9];    
  return year+"-"+month+"-"+day;
}
</script>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- tags -->
    <script src="js/tags/jquery.tagsinput.min.js"></script>
    <!-- switchery -->
    <script src="js/switchery/switchery.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- richtext editor -->
    <script src="js/editor/bootstrap-wysiwyg.js"></script>
    <script src="js/editor/external/jquery.hotkeys.js"></script>
    <script src="js/editor/external/google-code-prettify/prettify.js"></script>
    <!-- input mask -->
    <script src="js/input_mask/jquery.inputmask.js"></script>
    <!-- knob -->
    <script src="js/knob/jquery.knob.min.js"></script>
    <!-- range slider -->
    <script src="js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="js/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="js/colorpicker/docs.js"></script>

    <!-- image cropping -->
    <script src="js/cropping/cropper.min.js"></script>
    <script src="js/cropping/main2.js"></script>
    <!-- select2 -->
    <script src="js/select/select2.full.js"></script>
    <!-- form validation -->
    <script type="text/javascript" src="js/parsley/parsley.min.js"></script>
    <!-- textarea resize -->
    <script src="js/textarea/autosize.min.js"></script>

</body>
</html>