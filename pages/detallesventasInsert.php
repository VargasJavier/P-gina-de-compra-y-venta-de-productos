<?php
  require 'conexion.php';
  session_start();



  // Ingresando la compra
  if(!isset($_POST))
    header("Location: menu.php");

  if($_POST['selectProducto'] == 0)
    header("Location: menu-ventas2.php");  

  $idVenta = 34;
  $producto = $_POST['selectProducto'];
  $cantidad = $_POST['cantidad'];
  $sqlPrecio = "SELECT precio FROM productos WHERE id = $producto;";
  $resultadoPrecio = $mysqli->query($sqlPrecio);
  $precio = $resultadoPrecio->fetch_array()[0] ?? 0;
  $año = date('Y');
  $sqlPrecioVenta = "SELECT porcentajeVenta FROM configuracioncomisiones WHERE año = $año";
  $resultadoPrecioVenta = $mysqli->query($sqlPrecioVenta);
  $precioVenta = $resultadoPrecioVenta->fetch_array()[0] ?? 0;
  //$precio = $_POST['precio'];
  // Suma las comisiones
  $precio += ($precio * $precioVenta) / 100; 
  
  $subTotal = $cantidad * $precio;
  $sql1 = "SELECT id, total FROM ventas WHERE id = (SELECT MAX(id) FROM ventas);";
  $result = $mysqli->query($sql1);
  foreach($result as $row){
    $idVenta = $row['id'];
    $total = $row['total'];
  }
  $idDetalleVenta = $idVenta."_".$producto;
  $sqlValidacion = "SELECT id FROM detalleventas WHERE id = '$idDetalleVenta'";
  $resultadoValidacion = $mysqli->query($sqlValidacion);
  $num = $resultadoValidacion->num_rows;
    
  if($num>0){
    $precioModificado = $cantidad * $precio;
    $sqlUpdateDetalle = "UPDATE `detalleventas` SET `stock` = $cantidad, `subTotal` = $precioModificado WHERE `id` = $idVenta";
    $resultadoDetalle = $mysqli->query($sqlUpdateDetalle);
    header("Location: menu-ventas2.php");
  }

  $sqlProducto = "SELECT cantidad FROM productos WHERE id = $producto";
  $resultadoProducto = $mysqli->query($sqlProducto);
  foreach($resultadoProducto as $row){
    $cantidadProducto = $row['cantidad'];
  }
  if($cantidadProducto < $cantidad){
    header("Location: menu-ventas2.php");
    echo "Se superó el número de productos disponibles. Intente nuevamente";
  }
  $sql = "INSERT INTO `detalleventas` (`id`, `stock`, `precioUnitario`, `subTotal`, `idVenta_fk`, `idProducto_fk`) VALUES ('$idDetalleVenta', $cantidad, $precio, $subTotal, $idVenta, $producto);";
  $resultado = $mysqli->query($sql);
  $subTotalUpdate = $total + $subTotal;
  $sqlUpdate = "UPDATE `ventas` SET `total` = $subTotalUpdate WHERE `id` = $idVenta";
  $result = $mysqli->query($sqlUpdate);
  $cantidadFinal = $cantidadProducto - $cantidad;
  $sqlUpdate = "UPDATE `productos` SET `cantidad` = $cantidadFinal WHERE `id` = $producto";
  $result = $mysqli->query($sqlUpdate);
  if($resultado){
    header("Location: menu-ventas2.php");
    if($cantidadProducto == $cantidad) echo "Se agotó el stock de productos";
  }
  else{
    //header("Location: menu.php");
    echo $idDetalleVenta;
    echo "<br>".$cantidad;
    echo "<br>".$precio;
    echo "<br>".$precioVenta;
    echo "<br>".$subTotal;
    echo "<br>".$producto;
    echo "<br>".$idVenta;
  }
?>