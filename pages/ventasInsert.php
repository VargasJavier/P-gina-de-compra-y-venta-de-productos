<?php
  require 'conexion.php';
  session_start();

  // Ingresando la compra
  $idVenta = "user_0002";
  if(!isset($_SESSION['id'])){
    $idVenta = $_SESSION['id'];
  }
  $proveedor = $_POST['selectCliente'];
  $metodoPago = $_POST['selectPago'];
  $objetoFecha = new DateTime();
  $fecha = $objetoFecha->format("Y-m-d h:i:s");
  $fecha = $fecha.".000000";

  $sql = "INSERT INTO `ventas` (`fecha`, `total`, `idVendedor_fk`, `idCliente_fk`, `metodoPago`) VALUES ('$fecha', 0, '$idVenta', $proveedor, '$metodoPago');";
  $resultado = $mysqli->query($sql);

  if($resultado){
    header("Location: menu-ventas2.php");
  }
  else{
    // header("Location: menu.php");
    echo $fecha;
    echo "<br>".$idVenta;
    echo "<br>".$proveedor;
    echo "<br>".$metodoPago;
  }
?>