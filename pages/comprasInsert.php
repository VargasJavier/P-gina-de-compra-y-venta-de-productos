<?php
  require 'conexion.php';
  session_start();

  // Ingresando la compra
  $idCompra = "user_0001";
  if(!isset($_SESSION['id'])){
    $idCompra = $_SESSION['id'];
  }
  $cliente = $_POST['selectCliente'];
  $metodoPago = $_POST['selectPago'];
  $objetoFecha = new DateTime();
  $fecha = $objetoFecha->format("Y-m-d h:i:s");
  $fecha = $fecha.".000000";
  $sql = "INSERT INTO `compras` (`fecha`, `total`, `idVendedor_fk`, `idCliente_fk`, `metodoPago`) VALUES ('$fecha', 0, '$idCompra', $cliente, '$metodoPago');";
  $resultado = $mysqli->query($sql);

  if($resultado){
    header("Location: menu-ventas2.php");
  }
  else{
    // header("Location: menu.php");
    echo $fecha;
    echo "<br>".$idCompra;
    echo "<br>".$proveedor;
    echo "<br>".$metodoPago;
  }
?>