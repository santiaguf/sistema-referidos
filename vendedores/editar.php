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
    <title>edit User - referidos v1.0</title>
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
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `usuarios` SET  `nombre_completo` =  '{$_POST['nombre_completo']}' ,  `nick` =  '{$_POST['nick']}' ,  `movil` =  '{$_POST['movil']}' ,  `mail` =  '{$_POST['mail']}'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo "<br /><center><h3><p class='bg-info'>"; 
echo (mysql_affected_rows()) ? "Source editado correctamente.<br />" : "Ningun cambio realizado. <br />"; 
echo "<a href='index.php'>volver al listado</a></p></h3></center>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `usuarios` WHERE `id` = '$id' ")); 
?>

<br />
<div class="container">
<form class="form-horizontal" role="form" action='' method='POST'>
	<div class="form-group">
    	<label class="col-sm-2 control-label">Nick:</label>
    		<div class="col-sm-4">
    			<input type="text" class="form-control" placeholder="pepito" name='nick' value='<?php echo stripslashes($row['nick']) ?>'>
    		</div>	
        <label class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="julano de tal" name='nombre_completo' value='<?php echo stripslashes($row['nombre_completo']) ?>'>
            </div>      
     	<label class="col-sm-2 control-label">m&oacute;vil:</label>
    		<div class="col-sm-4">	
    			<input type="text" class="form-control" placeholder="" name='cc_titular' value='<?php echo stripslashes($row['movil']) ?>'>
			</div>
     	<label class="col-sm-2 control-label">mail:</label>
    		<div class="col-sm-4">	
    			<input type="email" class="form-control" placeholder="calle y numero" name='mail' value='<?php echo stripslashes($row['mail']) ?>'>
			</div>     	  	   	
    			<input type='hidden' value='1' name='submitted' />
			
 	</div><button type="submit" class="btn btn-primary">Editar</button>
 	<input type='hidden' value='1' name='submitted' /> 
</form>
 
<?php } 
	echo "<a href='index.php'>Cancelar</a>";
?>
</div>
</body>
</html>