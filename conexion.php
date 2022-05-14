<?php

date_default_timezone_set('America/Bogota');  //se define el uso horario para la aplicaci�n en caso de que difiera de la hora del servidor

    $nombre_server[1] = 'localhost'; //Servidor al cual nos vamos a conectar.
    $nombre_user[2] = 'root'; //Nombre del usuario de la base de datos.
    $password[3] = ''; //Contrase�a de la base de datos
    $nombre_db[4] = 'referids'; //nombre de la base de datos

    $conectar = mysqli_connect($nombre_server[1],$nombre_user[2],$password[3]) or exit('Datos de conexion incorrectos.');
    
/*En este archivo tambi�n pondremos unas funciones necesarias para el registro y el login*/    
session_start();

/*Funci�n que se encarga de eliminar codigo malicioso de las variables.*/
function limpiar($var)
{

    $var = trim($var);
    $var = htmlspecialchars($var);
    $var = str_replace(chr(160),'',$var);
    return $var;
}

/*Funci�n que se encarga de validar el email de registro para que sea correcto.*/
function validar_email($email){
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
    { 
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," ")))
       {//miro si tiene caracter .
          if (substr_count($email,".")>= 1)
          {//obtengo la terminacion del dominio 
             $term_dom = substr(strrchr ($email, '.'),1); 
             //compruebo que la terminaci?n del dominio sea correcta 
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
             {//compruebo que lo de antes del dominio sea correcto 
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                if ($caracter_ult != "@" && $caracter_ult != ".")
                { 
                   $mail_correcto = 1; 
                }
             }
          }
       }
    }
    if ($mail_correcto) 
       return 1;
    else 
       return 0;
}

/*Funcion que se encarga de validar si el usuario esta registrado en el sistema*/
function user_login()
{
    if(!$_SESSION['id'])
    {
        exit ("Solo usuarios registrados, <button onclick='window.history.back()'>Volver</button>");
    }
}

function validar_admin(){
  if($_SESSION['perfil'] != "administrador"){
    if ($_SESSION['perfil'] != "team") {
     exit ("acceso restringido, <a href='http://localhost/referidos/index.php'>Volver</a>");
    }
  }
}

function mostrar_header() {
echo "<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>";
  echo " <div class='container'>";
  echo "      <div class='navbar-header'>";
  echo "        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>";
  echo "          <span class='sr-only'>Toggle navigation</span>";
  echo "          <span class='icon-bar'></span>";
  echo "          <span class='icon-bar'></span>";
  echo "          <span class='icon-bar'></span>";
  echo "        </button>";
  echo "        <a class='navbar-brand' href='#'>Fredy Marin & Associates</a>";
  echo "      </div>";
  echo "      <div class='navbar-collapse collapse'>";
  echo "        <ul class='nav navbar-nav navbar-right'>";
  echo "          <li><a href='#'>";
  echo $_SESSION['nick'];
  echo "           </a></li>";
  echo "          <li><a href='http://localhost/referidos/perfil.php'>Perfil</a></li>";
  echo "          <li><a href='http://localhost/referidos/index.php?modo=desconectar'>Salir</a></li>";
  echo "        </ul>";
  echo "      </div><!--/.navbar-collapse -->";
  echo "      </div>";
  echo "    </div>";
}

?>
