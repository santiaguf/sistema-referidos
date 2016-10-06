<?php
include("conexion.php");
//Sistema de registro --aumentada.net  - twitter.com/santiaguf --

if(isset($_POST['registro']))//Validamos que el formulario fue enviado
{    /*Validamos que todos los campos esten llenos correctamente*/
    if(($_POST['nick'] != '') && ($_POST['mail'] != '') && ($_POST['pass'] != '') && ($_POST['conf_pass'] != ''))
    {
        if($_POST['pass'] != $_POST['conf_pass'])
        {
            echo '<br />Las contrase&ntilde;as no coinciden';
        }
        else
        {
            $date= time(); 
            $nick= limpiar($_POST['nick']);
            $mail= limpiar($_POST['mail']);
            $pass= md5(md5(limpiar($_POST['pass'])));
            $ipuser= $_SERVER['REMOTE_ADDR'];
            $nombre_completo = $_POST['nombre_completo'];
            $movil = $_POST['movil'];
            $perfil= limpiar($_POST['perfil']);
            if ($perfil == "administrador") {
                $tipoperfil = 1;
            }else if ($perfil == "vendedor") {
                $tipoperfil = 2;
            }else if ($perfil == "team") {
                $tipoperfil = 3;
            }

            $b_user= mysql_query("SELECT nick FROM usuarios WHERE nick='$nick'");
            if($user=@mysql_fetch_array($b_user))
            {
                echo '<br />El nombre de usuario o el email ya esta registrado.';
                mysql_free_result($b_user); //liberamos la memoria del query a la db
            }
            else
            {
                if(validar_email($_POST['mail']))
                {
                    mysql_query("INSERT INTO usuarios (fecha,nick,mail,pass,ip,perfil,tipoperfil,nombre_completo,movil) values ('$date','$nick','$mail','$pass','$ipuser','$perfil','$tipoperfil','$nombre_completo','$movil')");
                    echo '<br /><center><h3><p class="bg-info">Te has registrado Correctamente, ahora podras iniciar sesi&oacute;n como usuario registrado. espera 3 segundos</p></h3></center>';
                    echo '<meta http-equiv="Refresh" content="3;url=index.php"> ';

                }
                else 
                {
                    echo '<br />El email no es valido.';
                }
            }
        }
    }
    else
    {
        echo '<br />Deberas llenar todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>registro de usuarios - Referidos v1.0</title>
    <link href="estilos/bootstrap.min.css" rel="stylesheet">
    <link href="estilos/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
   <div class='container'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='#'>Fredy Marin & Associates</a>
        </div>
        <div class='navbar-collapse collapse'>
          <ul class='nav navbar-nav navbar-right'>
            <li><a href='http://fredymarinandassociates.com/referidos/'>Iniciar Sesi&oacute;n</a></li>
            <li><a href='http://fredymarinandassociates.com/referidos/perfil.php'>Perfil</a></li>
            <li><a href='http://fredymarinandassociates.com/referidos/index.php?modo=desconectar'>Salir</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
        </div>
      </div>

<br />

<div class="container">
<form class="form-horizontal" name="registrar" role="form" action='_registro.php' method='POST' onsubmit="return validar()">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nombre de Usuario:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Ej.: fredy123" name='nick' data-validation="length" data-validation-length="min1">
            </div>  
        <label class="col-sm-2 control-label">Nombre Completo:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Ej.: Fredy Marin" name='nombre_completo' data-validation="length" data-validation-length="min1">
            </div>     
        <label class="col-sm-2 control-label">Clave:</label>
            <div class="col-sm-4">  
                <input type="password" class="form-control" placeholder="Clave" name='pass'>
            </div>    
        <label class="col-sm-2 control-label">Confirmar Clave:</label>
            <div class="col-sm-4">  
                <input type="password" class="form-control" placeholder="Confirmar Clave" name='conf_pass' >
            </div>   
        <label class="col-sm-2 control-label">M&oacute;vil:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="(111)111-1111" name='movil' data-validation="length" data-validation-length="min1">
            </div>                         
        <label class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-4">  
                <input type="email" class="form-control" placeholder="info@correo.com" name='mail' data-validation="length" data-validation-length="min1">
            </div>      
        <label class="col-sm-2 control-label">Perfil:</label>
            <div class="col-sm-4">  
                <select name='perfil' class="form-control">
                            <option value='administrador'>administrador</option>
                            <option value='team'>team</option>
                            <option value='vendedor'>vendedor</option>
                        </select> 
            </div>                  
                <input type='hidden' value='1' name='submitted' />
            
    </div><button type="submit" name="registro" class="btn btn-primary">Registrar</button>
</form>
</div> 

<script src="js/jquery.min.js"></script>
<script src="js/jquery.form-validator.min.js"></script>
<script> $.validate(); </script>
</body>
</html>