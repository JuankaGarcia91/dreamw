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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO persona (cedula, fecha, asunto, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fijo, celular, direccion, barrio, descripcion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['asunto'], "text"),
                       GetSQLValueString($_POST['primer_nombre'], "text"),
                       GetSQLValueString($_POST['segundo_nombre'], "text"),
                       GetSQLValueString($_POST['primer_apellido'], "text"),
                       GetSQLValueString($_POST['segundo_apellido'], "text"),
                       GetSQLValueString($_POST['fijo'], "int"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['barrio'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"));

  mysql_select_db($database_prueba, $prueba);
  $Result1 = mysql_query($insertSQL, $prueba) or die(mysql_error());

  $insertGoTo = "personas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_registrar = "-1";
if (isset($_GET['cedula'])) {
  $colname_registrar = $_GET['cedula'];
}
mysql_select_db($database_prueba, $prueba);
$query_registrar = sprintf("SELECT * FROM persona WHERE cedula = %s", GetSQLValueString($colname_registrar, "int"));
$registrar = mysql_query($query_registrar, $prueba) or die(mysql_error());
$row_registrar = mysql_fetch_assoc($registrar);
$totalRows_registrar = mysql_num_rows($registrar);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>

body {
    font-family: 'Overpass', sans-serif;
    font-weight: normal;
    font-size: 100%;
    color: #1b262c;   
    margin: 0;
    background-color: #53a83e;
}

#regis {
    font-size: 250%;
    color:#ffffff;
    text-align: center;
	margin-top:50px;    
}

#inregis {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 90%;    
    border: none;
    padding: 5px;
	text-align:center;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin: 10px;
	margin-right: 20px
    
}
#inregis:hover {
    background-color: #9fff51;
    color:#000000;
}

</style>
</head>

<body>

<h1 id="regis">Registro</h1>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Cedula:</td>
      <td><input type="text" name="cedula" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fecha:</td>
      <td><input type="date" name="fecha" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Asunto:</td>
      <td><input type="text" name="asunto" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_nombre:</td>
      <td><input type="text" name="primer_nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_nombre:</td>
      <td><input type="text" name="segundo_nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_apellido:</td>
      <td><input type="text" name="primer_apellido" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_apellido:</td>
      <td><input type="text" name="segundo_apellido" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fijo:</td>
      <td><input type="text" name="fijo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Celular:</td>
      <td><input type="text" name="celular" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Barrio:</td>
      <td><input type="text" name="barrio" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Descripcion:</td>
      <td><input type="text" name="descripcion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input id="inregis" type="submit" value="Insertar registro"></td>
    </tr>
  </table>    
    <input type="hidden" name="MM_insert" value="form1">
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($registrar);
?>
