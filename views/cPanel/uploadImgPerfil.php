<?php
session_start();
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
 
    //obtenemos el archivo a subir
    $file = $_FILES['archivo']['name'];
 
    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("files/")) 
        mkdir("files/", 0777);
     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"files/"."temporalFileImg.jpg"))
    {
        $temName = 'files/temporalFileImg.jpg';
        $fp = fopen($temName, "rb");
        $contenido = fread($fp, filesize($temName));
        $ImgPortada = addslashes($contenido);//se escapan los caracteres especiales
        fclose($fp);

        require "../PHP/database.php";
        mysql_connect($db_host,$db_user,$db_pass);
        mysql_select_db($db_name);
        if(mysql_query("UPDATE  usuarios set ImgPerfil='$ImgPortada' where IdUsuario='$_SESSION[IdUsuario]'")){
            mysql_close();
        }
        echo "files/temporalFileImg.jpg";//devolvemos el nombre del archivo para pintar la imagen
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}
?>