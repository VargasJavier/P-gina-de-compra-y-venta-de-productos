<?php
  require 'conexion.php';

  $idDetalle = $_GET['idDetalle'];

  $sql = "DELETE FROM `detalleventas` WHERE `id` = '$idDetalle'";
  $resultado = $mysqli->query($sql);
  if($resultado)
    header("Location: menu-ventas2.php");
  else
    echo "Hola, algo salió mal :/ ".$idDetalle;

?>