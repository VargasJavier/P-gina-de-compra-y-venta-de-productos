<?php
  require 'conexion.php';
  session_start();



  // Ingresando la compra
  if(!isset($_POST))
    header("Location: menu-contraseña.php");
  $idCompra = 34;
  $producto = $_POST['selectProducto'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $subTotal = $cantidad * $precio;
  $sql1 = "SELECT id, Total FROM compras WHERE id = (SELECT MAX(id) FROM compras);";
  $result = $mysqli->query($sql1);
  foreach($result as $row){
    $idCompra = $row['id'];
    $total = $row['Total'];
  }
  $idDetalleCompra = $idCompra."_".$producto;
  $sql = "INSERT INTO `detallecompras` (`id`, `stock`, `precioUnitario`, `subTotal`, `idCompra_fk`, `idProducto_fk`) VALUES ('$idDetalleCompra', '$cantidad', '$precio', '$subTotal', $idCompra, '$producto')";
  $resultado = $mysqli->query($sql);
  $subTotalUpdate = $total + $subTotal;
  $sqlUpdate = "UPDATE `compras` SET `Total` = $subTotalUpdate WHERE `id` = $idCompra";
  $result = $mysqli->query($sqlUpdate);
  if($resultado){
    header("Location: menu-compras2.php");
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