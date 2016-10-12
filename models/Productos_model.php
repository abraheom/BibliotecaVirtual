<?php 
	class Productos_model extends Model {
		function __construct() {
            parent::__construct();
        }
        public function getBase64(){
        	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
			{
			    $img = file_get_contents($_FILES['archivo']['tmp_name']);
			    $imgdata = base64_encode($img);
			    echo $imgdata;
			}
			else{
			    echo "error";   
			}
        }
        public function generarNombre(){
        	$Nombre="";
        	for($i=0; $i < 20 ; $i++) { 
        		if(rand(0,1))
        			$Nombre.=chr(rand(ord("a"), ord("z")));
        		else
        			$Nombre.=rand(0,9);
        	}
        	return $Nombre;
        }
        public function guardarLibro(){
        	$Titulo = $_POST['Titulo'];
			$Editorial = $_POST['Editorial'];
			$Autor = $_POST['Autor'];
			$Idioma = $_POST['Idioma'];
			$FechaPublicacion = $_POST['fechaAnio']."-".$_POST['fechaMes']."-".$_POST['fechaDia'];
			$Descripcion = $_POST['Descripcion'];
			$Precio = $_POST['Precio'];
			$ImgPortada=Productos_model::generarNombre().".jpg";

			$file = $_FILES['archivo']['name'];

    		//Comprobacion de subida del archivo
		    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"public/imagenes/Portadas/".$ImgPortada))
		    {
				MySQLDriver::consulta("INSERT into productos(Titulo, Editorial, Idioma, FechaPublicacion, Descripcion, Precio, Autor,ImgPortada) values('$Titulo','$Editorial','$Idioma','$FechaPublicacion','$Descripcion','$Precio','$Autor','$ImgPortada')");
				echo "<div class='mensajeSuccess' onclick='$(this).remove()'>El libro se guardo correctamente...</div>";
        	}
    	}
		public function ObtenerProductos(){
			$consulta = MySQLDriver::consulta("select * from productos");
			$recent = 0;
			while($reg = mysql_fetch_array($consulta)){
				?>
							<div class="producto">
				<?php
				$recent++;
					if($recent<=4)
								echo "<div class='etiquetaNuevo'>NUEVO</div>";
				?>
								<div class="portadaProducto">
									<img width="120" height="178" src="public/imagenes/Portadas/<?php echo $reg['ImgPortada']; ?>">
								</div>
								<div class="infoProducto">
									<label class="proTitulo1">Titulo: </label><label class="proTitulo2"><?php echo $reg['Titulo']; ?></label>
									<br>
									<label class="proTitulo1">Autor: </label><label class="proTitulo2"><?php echo $reg['Autor']; ?></label>
								</div>
				<?php 
					if(isset($_SESSION['IdUsuario'])){
						if(isset($_SESSION['carro']) and isset($_SESSION['carro'][md5($reg['Id'])])){
				?>
								<div class="btnRemoveToCar" data-objetoproductoid="<?php echo $reg['Id'] ?>" onclick="addToCar(this,<?php echo $reg['Id'] ?>,1)">
									<span>-</span> Quitar del carrito
								</div>
				<?php
						}
						else {
				?>
								<div class="btnAddToCar" data-objetoproductoid="<?php echo $reg['Id'] ?>" onclick="addToCar(this,<?php echo $reg['Id'] ?>,1)">
									<span>+</span> Añadir al Carrito
								</div>
				<?php
						}
					}
					else {
				?>
								<div class="btnAddToCar" onclick="focusLogin()">
									<span>+</span> Añadir al Carrito
								</div>
				<?php
					}
				?>
							</div>
				<?php
			}
		}//Fin ObtenerProductos
	}
?>