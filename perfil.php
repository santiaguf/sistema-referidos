<?php
include("conexion.php");
user_login();
?>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>Men&uacute; Principal - Referidos v1.0</title>
    <link href="estilos/bootstrap.min.css" rel="stylesheet">
    <link href="estilos/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php mostrar_header();  ?>
<br />
<h2><p class="text-center">M&oacute;dulos</p></h2>
<ul>

<?php 
if ($_SESSION['perfil'] == "administrador") 
   {    
   echo "<li class='titulos2 botones-perfil'>";
   echo " <a href='vendedores/index.php?mostrar=team' class='btn btn-info' role='button'>";
   echo "     <img src='images/vendedores.png' height='48' alt='Team'>";
   echo "     <span>Team</span>";
   echo " </a>";
   echo "</li>";
   }
if ($_SESSION['perfil'] == "administrador" || $_SESSION['perfil'] == "team") 
   {    
   echo "<li class='titulos2 botones-perfil'>";
   echo " <a href='vendedores/index.php?mostrar=vendedores' class='btn btn-info' role='button'>";
   echo "     <img src='images/vendedores.png' height='48' alt='Sources'>";
   echo "     <span>Sources</span>";
   echo " </a>";
   echo "</li>";
   }
?>
<li class="titulos2 botones-perfil">
  <a href="clientes/index.php" class='btn btn-info' role='button'>
      <img src="images/clientes.png" height="48" alt="Prospects">
      <span>Prospects</span>
  </a>
</li>
<li class="titulos2 botones-perfil">
  <a href="index.php?modo=desconectar" class='btn btn-info' role='button'>
      <img src="images/salir.png"  alt="Logout">
      <span>Logout</span>
  </a>
</li>
</ul>
</body>
</html>