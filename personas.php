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

$currentPage = $_SERVER["PHP_SELF"];

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

$queryString_personas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_personas") == false && 
        stristr($param, "totalRows_personas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_personas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_personas = sprintf("&totalRows_personas=%d%s", $totalRows_personas, $queryString_personas);
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

#registro {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 5%;
    height: 20px;
    border: none;
    padding: 5px;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
    margin-left: 40rem;
    
}
#registro:hover {
    background-color: #9fff51;
    color:#000000;
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

.caja2 {
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 1rem;
}

.anterior {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 5%;
    height: 20px;
    border: none;
    padding: 5px;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
    
}
.anterior:hover {
    background-color: #9fff51;
    color:#000000;
}

.siguiente {
    font-family: 'Overpass', sans-serif;
    font-size: 120%;
    font-style: normal;
    color:#ffffff;
    text-decoration: none;
    width: 5%;
    height: 20px;
    border: none;
    padding: 5px;
    
    border-radius: 3px 3px 3px 3px;
    -moz-border-radius: 3px 3px 3px 3px;
    -webkit-border-radius: 3px 3px 3px 3px;
    
    background-color: #7c0000;
    
    margin-top: 10px;
    margin-left: 21rem;
    
}
.siguiente:hover {
    background-color: #9fff51;
    color:#000000;
}

#volver {
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
    
    margin-left: 21rem;
    
}
#volver:hover {
    background-color: #9fff51;
    color:#000000;
}
</style>
</head>

<script type="text/javascript">
function confirmarel(){
	var respuesta = confirm("Estas seguro que deseas eliminar el usuario");
	
	if (respuesta == true){
		return true;}
		else{
			return false;}
}



</script>

<body>
<div class="titulo1">
Nuestros Clientes
</div>

<div id="regis" align="center">
	<a id="registro" href="registro.php">Registro</a>
	<br>
	<br>
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
      <td><a id="elim" onClick="return confirmarel()" href="eliminar.php?cedula=<?php echo $row_personas['cedula']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_personas = mysql_fetch_assoc($personas)); ?>
</table>
</div>

<div class="paginacion" align="center">
  <table class="pagina" width="60%" border="0px">
    <tr>
      <td class="caja1" width="30%"><?php if ($pageNum_personas > 0) { // Show if not first page ?>
          <a class="anterior" href="<?php printf("%s?pageNum_personas=%d%s", $currentPage, max(0, $pageNum_personas - 1), $queryString_personas); ?>">Anterior</a>
          <?php } // Show if not first page ?></td>
      <td class="caja2" style="text-align:center"> Registros <?php echo ($startRow_personas + 1) ?> a <?php echo min($startRow_personas + $maxRows_personas, $totalRows_personas) ?> de <?php echo $totalRows_personas ?></td>
      <td class="caja3" width="30%"><?php if ($pageNum_personas < $totalPages_personas) { // Show if not last page ?>
  <a class="siguiente" href="<?php printf("%s?pageNum_personas=%d%s", $currentPage, min($totalPages_personas, $pageNum_personas + 1), $queryString_personas); ?>">siguiente</a>
  <?php } // Show if not last page ?></td>
      </tr>
  </table>
</div>
<br>
<br>
<br>
<a id="volver" name="volver" type="submit" value="volver" href="privado.php">Volver</a>
</body>
</html>
<?php
mysql_free_result($personas);
?>
