<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="referidos v1.0">
    <meta name="author" content="santiago bernal betancourth">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>Reset Password - Referidos v1.0</title>
    <link href="estilos/bootstrap.min.css" rel="stylesheet">
    <link href="estilos/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
if (isset($_POST['submitted'])) { 

// 1. verificamos si el correo está en la BD
$el_correo = $_POST['correo'];    
$result2 = mysql_query("SELECT id,mail FROM usuarios WHERE usuarios.mail = '$el_correo' ") or trigger_error(mysql_error());
$row = mysql_fetch_array($result2);
$correo_source = $row['mail'];
$elid = $row['id'];

if (gettype($row) == 'boolean') {
    echo "<h2>EL correo no figura registrado en la base de datos.</h2>";
}else if (gettype($row) == 'array') {
    // 2. generamos una contraseña aleatoria de 9 dígitos y le generamos un doble md5 para guardarla en la base de datos
        function generate_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
        }
        $password1 = generate_password();
        $password2 = md5(md5($password1));

    //  3. enviamos la contraseña por correo y
        $para      = ''.$correo_source.'';
        $titulo = 'nueva clave referidos';
        $mensaje = 'Hola, tu nueva clave de acceso al sistema de referidos es: '.$password1.' ' . "\r\n" .'  esta se genera aleatoriamente por seguridad';
        $cabeceras = 'From: fredy@fredymarinandassociates.com' . "\r\n" .
            'Reply-To: fredy@fredymarin.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($para, $titulo, $mensaje, $cabeceras);

    //  4. guardamos la contraseña cifrada en la bd
        $sql = "UPDATE `usuarios` SET  `pass` =  '{$password2}'  WHERE `id` = '$elid' "; 
        mysql_query($sql) or die(mysql_error());     

        //echo $mensaje;
        echo "<br /><center><h3><p class='bg-info'>la clave se ha enviado al correo electr&oacute;nico.<br />"; 
        echo "<a href='index.php'>Volver al inicio</a></p></h3></center>"; 

    //echo $password1;
    //echo md5($password1);
    //echo md5(md5($password1));        
    }
 } 
?>
<br />

<center><img src="images/logo.jpg" / ></center>
<div class="container">
    <form class="form-signin" role="form" name="login_user" action="" method="post" />
    <h3 class="form-signin-heading">Escribe tu Email y clic en el bot&oacute;n Reset, te llegar&aacute; una nueva contraseña al email</h3>
        <input type="text" name='correo' class="form-control" placeholder="info@mail.com" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Reset</button>
        <input type="hidden" name='submitted'>
    </form>
    <center>Referidos 1.0</center>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.form-validator.min.js"></script>
<script> $.validate(); </script>
</body>
</html>