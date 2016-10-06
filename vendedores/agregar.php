<?php
include("../conexion.php");
user_login();
validar_admin();

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
            $date= date('Y-m-d'); 
            $nick= limpiar($_POST['nick']);
            $mail= limpiar($_POST['mail']);
            $pass= md5(md5(limpiar($_POST['pass'])));
            $ipuser= $_SERVER['REMOTE_ADDR'];
            $nombre_completo = $_POST['nombre_completo'];
            $movil = $_POST['movil'];
            $perfil= limpiar($_POST['perfil']);
            $tipoperfil = $_POST['tipoperfil'];
            $creado_por = $_SESSION['id'];

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
                    mysql_query("INSERT INTO usuarios (fecha,nick,mail,pass,ip,perfil,tipoperfil,nombre_completo,movil,creado_por) values ('$date','$nick','$mail','$pass','$ipuser','$perfil','$tipoperfil','$nombre_completo','$movil','$creado_por')");
                    echo '<br /><center><h3><p class="bg-info">Usuario registrado Correctamente</p></h3></center>';

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
    <meta name="description" content="referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title><?php 
    if ($_GET['add'] == 'team') {
        echo "Add Team";
    }else {
        echo "Add Source";
    }

    ?> - referidos v1.0</title>
    <link href="../estilos/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php mostrar_header();  ?>
<br />

<div class="container">
<form class="form-horizontal" name="registrar" role="form" action='' method='POST' onsubmit="return validar()">
    <div class="form-group">
        <label class="col-sm-2 control-label">Usuario:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="nombre de usuario" name='nick' data-validation="length" data-validation-length="min4">
            </div> 
        <label class="col-sm-2 control-label">Nombre completo:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="julano del tal" name='nombre_completo' data-validation="length" data-validation-length="min4">
            </div>     
        <label class="col-sm-2 control-label">clave:</label>
            <div class="col-sm-4">  
                <input type="password" class="form-control" placeholder="clave" name='pass'>
            </div>    
        <label class="col-sm-2 control-label">confirmar clave:</label>
            <div class="col-sm-4">  
                <input type="password" class="form-control" placeholder="clave" name='conf_pass'>
            </div>       
        <label class="col-sm-2 control-label">m&oacute;vil:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="(111)-1111111" name='movil' data-validation="length" data-validation-length="min4">
            </div>                     
        <label class="col-sm-2 control-label">correo:</label>
            <div class="col-sm-4">  
                <input type="email" class="form-control" placeholder="info@algo.com" name='mail' data-validation="length" data-validation-length="min2">
            </div>                 
                <input type='hidden' value='1' name='submitted' />
            <?php 
                if ($_GET['add'] == 'team') {
                    echo date('Y-m-d');
                	echo "<input type='hidden' value='team' name='perfil' />";
                    echo "<input type='hidden' value='3' name='tipoperfil' />";
                }else {
                	echo "<input type='hidden' value='vendedor' name='perfil' />";
                    echo "<input type='hidden' value='2' name='tipoperfil' />";
                }
            ?>    
    </div><button type="submit" name="registro" class="btn btn-primary">Registrar</button>
</form>
    <?php 
    if ($_GET['add'] == 'team') {
        echo "<a href='index.php?mostrar=team'class='btn btn-primary' role='button'>Volver al listado</a>";    
    }else {
        echo "<a href='index.php?mostrar=vendedores'class='btn btn-primary' role='button'>Volver al listado</a>"; 
    }
    ?>
</div> 

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.form-validator.min.js"></script>
<script> $.validate(); </script>
</body>
</html>