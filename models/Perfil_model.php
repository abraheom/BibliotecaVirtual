<?php 
	class Perfil_model extends Model {
		function listarCompras($IdUsuario) {
			$consulta = mysql_query("select * from detallecompra inner JOIN compra on compra.id=detallecompra.idcompra inner join productos on detallecompra.producto=productos.Titulo where compra.idcliente='$IdUsuario'")or die("<div class='mensajeError'>La tabla no existe...</div>");
			if(mysql_num_rows($consulta) > 0){
				echo "<div class='divToTable'><table cellspacing='0' cellpading='0' class='tablaReportes'>";
				echo "<tr class='tr-th'><td align='center'><img width='16' src='public/imagenes/icons/frontBook.png'></td><td> Fecha Compra </td><td>Producto</td><td>Cantidad</td><td>Precio</td><td>Total Compra</td></tr>";
				while($reg=mysql_fetch_array($consulta))
				{ 
					echo "<tr class='tr'><td align='center'><img class='portadaLibroReg' src='public/imagenes/Portadas/".$reg['ImgPortada']."'></td><td>".$reg['fecha']."</td><td>".$reg['producto']."</td><td>".$reg['cantidad']."</td><td>$ ".$reg['precio']."</td><td>$ ".($reg['cantidad']*$reg['precio'])."</td></tr>";
				}
				echo "</table></div>";
			}
			else {
				echo "Aun no   compras algun producto...";
			}
		}
	}
?>