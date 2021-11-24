<?php
  require 'conexion.php';
  session_start();

  // Ingresando la compra
  $idCompra = "user_0001";
  if(!isset($_SESSION['id'])){
    $idCompra = $_SESSION['id'];
  }
  $proveedor = $_POST['selectProveedor'];
  $metodoPago = $_POST['selectPago'];
  $objetoFecha = new DateTime();
  $fecha = $objetoFecha->format("Y-m-d h:i:s");
  $fecha = $fecha.".000000";
  $sql = "INSERT INTO `compras` (`fecha`, `Total`, `idAdmin_fk`, `idProveedor_fk`, `metodoPago`) VALUES ('$fecha', 0, '$idCompra', $proveedor, '$metodoPago');";
  $resultado = $mysqli->query($sql);

  if($resultado){
    header("Location: menu-compras2.php");
  }
  else{
    // header("Location: menu.php");
    echo $fecha;
    echo "<br>".$idCompra;
    echo "<br>".$proveedor;
    echo "<br>".$metodoPago;
  }
?>