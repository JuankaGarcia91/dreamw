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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE persona SET fecha=%s, asunto=%s, primer_nombre=%s, segundo_nombre=%s, primer_apellido=%s, segundo_apellido=%s, fijo=%s, celular=%s, direccion=%s, barrio=%s, descripcion=%s WHERE cedula=%s",
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
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"));

  mysql_select_db($database_prueba, $prueba);
  $Result1 = mysql_query($updateSQL, $prueba) or die(mysql_error());

  $updateGoTo = "personas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_clientes = "-1";
if (isset($_GET['cedula'])) {
  $colname_clientes = $_GET['cedula'];
}
mysql_select_db($database_prueba, $prueba);
$query_clientes = sprintf("SELECT * FROM persona WHERE cedula = %s", GetSQLValueString($colname_clientes, "int"));
$clientes = mysql_query($query_clientes, $prueba) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
$totalRows_clientes = mysql_num_rows($clientes);
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

.titulo {
    font-size: 250%;
    color:#ffffff;
    text-align: center;
	margin-top:50px;    
}

#tablacl {
	background-color:#7a0000;
	color:#fff;
	margin-top: 3rem;
}

#barra1 {
    background-color: #7a0000;
    color: white;
    font-size: 130%;
}

#barra2 {
    background-color: #7a0000;
    color: #c0c0c0;
	text-align: center;
    font-size: 100%;
}

#barra3 {
    background-color: #7a0000;
    color: #c0c0c0;
    font-size: 100%;
	border-radius: 30px
}

#botonact {
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
    
    background-color: #05a100;
    
    margin: 10px;
	margin-right: 20px
    
}
#botonact:hover {
    background-color: #9fff51;
    color:#000000;
}


</style>
</head>

<body>
<div id="titulo">
  <div class="titulo">
		Modificaciones
	</div>
</div>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table id="tablacl" align="center">
    <tr valign="baseline">
      <td  id="barra1" nowrap align="right">Cedula:</td>      
      <td id="barra2"><?php echo $row_clientes['cedula']; ?></td>     
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Fecha:</td>
      <td id="barra3"><input type="text" name="fecha" value="<?php echo htmlentities($row_clientes['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Asunto:</td>
      <td id="barra3"><input type="text" name="asunto" value="<?php echo htmlentities($row_clientes['asunto'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Primer_nombre:</td>
      <td id="barra3"><input type="text" name="primer_nombre" value="<?php echo htmlentities($row_clientes['primer_nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Segundo_nombre:</td>
      <td id="barra3"><input type="text" name="segundo_nombre" value="<?php echo htmlentities($row_clientes['segundo_nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Primer_apellido:</td>
      <td id="barra3"><input type="text" name="primer_apellido" value="<?php echo htmlentities($row_clientes['primer_apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Segundo_apellido:</td>
      <td id="barra3"><input type="text" name="segundo_apellido" value="<?php echo htmlentities($row_clientes['segundo_apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Fijo:</td>
      <td id="barra3"><input type="text" name="fijo" value="<?php echo htmlentities($row_clientes['fijo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Celular:</td>
      <td id="barra3"><input type="text" name="celular" value="<?php echo htmlentities($row_clientes['celular'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Direccion:</td>
      <td id="barra3"><input type="text" name="direccion" value="<?php echo htmlentities($row_clientes['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Barrio:</td>
      <td id="barra3"><input type="text" name="barrio" value="<?php echo htmlentities($row_clientes['barrio'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td id="barra1" nowrap align="right">Descripcion:</td>
      <td id="barra3"><input type="text" name="descripcion" value="<?php echo htmlentities($row_clientes['descripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input id="botonact" type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="cedula" value="<?php echo $row_clientes['cedula']; ?>">
</form>
</body>
</html>
<?php
mysql_free_result($clientes);
?>
