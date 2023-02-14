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

$maxRows_personas = 10;
$pageNum_personas = 0;
if (isset($_GET['pageNum_personas'])) {
  $pageNum_personas = $_GET['pageNum_personas'];
}
$startRow_personas = $pageNum_personas * $maxRows_personas;

mysql_select_db($database_prueba, $prueba);
$query_personas = "SELECT * FROM persona";
$query_limit_personas = sprintf("%s LIMIT %d, %d", $query_personas, $startRow_personas, $maxRows_personas);
$personas = mysql_query($query_limit_personas, $prueba) or die(mysql_error());
$row_personas = mysql_fetch_assoc($personas);

if (isset($_GET['totalRows_personas'])) {
  $totalRows_personas = $_GET['totalRows_personas'];
} else {
  $all_personas = mysql_query($query_personas);
  $totalRows_personas = mysql_num_rows($all_personas);
}
$totalPages_personas = ceil($totalRows_personas/$maxRows_personas)-1;
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

.titulo1 {
    font-size: 250%;
    color:#ffffff;
    text-align: center;
	margin-top:50px;    
}

#table2 {
	border: 1px
}

#table2 {    
    background-color: #aaaaaa;    
    width: 30rem;
    border: none;
    margin: 0 auto;
	margin-top: 2rem;
	margin-bottom:2rem
}

.barra1 {
    background-color: #7a0000;
    color: white;
    text-align: center;
    font-size: 100%;
}

.barra2 {    
    color: rgb(0, 0, 0);
    text-align: left;
    font-size: 90%;
}

#modif {
	text-decoration:none;
	color: #7a0000;
}

#elim {
	text-decoration:none;
	color: #7a0000;
}
</style>
</head>

<body>
<div class="titulo1">
Nuestros Clientes
</div>
<div id="contenedor">
<table id="table2" border="1">
  <tr class="barra1">
    <td>Cedula</td>
    <td>Fecha</td>
    <td>Asunto</td>
    <td>Primer_nombre</td>
    <td>Segundo_nombre</td>
    <td>Primer_apellido</td>
    <td>Segundo_apellido</td>
    <td>Fijo</td>
    <td>Celular</td>
    <td>Direccion</td>
    <td>Barrio</td>
    <td>Descripcion</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr class="barra2">
      <td><?php echo $row_personas['cedula']; ?></td>
      <td><?php echo $row_personas['fecha']; ?></td>
      <td><?php echo $row_personas['asunto']; ?></td>
      <td><?php echo $row_personas['primer_nombre']; ?></td>
      <td><?php echo $row_personas['segundo_nombre']; ?></td>
      <td><?php echo $row_personas['primer_apellido']; ?></td>
      <td><?php echo $row_personas['segundo_apellido']; ?></td>
      <td><?php echo $row_personas['fijo']; ?></td>
      <td><?php echo $row_personas['celular']; ?></td>
      <td><?php echo $row_personas['direccion']; ?></td>
      <td><?php echo $row_personas['barrio']; ?></td>
      <td><?php echo $row_personas['descripcion']; ?></td>
      <td><a id="modif" href="modificar.php?cedula=<?php echo $row_personas['cedula']; ?>">Modificar</a></td>
      <td><a id="elim" href="eliminar.php?cedula=<?php echo $row_personas['cedula']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_personas = mysql_fetch_assoc($personas)); ?>
</table>
</div>
</body>
</html>
<?php
mysql_free_result($personas);
?>
