<?php
include("../conexion.php");
user_login();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>Add Prospect - referidos v1.0</title>
    <link href="../estilos/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
if (isset($_POST['submitted'])) { 
//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$fecha_registro = date('Y-m-d');
if ($_SESSION['perfil'] == "administrador" or $_SESSION['perfil'] == "team") {
    $creado_por = $_SESSION['id'];
    $sql = "INSERT INTO `clientes` ( `nombre_cliente` ,  `apellido_cliente` ,  `telefono_cliente` ,  `email_cliente` ,  `tipo_servicio` , `fecha_registro` , `id_vendedor` , `subsource` , `creado_por`  ) VALUES(  '{$_POST['nombre_cliente']}' ,  '{$_POST['apellido_cliente']}' ,  '{$_POST['telefono_cliente']}' ,  '{$_POST['email_cliente']}' ,  '{$_POST['tipo_servicio']}' ,  '{$fecha_registro}' ,  '{$_POST['id']}' , '{$_POST['subsource']}' , '{$creado_por}'  ) "; 
}else {
    $sql = "INSERT INTO `clientes` ( `nombre_cliente` ,  `apellido_cliente` ,  `telefono_cliente` ,  `email_cliente` ,  `tipo_servicio` , `fecha_registro` , `id_vendedor` , `subsource`  ) VALUES(  '{$_POST['nombre_cliente']}' ,  '{$_POST['apellido_cliente']}' ,  '{$_POST['telefono_cliente']}' ,  '{$_POST['email_cliente']}' ,  '{$_POST['tipo_servicio']}' ,  '{$fecha_registro}' ,  '{$_POST['id']}' , '{$_POST['subsource']}'  ) "; 
}
mysql_query($sql) or die(mysql_error()); 
//obtengo el correo de la persona que agregó el cliente(prospect) para enviarle un mail de agradecimiento.
$elnick = $_SESSION['nick'];
$result2 = mysql_query("SELECT mail FROM usuarios WHERE usuarios.nick = '$elnick' ") or trigger_error(mysql_error());
$row = mysql_fetch_array($result2);
$correo_source = $row['mail'];
//si el cliente se agrega, se envía el correo al vendedor y a fredy
$para      = 'fredy@fredymarin.com,juanks10@hotmail.com,'.$correo_source.'';
$titulo = 'nuevo cliente agregado';
$mensaje = 'felicitaciones, un nuevo cliente ha sido agregado. se llama '.$_POST['nombre_cliente'].' '.$_POST['apellido_cliente'].'';
$cabeceras = 'From: fredy@fredymarin.com' . "\r\n" .
    'Reply-To: fredy@fredymarin.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($para, $titulo, $mensaje, $cabeceras);
// 

echo "<br /><center><h3><p class='bg-info'>Prospect creado.<br />"; 
echo "<a href='index.php'>Volver al listado</a></p></h3></center>"; 
} 
mostrar_header(); ?>

<br />

<div class="container">
<form class="form-horizontal" name="registrar" role="form" action='agregar.php' method='POST' onsubmit="return validar()">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Ej.: Pedro" name='nombre_cliente' data-validation="length" data-validation-length="min1">
            </div> 
        <label class="col-sm-2 control-label">Apellido:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="Ej.: Perez" name='apellido_cliente' data-validation="length" data-validation-length="min1">
            </div>   
        <label class="col-sm-2 control-label">Tel&eacute;fono:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="(111)-111-1111" name='telefono_cliente' data-validation="length" data-validation-length="min4">
            </div>   
        <label class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-4">  
                <input type="email" class="form-control" placeholder="micorrreo@correo.com" name='email_cliente'>
            </div>    
        <label class="col-sm-2 control-label">Tipo de Servicio:</label>
            <div class="col-sm-4">  
                <select class='form-control' name='tipo_servicio'>
                        <option value='Compra de casa'>Compra de casa</option>
                        <option value='Refinanciación'>Refinanciación</option>
                        <option value='Reparación crédito'>Reparación crédito</option>
                        <option value='Seguro de vida'>Seguro de vida</option>
                        <option value='Seguros'>Seguros</option>
                        <option value='Retiro'>Retiro</option>
                        <option value='Taxes y Contabilidad'>Taxes y Contabilidad</option>
                </select> 
            </div>

        <?php                            
       
       if ($_SESSION['perfil'] == "administrador" or $_SESSION['perfil'] == "team") {
         			echo "<label class='col-sm-2 control-label'>referido por:</label>";
            		echo "<div class='col-sm-4'>";          
                    // Consultar la base de datos para obtener listado de clientes
                    $consulta_mysql='select * from usuarios WHERE `tipoperfil` = 2  ORDER BY `usuarios`.`nombre_completo` ASC ';
                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conectar);
                    //menu desplegable con lista de clientes
                    echo "<select class='form-control' name='id'>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                    // se invirtieron las comillas dobles por simples para que funcione en windows server
                    echo '<option value="'.$fila['id'].'">'.$fila['nombre_completo'].'</option>';
                    }
                    echo "</select>";
            		echo "</div>"; 
            }else{
            	echo "<input type='hidden' value=".$_SESSION['id']." name='id' />";
            }

            ?> 
            <label class="col-sm-2 control-label">SubSource:</label>
            <div class="col-sm-4">  
                <input type="text" class="form-control" placeholder="SubSource" name='subsource'>
            </div>      
                <input type='hidden' value='vendedor' name='perfil' />                
                <input type='hidden' value='1' name='submitted' />
            
    </div><button type="submit" name="registro" class="btn btn-primary">Registrar</button>
</form>
<a href='index.php'class='btn btn-primary' role='button'>Volver al listado</a>
</div> 

<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.form-validator.min.js"></script>
<script> $.validate(); </script>
</body>
</html>