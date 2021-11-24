<?php
  require 'conexion.php';
  session_start();



  // Ingresando la compra
  if(!isset($_POST))
    header("Location: menu.php");
  $idCompra = 34;
  $producto = $_POST['selectProducto'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $subTotal = $cantidad * $precio;
  $sql1 = "SELECT id, total FROM ventas WHERE id = (SELECT MAX(id) FROM ventas);";
  $result = $mysqli->query($sql1);
  foreach($result as $row){
    $idCompra = $row['id'];
    $total = $row['total'];
  }
  $idDetalleCompra = $idCompra."_".$producto;
  $sql = "INSERT INTO `detalleventas` (`id`, `stock`, `precioUnitario`, `subTotal`, `idVendedor_fk`, `idProducto_fk`) VALUES ('$idDetalleCompra', '$cantidad', '$precio', '$subTotal', $idCompra, '$producto')";
  $resultado = $mysqli->query($sql);
  $subTotalUpdate = $total + $subTotal;
  $sqlUpdate = "UPDATE `ventas` SET `total` = $subTotalUpdate WHERE `id` = $idCompra";
  $result = $mysqli->query($sqlUpdate);
  $sqlProducto = "SELECT cantidad, precio FROM productos WHERE id = $producto";
  $resultadoProducto = $mysqli->query($sqlProducto);
  foreach($resultadoProducto as $row){
    $cantidadProducto = $row['cantidad'];
    $precioProducto = $row['precio'];
  }
  if($cantidadProducto < $cantidad){
    header("Location: menu.php");
    echo "Se superó el número de productos disponibles";
  }else if($cantidadProducto == $cantidad){
    echo "Se agotó el stock de productos";
  }
  $cantidadFinal = $cantidadProducto - $cantidad;
  $precioFinal = ($precio + $precioProducto) / $cantidadFinal;
  $sqlUpdate = "UPDATE `productos` SET `cantidad` = $cantidadFinal, `precio` = $precioFinal  WHERE `id` = $producto";
  $result = $mysqli->query($sqlUpdate);
  if($resultado){
    header("Location: menu-ventas2.php");
  }
  else{
    //header("Location: menu.php");
    echo $idDetalleCompra;
    echo "<br>".$cantidad;
    echo "<br>".$precio;
    echo "<br>".$subTotal;
    echo "<br>".$producto;
  }
?>