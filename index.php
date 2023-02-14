<?php require_once('Connections/prueba.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "tipo";
  $MM_redirectLoginSuccess = "privado.php";
  $MM_redirectLoginFailed = "error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_prueba, $prueba);
  	
  $LoginRS__query=sprintf("SELECT usuario, contrasena, tipo FROM login WHERE usuario=%s AND contrasena=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $prueba) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'tipo');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Index</title>
<style>
body {
    font-family: 'Overpass', sans-serif;
    font-weight: normal;
    font-size: 100%;
    color: #1b262c;
    
    margin: 0;
    background-color: #53a83e;
}

#contenedor {
    display: flex;
    align-items: center;
    justify-content: center;
    
    margin: 0;
    padding: 0;
    min-width: 100vw;
    min-height: 100vh;
    width: 100%;
    height: 100%;
}

.titulo {
    font-size: 250%;
    color:#7eff64;
    text-align: center;
    margin-bottom: 20px;
}

#login {
    width: 100%;
    padding: 50px 30px;
    background-color: #bd0000;
    
    -webkit-box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);
    -moz-box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);
    box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    box-sizing: border-box;
}

#login input {
    font-family: 'Overpass', sans-serif;
    font-size: 100%;
    color: #1b262c;
    
    display: block;
    width: 100%;
    height: 40px;
    
    margin-bottom: 10px;
    padding: 5px 5px 5px 10px;
    
    box-sizing: border-box;
    
    border: none;
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
}


 #login input::placeholder {
    font-family: 'Overpass', sans-serif;
    color: #E4E4E4;
}

#login #boton {
    font-family: 'Overpass', sans-serif;
    font-size: 110%;
    color:#ffffff;
    width: 100%;
    height: 40px;
    border: none;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
}

#login #boton:hover {
    background-color: #9fff51;
    color:#000000;
}

#text1 {
	font-size: 150%;
    color:#ffffff;
    text-align: center;
    margin-bottom: 20px;
}

#text2 {
	font-size: 150%;
    color:#ffffff;
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>

<body>
<div id="contenedor">
<div id="login">
<div class="titulo">
Bienvenido
</div>
<form id="form1" name="form1" action="<?php echo $loginFormAction; ?>" method="POST">
<p id="text1">Usuario:
<input id="usuario" type="text" name="usuario" placeholder="Usuario" required></p>
<p id="text2">Contraseña:
<input id="contrasena" type="password" name="contrasena" placeholder="Contraseña" required></p>
<input id="boton" name="ingresar" type="submit" value="Ingresar">
</form>
</div>
</div>
</body>
</html>