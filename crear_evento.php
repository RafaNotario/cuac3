<?php 
session_name('CUAC');
session_start();
/*@require_once ("xajax/xajax_core/xajax.inc.php");
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
	
	$titulo = $form["titulo"];
	$fecha = $form["fecha"];
	$num = $form["total"];
	$tareas = $form["tareas"];
	
	if($titulo == "")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Ingresa el titulo de la orden</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('titulo').focus()");
	}	
	
	if($fecha == "")
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Ingresa la fecha para la orden</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
		return $response->script("document.getElementById('fecha').focus()");
	}	
	
	
	$ordenes = "insert into ordenes values ('','$titulo', '$fecha', '$tareas')";
	$rsO = mysql_query($ordenes,$link);
	
	$select = "select * from ordenes order by id desc";
	$rsS = mysql_query($select,$link);
	$rowS = mysql_fetch_array($rsS);
	
	for($i=1; $i <= $form['total']; $i++)
	{
		if($form['a'.$i.''] != "")
		{
			$insert = "insert into asistencia values (".$rowS['id'].", ".$form['a'.$i.''].")";
			$rsI = mysql_query($insert,$link);		
		}
	}
		
	$html = '<div class="alert alert-success alert-dismissible fade in" role="alert">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Se guardo de manera correcta la orden</strong> 
                </div>';	
										
	$response->assign("mensaje", "innerHTML" ,$html);
	//$response->script("setTimeout('window.location.href=\"index.php\"', 3000);");
	$response->script("setTimeout('xajax_ordenar()',1000);");
			
	return $response;
}

function ordenar()
{ 
	$response = new xajaxResponse();
	global $link;
	
	$query= "SELECT * FROM ordenes order by id desc";
	$rs = mysql_query($query,$link);
	$row = mysql_fetch_array($rs);
						  
	$arreglo = $row['tareas'];
	$datos = explode(",", $arreglo);
	$tam = count($datos);	
	
	$html.='<table id="related">
            <tr>
            <td style="width:450px">
            <label>PUNTOS A TRATAR</label>
            <select multiple="multiple" id="lstBox1" name="lstBox1[]"  class="form-control">';
            for($i=0; $i<$tam; $i++) 
			{
    $html.='<option value="'.$datos[$i].'">'.$datos[$i].'</option>';
            }
     $html.='</select>
             </td>
             <td style="width:150px;text-align:center;vertical-align:middle;">
                 <input type="button" id="btnRight" class="btn btn-primary" value ="  >  "/><br/>
                 <input type="button" id="btnLeft" class="btn btn-primary" value ="  <  "/>
                                </td>
                                <td style="width:450px;">
                                    <label>PUNTOS A ORDENAR</label>
                                        <select multiple="multiple" id="lstBox2" name="lstBox2[]" class="form-control">
                                     </select>
                                </td>
                          </tr>	                
    		        </table>';
	
	$response->script("document.getElementById('ordenar').style.display = 'block';");
	$response->assign("ordenar", "innerHTML" ,"$html");
	
		
	return $response;
}

//Registto de funciones xajax
//$xajax->registerFunction("guarda");
//$xajax->registerFunction("ordenar");
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
	<?php echo"ESTABA XAJAX";//$xajax->printJavascript( "xajax/" ) ?>
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
                            <h2><?php echo "SESION RAFA"//$_SESSION['cl_nombre']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                       <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                              <li><a href="#">OPC 1</a></li>
                              <li><a href="#">OPC 2</a></li>                                      
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
                                    <?php echo "SESION RAFA";//$_SESSION['cl_nombre']; ?>
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
                       <h2>CREAR ORDEN DEL DIA</h2>
                	   <div class="clearfix"></div>
                   </div>
                   <div class="x_content">
                   <br />
            	   
                   <!-- FORMULARIO DE ORDEN DEL DIA --->
                   <div class="col-md-10 center-margin">
                   <div id="mensaje"></div>
	               <form id="forma" name="forma" class="form-horizontal form-label-left">
                      
                    <div class="form-group">
                    	<label>TITULO</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" placeholder="INGRESA EL TITULO DE LA ORDEN">
                    </div>
                    <br>
                    
                    <div class="form-group">
                       <label>FECHA</label>
                       <div class="xdisplay_inputx form-group has-feedback">                       
                       <input type="text" class="form-control" id="fecha" name="fecha" placeholder="SELECCIONE FECHA" aria-describedby="inputSuccess2Status2">
                       <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>  
                       </div>                     
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>PARTICIPANTES</label>
                       	<p style="padding: 5px;">
                    <?php //$cuerpos = "select * from cat_usuarios where cuerpo_academico=".$_SESSION['cl_cuerpo']."";
						  // $rs_c = mysql_query($cuerpos,$link);
						   //$i=0;
						  // while($row_c = mysql_fetch_array($rs_c))
						 	//{
					?>                    
                        <input type="checkbox" name="a<?php echo"rafa";//echo $row_c["id"];?>"  value="<?php echo "1";//$row_c["id"];?>" class="flat" checked />&nbsp;&nbsp;&nbsp; <?php echo "casa";//$row_c["nombre"];?>
                        <br />
                     <?php  //$i+=$row_c["id"];
					 		//}						
					?> 
                    	<input type="hidden" name="total" value="<?php echo $i;?>" />
                        <p>
                    </div>
                    <br>
                    
                    <div class="form-group">
                    	<label>PUNTOS A TRATAR</label>
                     	<div class="col-md-12 col-sm-12 col-xs-12">
                   		  <input id="tareas" name="tareas" type="text" class="tags form-control" value="SALUDO INICIAL, PASE DE ASISTENCIA, REVISION DE MINUTA" />
                    	  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    	</div>                                           
                    </div>
                    <br>
                    
                    <div class="form-group">
                      	<div class="col-md-12 col-sm-12 col-xs-12 center-margin">
                        	<button type="button" class="btn btn-primary">Cancelar</button>
							
                        	<button type="button" class="btn btn-success" onClick="xajax_guarda(xajax.getFormValues('forma'));">Enviar</button>
                  		</div>
                    </div>                     
                    <br>
                    
                    <?php //$ordenes = "SELECT * FROM ordenes where id=4"; 
						  //$rsO = mysql_query($ordenes,$link);
						  //$rowO = mysql_fetch_array($rsO);
						  
						  //$arreglo = $rowO['tareas'];
						  //$datos = explode(",", $arreglo);
						  //$tam = count($datos);					  
					?>
                    
                     <div class="form-group" style="display:none" id="ordenar">
                     
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

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

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
    <script>
    autosize($('.resizable_textarea'));
    </script>
    <!-- Autocomplete -->
    <script type="text/javascript" src="js/autocomplete/countries.js"></script>
    <script src="js/autocomplete/jquery.autocomplete.js"></script>
    <script type="text/javascript">
	$(document).ready(function(){
 
			// Accion del boton para mover elementos de derecha a izquierda
			$('#btnRight').click(function(e) {
				// Recupera los elementos seleccionados del select
				var selectedOpts = $('#lstBox1 option:selected');
				// Si no seleccionamos ningun elemento, 
				// nos mostrara un mensaje de alerta
				if (selectedOpts.length == 0) {
					alert("Seleccione un item para mover.");
					e.preventDefault();
				}
				// Copia los elementos seleccionados con la funcion clone
				// Para luego eleminarlos del lugar de origen.
				$('#lstBox2').append($(selectedOpts).clone());
				$(selectedOpts).remove();
				e.preventDefault();
			});
			// Accion del boton para mover elementos viceversa
			$('#btnLeft').click(function(e) {
				var selectedOpts = $('#lstBox2 option:selected');
				if (selectedOpts.length == 0) {
					alert("Seleccione un item para mover.");
					e.preventDefault();
				}
		 
				$('#lstBox1').append($(selectedOpts).clone());
				$(selectedOpts).remove();
				e.preventDefault();
			});	 
		});
		 
		function selectAll()
		{
			// Esta funcion, permitira seleccionar los elementos de la lista 2
			// para que sean enviados, atravez de POST
			$('#lstBox2 option').attr('selected', 'selected');
		}
    </script>
    
    <script type="text/javascript">
    $(function () {
      'use strict';
      var countriesArray = $.map(countries, function (value, key) {
      return {
               value: value,
               data: key
             };
      });
    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-custom-append').autocomplete({
       lookup: countriesArray,
       appendTo: '#autocomplete-container'
     });
    });
    </script>
    
     <!-- input tags -->
        <script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tareas').tagsInput({
                    width: 'auto'
                });
            });
        </script>
        <!-- /input tags -->

    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };

            $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange_right').daterangepicker(optionSet1, cb);

            $('#reportrange_right').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange_right').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });

            $('#options1').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
            });

            $('#options2').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
            });

            $('#destroy').click(function () {
                $('#reportrange_right').data('daterangepicker').remove();
            });

        });
    </script>
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#fecha').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reservation').daterangepicker(null, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <!-- /datepicker -->
    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
    </script>
    <!-- /input mask -->
    <!-- ion_range -->
    <script>
        $(function () {
            $("#range_27").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true,
                force_edges: true
            });
            $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$",
                grid: true
            });
            $("#range_25").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true
            });
            $("#range_26").ionRangeSlider({
                type: "double",
                min: 0,
                max: 10000,
                step: 500,
                grid: true,
                grid_snap: true
            });
            $("#range_31").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                from_fixed: true
            });
            $(".range_min_max").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                max_interval: 50
            });
            $(".range_time24").ionRangeSlider({
                min: +moment().subtract(12, "hours").format("X"),
                max: +moment().format("X"),
                from: +moment().subtract(6, "hours").format("X"),
                grid: true,
                force_edges: true,
                prettify: function (num) {
                    var m = moment(num, "X");
                    return m.format("Do MMMM, HH:mm");
                }
            });
        });
    </script>
    <!-- /ion_range -->
    <!-- knob -->
    <script>
        $(function ($) {

            $(".knob").knob({
                change: function (value) {
                    //console.log("change : " + value);
                },
                release: function (value) {
                    //console.log(this.$.attr('value'));
                    console.log("release : " + value);
                },
                cancel: function () {
                    console.log("cancel : ", this);
                },
                /*format : function (value) {
                 return value + '%';
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        this.cursorExt = 0.3;

                        var a = this.arc(this.cv) // Arc
                            ,
                            pa // Previous arc
                            , r = 1;

                        this.g.lineWidth = this.lineWidth;

                        if (this.o.displayPrevious) {
                            pa = this.arc(this.v);
                            this.g.beginPath();
                            this.g.strokeStyle = this.pColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });

            // Example of infinite knob, iPod click wheel
            var v, up = 0,
                down = 0,
                i = 0,
                $idir = $("div.idir"),
                $ival = $("div.ival"),
                incr = function () {
                    i++;
                    $idir.show().html("+").fadeOut();
                    $ival.html(i);
                },
                decr = function () {
                    i--;
                    $idir.show().html("-").fadeOut();
                    $ival.html(i);
                };
            $("input.infinite").knob({
                min: 0,
                max: 20,
                stopper: false,
                change: function () {
                    if (v > this.cv) {
                        if (up) {
                            decr();
                            up = 0;
                        } else {
                            up = 1;
                            down = 0;
                        }
                    } else {
                        if (v < this.cv) {
                            if (down) {
                                incr();
                                down = 0;
                            } else {
                                down = 1;
                                up = 0;
                            }
                        }
                    }
                    v = this.cv;
                }
            });
        });
    </script>
    <!-- /knob -->
</body>

</html>