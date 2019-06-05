<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CA - FCC COMPUTACION </title>
	<?php //$xajax->printJavascript( "xajax/" ) ?>
    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">

	 <link rel="stylesheet" type="text/css" href="css/progressbar/bootstrap-progressbar-3.3.0.css">
   
    <script src="js/jquery-1-12-3.min.js" charset="utf-8"></script>


</head>

<body style="background:#F7F7F7;">    

	
    <br>
	<div class="col-lg-12" align="center">
    	  <img src="images/sfcomputacion.jpg" alt="...">
	</div>
    <br>
        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                <div id="mensaje"></div>
                    <form id="forma" name="forma">
                        <h1>Acceso</h1>
                        <div>
                            <input type="text" id="Usuario" name="Usuario" class="form-control" placeholder="Usuario" />
                        </div>
                        <div>
                            <input type="password" id="Password" name="Password" class="form-control" placeholder="Password"  />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="#" onClick="loguea();">Iniciar Sesi&oacute;n</a>
                            <a class="reset_pass" href="#">¿Olvidaste tu password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h4>ENTORNOS COLABORATIVOS</h4>
                            <span id="result"></span>
                                <p>CUERPOS ACADEMICOS | FCC BUAP <?php echo date('Y-m-d')?></p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
<!-- FORM COMENTADO -->


	<script src="js/bootstrap.min.js"></script> 

<script type="text/javascript">
         
    function loguea(){
    
        var user = $('#Usuario').val();
        var pass = $('#Password').val();
        console.log("user"+user+"Pass"+pass);
        if($.trim(user).length > 0 && $.trim(pass).length > 0) 
        {
            $.ajax({
                url:"CONTROLLER/logueame.php",
                method:"POST",
                data:{user:user,pass:pass},
                cache:"false",
                beforeSend:function(){
                    $('#login').val("Conectando...").delay(3000);
                },//beforeSend
                success:function(data){
                    $('#login').val("Login");
                    console.log("ata"+data);
                    if (data=="1") {
                        console.log("ata"+data);
                        $(location).attr('href','alta_usuario.php');
                    }else{//$times
                        $('#result').html("<div class='alert alert-dismissible alert-danger'> <button type='button' class='close' data-dismiss='alert'> x; </button> <strong> ¡Error! </strong> Las credenciales son incorrectas o no verifico captcha.</div>");
                    }
                }//function data
            });//ajax
        }else{
                alert("Campo vacio");
            };//if
    }//func loguea

    </script> 

</body>

</html>