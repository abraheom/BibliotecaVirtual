<?php 
	class Carrito_model extends Model {
		function __construct() {
            parent::__construct();
        }
		public function verCarrito(){
		    $qry = MySQLDriver::consulta("select id from productos")or die(mysql_error());
		    if(Session::exist('carro') and count(Session::getValue('carro'))>0) {
		    $carro=Session::getValue('carro');
		    ?>  
		        <div>
		            <table class="tableProductosCarrito" cellspacing="0">
		              <tr>
		                <th align="center">¿?</th>
		                <th align="center">Titulo</th>
		                <th align="center">Precio</th>
		                <th align="center">Cantidad</th>
		                <th align="center">Total</th>
		                <th></th>
		              </tr>
		    <?php
		      $totalPagar=0;
		      while($row = mysql_fetch_array($qry)){
		        if(isset($carro[md5($row['id'])])){
		        $totalPagar += $carro[md5($row['id'])]['totalCompra'];
		        $_SESSION['ValorPagar']=$totalPagar;      
		    ?>
		              <tr>
		                <td><img src="public/imagenes/Portadas/<?php echo ($carro[md5($row['id'])]['imgPortada']); ?>" width="20"></td>
		                <td><?php echo $carro[md5($row['id'])]['titulo']; ?></td>
		                <td align="center"><?php echo $carro[md5($row['id'])]['precio']; ?></td>
		                <td align="center"><div class="divAdmin">
		                  <span class="adminBtn" onclick="reducirProducto(<?php echo $carro[md5($row['id'])]['id']; ?>,<?php echo $carro[md5($row['id'])]['cantidad']; ?>)">-</span>
		                  <span class="cantidadProducto">
		                    <?php echo $carro[md5($row['id'])]['cantidad']; ?>
		                  </span>
		                  <span class="adminBtn" onclick="aumentarProducto(<?php echo $carro[md5($row['id'])]['id']; ?>,<?php echo $carro[md5($row['id'])]['cantidad']; ?>)">+</span>
		                </div>
		                </td>
		                <td align="center"><?php echo $carro[md5($row['id'])]['totalCompra']; ?></td>
		                <td><span class='flaticon-delete81' style="padding:0px 5px;padding-right:10px;cursor:pointer;" title='Quitar del carrito' onclick='removeProduct(this,<?php echo $carro[md5($row['id'])]['id']; ?>)'></span></td>
		              </tr>
		    <?php
		        }
		      }
		      echo "</table></div>";
		      echo "<div class='campoTotal'>Total a pagar $: $totalPagar</div>";
		      echo "<div><input type='button' value='Comprar ahora' class='btnComprarAhora' onclick='getFormPagoCompra()'></div>";
		    }
		    else {
		      echo "<div class='noSelectedProducts'>No ha seleccionado productos</div>";
		    }  
		  }
		  static function agregaCar(){
		      $id = $_POST['Id']; 
		      $cantidad = $_POST['Cantidad'];

		    if(!isset($cantidad)){
		      $cantidad=1;
		    }

		    $qry = MySQLDriver::consulta("select * from productos where id='".$id."'");
		    $row = mysql_fetch_array($qry);

		    if(isset($_SESSION['carro']))
		      $carro = $_SESSION['carro'];

		    $carro[md5($id)]=array( 'identificador'=>md5($id),
		                'cantidad'=>$cantidad,
		                'titulo'=>$row['Titulo'],
		                'precio'=>$row['Precio'],
		                'id'=>$id,
		                'imgPortada'=>$row['ImgPortada'],
		                'totalCompra'=>$row['Precio']*$cantidad
		                );

		    $_SESSION['carro']=$carro;
		    CarritoCompras::verCarrito();
		  }
		  static function borrarCar(){
		    extract($_REQUEST);
		    $carro= $_SESSION['carro'];

		    unset($carro[md5($Id)]);

		    $_SESSION['carro']=$carro;
		    CarritoCompras::verCarrito();
		  }
		  static function pagarCompra(){
		    date_default_timezone_set('UTC');
		    $carro=$_SESSION['carro'];
		    ?>
		    <div class="ventanaEmergente-contenido">
		      <span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		      <div class="titulo-1">Valor a pagar $: <?php echo $_SESSION['ValorPagar']; ?><span>(No incluye IVA.)</span></div>
		      <table cellspacing="5" class="tablaPago">
		        <tr>
		          <td>Nombre segun tarjeta:</td>
		          <td><input type="text" id="NombreSegunTargeta"></td>
		        </tr>
		        <tr>
		          <td>Banco Emisor:</td>
		          <td><input type="text" id="BancoEmisor"></td>
		        </tr>
		        <tr>
		          <td>Numero de tarjeta:</td>
		          <td><input type="text" id="NumeroTargeta" placeholder="Ej: 4242424242424242"></td>
		        </tr>
		        <tr>
		          <td>Tipo de tarjeta:</td>
		          <td>
		            <select name="tipoTargeta" id="TipoTargeta">
		              <option value="visa">Visa</option>
		              <option value="masterCard">Mastercard</option>
		            </select>
		          </td>
		        </tr>
		        <tr>
		          <td>Fecha de Vencimiento:</td>
		          <td>
		            <select name="venceMes" id="venceMes">
		              <?php 
		                $anio = date("Y");
		                for($i=1;$i<=12;$i++){
		                  echo "<option value='$i'>$i</option>";
		                }
		              ?>
		            </select>
		            /
		            <select name="venceAnio" id="venceAnio">
		              <?php 
		                $anio = date("Y");
		                for($i=0;$i<10;$i++){
		                  $a = $anio+$i;
		                  echo "<option value='$a'>$a</option>";
		                }
		              ?>
		            </select>
		          </td>
		        </tr>
		      </table>
		      <div class="divBotonesEdit" align="center">
		        <input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' class="btnEjecutarCompra" value='Ejecutar Compra' onclick='EjecutarCompra()'>
		      </div>
		    </div>
		<?php
		  }
		  static function guardarCompra(){
		    $carro=$_SESSION['carro'];
		    $valorcompra=$_SESSION['ValorPagar'];
		    $iduser=$_SESSION['IdUsuario'];
		    $fecha=@date('Y-m-d H:i:s');
		    extract($_POST);
		    $sql="Insert into compra (idcliente, fecha, valorcompra, 
		estado, nombretc, numerotc, bancotc, tipotc, mestc, aniotc
		) values('$iduser','$fecha', $valorcompra, '0', '$NombreSegunTargeta',
		'$NumeroTargeta', '$BancoEmisor', '$TipoTargeta','$mesv', '$aniov')";
		    MySQLDriver::consulta($sql);
		    //Capturar el id de la compra que se genero
		    $idcompra=mysql_insert_id();

		if ($idcompra>0)
		{
		  foreach($carro as $k => $v)
		  {
		    $pro=$v['titulo'];
		    $pre=$v['precio'];
		    $can=$v['cantidad'];
		    $sqlitem="insert into detallecompra (idcompra, producto, 
		    precio, cantidad) values($idcompra,'$pro',$pre,$can)";
		    mysql_query($sqlitem);
		  }
		  //Y vaciamos el carrito
		  $carro=false;
		  Session::unsetValue('carro');
		?>

		  <div align="center">
		    <span>
		      Compra procesada con exito...
		    </span>
		    <div class="titulo-2">¡Gracias por su compra!</div>
		  </div>
		  <div class="divBotonesEdit" align="center">
		    <input type='button' value='Cerrar' title="Cerrar esta ventana" onclick='ventanaEmergente_Close()'>
		  </div>
		<?php
		}
		else
		{
		  echo '
		    <div align="center">
		      <span>
		        No se pudo procesar tu compra en este momento, Intenta nuevamente...
		      </span>
		    </div>
		    ';
		}
		  }
	}
?>