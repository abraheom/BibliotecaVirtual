<?php 
$Titulo = $_POST['Titulo'];
$Editorial = $_POST['Editorial'];
$Autor = $_POST['Autor'];
$Idioma = $_POST['Idioma'];
$FechaPublicacion = $_POST['fechaAnio']."-".$_POST['fechaMes']."-".$_POST['fechaDia'];
$Descripcion = $_POST['Descripcion'];
$Precio = $_POST['Precio'];

$temName = 'files/temporalFileImg.jpg';
$fp = fopen($temName, "rb");
$contenido = fread($fp, filesize($temName));
$ImgPortada = addslashes($contenido);//se escapan los caracteres especiales
fclose($fp);

require "../PHP/database.php";
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);
mysql_query("INSERT into productos(Titulo, Editorial, Idioma, FechaPublicacion, Descripcion, Precio, Autor,ImgPortada) values('$Titulo','$Editorial','$Idioma','$FechaPublicacion','$Descripcion','$Precio','$Autor','$ImgPortada')")or die("<div class='mensajeError'>Error al guardar el archivo...</div>");
echo "<div class='mensajeSuccess' onclick='$(this).remove()'>El libro se guardo correctamente...</div>";
?>
