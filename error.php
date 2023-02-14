<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Error</title>
<style>
body {
    font-family: 'Overpass', sans-serif;
    font-weight: normal;
    font-size: 100%;
    color: #1b262c;
    
    margin: 0;
    background-color: #53a83e;
}

#caja {
    background-color: #E4E4E4;
    width: 40%;    
    margin: 0 auto;
    border-radius: 20px;
    padding: 0.5px;
    margin-top: 8rem;
}

#error {
    color: #000000;
    font-size: 1.5rem;
    text-align: center;    
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
    
    margin-top: 10px;
    margin-left: 21rem;
    
}
#volver:hover {
    background-color: #9fff51;
    color:#000000;
}
</style>
</head>

<body>
<div id="caja">
<p id="error">Error, te has equivocado de usuario y contraseña</p>
</div>
<br/>
<br/>
<a id="volver" name="volver" type="submit" value="volver" href="index.php">Volver</a>

</body>
</html>