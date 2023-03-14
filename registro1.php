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
  $insertSQL = sprintf("INSERT INTO persona (cedula, fecha, asunto, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fijo, celular, direccion, barrio, descripcion, pais, estado, ciudad, proceso) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "text"),
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
                       GetSQLValueString($_POST['pais'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['ciudad'], "text"),
					   GetSQLValueString($_POST['proceso'], "text"));

  mysql_select_db($database_prueba, $prueba);
  $Result1 = mysql_query($insertSQL, $prueba) or die(mysql_error());

  $insertGoTo = "personas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_prueba, $prueba);
$query_listabarrio = "SELECT * FROM barrios";
$listabarrio = mysql_query($query_listabarrio, $prueba) or die(mysql_error());
$row_listabarrio = mysql_fetch_assoc($listabarrio);
$totalRows_listabarrio = mysql_num_rows($listabarrio);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	cargar_paises();
	$("#pais").change(function(){dependencia_estado();});
	$("#estado").change(function(){dependencia_ciudad();});
	$("#estado").attr("disabled",true);
	$("#ciudad").attr("disabled",true);
});

function cargar_paises()
{
	$.get("scripts/cargar-paises.php", function(resultado){
		if(resultado == false)
		{
			alert("Error");
		}
		else
		{
			$('#pais').append(resultado);			
		}
	});	
}
function dependencia_estado()
{
	var code = $("#pais").val();
	$.get("scripts/dependencia-estado.php", { code: code },
		function(resultado)
		{
			if(resultado == false)
			{
				alert("Error");
			}
			else
			{
				$("#estado").attr("disabled",false);
				document.getElementById("estado").options.length=1;
				$('#estado').append(resultado);			
			}
		}

	);
}

function dependencia_ciudad()
{
	var code = $("#estado").val();
	$.get("scripts/dependencia-ciudades.php?", { code: code }, function(resultado){
		if(resultado == false)
		{
			alert("Error");
		}
		else
		{
			$("#ciudad").attr("disabled",false);
			document.getElementById("ciudad").options.length=1;
			$('#ciudad').append(resultado);			
		}
	});	
	
}
</script>
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
      <td><input type="number" name="cedula" value="" size="32" required></td>
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
      <td><input type="number" name="fijo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Celular:</td>
      <td><input type="number" name="celular" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Proceso:</td>
      <td><input type="text" name="proceso" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Barrio:</td>
      <td><select name="barrio">
        <?php
do {  
?>
        <option value="<?php echo $row_listabarrio['cod_barrio']?>"><?php echo $row_listabarrio['nom_barrio']?></option>
        <?php
} while ($row_listabarrio = mysql_fetch_assoc($listabarrio));
  $rows = mysql_num_rows($listabarrio);
  if($rows > 0) {
      mysql_data_seek($listabarrio, 0);
	  $row_listabarrio = mysql_fetch_assoc($listabarrio);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Descripcion:</td>
      <td><input type="text" name="descripcion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Pais:</td>
      <td><select id="pais" name="pais">
            <option value="0">Selecciona Uno...</option>
        </select>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Estado:</td>
      <td><select id="estado" name="estado">
            <option value="0">Selecciona Uno...</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ciudad:</td>
      <td><select id="ciudad" name="ciudad">
            <option value="0">Selecciona Uno...</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input id="inregis" type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($listabarrio);
?>
