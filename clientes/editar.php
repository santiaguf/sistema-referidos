<?php 
include("../conexion.php");
user_login();
validar_admin();
?>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>editar Prospect - referidos v1.0</title>
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
<?php 
if (isset($_GET['id_cliente']) ) { 
$id_cliente = (int) $_GET['id_cliente']; 
if (isset($_POST['submitted'])) { 
//$id_cliente = (int) $_POST['id_cliente'];    
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `clientes` SET  `nombre_cliente` =  '{$_POST['nombre_cliente']}' ,  `apellido_cliente` =  '{$_POST['apellido_cliente']}' ,  `telefono_cliente` =  '{$_POST['telefono_cliente']}' ,  `email_cliente` =  '{$_POST['email_cliente']}' ,  `tipo_servicio` =  '{$_POST['tipo_servicio']}' ,  `id_vendedor` =  '{$_POST['id']}' , `subsource` = '{$_POST['subsource']}'  WHERE `id_cliente` = '$id_cliente' "; 
mysql_query($sql) or die(mysql_error()); 
echo "<br /><center><h3><p class='bg-info'>"; 
echo (mysql_affected_rows()) ? "Prospect editado correctamente.<br />" : "Ningun cambio realizado. <br />"; 
echo "<a href='index.php'>volver al listado</a></p></h3></center>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `clientes` WHERE `id_cliente` = '$id_cliente' ")); 
?>

<br />
<div class="container">
<form class="form-horizontal" name="registrar" role="form" action='' method='POST' onsubmit="return validar()">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="pepito" name='nombre_cliente' value='<?php echo stripslashes($row['nombre_cliente']) ?>' data-validation="length" data-validation-length="min1">
            </div> 
        <label class="col-sm-2 control-label">Apellido:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="perez" name='apellido_cliente' value='<?php echo stripslashes($row['apellido_cliente']) ?>' data-validation="length" data-validation-length="min1">
            </div>   
        <label class="col-sm-2 control-label">Tel&eacute;fono:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="304-1234567" name='telefono_cliente' value='<?php echo stripslashes($row['telefono_cliente']) ?>' data-validation="length" data-validation-length="min4">
            </div>   
        <label class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-4">  
                <input type="email" class="form-control" placeholder="micorrreo@gmail.com" name='email_cliente' value='<?php echo stripslashes($row['email_cliente']) ?>'>
            </div>    
        <label class="col-sm-2 control-label">Tipo de servicio:</label>
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
        <label class="col-sm-2 control-label">referido por:</label>
            <div class="col-sm-4">  
                    <?php
                    // Consultar la base de datos para obtener listado de clientes
                    $consulta_mysql="select * from usuarios WHERE `tipoperfil` = '2' ORDER BY `usuarios`.`nombre_completo` ASC ";
                    $resultado_consulta_mysql=mysql_query($consulta_mysql,$conectar);
                    //menu desplegable con lista de clientes
                    echo "<select class='form-control' name='id'>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                    // se invirtieron las comillas dobles por simples para que funcione en windows server
                    echo '<option value="'.$fila['id'].'">'.$fila['nombre_completo'].'</option>';
                    }
                    echo "</select>";
                ?> 
            </div>
        <label class="col-sm-2 control-label">SubSource:</label>
            <div class="col-sm-4">  
                <input type="text" class="form-control" placeholder="SubSource" name='subsource' value='<?php echo stripslashes($row['subsource']) ?>'>
            </div>            
                <input type='hidden' value='1' name='submitted' />
            
    </div><button type="submit" name="registro" class="btn btn-primary">Guardar</button>
</form> 
<?php } 
	echo "<a href='index.php'>Cancelar</a>";
?>
</div>
</body>
</html>