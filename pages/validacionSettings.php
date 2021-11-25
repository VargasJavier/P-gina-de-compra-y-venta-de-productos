<?php
  require 'conexion.php';

  $año = date('Y');
  $sql = "SELECT * FROM configuracioncomisiones WHERE año = $año;";
  $resultado = $mysqli->query($sql);
  $num = $resultado->num_rows;
  if($num == 0)
    header("Location: menu2.php");
  else
    header("Location: menu3.php");
?>