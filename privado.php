<?php require_once('Connections/prueba.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "consul,admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "error.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

mysql_select_db($database_prueba, $prueba);
$query_login = "SELECT * FROM login";
$login = mysql_query($query_login, $prueba) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Privado</title>
<style>
body {
    font-family: 'Overpass', sans-serif;
    font-weight: normal;
    font-size: 100%;
    color: #1b262c;
    
    margin: 0;
    background-color: #53a83e;
}

#table1 {
	border: 1px
}

#table1 {    
    background-color: #aaaaaa;    
    width: 50%;
    border: none;
    margin: 0 auto;
	margin-top: 10rem;
}

.barra1 {
    background-color: #7a0000;
    color: white;
    text-align: center;
    font-size: 150%;
}

.barra2 {    
    color: rgb(0, 0, 0);
    text-align: left;
    font-size: 120%;
}

#boton1 {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 10%;
    height: 40px;
    border: none;
    padding: 10px;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
    margin-left: 21rem;
    
}

#boton1:hover {
    background-color: #9fff51;
    color:#000000;
}

#boton2 {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 10%;
    height: 40px;
    border: none;
    padding: 10px;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
    margin-left: 21rem;
    
}

#boton2:hover {
    background-color: #9fff51;
    color:#000000;
}
</style>
</head>

<body>
<table id="table1">
  <tr class="barra1">
    <td>Cod</td>
    <td>usuario</td>
    <td>Contrasena</td>
    <td>Tipo</td>
  </tr>
  <?php do { ?>
    <tr class="barra2">
      <td><?php echo $row_login['cod']; ?></td>
      <td><?php echo $row_login['usuario']; ?></td>
      <td><?php echo $row_login['contrasena']; ?></td>
      <td><?php echo $row_login['tipo']; ?></td>
    </tr>
    <?php } while ($row_login = mysql_fetch_assoc($login)); ?>
</table>
<br>
<br>
<br>
<a id="boton2" name="personas" type="submit" value="personas" href="personas.php">Pagina Personas</a>
<br>
<br>
<br>
<a id="boton1" name="cerrar_sesion" type="submit" value="Cerrar Sesion" href="<?php echo $logoutAction ?>">Cerrar Sesion</a>
</body>
</html>
<?php
mysql_free_result($login);
?>
