<?php 
session_name('CUAC');
session_start();
//@require_once ("xajax/xajax_core/xajax.inc.php");
//$xajax = new xajax();
//$xajax->setFlag("debug", true);
//$xajax->configure("cleanBuffer", true);
//$xajax->configure("characterEncoding","ISO-8859-1");
//$xajax->configure("decodeUTF8Input",true);
//$xajax->configure("javascript URI","xajax/");

// conexion a base de datos
//include('conexion.php');
//$link = conectarse();

//<---------------------------------------------------------------------------------------------
//datos para login
function eliminar($id)
{ 
	$response = new xajaxResponse();
	global $link;
	
	$query = "delete from usuario_cv where id=$id";
	$rs = mysql_query($query);
	
	if(!$rs)
	{
		$html = '<div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerta_error" name="alerta_error">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Hubo un error al eliminar el curriculum</strong> 
                </div>';				
		$response->assign("mensaje", "innerHTML" ,$html);
	}
	else
	{
		
		$html = '<div class="alert alert-success alert-dismissible fade in" role="alert">
                  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  		<span aria-hidden="true">Cerrar</span>
                  	</button>
                  <strong>Se elimino de manera correcta el curriculum</strong> 
                </div>';										
		$response->assign("mensaje", "innerHTML" ,$html);		
	}
	
	$response->script("setTimeout('window.location.href = \'listado_curriculum.php\'',2000)");
	
	
	
	return $response;
}

//Registto de funciones xajax
//$xajax->registerFunction("eliminar");
//$xajax->registerFunction("ordenar");
//$xajax->registerFunction("puntos");
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
	<?php echo"xajax";//$xajax->printJavascript( "xajax/" ) ?>
     <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

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
                            <h2><?php echo "RAFA SESION";//$_SESSION['cl_nombre']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                       <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
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
                <div class="">
                    
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>LISTADO DE CURRICULUMS</h2>
                                    <div class="clearfix"></div>
                                </div>
								 <div id="mensaje"></div>
                                <div class="x_content">
                                <?php
									//$sql = "select * from usuario_cv";
									//$rs_s = mysql_query($sql,$link);
									//$num = 1;
								?>
                                
                               <table id="example" class="table table-striped responsive-utilities jambo_table" width="90%" align="center">
                                <thead>
                                            <tr class="headings">
                                                <th align="center">No</th>
                                                <th align="center">Nombre</th>
                                                <th align="center">Telefono</th>
                                                <th align="center">Correo</th>
                                                <th align="center">Archivo</th>
                                                <th align="center">Eliminar</th>
												</th>
                                            </tr>
                                  </thead>
                                  <tbody>
                                  <?php //while($row_s = mysql_fetch_array($rs_s))
//								  {
								  ?>
                                  	<tr>
                                    	<td><?php echo "1";//$num;?></td>
                                        <td><?php echo "RAFA"//$row_s['nombre'];?></td>
                                        <td><?php echo "2225984218";//$row_s['lada'].$row_s['telefono'];?></td>
										<td><?php echo "rafagmail.com";//$row_s['correo'];?></td>
                                        <td><a target="_blank" href="<?php echo "archivo";//$row_s['archivo'];?>" ><img src="./images/pdf.png" width="50px" height="50px" style="cursor:pointer"/></a></td>
                                        <td><a href="#" onClick="#;"><button type="button" class="btn btn-info btn-xs">Eliminar</button></a></td>                                        
                                    </tr>
                                  
								  <?php 
//								  $num++;
//								  }?>
                                
                                  </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

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


        <!-- Datatables -->
        <script src="js/datatables/js/jquery.dataTables.js"></script>
        <!--<script src="js/datatables/tools/js/dataTables.tableTools.js"></script>-->
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Busca por nombre de orden:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf');"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>
</body>

</html>