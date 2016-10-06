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
    <title>borrar Source - referidos v1.0</title>
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
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `usuarios` WHERE `id` = '$id' ") ; 
echo "<br /><center><h3><p class='bg-info'>";
echo (mysql_affected_rows()) ? "Source eliminado.<br /> " : "No se elimin&oacute;.<br /> "; 
echo 'espera 3 segundos o haz clic <a href="index.php">aqui</a></p></h3></center>';
echo '<meta http-equiv="Refresh" content="3;url=index.php"> ';
?>
<?php mostrar_header();  ?>
<br />
	<div class="container">
		<a href='index.php'>Volver al listado</a>
	</div>
</body>
</html>