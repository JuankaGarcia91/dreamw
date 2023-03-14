<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
</head>
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
</style>

<body>
<div class="titulo1">
Menu

</div>
<br>
<br>
<ul id="MenuBar1" class="MenuBarHorizontal" >
  <li><a class="MenuBarItemSubmenu1" href="#">Tablas</a>
    <ul>
      <li><a href="privado.php">Usuarios</a></li>
      <li><a href="personas.php">Personas</a></li>
    </ul>
  </li>
  <li><a class="MenuBarItemSubmenu2" href="#">Acciones</a>
    <ul>
      <li><a href="registro1.php">Registrar</a></li>
      <li><a href="modificar.php">Modificar</a></li>
    </ul>
  </li>  
</ul>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>