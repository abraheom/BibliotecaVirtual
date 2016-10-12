<?php
class CarritoCompras {
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
}
?>